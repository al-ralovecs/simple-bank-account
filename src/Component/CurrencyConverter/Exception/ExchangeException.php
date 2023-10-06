<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Exception;

use Component\CurrencyConverter\Operator\ExchangeExceptionInterface;
use Money\Currency;
use RuntimeException;

final class ExchangeException extends RuntimeException implements ExchangeExceptionInterface
{
    private const MESSAGE = 'Cannot exchange currency pair "%s/%s"';

    public static function missingQuote(Currency $baseCurrency, Currency $counterCurrency): self
    {
        return new self(sprintf(self::MESSAGE, $baseCurrency->getCode(), $counterCurrency->getCode()));
    }
}
