<?php

declare(strict_types=1);

namespace App\Tests\Functional\CurrencyConverter\Bridge\Gateway\Exchange;

use Component\CurrencyConverter\Bridge\Gateway\Exchange\Gateway;
use Component\CurrencyConverter\Bridge\Gateway\Exchange\Request;
use Component\CurrencyConverter\Bridge\Gateway\Exchange\ResponseTransformer;
use Component\Http\Operator\HttpClientInterface;
use GuzzleHttp\Psr7\Stream;
use Money\Currency;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponseInterface;

/**
 * @coversDefaultClass \Component\CurrencyConverter\Bridge\Gateway\Exchange\Gateway
 */
final class GatewayTest extends TestCase
{
    /**
     * @var (HttpClientInterface&MockObject)
     */
    private HttpClientInterface $client;
    private Gateway $gateway;

    protected function setUp(): void
    {
        $this->gateway = new Gateway(
            $this->client = $this->createMock(HttpClientInterface::class),
            new ResponseTransformer(),
            'loremIpsumDolor_sit_amet',
        );
    }

    /**
     * @test
     */
    public function it_returns_quote(): void
    {
        /** @var resource $resource */
        $resource = fopen('data://text/plain,' . json_encode(['data' => ['USD' => 1.0480640665]]), 'r');
        $request = new Request(new Currency('EUR'), new Currency('USD'));
        $clientResponse = $this->createMock(ClientResponseInterface::class);
        $clientResponse
            ->expects(self::once())
            ->method('getBody')
            ->willReturn(new Stream($resource));

        $this->client
            ->expects(self::once())
            ->method('send')
            ->willReturn($clientResponse);

        self::assertSame('1.0480640665', $this->gateway->request($request)->ratio());
    }
}
