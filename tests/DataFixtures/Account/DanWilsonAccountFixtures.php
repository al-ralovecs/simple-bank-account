<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures\Account;

use App\Tests\DataFixtures\User\UserFixtures;
use Component\Account\Specification\AccountSpecification;
use Component\User\Model\User;
use Component\User\Operator\UserInterface;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;

final class DanWilsonAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_DW_AUD_ACCOUNT_ID = '018b0467-5a00-734b-ab8d-7e9faa208e65';
    public const USER_DW_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_DW_BGN_ACCOUNT_ID = '018b0467-5771-70aa-b44c-f8150c3f33f1';
    public const USER_DW_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_DW_BRL_ACCOUNT_ID = '018b0467-5b37-766f-9ef9-cda696b1c48d';
    public const USER_DW_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_DW_CAD_ACCOUNT_ID = '018b0467-5abc-7c4f-95e0-f417e9380b0b';
    public const USER_DW_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_DW_CHF_ACCOUNT_ID = '018b0467-5ae5-7e8b-b92e-639aa742bc99';
    public const USER_DW_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_DW_CNY_ACCOUNT_ID = '018b0467-56ef-7921-920c-8518e4702202';
    public const USER_DW_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_DW_CZK_ACCOUNT_ID = '018b0467-5ba9-7fd2-9a79-0b65ad5fa6a8';
    public const USER_DW_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_DW_DKK_ACCOUNT_ID = '018b0467-57b0-7ad4-981e-4fa1e5e59a96';
    public const USER_DW_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_DW_EUR_ACCOUNT_ID = '018b0467-5c4f-7def-92f8-21fc1a12c729';
    public const USER_DW_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_DW_GBP_ACCOUNT_ID = '018af688-c985-794f-87bd-fa683ea1878f';
    public const USER_DW_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_DW_HKD_ACCOUNT_ID = '018b0467-59c5-7fbd-932e-5d55e7e4254e';
    public const USER_DW_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_DW_HUF_ACCOUNT_ID = '018b0467-591f-7872-9b83-f656ba8843af';
    public const USER_DW_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_DW_IDR_ACCOUNT_ID = '018b0467-5b7f-7b64-ad51-b8a0dcd5aa4a';
    public const USER_DW_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_DW_ILS_ACCOUNT_ID = '018b0467-594b-7ca4-9952-6df762b12915';
    public const USER_DW_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_DW_INR_ACCOUNT_ID = '018b0467-58d7-7127-bd6c-6bcdf88a6998';
    public const USER_DW_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_DW_ISK_ACCOUNT_ID = '018b0467-5c24-7350-a857-8fb56664560a';
    public const USER_DW_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_DW_JPY_ACCOUNT_ID = '018b0467-5b5a-7f57-b7e2-27c42943d864';
    public const USER_DW_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_DW_KRW_ACCOUNT_ID = '018b0467-59a1-7bcc-b281-26595ddd748a';
    public const USER_DW_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_DW_MXN_ACCOUNT_ID = '018b0467-5a94-72e1-b957-70cc3b2e0b8a';
    public const USER_DW_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_DW_MYR_ACCOUNT_ID = '018b0467-5bfa-7e4e-a9f7-a91115d4c1dc';
    public const USER_DW_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_DW_NOK_ACCOUNT_ID = '018b0467-5bd4-7f39-91a2-78df30f4aaf2';
    public const USER_DW_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_DW_NZD_ACCOUNT_ID = '018b0467-5710-73c1-bc71-51a84786e578';
    public const USER_DW_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_DW_PHP_ACCOUNT_ID = '018b0467-5b0e-7a5d-8b64-739f7379fe2d';
    public const USER_DW_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_DW_PLN_ACCOUNT_ID = '018b0467-581f-77c8-aee8-c55db4e2e2e4';
    public const USER_DW_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_DW_RON_ACCOUNT_ID = '018b0467-5874-7f26-8ab1-4344646dd249';
    public const USER_DW_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_DW_RUB_ACCOUNT_ID = '018b0467-5a49-7f37-8beb-54adfde0ed7d';
    public const USER_DW_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_DW_SEK_ACCOUNT_ID = '018b0467-5a26-75b8-aaad-fa9a126cf8ff';
    public const USER_DW_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_DW_SGD_ACCOUNT_ID = '018b0467-597c-730f-9038-7999533a4657';
    public const USER_DW_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_DW_THB_ACCOUNT_ID = '018b0467-5a6e-75a2-9511-0258e2ee1ccb';
    public const USER_DW_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_DW_TRY_ACCOUNT_ID = '018b0467-57db-7870-aa8d-a81a0087be1e';
    public const USER_DW_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_DW_USD_ACCOUNT_ID = '018b0467-5c7c-74e3-985d-9728605f0a5f';
    public const USER_DW_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_DW_ZAR_ACCOUNT_ID = '018b0467-58a0-70f1-a692-c46027ef0a87';
    public const USER_DW_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $client */
        $client = $manager->find(User::class, UserFixtures::USER_DAN_WILSON_ID);

        $data = [
            self::USER_DW_AUD_ACCOUNT_ID => self::USER_DW_AUD_ACCOUNT_CURRENCY,
            self::USER_DW_BGN_ACCOUNT_ID => self::USER_DW_BGN_ACCOUNT_CURRENCY,
            self::USER_DW_BRL_ACCOUNT_ID => self::USER_DW_BRL_ACCOUNT_CURRENCY,
            self::USER_DW_CAD_ACCOUNT_ID => self::USER_DW_CAD_ACCOUNT_CURRENCY,
            self::USER_DW_CHF_ACCOUNT_ID => self::USER_DW_CHF_ACCOUNT_CURRENCY,
            self::USER_DW_CNY_ACCOUNT_ID => self::USER_DW_CNY_ACCOUNT_CURRENCY,
            self::USER_DW_CZK_ACCOUNT_ID => self::USER_DW_CZK_ACCOUNT_CURRENCY,
            self::USER_DW_DKK_ACCOUNT_ID => self::USER_DW_DKK_ACCOUNT_CURRENCY,
            self::USER_DW_EUR_ACCOUNT_ID => self::USER_DW_EUR_ACCOUNT_CURRENCY,
            self::USER_DW_GBP_ACCOUNT_ID => self::USER_DW_GBP_ACCOUNT_CURRENCY,
            self::USER_DW_HKD_ACCOUNT_ID => self::USER_DW_HKD_ACCOUNT_CURRENCY,
            self::USER_DW_HUF_ACCOUNT_ID => self::USER_DW_HUF_ACCOUNT_CURRENCY,
            self::USER_DW_IDR_ACCOUNT_ID => self::USER_DW_IDR_ACCOUNT_CURRENCY,
            self::USER_DW_ILS_ACCOUNT_ID => self::USER_DW_ILS_ACCOUNT_CURRENCY,
            self::USER_DW_INR_ACCOUNT_ID => self::USER_DW_INR_ACCOUNT_CURRENCY,
            self::USER_DW_ISK_ACCOUNT_ID => self::USER_DW_ISK_ACCOUNT_CURRENCY,
            self::USER_DW_JPY_ACCOUNT_ID => self::USER_DW_JPY_ACCOUNT_CURRENCY,
            self::USER_DW_KRW_ACCOUNT_ID => self::USER_DW_KRW_ACCOUNT_CURRENCY,
            self::USER_DW_MXN_ACCOUNT_ID => self::USER_DW_MXN_ACCOUNT_CURRENCY,
            self::USER_DW_MYR_ACCOUNT_ID => self::USER_DW_MYR_ACCOUNT_CURRENCY,
            self::USER_DW_NOK_ACCOUNT_ID => self::USER_DW_NOK_ACCOUNT_CURRENCY,
            self::USER_DW_NZD_ACCOUNT_ID => self::USER_DW_NZD_ACCOUNT_CURRENCY,
            self::USER_DW_PHP_ACCOUNT_ID => self::USER_DW_PHP_ACCOUNT_CURRENCY,
            self::USER_DW_PLN_ACCOUNT_ID => self::USER_DW_PLN_ACCOUNT_CURRENCY,
            self::USER_DW_RON_ACCOUNT_ID => self::USER_DW_RON_ACCOUNT_CURRENCY,
            self::USER_DW_RUB_ACCOUNT_ID => self::USER_DW_RUB_ACCOUNT_CURRENCY,
            self::USER_DW_SEK_ACCOUNT_ID => self::USER_DW_SEK_ACCOUNT_CURRENCY,
            self::USER_DW_SGD_ACCOUNT_ID => self::USER_DW_SGD_ACCOUNT_CURRENCY,
            self::USER_DW_THB_ACCOUNT_ID => self::USER_DW_THB_ACCOUNT_CURRENCY,
            self::USER_DW_TRY_ACCOUNT_ID => self::USER_DW_TRY_ACCOUNT_CURRENCY,
            self::USER_DW_USD_ACCOUNT_ID => self::USER_DW_USD_ACCOUNT_CURRENCY,
            self::USER_DW_ZAR_ACCOUNT_ID => self::USER_DW_ZAR_ACCOUNT_CURRENCY,
        ];

        foreach ($data as $accountId => $currency) {
            $specification = new AccountSpecification(
                $accountId,
                new Currency($currency),
                $createdAt,
            );
            $account = $client->createAccount($specification);

            $manager->persist($account);
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
