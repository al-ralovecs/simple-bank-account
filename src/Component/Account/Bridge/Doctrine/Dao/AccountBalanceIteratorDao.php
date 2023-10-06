<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Doctrine\Dao;

use Component\Account\Bridge\Doctrine\Dao\Adapter\AccountBalancePaginationAdapter;
use Component\Account\Criteria\GetUserAccountListCriteriaInterface;
use Component\Account\Operator\AccountBalanceInterface;
use Component\Account\Operator\AccountIteratorInterface;
use Doctrine\DBAL\Connection;
use Pagerfanta\Pagerfanta;
use Pagerfanta\PagerfantaInterface;

final readonly class AccountBalanceIteratorDao implements AccountIteratorInterface
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    /**
     * @return PagerfantaInterface<AccountBalanceInterface>
     */
    public function findByCriteria(GetUserAccountListCriteriaInterface $criteria): PagerfantaInterface
    {
        ($qb = $this->connection->createQueryBuilder())
            ->addSelect(
                'a.id',
                'a.currency',
                'SUM(t.amount) AS balance',
                'a.created_at',
            )
            ->from('account', 'a')
            ->leftJoin('a', 'transaction', 't', 'a.id = t.account_id')
            ->andWhere($qb->expr()->eq('a.user_id', $qb->expr()->literal($criteria->userId())))
            ->addGroupBy('a.id')
            ->addOrderBy('a.id', 'DESC');

        return new Pagerfanta(new AccountBalancePaginationAdapter($qb, $criteria->limit()));
    }
}
