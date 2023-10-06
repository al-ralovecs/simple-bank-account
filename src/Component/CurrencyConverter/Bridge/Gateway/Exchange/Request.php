<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Gateway\Exchange;

use Component\Gateway\Operator\RequestInterface;
use Money\Currency;

final readonly class Request implements RequestInterface
{
    public function __construct(
        private Currency $baseCurrency,
        private Currency $counterCurrency,
    ) {
    }

    public function baseCurrency(): Currency
    {
        return $this->baseCurrency;
    }

    public function counterCurrency(): Currency
    {
        return $this->counterCurrency;
    }
}
