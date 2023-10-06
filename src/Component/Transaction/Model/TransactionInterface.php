<?php

declare(strict_types=1);

namespace Component\Transaction\Model;

use Component\Account\Operator\AccountInterface;
use DateTimeImmutable;
use Money\Money;

interface TransactionInterface
{
    public function id(): string;

    public function amount(): Money;

    public function sourceAccount(): string;

    public function account(): AccountInterface;

    public function createdAt(): DateTimeImmutable;
}
