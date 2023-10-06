<?php

declare(strict_types=1);

namespace Component\Account\Operator;

use DateTimeImmutable;
use Money\Money;

interface AccountBalanceInterface
{
    public function id(): string;

    public function balance(): Money;

    public function createdAt(): DateTimeImmutable;
}
