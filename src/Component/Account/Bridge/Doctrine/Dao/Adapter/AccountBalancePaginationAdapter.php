<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Doctrine\Dao\Adapter;

use Component\Account\Bridge\Doctrine\Dao\Result\AccountBalanceDaoResult;
use Doctrine\DBAL\Query\QueryBuilder;
use Pagerfanta\Doctrine\DBAL\QueryAdapter;

/**
 * @extends QueryAdapter<AccountBalanceDaoResult>
 */
final class AccountBalancePaginationAdapter extends QueryAdapter
{
    public function __construct(
        private readonly QueryBuilder $queryBuilder,
        private readonly int $limit = PHP_INT_MAX,
    ) {
        parent::__construct($queryBuilder, static function (QueryBuilder $queryBuilder): void {
            $queryBuilder
                ->select('COUNT(*)')
                ->resetQueryParts(['orderBy', 'join', 'groupBy']);
        });
    }

    /**
     * @return iterable<int, AccountBalanceDaoResult>
     */
    public function getSlice(int $offset, int $length): iterable
    {
        $results = (clone $this->queryBuilder)
            ->setMaxResults(min($length, $this->limit))
            ->setFirstResult($offset)
            ->executeQuery()
            ->fetchAllAssociative();

        return array_map(AccountBalanceDaoResult::create(...), $results);
    }
}
