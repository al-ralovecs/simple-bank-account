<?php

declare(strict_types=1);

namespace Component\Pagination\Criteria;

interface PaginatedCriteriaInterface
{
    public function limit(): int;

    public function offset(): int;

    public function perPage(): int;

    public function pageNumber(): int;
}
