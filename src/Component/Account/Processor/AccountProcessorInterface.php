<?php

declare(strict_types=1);

namespace Component\Account\Processor;

use Component\Account\Operator\AccountInterface;

interface AccountProcessorInterface
{
    public function __invoke(AccountInterface $account): void;
}
