<?php

declare(strict_types=1);

namespace Component\Pagination\Criteria;

abstract class AbstractPaginatedCriteria implements PaginatedCriteriaInterface
{
    public ?int $limit;
    public ?int $offset;

    public function limit(): int
    {
        $limit = $this->limit ?? $this->defaultLimit();

        return $limit < 1 || $limit > $this->maxLimit() ? $this->maxLimit() : $limit;
    }

    public function offset(): int
    {
        return max($this->offset ?? 0, 0);
    }

    public function perPage(): int
    {
        return $this->limit();
    }

    public function pageNumber(): int
    {
        return (int) floor($this->offset() / $this->perPage()) + 1;
    }

    protected function defaultLimit(): int
    {
        return 10;
    }

    protected function maxLimit(): int
    {
        return 100;
    }
}
