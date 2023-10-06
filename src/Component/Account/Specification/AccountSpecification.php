<?php

declare(strict_types=1);

namespace Component\Account\Specification;

use Component\Account\Operator\AccountSpecificationInterface;
use DateTimeImmutable;
use Money\Currency;

final readonly class AccountSpecification implements AccountSpecificationInterface
{
    public function __construct(
        private string $id,
        private Currency $currency,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
