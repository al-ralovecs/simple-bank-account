<?php

declare(strict_types=1);

namespace App\Tests\Functional\Http\Bridge\Psr7\Transformer;

use Component\Http\Bridge\Psr7\Transformer\UriTransformer;
use Component\Http\Operator\UriInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Component\Http\Bridge\Psr7\Transformer\UriTransformer
 */
final class UriTransformerTest extends TestCase
{
    private string $endpointUrl = 'https://fake.url.com/api/';
    private UriTransformer $transformer;

    protected function setUp(): void
    {
        $this->transformer = new UriTransformer($this->endpointUrl);
    }

    /**
     * @test
     */
    public function it_transforms_uri(): void
    {
        $httpUri = $this->createConfiguredMock(UriInterface::class, [
            'path' => '/path/to/source',
            'query' => $query = http_build_query(['lorem' => 'ipsum', 'solor' => 'sit']),
        ]);

        $uri = $this->transformer->transform($httpUri);
        self::assertSame('https', $uri->getScheme());
        self::assertSame('fake.url.com', $uri->getHost());
        self::assertSame('/api/path/to/source', $uri->getPath());
        self::assertSame($query, $uri->getQuery());
    }
}
