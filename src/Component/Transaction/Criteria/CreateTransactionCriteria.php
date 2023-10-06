<?php

declare(strict_types=1);

namespace Component\Transaction\Criteria;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use DateTimeImmutable;
use Money\Money;

final readonly class CreateTransactionCriteria implements CreateTransactionCriteriaInterface
{
    public function __construct(
        private string $sourceAccount,
        private Money $sourceAmount,
        private string $targetAccount,
        private Money $targetAmount,
        private DateTimeImmutable $operationTime,
    ) {
    }

    public function sourceAccount(): string
    {
        return $this->sourceAccount;
    }

    public function sourceAmount(): Money
    {
        return $this->sourceAmount;
    }

    public function targetAccount(): string
    {
        return $this->targetAccount;
    }

    public function targetAmount(): Money
    {
        return $this->targetAmount;
    }

    public function operationTime(): DateTimeImmutable
    {
        return $this->operationTime;
    }
}
