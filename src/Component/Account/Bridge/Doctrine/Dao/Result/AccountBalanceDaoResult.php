<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Doctrine\Dao\Result;

use Component\Account\Operator\AccountBalanceInterface;
use DateTimeImmutable;
use Exception;
use Money\Currency;
use Money\Money;

final readonly class AccountBalanceDaoResult implements AccountBalanceInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        private array $data,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function create(array $data): self
    {
        return new self($data);
    }

    public function id(): string
    {
        /** @var string $id */
        $id = $this->data['id'];

        return $id;
    }

    public function balance(): Money
    {
        /** @var numeric-string $amount */
        $amount = $this->data['balance'] ?? '0';
        /** @var non-empty-string $currency */
        $currency = $this->data['currency'];

        return new Money($amount, new Currency($currency));
    }

    /**
     * @throws Exception
     */
    public function createdAt(): DateTimeImmutable
    {
        /** @var string $createdAt */
        $createdAt = $this->data['created_at'];

        return new DateTimeImmutable($createdAt);
    }
}
