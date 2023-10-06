<?php

declare(strict_types=1);

namespace App\Tests\Functional\Http\Uri;

use Component\Http\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Component\Http\Uri\Uri
 */
final class UriTest extends TestCase
{
    /**
     * @test
     *
     * @param array<string, array<string>|string>|null $queryParams
     *
     * @dataProvider dataProvider
     */
    public function it_creates_uri(string $path, ?array $queryParams, string $expectedResult): void
    {
        $uri = new Uri($path, $queryParams ?? []);

        self::assertEquals($expectedResult, (string) $uri);
    }

    /**
     * @return array<int, mixed>
     */
    public static function dataProvider(): iterable
    {
        yield ['/path/without/parameters', null, '/path/without/parameters'];

        yield [
            '/some/path',
            [
                'foo' => 'bar',
            ],
            '/some/path?foo=bar',
        ];

        yield [
            '/path/with/foo/bar',
            [
                'query_param1' => 'asd',
                'query_param2' => 'qwe',
            ],
            '/path/with/foo/bar?query_param1=asd&query_param2=qwe',
        ];
    }
}
