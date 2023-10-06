<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Request;

use Component\User\Command\CreateUserCommand;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateUserRequest
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
            new Assert\Email(),
        ])]
        public string $email,
    ) {
    }

    public function toCommand(): CreateUserCommand
    {
        return new CreateUserCommand(
            (string) Uuid::v7(),
            $this->email,
            new DateTimeImmutable(),
        );
    }
}
