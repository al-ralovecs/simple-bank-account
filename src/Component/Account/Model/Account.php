<?php

declare(strict_types=1);

namespace Component\Account\Model;

use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountSpecificationInterface;
use Component\User\Operator\UserInterface;
use DateTimeImmutable;
use Money\Currency;

class Account implements AccountInterface
{
    public function __construct(
        private readonly string $id,
        /** @var non-empty-string $currency */
        private readonly string $currency,
        private readonly UserInterface $user,
        private readonly DateTimeImmutable $createdAt,
    ) {
    }

    public static function create(
        UserInterface $user,
        AccountSpecificationInterface $specification,
    ): self {
        return new self(
            $specification->id(),
            $specification->currency()->getCode(),
            $user,
            $specification->createdAt(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function currency(): Currency
    {
        return new Currency($this->currency);
    }

    public function user(): UserInterface
    {
        return $this->user;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
