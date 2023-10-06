<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\User;

use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetUserListActionTest extends WebTestCase
{
    use FixturesTrait, RestTestTrait;

    private const GET_USER_LIST_URL = '/api/user';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_gets_user_list_successfully(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
        ]);

        $response = $this->get(self::GET_USER_LIST_URL, 200, []);

        self::assertCount(2, $response);
        self::assertArrayHasKey('data', $response);
        self::assertCount(10, $response['data']);
        self::assertArrayHasKey('pagination', $response);
        self::assertArrayHasKey('total', $response['pagination']);
        self::assertSame(11, $response['pagination']['total']);
        self::assertArrayHasKey('count', $response['pagination']);
        self::assertSame(10, $response['pagination']['count']);
        self::assertArrayHasKey('per_page', $response['pagination']);
        self::assertSame(10, $response['pagination']['per_page']);
        self::assertArrayHasKey('current_page', $response['pagination']);
        self::assertSame(1, $response['pagination']['current_page']);
        self::assertArrayHasKey('total_pages', $response['pagination']);
        self::assertSame(2, $response['pagination']['total_pages']);
        self::assertArrayHasKey('links', $response['pagination']);
    }
}
