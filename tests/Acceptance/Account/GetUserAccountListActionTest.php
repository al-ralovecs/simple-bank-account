<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Account;

use App\Tests\DataFixtures\Account\BrianCoxAccountFixtures;
use App\Tests\DataFixtures\Account\FrancisMitchelAccountFixtures;
use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetUserAccountListActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const GET_USER_ACCOUNT_LIST_URL = '/api/user/%s/account';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_gets_user_account_with_transactions_list(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            BrianCoxAccountFixtures::class,
        ]);

        $response = $this->get(sprintf(self::GET_USER_ACCOUNT_LIST_URL, UserFixtures::USER_BRIAN_COX_ID), 200, []);

        self::assertCount(2, $response);
        self::assertArrayHasKey('data', $response);
        self::assertCount(10, $response['data']);
        self::assertArrayHasKey('id', $response['data'][0]);
        self::assertArrayHasKey('balance', $response['data'][0]);
        self::assertIsArray($response['data'][0]['balance']);
        self::assertArrayHasKey('amount', $response['data'][0]['balance']);
        self::assertArrayHasKey('currency', $response['data'][0]['balance']);
        self::assertArrayHasKey('created_at', $response['data'][0]);
        self::assertArrayHasKey('pagination', $response);
        self::assertArrayHasKey('total', $response['pagination']);
        self::assertSame(13, $response['pagination']['total']);
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

    /**
     * @test
     */
    public function it_gets_user_account_without_transactions_list(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            FrancisMitchelAccountFixtures::class,
        ]);

        $response = $this->get(sprintf(self::GET_USER_ACCOUNT_LIST_URL, UserFixtures::USER_FRANCIS_MITCHEL_ID), 200, []);

        self::assertCount(2, $response);
        self::assertArrayHasKey('data', $response);
        self::assertCount(10, $response['data']);
        self::assertArrayHasKey('id', $response['data'][0]);
        self::assertArrayHasKey('balance', $response['data'][0]);
        self::assertIsArray($response['data'][0]['balance']);
        self::assertArrayHasKey('amount', $response['data'][0]['balance']);
        self::assertSame('0', $response['data'][0]['balance']['amount']);
        self::assertArrayHasKey('currency', $response['data'][0]['balance']);
        self::assertArrayHasKey('created_at', $response['data'][0]);
        self::assertArrayHasKey('pagination', $response);
        self::assertArrayHasKey('total', $response['pagination']);
        self::assertSame(32, $response['pagination']['total']);
        self::assertArrayHasKey('count', $response['pagination']);
        self::assertSame(10, $response['pagination']['count']);
        self::assertArrayHasKey('per_page', $response['pagination']);
        self::assertSame(10, $response['pagination']['per_page']);
        self::assertArrayHasKey('current_page', $response['pagination']);
        self::assertSame(1, $response['pagination']['current_page']);
        self::assertArrayHasKey('total_pages', $response['pagination']);
        self::assertSame(4, $response['pagination']['total_pages']);
        self::assertArrayHasKey('links', $response['pagination']);
    }
}
