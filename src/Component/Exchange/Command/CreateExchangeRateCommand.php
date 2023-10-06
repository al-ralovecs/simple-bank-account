<?php

declare(strict_types=1);

namespace Component\Exchange\Command;

use Component\Exchange\Specification\ExchangeRateSpecificationInterface;

final readonly class CreateExchangeRateCommand
{
    public function __construct(
        private ExchangeRateSpecificationInterface $specification,
    ) {
    }

    public function specification(): ExchangeRateSpecificationInterface
    {
        return $this->specification;
    }
}
