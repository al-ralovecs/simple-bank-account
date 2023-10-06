<?php

declare(strict_types=1);

namespace Component\Account\Operator;

use DateTimeImmutable;
use Money\Currency;

interface AccountSpecificationInterface
{
    public function id(): string;

    public function currency(): Currency;

    public function createdAt(): DateTimeImmutable;
}
