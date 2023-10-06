<?php

declare(strict_types=1);

namespace Component\Transaction\Operator;

use DateTimeImmutable;
use Money\Money;

interface CreateTransactionCriteriaInterface
{
    public function sourceAccount(): string;

    public function sourceAmount(): Money;

    public function targetAccount(): string;

    public function targetAmount(): Money;

    public function operationTime(): DateTimeImmutable;
}
