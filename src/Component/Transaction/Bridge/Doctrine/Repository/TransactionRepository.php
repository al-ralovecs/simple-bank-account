<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Doctrine\Repository;

use Component\Transaction\Criteria\GetAccountTransactionListCriteriaInterface;
use Component\Transaction\Model\Transaction;
use Component\Transaction\Model\TransactionInterface;
use Component\Transaction\Operator\TransactionIteratorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\PagerfantaInterface;

/**
 * @extends ServiceEntityRepository<TransactionInterface>
 */
final class TransactionRepository extends ServiceEntityRepository implements TransactionIteratorInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    /**
     * @return PagerfantaInterface<TransactionInterface>
     */
    public function findByCriteria(GetAccountTransactionListCriteriaInterface $criteria): PagerfantaInterface
    {
        ($qb = $this->createQueryBuilder('t'))
            ->addSelect('t')
            ->andWhere($qb->expr()->eq('t.account', $qb->expr()->literal($criteria->accountId())))
            ->orderBy('t.id');

        return new Pagerfanta(new QueryAdapter($qb, false, false));
    }
}
