<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\User;

use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetUserActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const GET_USER_URL = '/api/user/%s';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_gets_user_successfully(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
        ]);

        $response = $this->get(sprintf(self::GET_USER_URL, UserFixtures::USER_DAN_WILSON_ID), 200);

        self::assertArrayHasKey('id', $response);
        self::assertSame(UserFixtures::USER_DAN_WILSON_ID, $response['id']);
        self::assertArrayHasKey('email', $response);
        self::assertSame(UserFixtures::USER_DAN_WILSON_EMAIL, $response['email']);
    }

    /**
     * @test
     */
    public function it_fails_with_user_does_not_exist(): void
    {
        $this->loadFixtures(static::getContainer());

        $response = $this->get(sprintf(self::GET_USER_URL, UserFixtures::USER_DAN_WILSON_ID), 400);

        self::assertArrayHasKey('status', $response);
        self::assertSame('failed', $response['status']);
        self::assertArrayHasKey('error', $response);
        self::assertSame('User "018aec6c-c03c-7610-975d-3474bc57e0e3" does not exist', $response['error']);
    }
}
