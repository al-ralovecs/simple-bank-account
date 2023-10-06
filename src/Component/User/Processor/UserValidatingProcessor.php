<?php

declare(strict_types=1);

namespace Component\User\Processor;

use Component\User\Operator\UserInterface;
use Component\User\Validator\UserValidatorInterface;

final readonly class UserValidatingProcessor implements UserProcessorInterface
{
    public function __construct(
        private UserValidatorInterface $userValidator,
    ) {
    }

    public function __invoke(UserInterface $user): void
    {
        ($this->userValidator)($user);
    }
}
