<?php

declare(strict_types=1);

namespace Component\User\Command;

use DateTimeImmutable;

final readonly class CreateUserCommand
{
    public function __construct(
        private string $id,
        private string $email,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
