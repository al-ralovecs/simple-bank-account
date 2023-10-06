<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Api\Request;

use Component\Pagination\Request\PaginatedRequest;
use Component\Transaction\Criteria\GetAccountTransactionListCriteriaInterface;

final class GetAccountTransactionListRequest extends PaginatedRequest implements GetAccountTransactionListCriteriaInterface
{
    public function __construct(
        private readonly string $accountId,
        ?int $limit,
        ?int $offset,
    ) {
        parent::__construct($limit, $offset);
    }

    public function accountId(): string
    {
        return $this->accountId;
    }
}
