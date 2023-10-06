<?php

declare(strict_types=1);

namespace App\Tests\Functional\Http\Bridge\GuzzleHttp\Client;

use Component\Http\Bridge\GuzzleHttp\Client\Client;
use Component\Http\Bridge\Psr7\Transformer\UriTransformerInterface;
use Component\Http\Enum\Method;
use Component\Http\Exception\HttpClientException;
use Component\Http\Operator\RequestBodyInterface;
use Component\Http\Operator\UriInterface as HttpUri;
use Component\Http\Request\Request as HttpRequest;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface as Psr7UriInterface;

/**
 * @coversDefaultClass \Component\Http\Bridge\GuzzleHttp\Client\Client
 */
final class ClientTest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    private ClientInterface $baseClient;
    /**
     * @var UriTransformerInterface|MockObject
     */
    private UriTransformerInterface $uriTransformer;
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(
            $this->baseClient = $this->createMock(ClientInterface::class),
            $this->uriTransformer = $this->createMock(UriTransformerInterface::class),
        );
    }

    /**
     * @test
     */
    public function it_wraps_guzzle_client_exceptions(): void
    {
        /** @var MockObject $baseClientMock */
        /** @var HttpRequest $request */
        [$baseClientMock, $request] = $this->mockGuzzleClient();
        $baseClientMock->willThrowException($exception = new class('lorem ipsum') extends Exception implements GuzzleException {}); // @phpstan-ignore-line

        $this->expectExceptionObject(new HttpClientException($exception->getMessage(), $exception->getCode(), $exception));
        $this->client->send($request);
    }

    /**
     * @test
     */
    public function it_returns_base_client_response(): void
    {
        /** @var MockObject $baseClientMock */
        /** @var HttpRequest $request */
        [$baseClientMock, $request] = $this->mockGuzzleClient();
        $baseClientMock->willReturn($response = $this->createMock(ResponseInterface::class)); // @phpstan-ignore-line
        self::assertSame($response, $this->client->send($request));
    }

    /**
     * @return array<int, object>
     */
    private function mockGuzzleClient(): array
    {
        $request = new HttpRequest(
            $uri = $this->createMock(HttpUri::class),
            /* @var Method $method */
            $method = Method::GET,
            (bool) random_int(0, 1)
                ? $this->createConfiguredMock(RequestBodyInterface::class, [
                'toStream' => $this->createConfiguredMock(StreamInterface::class, [
                    '__toString' => $body = 'lorem ipsum dolor sit amet',
                ]),
            ])
                : $body = null,
            [],
            [],
        );

        $this->uriTransformer
            ->expects(self::once())
            ->method('transform')
            ->with($uri)
            ->willReturn($clientUri = $this->createMock(Psr7UriInterface::class));

        $baseClientMock = $this->baseClient
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(function (Request $guzzleRequest) use ($method, $clientUri, $body): bool {
                self::assertSame($method->value, $guzzleRequest->getMethod());
                self::assertSame($clientUri, $guzzleRequest->getUri());
                self::assertSame($body ?? '', (string) $guzzleRequest->getBody());

                return true;
            }));

        return [$baseClientMock, $request];
    }
}
