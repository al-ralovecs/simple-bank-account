<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Request;

use Component\Account\Criteria\GetUserAccountListCriteriaInterface;
use Component\Pagination\Request\PaginatedRequest;

final class GetUserAccountListRequest extends PaginatedRequest implements GetUserAccountListCriteriaInterface
{
    public function __construct(
        private readonly string $userId,
        ?int $limit,
        ?int $offset,
    ) {
        parent::__construct($limit, $offset);
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
