<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures\Account;

use App\Tests\DataFixtures\User\UserFixtures;
use Component\Account\Specification\AccountSpecification;
use Component\Transaction\Command\CreateTransactionCommand;
use Component\Transaction\Model\Transaction;
use Component\Transaction\Specification\TransactionSpecification;
use Component\User\Model\User;
use Component\User\Operator\UserInterface;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;
use Money\Money;
use Symfony\Component\Uid\Uuid;

final class EmmaSmithAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_ES_AUD_ACCOUNT_ID = '018af688-c6e4-7c49-a420-019702f7ba6a';
    public const USER_ES_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_ES_BGN_ACCOUNT_ID = '018af688-c766-7a4d-abb1-80e9bed9d750';
    public const USER_ES_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_ES_BRL_ACCOUNT_ID = '018af688-c54f-7c06-8526-0d573ac5d689';
    public const USER_ES_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_ES_CAD_ACCOUNT_ID = '018af688-c82b-7b6b-b52f-dae840340767';
    public const USER_ES_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_ES_CHF_ACCOUNT_ID = '018af688-c690-7b1f-8aa5-91776a0bed57';
    public const USER_ES_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_ES_CNY_ACCOUNT_ID = '018af688-c576-7d65-a8b2-5073058b18f2';
    public const USER_ES_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_ES_CZK_ACCOUNT_ID = '018af688-c7d0-7c17-9a4e-1ec1ebd6615a';
    public const USER_ES_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_ES_DKK_ACCOUNT_ID = '018af688-c525-7f49-8cd7-f83c169ef17c';
    public const USER_ES_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_ES_EUR_ACCOUNT_ID = '018af688-c713-7503-b76e-b48a7e8a6c24';
    public const USER_ES_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_ES_GBP_ACCOUNT_ID = '018af688-c985-794f-87bd-fa684ea1878f';
    public const USER_ES_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_ES_HKD_ACCOUNT_ID = '018af688-c6bb-7376-a863-3b731200d693';
    public const USER_ES_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_ES_HUF_ACCOUNT_ID = '018af688-c91d-7032-a472-5ff3c28c6548';
    public const USER_ES_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_ES_IDR_ACCOUNT_ID = '018af688-c740-7750-a820-6c2f38626929';
    public const USER_ES_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_ES_ILS_ACCOUNT_ID = '018af688-c9a9-7412-880e-3bbc31b10313';
    public const USER_ES_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_ES_INR_ACCOUNT_ID = '018af688-c7ac-7168-a60b-ec7e97fd4bad';
    public const USER_ES_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_ES_ISK_ACCOUNT_ID = '018af688-c964-71f5-bca5-622f24213d0a';
    public const USER_ES_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_ES_JPY_ACCOUNT_ID = '018af688-c8ac-78f6-a290-a6137222ff70';
    public const USER_ES_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_ES_KRW_ACCOUNT_ID = '018af688-c641-761a-a114-2709744304f8';
    public const USER_ES_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_ES_MXN_ACCOUNT_ID = '018af688-c787-79f8-bb9e-e8f160105304';
    public const USER_ES_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_ES_MYR_ACCOUNT_ID = '018af688-ca00-73e6-b31a-c6c81f9936c9';
    public const USER_ES_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_ES_NOK_ACCOUNT_ID = '018af688-c87d-7196-98b6-e463818fc117';
    public const USER_ES_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_ES_NZD_ACCOUNT_ID = '018af688-c667-7006-9d2a-3cce9c5cefc6';
    public const USER_ES_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_ES_PHP_ACCOUNT_ID = '018af688-c5ea-780b-a10f-efa7334dd448';
    public const USER_ES_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_ES_PLN_ACCOUNT_ID = '018af688-c59b-75d0-ac58-bfe935baaac2';
    public const USER_ES_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_ES_RON_ACCOUNT_ID = '018af688-c614-7486-8d1f-4ade22de515e';
    public const USER_ES_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_ES_RUB_ACCOUNT_ID = '018af688-c7f9-7664-9317-e6fb78af8207';
    public const USER_ES_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_ES_SEK_ACCOUNT_ID = '018af688-c5c3-7f3d-8b57-2722454c8179';
    public const USER_ES_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_ES_SGD_ACCOUNT_ID = '018af688-c9cf-711b-b49b-ba5f3b4ebda1';
    public const USER_ES_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_ES_THB_ACCOUNT_ID = '018af688-c855-79c5-a4ed-a07c9e048a74';
    public const USER_ES_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_ES_TRY_ACCOUNT_ID = '018af688-c940-722d-a266-8daca0b5034a';
    public const USER_ES_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_ES_USD_ACCOUNT_ID = '018af688-c8f8-7796-b76d-857758e2d42f';
    public const USER_ES_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_ES_ZAR_ACCOUNT_ID = '018af688-c8d4-7899-be40-84692772ea21';
    public const USER_ES_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $client */
        $client = $manager->find(User::class, UserFixtures::USER_EMMA_SMITH_ID);

        $data = [
            self::USER_ES_AUD_ACCOUNT_ID => self::USER_ES_AUD_ACCOUNT_CURRENCY,
            self::USER_ES_BGN_ACCOUNT_ID => self::USER_ES_BGN_ACCOUNT_CURRENCY,
            self::USER_ES_BRL_ACCOUNT_ID => self::USER_ES_BRL_ACCOUNT_CURRENCY,
            self::USER_ES_CAD_ACCOUNT_ID => self::USER_ES_CAD_ACCOUNT_CURRENCY,
            self::USER_ES_CHF_ACCOUNT_ID => self::USER_ES_CHF_ACCOUNT_CURRENCY,
            self::USER_ES_CNY_ACCOUNT_ID => self::USER_ES_CNY_ACCOUNT_CURRENCY,
            self::USER_ES_CZK_ACCOUNT_ID => self::USER_ES_CZK_ACCOUNT_CURRENCY,
            self::USER_ES_DKK_ACCOUNT_ID => self::USER_ES_DKK_ACCOUNT_CURRENCY,
            self::USER_ES_EUR_ACCOUNT_ID => self::USER_ES_EUR_ACCOUNT_CURRENCY,
            self::USER_ES_GBP_ACCOUNT_ID => self::USER_ES_GBP_ACCOUNT_CURRENCY,
            self::USER_ES_HKD_ACCOUNT_ID => self::USER_ES_HKD_ACCOUNT_CURRENCY,
            self::USER_ES_HUF_ACCOUNT_ID => self::USER_ES_HUF_ACCOUNT_CURRENCY,
            self::USER_ES_IDR_ACCOUNT_ID => self::USER_ES_IDR_ACCOUNT_CURRENCY,
            self::USER_ES_ILS_ACCOUNT_ID => self::USER_ES_ILS_ACCOUNT_CURRENCY,
            self::USER_ES_INR_ACCOUNT_ID => self::USER_ES_INR_ACCOUNT_CURRENCY,
            self::USER_ES_ISK_ACCOUNT_ID => self::USER_ES_ISK_ACCOUNT_CURRENCY,
            self::USER_ES_JPY_ACCOUNT_ID => self::USER_ES_JPY_ACCOUNT_CURRENCY,
            self::USER_ES_KRW_ACCOUNT_ID => self::USER_ES_KRW_ACCOUNT_CURRENCY,
            self::USER_ES_MXN_ACCOUNT_ID => self::USER_ES_MXN_ACCOUNT_CURRENCY,
            self::USER_ES_MYR_ACCOUNT_ID => self::USER_ES_MYR_ACCOUNT_CURRENCY,
            self::USER_ES_NOK_ACCOUNT_ID => self::USER_ES_NOK_ACCOUNT_CURRENCY,
            self::USER_ES_NZD_ACCOUNT_ID => self::USER_ES_NZD_ACCOUNT_CURRENCY,
            self::USER_ES_PHP_ACCOUNT_ID => self::USER_ES_PHP_ACCOUNT_CURRENCY,
            self::USER_ES_PLN_ACCOUNT_ID => self::USER_ES_PLN_ACCOUNT_CURRENCY,
            self::USER_ES_RON_ACCOUNT_ID => self::USER_ES_RON_ACCOUNT_CURRENCY,
            self::USER_ES_RUB_ACCOUNT_ID => self::USER_ES_RUB_ACCOUNT_CURRENCY,
            self::USER_ES_SEK_ACCOUNT_ID => self::USER_ES_SEK_ACCOUNT_CURRENCY,
            self::USER_ES_SGD_ACCOUNT_ID => self::USER_ES_SGD_ACCOUNT_CURRENCY,
            self::USER_ES_THB_ACCOUNT_ID => self::USER_ES_THB_ACCOUNT_CURRENCY,
            self::USER_ES_TRY_ACCOUNT_ID => self::USER_ES_TRY_ACCOUNT_CURRENCY,
            self::USER_ES_USD_ACCOUNT_ID => self::USER_ES_USD_ACCOUNT_CURRENCY,
            self::USER_ES_ZAR_ACCOUNT_ID => self::USER_ES_ZAR_ACCOUNT_CURRENCY,
        ];

        foreach ($data as $accountId => $currency) {
            $specification = new AccountSpecification(
                $accountId,
                new Currency($currency),
                $createdAt,
            );
            $account = $client->createAccount($specification);

            $createTransactionCommand = new CreateTransactionCommand(
                new TransactionSpecification(
                    (string) Uuid::v7(),
                    new Money((string) random_int(1000, 99999), new Currency($currency)),
                    (string) Uuid::v7(),
                    $account,
                    $createdAt,
                ),
            );
            $transaction = Transaction::create($createTransactionCommand);

            $manager->persist($account);
            $manager->persist($transaction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
