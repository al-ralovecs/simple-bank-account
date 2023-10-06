<?php

declare(strict_types=1);

namespace App\Tests\Functional\CurrencyConverter\Bridge\Exchange\Decorator;

use Component\CurrencyConverter\Bridge\Exchange\Decorator\FirstNonFailingExchange;
use Component\CurrencyConverter\Exception\ExchangeException;
use Component\CurrencyConverter\Operator\ExchangeInterface;
use Money\Currency;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversDefaultClass \Component\CurrencyConverter\Bridge\Exchange\Decorator\FirstNonFailingExchange
 */
final class FirstNonFailingExchangeTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception(): void
    {
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $exchange = $this->createMock(ExchangeInterface::class);
        $exchange->expects(self::once())
            ->method('quote')
            ->willThrowException(new RuntimeException('lorem ipsum dolor sit amet'));

        $decorator = new FirstNonFailingExchange();
        $decorator->add($exchange);

        $this->expectExceptionObject(ExchangeException::missingQuote($baseCurrency, $counterCurrency));
        $decorator->quote($baseCurrency, $counterCurrency);
    }
}
