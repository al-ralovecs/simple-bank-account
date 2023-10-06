<?php

declare(strict_types=1);

namespace Component\User\Processor;

use Component\User\Operator\UserInterface;

interface UserProcessorInterface
{
    public function __invoke(UserInterface $user): void;
}
