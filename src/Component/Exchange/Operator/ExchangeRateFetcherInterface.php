<?php

declare(strict_types=1);

namespace Component\Exchange\Operator;

use Component\Exchange\Model\ExchangeRateInterface;
use Money\Currency;

interface ExchangeRateFetcherInterface
{
    public function findByCurrencies(Currency $baseCurrency, Currency $counterCurrency): ?ExchangeRateInterface;
}
