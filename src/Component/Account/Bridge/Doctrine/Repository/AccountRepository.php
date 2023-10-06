<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Doctrine\Repository;

use Component\Account\Exception\AccountDoesNotExistException;
use Component\Account\Model\Account;
use Component\Account\Operator\AccountFetcherInterface;
use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountPersisterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountInterface>
 */
final class AccountRepository extends ServiceEntityRepository implements AccountFetcherInterface, AccountPersisterInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function getById(string $accountId): AccountInterface
    {
        /** @var ?AccountInterface $account */
        $account = $this->find($accountId);
        if (null === $account) {
            throw AccountDoesNotExistException::missingId($accountId);
        }

        return $account;
    }

    public function save(AccountInterface ...$accounts): void
    {
        foreach ($accounts as $account) {
            $this->getEntityManager()->persist($account);
        }

        $this->getEntityManager()->flush();
    }
}
