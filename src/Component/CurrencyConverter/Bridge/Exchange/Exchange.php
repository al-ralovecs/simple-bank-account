<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Exchange;

use Component\CurrencyConverter\Bridge\Gateway\Exchange\Gateway;
use Component\CurrencyConverter\Bridge\Gateway\Exchange\Request;
use Component\CurrencyConverter\Operator\ExchangeInterface;
use Component\Gateway\Operator\GatewayExceptionInterface;
use Money\Currency;
use Money\CurrencyPair;

final readonly class Exchange implements ExchangeInterface
{
    public function __construct(
        private Gateway $gateway,
    ) {
    }

    /**
     * @throws GatewayExceptionInterface
     */
    public function quote(Currency $baseCurrency, Currency $counterCurrency): CurrencyPair
    {
        $ratio = $this->gateway->request(new Request($baseCurrency, $counterCurrency))->ratio();

        return new CurrencyPair($baseCurrency, $counterCurrency, $ratio);
    }
}
