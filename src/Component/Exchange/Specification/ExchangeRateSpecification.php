<?php

declare(strict_types=1);

namespace Component\Exchange\Specification;

use DateTimeImmutable;
use Money\Currency;

final readonly class ExchangeRateSpecification implements ExchangeRateSpecificationInterface
{
    public function __construct(
        private Currency $baseCurrency,
        private Currency $counterCurrency,
        /** @var numeric-string $ratio */
        private string $ratio,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function baseCurrency(): Currency
    {
        return $this->baseCurrency;
    }

    public function counterCurrency(): Currency
    {
        return $this->counterCurrency;
    }

    /**
     * @return numeric-string
     */
    public function ratio(): string
    {
        return $this->ratio;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
