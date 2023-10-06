<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Exchange\Decorator;

use Component\CurrencyConverter\Exception\ExchangeException;
use Component\CurrencyConverter\Operator\ExchangeInterface;
use Money\Currency;
use Money\CurrencyPair;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;
use Throwable;

final class FirstNonFailingExchange implements ExchangeInterface
{
    /**
     * @var PrioritizedCollection<ExchangeInterface>
     */
    private PrioritizedCollection $collection;

    public function __construct()
    {
        $this->collection = new PrioritizedCollection();
    }

    public function add(ExchangeInterface $exchange, int $priority = Priority::NORMAL): void
    {
        $this->collection->add($exchange, $priority);
    }

    public function quote(Currency $baseCurrency, Currency $counterCurrency): CurrencyPair
    {
        /** @var CurrencyPair|null $quote */
        $quote = $this->collection->firstNonNullResult(
            static function (ExchangeInterface $exchange) use ($baseCurrency, $counterCurrency): ?CurrencyPair {
                try {
                    return $exchange->quote($baseCurrency, $counterCurrency);
                } catch (Throwable) {
                    return null;
                }
            },
        );

        return $quote ?? throw ExchangeException::missingQuote($baseCurrency, $counterCurrency);
    }
}
