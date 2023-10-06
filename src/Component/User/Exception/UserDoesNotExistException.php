<?php

declare(strict_types=1);

namespace Component\User\Exception;

use RuntimeException;

final class UserDoesNotExistException extends RuntimeException
{
    private const MESSAGE = 'User "%s" does not exist';

    public static function missingId(string $userId): self
    {
        return new self(sprintf(self::MESSAGE, $userId), 400);
    }
}
