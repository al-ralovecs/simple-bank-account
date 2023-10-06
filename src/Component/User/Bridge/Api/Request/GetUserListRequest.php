<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Request;

use Component\Pagination\Request\PaginatedRequest;
use Component\User\Criteria\GetUserListCriteriaInterface;

final class GetUserListRequest extends PaginatedRequest implements GetUserListCriteriaInterface
{
    public function __construct(
        ?int $limit,
        ?int $offset,
    ) {
        parent::__construct($limit, $offset);
    }
}
