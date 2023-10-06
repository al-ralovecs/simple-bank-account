<?php

declare(strict_types=1);

namespace App\Tests\Functional\CurrencyConverter\Bridge\Exchange;

use Component\CurrencyConverter\Bridge\Exchange\Exchange;
use Component\CurrencyConverter\Bridge\Gateway\Exchange\Gateway;
use Component\CurrencyConverter\Bridge\Gateway\Exchange\ResponseTransformer;
use Component\Http\Operator\HttpClientInterface;
use GuzzleHttp\Psr7\Stream;
use Money\Currency;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponseInterface;

/**
 * @coversDefaultClass \Component\CurrencyConverter\Bridge\Exchange\Exchange
 */
final class ExchangeTest extends TestCase
{
    private Gateway $gateway;

    protected function setUp(): void
    {
        /** @var resource $resource */
        $resource = fopen('data://text/plain,' . json_encode(['data' => ['USD' => 1.0480640665]]), 'r');
        $clientResponse = $this->createMock(ClientResponseInterface::class);
        $clientResponse
            ->expects(self::once())
            ->method('getBody')
            ->willReturn(new Stream($resource));

        /** @var (HttpClientInterface&MockObject) $client */
        $client = $this->createMock(HttpClientInterface::class);
        $client
            ->expects(self::once())
            ->method('send')
            ->willReturn($clientResponse);

        $this->gateway = new Gateway(
            $client,
            new ResponseTransformer(),
            'loremIpsumDolor_sit_amet',
        );
    }

    /**
     * @test
     */
    public function it_returns_currency_pair_with_ratio(): void
    {
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $exchange = new Exchange($this->gateway);

        $result = $exchange->quote($baseCurrency, $counterCurrency);

        self::assertSame($baseCurrency, $result->getBaseCurrency());
        self::assertSame($counterCurrency, $result->getCounterCurrency());
        self::assertSame('1.0480640665', $result->getConversionRatio());
    }
}
