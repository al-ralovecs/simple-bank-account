<?php

declare(strict_types=1);

namespace Component\Transaction\Exception;

use InvalidArgumentException;

final class InvalidAccountTransactionException extends InvalidArgumentException
{
    private const MESSAGE = 'Cannot make a transaction to the same account "%s"';

    public static function sameAccount(string $accountId): self
    {
        return new self(sprintf(self::MESSAGE, $accountId), 400);
    }
}
