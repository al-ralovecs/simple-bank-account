<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\User;

use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

class CreateUserActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const CREATE_USER_URL = '/api/user';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_creates_user_successfully(): void
    {
        $response = $this->post(self::CREATE_USER_URL, 201, ['email' => UserFixtures::USER_JOHN_DOE_EMAIL]);

        self::assertArrayHasKey('status', $response);
        self::assertSame('success', $response['status']);
        self::assertArrayHasKey('user_id', $response);
        self::assertTrue(Uuid::isValid($response['user_id']));
    }

    /**
     * @test
     */
    public function it_fails_on_existing_user(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
        ]);

        $response = $this->post(self::CREATE_USER_URL, 400, ['email' => UserFixtures::USER_JOHN_DOE_EMAIL]);

        self::assertArrayHasKey('status', $response);
        self::assertSame('failed', $response['status']);
        self::assertArrayHasKey('error', $response);
        self::assertSame('User with email "john.doe@example.com" already exists', $response['error']);
    }
}
