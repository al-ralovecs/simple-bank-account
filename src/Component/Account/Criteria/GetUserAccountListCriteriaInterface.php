<?php

declare(strict_types=1);

namespace Component\Account\Criteria;

use Component\Pagination\Criteria\PaginatedCriteriaInterface;

interface GetUserAccountListCriteriaInterface extends PaginatedCriteriaInterface
{
    public function userId(): string;
}
