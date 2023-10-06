<?php

declare(strict_types=1);

namespace Component\User\Exception;

use RuntimeException;

final class UserAlreadyExistsException extends RuntimeException
{
    private const MESSAGE = 'User with email "%s" already exists';

    public static function duplicateEmail(string $email): self
    {
        return new self(sprintf(self::MESSAGE, $email), 400);
    }
}
