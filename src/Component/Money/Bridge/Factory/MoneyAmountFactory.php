<?php

declare(strict_types=1);

namespace Component\Money\Bridge\Factory;

use Money\Currencies\ISOCurrencies;
use Money\Money;

final readonly class MoneyAmountFactory
{
    public static function amount(Money $money): string
    {
        $currencies = new ISOCurrencies();
        $digits = $currencies->subunitFor($money->getCurrency());

        $cents = (int) $money->getAmount();
        $withComma = $cents / (10 ** $digits);

        return number_format($withComma, $digits);
    }
}
