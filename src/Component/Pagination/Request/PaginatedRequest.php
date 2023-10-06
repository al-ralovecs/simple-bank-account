<?php

declare(strict_types=1);

namespace Component\Pagination\Request;

use Component\Pagination\Criteria\AbstractPaginatedCriteria;
use Symfony\Component\Validator\Constraints as Assert;

class PaginatedRequest extends AbstractPaginatedCriteria
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\Type('integer'),
            new Assert\Range(min: 1, max: 100),
        ])]
        public ?int $limit,

        #[Assert\Sequentially([
            new Assert\Type('integer'),
            new Assert\Range(min: 0),
        ])]
        public ?int $offset,
    ) {
    }
}
