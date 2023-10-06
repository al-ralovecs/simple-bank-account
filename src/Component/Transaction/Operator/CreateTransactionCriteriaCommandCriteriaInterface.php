<?php

declare(strict_types=1);

namespace Component\Transaction\Operator;

use Money\Money;

interface CreateTransactionCriteriaCommandCriteriaInterface
{
    public function sourceAccount(): string;

    public function targetAccount(): string;

    public function amount(): Money;
}
