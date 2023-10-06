<?php

declare(strict_types=1);

namespace Component\Transaction\Model;

use Component\Account\Operator\AccountInterface;
use Component\Transaction\Command\CreateTransactionCommand;
use DateTimeImmutable;
use Money\Currency;
use Money\Money;

readonly class Transaction implements TransactionInterface
{
    public function __construct(
        private string $id,
        /** @var numeric-string $amount */
        private string $amount,
        /** @var non-empty-string $currency */
        private string $currency,
        private string $sourceAccount,
        private AccountInterface $account,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public static function create(CreateTransactionCommand $command): self
    {
        return new self(
            $command->specification()->id(),
            $command->specification()->amount()->getAmount(),
            $command->specification()->amount()->getCurrency()->getCode(),
            $command->specification()->sourceAccount(),
            $command->specification()->account(),
            $command->specification()->createdAt(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function amount(): Money
    {
        return new Money($this->amount, new Currency($this->currency));
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
