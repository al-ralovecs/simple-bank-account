<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Account;

use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateAccountActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const CREATE_ACCOUNT_URL = '/api/user/%s/account';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_creates_account_successfully(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
        ]);

        $response = $this->post(sprintf(self::CREATE_ACCOUNT_URL, UserFixtures::USER_BRIAN_COX_ID), 201, ['currency' => 'EUR']);

        self::assertArrayHasKey('status', $response);
        self::assertSame('success', $response['status']);
        self::assertArrayHasKey('account_id', $response);
    }

    /**
     * @test
     */
    public function it_fails_with_user_does_not_exist_exception(): void
    {
        $this->loadFixtures(static::getContainer());

        $response = $this->post(sprintf(self::CREATE_ACCOUNT_URL, UserFixtures::USER_BRIAN_COX_ID), 400, ['currency' => 'EUR']);

        self::assertArrayHasKey('status', $response);
        self::assertSame('failed', $response['status']);
        self::assertArrayHasKey('error', $response);
        self::assertSame('User "018aec6c-bfff-7d71-a60d-198df8b57c19" does not exist', $response['error']);
    }

    /**
     * @test
     */
    public function it_fails_with_currency_does_not_exist_exception(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
        ]);

        $response = $this->post(sprintf(self::CREATE_ACCOUNT_URL, UserFixtures::USER_BRIAN_COX_ID), 400, ['currency' => 'XYZ']);

        self::assertArrayHasKey('status', $response);
        self::assertSame('failed', $response['status']);
        self::assertArrayHasKey('error', $response);
        self::assertSame('Currency "XYZ" does not exist', $response['error']);
    }
}
