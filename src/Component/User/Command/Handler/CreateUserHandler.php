<?php

declare(strict_types=1);

namespace Component\User\Command\Handler;

use Component\User\Command\CreateUserCommand;
use Component\User\Model\User;
use Component\User\Processor\UserProcessorInterface;

final readonly class CreateUserHandler
{
    public function __construct(
        private UserProcessorInterface $userProcessor,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = User::create($command);

        ($this->userProcessor)($user);
    }
}
