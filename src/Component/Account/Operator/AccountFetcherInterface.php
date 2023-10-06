<?php

declare(strict_types=1);

namespace Component\Account\Operator;

interface AccountFetcherInterface
{
    public function getById(string $accountId): AccountInterface;
}
