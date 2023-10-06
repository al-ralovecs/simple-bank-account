<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Transaction;

use App\Tests\DataFixtures\Account\DanWilsonAccountFixtures;
use App\Tests\DataFixtures\Account\SeanBeanAccountFixtures;
use App\Tests\DataFixtures\Exchange\EurExchangeRateFixtures;
use App\Tests\DataFixtures\User\UserFixtures;
use SN\TestFixturesBundle\FixturesTrait;
use SN\TestLib\Rest\RestTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CreateTransactionActionTest extends WebTestCase
{
    use FixturesTrait,
        RestTestTrait;

    private const CREATE_TRANSACTION_URL = '/api/transaction';
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
    public function it_creates_transaction_without_currency_conversion_to_empty_account(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            EurExchangeRateFixtures::class,
            DanWilsonAccountFixtures::class,
            SeanBeanAccountFixtures::class,
        ]);

        $response = $this->post(self::CREATE_TRANSACTION_URL, 201, [
            'sourceAccount' => SeanBeanAccountFixtures::USER_SB_EUR_ACCOUNT_ID,
            'targetAccount' => DanWilsonAccountFixtures::USER_DW_EUR_ACCOUNT_ID,
            'currency' => 'EUR',
            'amount' => 10099,
        ]);

        self::assertArrayHasKey('status', $response);
        self::assertSame('success', $response['status']);

        $seanBeanEurAccountResponse = $this->get(sprintf(self::GET_ACCOUNT_TRANSACTION_LIST_URL, SeanBeanAccountFixtures::USER_SB_EUR_ACCOUNT_ID), 200, []);

        self::assertArrayHasKey('data', $seanBeanEurAccountResponse);
        self::assertCount(2, $seanBeanEurAccountResponse['data']);
        self::assertIsArray($seanBeanEurAccountResponse['data'][1]);
        self::assertArrayHasKey('id', $seanBeanEurAccountResponse['data'][1]);
        self::assertArrayHasKey('amount', $seanBeanEurAccountResponse['data'][1]);
        self::assertSame('-100.99', $seanBeanEurAccountResponse['data'][1]['amount']);
        self::assertArrayHasKey('created_at', $seanBeanEurAccountResponse['data'][1]);

        $danWilsonEurAccountResponse = $this->get(sprintf(self::GET_ACCOUNT_TRANSACTION_LIST_URL, DanWilsonAccountFixtures::USER_DW_EUR_ACCOUNT_ID), 200, []);

        self::assertArrayHasKey('data', $danWilsonEurAccountResponse);
        self::assertCount(1, $danWilsonEurAccountResponse['data']);
        self::assertIsArray($danWilsonEurAccountResponse['data'][0]);
        self::assertArrayHasKey('id', $danWilsonEurAccountResponse['data'][0]);
        self::assertArrayHasKey('amount', $danWilsonEurAccountResponse['data'][0]);
        self::assertSame('100.99', $danWilsonEurAccountResponse['data'][0]['amount']);
        self::assertArrayHasKey('created_at', $danWilsonEurAccountResponse['data'][0]);
    }

    /**
     * @test
     */
    public function it_creates_transaction_with_currency_conversion_to_empty_account(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            EurExchangeRateFixtures::class,
            DanWilsonAccountFixtures::class,
            SeanBeanAccountFixtures::class,
        ]);

        $response = $this->post(self::CREATE_TRANSACTION_URL, 201, [
            'sourceAccount' => SeanBeanAccountFixtures::USER_SB_USD_ACCOUNT_ID,
            'targetAccount' => DanWilsonAccountFixtures::USER_DW_EUR_ACCOUNT_ID,
            'currency' => 'EUR',
            'amount' => 9636,
        ]);

        self::assertArrayHasKey('status', $response);
        self::assertSame('success', $response['status']);

        $seanBeanEurAccountResponse = $this->get(sprintf(self::GET_ACCOUNT_TRANSACTION_LIST_URL, SeanBeanAccountFixtures::USER_SB_USD_ACCOUNT_ID), 200, []);

        self::assertArrayHasKey('data', $seanBeanEurAccountResponse);
        self::assertCount(2, $seanBeanEurAccountResponse['data']);
        self::assertIsArray($seanBeanEurAccountResponse['data'][1]);
        self::assertArrayHasKey('id', $seanBeanEurAccountResponse['data'][1]);
        self::assertArrayHasKey('amount', $seanBeanEurAccountResponse['data'][1]);
        self::assertSame('-100.99', $seanBeanEurAccountResponse['data'][1]['amount']);
        self::assertArrayHasKey('created_at', $seanBeanEurAccountResponse['data'][1]);

        $danWilsonEurAccountResponse = $this->get(sprintf(self::GET_ACCOUNT_TRANSACTION_LIST_URL, DanWilsonAccountFixtures::USER_DW_EUR_ACCOUNT_ID), 200, []);

        self::assertArrayHasKey('data', $danWilsonEurAccountResponse);
        self::assertCount(1, $danWilsonEurAccountResponse['data']);
        self::assertIsArray($danWilsonEurAccountResponse['data'][0]);
        self::assertArrayHasKey('id', $danWilsonEurAccountResponse['data'][0]);
        self::assertArrayHasKey('amount', $danWilsonEurAccountResponse['data'][0]);
        self::assertSame('96.36', $danWilsonEurAccountResponse['data'][0]['amount']);
        self::assertArrayHasKey('created_at', $danWilsonEurAccountResponse['data'][0]);
    }

    /**
     * @test
     */
    public function it_creates_transaction_with_insufficient_funds_exception(): void
    {
        $this->loadFixtures(static::getContainer(), [
            UserFixtures::class,
            EurExchangeRateFixtures::class,
            DanWilsonAccountFixtures::class,
            SeanBeanAccountFixtures::class,
        ]);

        $response = $this->post(self::CREATE_TRANSACTION_URL, 400, [
            'sourceAccount' => SeanBeanAccountFixtures::USER_SB_USD_ACCOUNT_ID,
            'targetAccount' => DanWilsonAccountFixtures::USER_DW_EUR_ACCOUNT_ID,
            'currency' => 'EUR',
            'amount' => 10099,
        ]);

        self::assertArrayHasKey('status', $response);
        self::assertSame('failed', $response['status']);
        self::assertArrayHasKey('error', $response);
        self::assertSame('Account "018af68d-f005-7b2a-a460-6fe26dfbee21" has "10099 USD" at its balance, while it requires "10584 USD" for transaction to be accomplished', $response['error']);
    }
}
