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

final class FrancisMitchelAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_FM_AUD_ACCOUNT_ID = '018af694-3d43-7173-8395-ef068ea31e53';
    public const USER_FM_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_FM_BGN_ACCOUNT_ID = '018af694-3a9a-7f20-9531-8c67f92c4fce';
    public const USER_FM_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_FM_BRL_ACCOUNT_ID = '018af694-3914-7d3d-9b51-b6ff2fd44d14';
    public const USER_FM_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_FM_CAD_ACCOUNT_ID = '018af694-3c45-7c07-b799-2affb03fa967';
    public const USER_FM_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_FM_CHF_ACCOUNT_ID = '018af694-3ac1-74af-8d93-18d0b1f98907';
    public const USER_FM_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_FM_CNY_ACCOUNT_ID = '018af694-3cd8-7311-beb3-9ab482a9ede6';
    public const USER_FM_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_FM_CZK_ACCOUNT_ID = '018af694-3b85-7502-b879-27aa14c74c81';
    public const USER_FM_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_FM_DKK_ACCOUNT_ID = '018af694-3d6b-7634-848f-5aef0f363985';
    public const USER_FM_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_FM_EUR_ACCOUNT_ID = '018af694-3893-7324-b39d-86b9a03adfcb';
    public const USER_FM_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_FM_GBP_ACCOUNT_ID = '018af694-3b31-770b-a1f9-ff5f73444e6f';
    public const USER_FM_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_FM_HKD_ACCOUNT_ID = '018af694-3ae9-7759-aea6-c659c4d3003e';
    public const USER_FM_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_FM_HUF_ACCOUNT_ID = '018af694-3a3d-76eb-a42e-a5f8ad2c24b6';
    public const USER_FM_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_FM_IDR_ACCOUNT_ID = '018af694-3941-7181-9b76-02e62daf9eb5';
    public const USER_FM_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_FM_ILS_ACCOUNT_ID = '018af694-3cfd-7d2b-9061-b440d62e45c3';
    public const USER_FM_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_FM_INR_ACCOUNT_ID = '018af694-39e9-70e4-aee9-4016de1edb7c';
    public const USER_FM_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_FM_ISK_ACCOUNT_ID = '018af694-3d94-796e-87d4-830c2e9efa78';
    public const USER_FM_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_FM_JPY_ACCOUNT_ID = '018af694-3a14-708f-92f0-53145d713d48';
    public const USER_FM_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_FM_KRW_ACCOUNT_ID = '018af694-3b0f-738f-aedc-bd2ff74f64fd';
    public const USER_FM_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_FM_MXN_ACCOUNT_ID = '018af694-3b54-7764-91f4-0158cb580afa';
    public const USER_FM_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_FM_MYR_ACCOUNT_ID = '018af694-39bc-7a0e-9c06-eef5dff9287b';
    public const USER_FM_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_FM_NOK_ACCOUNT_ID = '018af694-386d-77d2-a713-a6948ef6b9f5';
    public const USER_FM_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_FM_NZD_ACCOUNT_ID = '018af694-38ea-7fdc-aa47-673ebd049b17';
    public const USER_FM_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_FM_PHP_ACCOUNT_ID = '018af694-3bae-7428-bc5d-6c65a61c3806';
    public const USER_FM_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_FM_PLN_ACCOUNT_ID = '018af694-3990-7f4a-b6cb-5397a4f637be';
    public const USER_FM_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_FM_RON_ACCOUNT_ID = '018af694-3967-770b-a9b8-7f184f9d51e5';
    public const USER_FM_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_FM_RUB_ACCOUNT_ID = '018af694-3c0e-72c2-b94c-13a0e95aa24b';
    public const USER_FM_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_FM_SEK_ACCOUNT_ID = '018af694-3d1f-730e-8c13-54a404f6e537';
    public const USER_FM_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_FM_SGD_ACCOUNT_ID = '018af694-3ca1-710a-8db8-eec503774c1a';
    public const USER_FM_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_FM_THB_ACCOUNT_ID = '018af694-3be0-73a1-9165-70e63152614f';
    public const USER_FM_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_FM_TRY_ACCOUNT_ID = '018af694-3c74-7884-87e1-39c5f69990bc';
    public const USER_FM_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_FM_USD_ACCOUNT_ID = '018af694-38bc-7600-9a97-acf185d5d802';
    public const USER_FM_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_FM_ZAR_ACCOUNT_ID = '018af694-3a6a-7d39-9d67-b4e8af377152';
    public const USER_FM_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $client */
        $client = $manager->find(User::class, UserFixtures::USER_FRANCIS_MITCHEL_ID);

        $data = [
            self::USER_FM_AUD_ACCOUNT_ID => self::USER_FM_AUD_ACCOUNT_CURRENCY,
            self::USER_FM_BGN_ACCOUNT_ID => self::USER_FM_BGN_ACCOUNT_CURRENCY,
            self::USER_FM_BRL_ACCOUNT_ID => self::USER_FM_BRL_ACCOUNT_CURRENCY,
            self::USER_FM_CAD_ACCOUNT_ID => self::USER_FM_CAD_ACCOUNT_CURRENCY,
            self::USER_FM_CHF_ACCOUNT_ID => self::USER_FM_CHF_ACCOUNT_CURRENCY,
            self::USER_FM_CNY_ACCOUNT_ID => self::USER_FM_CNY_ACCOUNT_CURRENCY,
            self::USER_FM_CZK_ACCOUNT_ID => self::USER_FM_CZK_ACCOUNT_CURRENCY,
            self::USER_FM_DKK_ACCOUNT_ID => self::USER_FM_DKK_ACCOUNT_CURRENCY,
            self::USER_FM_EUR_ACCOUNT_ID => self::USER_FM_EUR_ACCOUNT_CURRENCY,
            self::USER_FM_GBP_ACCOUNT_ID => self::USER_FM_GBP_ACCOUNT_CURRENCY,
            self::USER_FM_HKD_ACCOUNT_ID => self::USER_FM_HKD_ACCOUNT_CURRENCY,
            self::USER_FM_HUF_ACCOUNT_ID => self::USER_FM_HUF_ACCOUNT_CURRENCY,
            self::USER_FM_IDR_ACCOUNT_ID => self::USER_FM_IDR_ACCOUNT_CURRENCY,
            self::USER_FM_ILS_ACCOUNT_ID => self::USER_FM_ILS_ACCOUNT_CURRENCY,
            self::USER_FM_INR_ACCOUNT_ID => self::USER_FM_INR_ACCOUNT_CURRENCY,
            self::USER_FM_ISK_ACCOUNT_ID => self::USER_FM_ISK_ACCOUNT_CURRENCY,
            self::USER_FM_JPY_ACCOUNT_ID => self::USER_FM_JPY_ACCOUNT_CURRENCY,
            self::USER_FM_KRW_ACCOUNT_ID => self::USER_FM_KRW_ACCOUNT_CURRENCY,
            self::USER_FM_MXN_ACCOUNT_ID => self::USER_FM_MXN_ACCOUNT_CURRENCY,
            self::USER_FM_MYR_ACCOUNT_ID => self::USER_FM_MYR_ACCOUNT_CURRENCY,
            self::USER_FM_NOK_ACCOUNT_ID => self::USER_FM_NOK_ACCOUNT_CURRENCY,
            self::USER_FM_NZD_ACCOUNT_ID => self::USER_FM_NZD_ACCOUNT_CURRENCY,
            self::USER_FM_PHP_ACCOUNT_ID => self::USER_FM_PHP_ACCOUNT_CURRENCY,
            self::USER_FM_PLN_ACCOUNT_ID => self::USER_FM_PLN_ACCOUNT_CURRENCY,
            self::USER_FM_RON_ACCOUNT_ID => self::USER_FM_RON_ACCOUNT_CURRENCY,
            self::USER_FM_RUB_ACCOUNT_ID => self::USER_FM_RUB_ACCOUNT_CURRENCY,
            self::USER_FM_SEK_ACCOUNT_ID => self::USER_FM_SEK_ACCOUNT_CURRENCY,
            self::USER_FM_SGD_ACCOUNT_ID => self::USER_FM_SGD_ACCOUNT_CURRENCY,
            self::USER_FM_THB_ACCOUNT_ID => self::USER_FM_THB_ACCOUNT_CURRENCY,
            self::USER_FM_TRY_ACCOUNT_ID => self::USER_FM_TRY_ACCOUNT_CURRENCY,
            self::USER_FM_USD_ACCOUNT_ID => self::USER_FM_USD_ACCOUNT_CURRENCY,
            self::USER_FM_ZAR_ACCOUNT_ID => self::USER_FM_ZAR_ACCOUNT_CURRENCY,
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
