<?php

declare(strict_types=1);

namespace Component\User\Operator;

use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountSpecificationInterface;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

interface UserInterface
{
    public function id(): string;

    public function email(): string;

    /**
     * @return Collection<int, AccountInterface>
     */
    public function accounts(): Collection;

    public function createAccount(AccountSpecificationInterface $specification): AccountInterface;

    public function createdAt(): DateTimeImmutable;
}
