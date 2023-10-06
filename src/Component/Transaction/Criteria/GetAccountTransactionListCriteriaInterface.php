<?php

declare(strict_types=1);

namespace Component\Transaction\Criteria;

use Component\Pagination\Criteria\PaginatedCriteriaInterface;

interface GetAccountTransactionListCriteriaInterface extends PaginatedCriteriaInterface
{
    public function accountId(): string;
}
