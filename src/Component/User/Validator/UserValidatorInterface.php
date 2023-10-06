<?php

declare(strict_types=1);

namespace Component\User\Validator;

use Component\User\Operator\UserInterface;

interface UserValidatorInterface
{
    public function __invoke(UserInterface $user): void;
}
