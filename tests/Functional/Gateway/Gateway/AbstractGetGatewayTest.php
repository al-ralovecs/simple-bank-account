<?php

declare(strict_types=1);

namespace App\Tests\Functional\Gateway\Gateway;

use Component\Gateway\Gateway\AbstractGetGateway;
use Component\Gateway\Operator\RequestInterface;
use Component\Gateway\Operator\ResponseInterface;
use Component\Gateway\Response\Transformer\ClientResponseTransformerInterface;
use Component\Http\Operator\HttpClientInterface;
use Component\Http\Operator\UriInterface;
use Component\Http\Request\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponseInterface;

/**
 * @coversDefaultClass \Component\Gateway\Gateway\AbstractGetGateway
 */
final class AbstractGetGatewayTest extends TestCase
{
    /**
     * @var (HttpClientInterface&MockObject)
     */
    private HttpClientInterface $client;
    /**
     * @var (ClientResponseTransformerInterface&MockObject)
     */
    private ClientResponseTransformerInterface $clientResponseTransformer;
    /**
     * @var (UriInterface&MockObject)
     */
    private UriInterface $uri;
    /**
     * @var mixed[]|null
     */
    private ?array $headers;
    /**
     * @var mixed[]|null
     */
    private ?array $options;
    private AbstractGetGateway $gateway;

    protected function setUp(): void
    {
        $this->gateway = new DummyGetGateway(
            $this->client = $this->createMock(HttpClientInterface::class),
            $this->clientResponseTransformer = $this->createMock(ClientResponseTransformerInterface::class),
            $this->uri = $this->createMock(UriInterface::class),
            $this->headers = (bool) random_int(0, 1) ? ['dolor' => 'sit amet'] : null,
            $this->options = (bool) random_int(0, 1) ? ['lorem' => 'ipsum'] : null,
        );
    }

    /**
     * @test
     */
    public function it_sends_request(): void
    {
        $this->client
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(function (Request $clientRequest): bool {
                self::assertSame($this->uri, $clientRequest->uri());
                self::assertNull($clientRequest->body());
                self::assertSame($this->headers ?? [], $clientRequest->headers());
                self::assertSame($this->options ?? [], $clientRequest->options());

                return true;
            }))
            ->willReturn($clientResponse = $this->createMock(ClientResponseInterface::class));

        $this->clientResponseTransformer
            ->expects(self::once())
            ->method('transform')
            ->with($clientResponse)
            ->willReturn($response = $this->createMock(ResponseInterface::class));

        self::assertSame($response, $this->gateway->request());
    }
}

final readonly class DummyGetGateway extends AbstractGetGateway
{
    private UriInterface $uri;
    /**
     * @var array<string, array<string>|string>|null
     */
    private ?array $headers;
    /**
     * @var mixed[]|null
     */
    private ?array $options;

    /**
     * @param array<string, array<string>|string>|null $headers
     * @param mixed[]|null $options
     */
    public function __construct(
        HttpClientInterface $client,
        ClientResponseTransformerInterface $clientResponseTransformer,
        UriInterface $uri,
        ?array $headers,
        ?array $options,
    ) {
        parent::__construct($client, $clientResponseTransformer);
        $this->uri = $uri;
        $this->headers = $headers;
        $this->options = $options;
    }

    protected function uri(RequestInterface $request): UriInterface
    {
        return $this->uri;
    }

    /**
     * @return array<string, array<string>|string>|null
     */
    protected function headers(RequestInterface $request): ?array
    {
        return $this->headers;
    }

    /**
     * @return mixed[]|null
     */
    protected function options(RequestInterface $request): ?array
    {
        return $this->options;
    }
}
