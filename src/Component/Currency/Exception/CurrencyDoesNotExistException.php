<?php

declare(strict_types=1);

namespace Component\Currency\Exception;

use InvalidArgumentException;
use Money\Currency;

final class CurrencyDoesNotExistException extends InvalidArgumentException
{
    private const MESSAGE = 'Currency "%s" does not exist';

    public function __construct(Currency $currency)
    {
        parent::__construct(sprintf(self::MESSAGE, $currency->getCode()), 400);
    }
}
