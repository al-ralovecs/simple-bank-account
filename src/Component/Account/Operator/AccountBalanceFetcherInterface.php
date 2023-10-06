<?php

declare(strict_types=1);

namespace Component\Account\Operator;

interface AccountBalanceFetcherInterface
{
    public function accountBalance(string $accountId): int;
}
