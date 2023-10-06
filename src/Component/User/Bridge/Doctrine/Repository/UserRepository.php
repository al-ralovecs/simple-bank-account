<?php

declare(strict_types=1);

namespace Component\User\Bridge\Doctrine\Repository;

use Component\User\Criteria\GetUserListCriteriaInterface;
use Component\User\Exception\UserDoesNotExistException;
use Component\User\Model\User;
use Component\User\Operator\UserFetcherInterface;
use Component\User\Operator\UserInterface;
use Component\User\Operator\UserPersisterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\PagerfantaInterface;

/**
 * @extends ServiceEntityRepository<UserInterface>
 */
final class UserRepository extends ServiceEntityRepository implements UserFetcherInterface, UserPersisterInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getById(string $userId): UserInterface
    {
        /** @var ?UserInterface $user */
        $user = $this->find($userId);
        if (null === $user) {
            throw UserDoesNotExistException::missingId($userId);
        }

        return $user;
    }

    public function findByEmail(string $userEmail): ?UserInterface
    {
        return $this->findOneBy(['email' => $userEmail]);
    }

    /**
     * @return PagerfantaInterface<UserInterface>
     */
    public function findByCriteria(GetUserListCriteriaInterface $criteria): PagerfantaInterface
    {
        ($qb = $this->createQueryBuilder('u'))
            ->setFirstResult($criteria->offset())
            ->setMaxResults($criteria->limit())
            ->addOrderBy('u.id', 'DESC');

        return new Pagerfanta(new QueryAdapter($qb, false, false));
    }

    public function save(UserInterface ...$users): void
    {
        foreach ($users as $user) {
            $this->getEntityManager()->persist($user);
        }

        $this->getEntityManager()->flush();
    }
}
