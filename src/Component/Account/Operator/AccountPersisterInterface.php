<?php

declare(strict_types=1);

namespace Component\Account\Operator;

interface AccountPersisterInterface
{
    public function save(AccountInterface ...$accounts): void;
}
