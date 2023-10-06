<?php

declare(strict_types=1);

namespace Component\User\Model;

use Component\Account\Model\Account;
use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountSpecificationInterface;
use Component\User\Command\CreateUserCommand;
use Component\User\Operator\UserInterface;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User implements UserInterface
{
    /**
     * @var Collection<int, AccountInterface>
     */
    private Collection $accounts;

    public function __construct(
        private readonly string $id,
        private readonly string $email,
        private readonly DateTimeImmutable $createdAt,
    ) {
        $this->accounts = new ArrayCollection();
    }

    public static function create(CreateUserCommand $command): self
    {
        return new self(
            $command->id(),
            $command->email(),
            $command->createdAt(),
        );
    }

    public function createAccount(AccountSpecificationInterface $specification): AccountInterface
    {
        return Account::create($this, $specification);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return Collection<int, AccountInterface>
     */
    public function accounts(): Collection
    {
        return $this->accounts;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
