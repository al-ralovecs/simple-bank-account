<?php

declare(strict_types=1);

namespace Component\Transaction\Command;

use Component\Transaction\Specification\TransactionSpecificationInterface;

final readonly class CreateTransactionCommand
{
    public function __construct(
        private TransactionSpecificationInterface $specification,
    ) {
    }

    public function specification(): TransactionSpecificationInterface
    {
        return $this->specification;
    }
}
