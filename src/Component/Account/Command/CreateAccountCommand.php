<?php

declare(strict_types=1);

namespace Component\Account\Command;

use Component\Account\Operator\AccountSpecificationInterface;

final readonly class CreateAccountCommand
{
    public function __construct(
        private string $userId,
        private AccountSpecificationInterface $specification,
    ) {
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function specification(): AccountSpecificationInterface
    {
        return $this->specification;
    }
}
