<?php

declare(strict_types=1);

namespace App\Tests\Functional\Gateway\Response\Transformer\Decorator;

use Component\Gateway\Operator\ResponseInterface;
use Component\Gateway\Response\Transformer\ClientResponseTransformerInterface;
use Component\Gateway\Response\Transformer\Decorator\StatusApplicableClientResponseTransformer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponse;

/**
 * @coversDefaultClass \Component\Gateway\Response\Transformer\Decorator\StatusApplicableClientResponseTransformer
 */
final class StatusApplicableClientResponseTransformerTest extends TestCase
{
    /**
     * @var ClientResponseTransformerInterface&MockObject
     */
    private ClientResponseTransformerInterface $decoratedClientResponseTransformer;
    private int $status = 200;
    private StatusApplicableClientResponseTransformer $transformer;

    protected function setUp(): void
    {
        $this->transformer = new StatusApplicableClientResponseTransformer(
            $this->decoratedClientResponseTransformer = $this->createMock(ClientResponseTransformerInterface::class),
            $this->status,
        );
    }

    /**
     * @test
     */
    public function it_returns_null_if_response_code_does_not_correspond_to_expected(): void
    {
        $clientResponse = $this->createConfiguredMock(ClientResponse::class, [
            'getStatusCode' => 400,
        ]);

        $this->decoratedClientResponseTransformer
            ->expects(self::never())
            ->method('transform');

        self::assertNull($this->transformer->transform($clientResponse));
    }

    /**
     * @test
     */
    public function it_transforms_client_response(): void
    {
        $clientResponse = $this->createConfiguredMock(ClientResponse::class, [
            'getStatusCode' => $this->status,
        ]);

        $this->decoratedClientResponseTransformer
            ->expects(self::once())
            ->method('transform')
            ->willReturn($response = (bool) random_int(0, 1) ? $this->createMock(ResponseInterface::class) : null);

        self::assertSame($response, $this->transformer->transform($clientResponse));
    }
}
