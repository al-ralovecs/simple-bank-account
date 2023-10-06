<?php

declare(strict_types=1);

namespace Component\Transaction\Command;

use Component\Account\Operator\AccountInterface;
use DateTimeImmutable;
use Money\Money;

final readonly class CreateTransactionCriteriaCommand
{
    public function __construct(
        private AccountInterface $sourceAccount,
        private AccountInterface $targetAccount,
        private Money $amount,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function sourceAccount(): AccountInterface
    {
        return $this->sourceAccount;
    }

    public function targetAccount(): AccountInterface
    {
        return $this->targetAccount;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
