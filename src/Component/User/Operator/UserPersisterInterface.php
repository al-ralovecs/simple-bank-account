<?php

declare(strict_types=1);

namespace Component\User\Operator;

interface UserPersisterInterface
{
    public function save(UserInterface ...$users): void;
}
