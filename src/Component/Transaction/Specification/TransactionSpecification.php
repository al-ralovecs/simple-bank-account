<?php

declare(strict_types=1);

namespace Component\Transaction\Specification;

use Component\Account\Operator\AccountInterface;
use DateTimeImmutable;
use Money\Money;

final readonly class TransactionSpecification implements TransactionSpecificationInterface
{
    public function __construct(
        private string $id,
        private Money $amount,
        private string $sourceAccount,
        private AccountInterface $account,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function sourceAccount(): string
    {
        return $this->sourceAccount;
    }

    public function account(): AccountInterface
    {
        return $this->account;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
