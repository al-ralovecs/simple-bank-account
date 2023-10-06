<?php

declare(strict_types=1);

namespace Component\User\Processor;

use Component\User\Operator\UserInterface;
use Component\User\Operator\UserPersisterInterface;

final readonly class UserPersistingProcessor implements UserProcessorInterface
{
    public function __construct(
        private UserPersisterInterface $userPersister,
    ) {
    }

    public function __invoke(UserInterface $user): void
    {
        $this->userPersister->save($user);
    }
}
