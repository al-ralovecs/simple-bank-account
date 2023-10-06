<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Exchange;

use Component\CurrencyConverter\Exception\ExchangeException;
use Component\CurrencyConverter\Operator\ExchangeInterface;
use Component\Exchange\Operator\ExchangeRateFetcherInterface;
use Money\Currency;
use Money\CurrencyPair;

final readonly class Storage implements ExchangeInterface
{
    public function __construct(
        private ExchangeRateFetcherInterface $exchangeRateFetcher,
    ) {
    }

    public function quote(Currency $baseCurrency, Currency $counterCurrency): CurrencyPair
    {
        $exchangeRate = $this->exchangeRateFetcher->findByCurrencies($baseCurrency, $counterCurrency);
        if (null === $exchangeRate) {
            throw ExchangeException::missingQuote($baseCurrency, $counterCurrency);
        }

        return new CurrencyPair($baseCurrency, $counterCurrency, $exchangeRate->ratio());
    }
}
