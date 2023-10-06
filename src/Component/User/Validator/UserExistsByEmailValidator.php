<?php

declare(strict_types=1);

namespace Component\User\Validator;

use Component\User\Exception\UserAlreadyExistsException;
use Component\User\Operator\UserFetcherInterface;
use Component\User\Operator\UserInterface;

final readonly class UserExistsByEmailValidator implements UserValidatorInterface
{
    public function __construct(
        private UserFetcherInterface $userFetcher,
    ) {
    }

    public function __invoke(UserInterface $user): void
    {
        $existingUser = $this->userFetcher->findByEmail($user->email());
        if (null === $existingUser) {
            return;
        }

        throw UserAlreadyExistsException::duplicateEmail($user->email());
    }
}
