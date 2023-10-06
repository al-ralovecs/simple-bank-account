<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Doctrine\Dao;

use Component\Account\Operator\AccountBalanceFetcherInterface;
use Doctrine\DBAL\Connection;

final readonly class AccountBalanceFetcherDao implements AccountBalanceFetcherInterface
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    public function accountBalance(string $accountId): int
    {
        /** @var numeric-string|false $result */
        $result = ($qb = $this->connection->createQueryBuilder())
            ->addSelect('SUM(t.amount)')
            ->from('transaction', 't')
            ->andWhere($qb->expr()->eq('t.account_id', $qb->expr()->literal($accountId)))
            ->executeQuery()
            ->fetchOne();

        return (false === $result) ? 0 : (int) $result;
    }
}
