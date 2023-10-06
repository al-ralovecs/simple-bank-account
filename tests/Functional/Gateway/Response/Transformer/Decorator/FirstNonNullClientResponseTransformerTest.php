<?php

declare(strict_types=1);

namespace App\Tests\Functional\Gateway\Response\Transformer\Decorator;

use Component\Gateway\Operator\ResponseInterface;
use Component\Gateway\Response\Transformer\ClientResponseTransformerInterface;
use Component\Gateway\Response\Transformer\Decorator\FirstNonNullClientResponseTransformer;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as ClientResponse;

/**
 * @coversDefaultClass \Component\Gateway\Response\Transformer\Decorator\FirstNonNullClientResponseTransformer
 */
final class FirstNonNullClientResponseTransformerTest extends TestCase
{
    private FirstNonNullClientResponseTransformer $transformer;

    protected function setUp(): void
    {
        $this->transformer = new FirstNonNullClientResponseTransformer();
    }

    /**
     * @test
     */
    public function it_returns_first_not_null_result_of_registered_transformers(): void
    {
        $clientResponse = $this->createMock(ClientResponse::class);

        $result = array_reduce(
            range(0, random_int(1, 10)),
            function (?ResponseInterface $response, int $index) use ($clientResponse): ?ResponseInterface {
                $transformer = $this->createMock(ClientResponseTransformerInterface::class);

                if (null !== $response) {
                    $transformer->expects(self::never())->method('transform');
                } else {
                    $transformer
                        ->expects(self::once())
                        ->method('transform')
                        ->with($clientResponse)
                        ->willReturn($response = (bool) random_int(0, 1) ? $this->createMock(ResponseInterface::class) : null);
                }

                $this->transformer->add($transformer, -$index);

                return $response;
            },
        );

        self::assertSame($result, $this->transformer->transform($clientResponse));
    }
}
