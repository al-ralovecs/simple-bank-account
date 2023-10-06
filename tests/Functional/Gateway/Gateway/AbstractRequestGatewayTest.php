<?php

declare(strict_types=1);

namespace App\Tests\Functional\Gateway\Gateway;

use Closure;
use Component\Gateway\Exception\ClientResponseTransformerException;
use Component\Gateway\Exception\HttpClientException;
use Component\Gateway\Gateway\AbstractRequestGateway;
use Component\Gateway\Operator\RequestInterface;
use Component\Gateway\Operator\ResponseInterface;
use Component\Gateway\Response\Transformer\ClientResponseTransformerInterface;
use Component\Http\Enum\Method;
use Component\Http\Operator\HttpClientInterface;
use Component\Http\Operator\RequestBodyInterface;
use Component\Http\Operator\UriInterface;
use Component\Http\Request\Request;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponseInterface;

/**
 * @coversDefaultClass \Component\Gateway\Gateway\AbstractRequestGateway
 */
final class AbstractRequestGatewayTest extends TestCase
{
    /**
     * @var HttpClientInterface&MockObject
     */
    private HttpClientInterface $client;
    /**
     * @var ClientResponseTransformerInterface&MockObject
     */
    private ClientResponseTransformerInterface $clientResponseTransformer;
    /**
     * @var UriInterface&MockObject
     */
    private UriInterface $uri;
    /**
     * @var (RequestBodyInterface&MockObject)|null
     */
    private ?RequestBodyInterface $body;
    /**
     * @var mixed[]|null
     */
    private ?array $headers;
    /**
     * @var mixed[]|null
     */
    private ?array $options;
    private AbstractRequestGateway $gateway;

    protected function setUp(): void
    {
        $this->gateway = new DummyGateway(
            $this->client = $this->createMock(HttpClientInterface::class),
            $this->clientResponseTransformer = $this->createMock(ClientResponseTransformerInterface::class),
            $this->uri = $this->createMock(UriInterface::class),
            Method::GET,
            $this->body = (bool) random_int(0, 1) ? $this->createMock(RequestBodyInterface::class) : null,
            $this->headers = (bool) random_int(0, 1) ? ['access_key' => 'lorem ipsum dolor sit amet'] : null,
            $this->options = (bool) random_int(0, 1) ? ['dorem' => 'ipsum lorem sit amet'] : null,
        );
    }

    /**
     * @test
     */
    public function it_wraps_client_exception(): void
    {
        $this->client
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(Closure::fromCallable([$this, 'assertRequest'])))
            ->willThrowException($clientException = new Exception('lorem ipsum dolor sit amet'));

        $this->expectExceptionObject(new HttpClientException($clientException));
        $this->gateway->request($this->createMock(RequestInterface::class));
    }

    /**
     * @test
     */
    public function it_throws_exception_on_empty_client_response_transformer_result(): void
    {
        $this->client
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(Closure::fromCallable([$this, 'assertRequest'])))
            ->willReturn($clientResponse = $this->createMock(ClientResponseInterface::class));

        $this->clientResponseTransformer
            ->expects(self::once())
            ->method('transform')
            ->with($clientResponse)
            ->willReturn(null);

        $this->expectExceptionObject(new ClientResponseTransformerException('Client response transformer returned null.'));
        $this->gateway->request($this->createMock(RequestInterface::class));
    }

    /**
     * @test
     */
    public function it_sends_request(): void
    {
        $this->client
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(Closure::fromCallable([$this, 'assertRequest'])))
            ->willReturn($clientResponse = $this->createMock(ClientResponseInterface::class));

        $this->clientResponseTransformer
            ->expects(self::once())
            ->method('transform')
            ->with($clientResponse)
            ->willReturn($response = $this->createMock(ResponseInterface::class));

        self::assertSame($response, $this->gateway->request($this->createMock(RequestInterface::class)));
    }

    private function assertRequest(Request $clientRequest): bool
    {
        self::assertSame($this->uri, $clientRequest->uri());
        self::assertSame($this->body, $clientRequest->body());
        self::assertSame($this->headers ?? [], $clientRequest->headers());
        self::assertSame($this->options ?? [], $clientRequest->options());

        return true;
    }
}

final readonly class DummyGateway extends AbstractRequestGateway
{
    private UriInterface $uri;
    private Method $method;
    private ?RequestBodyInterface $body;
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
        Method $method,
        ?RequestBodyInterface $body,
        ?array $headers,
        ?array $options,
    ) {
        parent::__construct($client, $clientResponseTransformer);
        $this->uri = $uri;
        $this->method = $method;
        $this->body = $body;
        $this->headers = $headers;
        $this->options = $options;
    }

    protected function uri(RequestInterface $request): UriInterface
    {
        return $this->uri;
    }

    protected function method(RequestInterface $request): Method
    {
        return $this->method;
    }

    protected function body(RequestInterface $request): ?RequestBodyInterface
    {
        return $this->body;
    }

    /**
     * @return array<string, array<string>|string>|null
     */
    protected function headers(RequestInterface $request): ?array
    {
        return $this->headers;
    }

    /**
     * @return array<string, mixed>|null
     */
    protected function options(RequestInterface $request): ?array
    {
        return $this->options;
    }
}
