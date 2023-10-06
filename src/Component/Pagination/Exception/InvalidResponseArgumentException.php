<?php

declare(strict_types=1);

namespace Component\Pagination\Exception;

use InvalidArgumentException;

final class InvalidResponseArgumentException extends InvalidArgumentException
{
    public static function missingTransformer(mixed $response): self
    {
        return new self(sprintf(
            'No transformer provided. Response argument must be array, %s given.',
            is_object($response) ? $response::class : gettype($response),
        ));
    }
}
