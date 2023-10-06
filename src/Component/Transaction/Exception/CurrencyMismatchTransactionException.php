<?php

declare(strict_types=1);

namespace Component\Transaction\Exception;

use InvalidArgumentException;
use Money\Currency;

final class CurrencyMismatchTransactionException extends InvalidArgumentException
{
    private const MESSAGE = 'Cannot transfer currency "%s" to account with currency "%s"';

    public function __construct(Currency $transactionCurrency, Currency $targetAccountCurrency)
    {
        parent::__construct(sprintf(self::MESSAGE, $transactionCurrency, $targetAccountCurrency), 400);
    }
}
