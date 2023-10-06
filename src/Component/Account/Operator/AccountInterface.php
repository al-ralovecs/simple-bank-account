<?php

declare(strict_types=1);

namespace Component\Account\Operator;

use Component\User\Operator\UserInterface;
use DateTimeImmutable;
use Money\Currency;

interface AccountInterface
{
    public static function create(UserInterface $user, AccountSpecificationInterface $specification): self;

    public function id(): string;

    public function currency(): Currency;

    public function user(): UserInterface;

    public function createdAt(): DateTimeImmutable;
}
