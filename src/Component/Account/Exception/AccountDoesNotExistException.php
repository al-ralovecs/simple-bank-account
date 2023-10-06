<?php

declare(strict_types=1);

namespace Component\Account\Exception;

use RuntimeException;

final class AccountDoesNotExistException extends RuntimeException
{
    private const MESSAGE = 'Account "%s" does not exist';

    public static function missingId(string $accountId): self
    {
        return new self(sprintf(self::MESSAGE, $accountId));
    }
}
