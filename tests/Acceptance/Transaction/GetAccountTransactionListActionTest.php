<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Transaction;

use App\Tests\DataFixtures\Account\SeanBeanAccountFixtures;
use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetAccountTransactionListActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const GET_ACCOUNT_TRANSACTION_LIST_URL = '/api/account/%s/transaction';

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->changeRestClient(self::createClient());

        $this->loadFixtures(static::getContainer());
    }

    /**
     * @test
     */
    public function it_gets_account_with_one_transaction(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            SeanBeanAccountFixtures::class,
        ]);

        $response = $this->get(sprintf(self::GET_ACCOUNT_TRANSACTION_LIST_URL, SeanBeanAccountFixtures::USER_SB_CAD_ACCOUNT_ID), 200, []);

        self::assertArrayHasKey('data', $response);
        self::assertCount(1, $response['data']);
        self::assertArrayHasKey('id', $response['data'][0]);
        self::assertArrayHasKey('amount', $response['data'][0]);
        self::assertSame('100.99', $response['data'][0]['amount']);
        self::assertArrayHasKey('created_at', $response['data'][0]);
        self::assertArrayHasKey('pagination', $response);
    }
}
