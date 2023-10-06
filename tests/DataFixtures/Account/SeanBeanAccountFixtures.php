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

final class SeanBeanAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_SB_AUD_ACCOUNT_ID = '018af68d-f14c-7527-91ff-2b3a5eb39af8';
    public const USER_SB_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_SB_BGN_ACCOUNT_ID = '018af68d-edf1-7a26-b953-886009e85cd2';
    public const USER_SB_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_SB_BRL_ACCOUNT_ID = '018af68d-ed05-70b8-aa6a-786248b2c8ee';
    public const USER_SB_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_SB_CAD_ACCOUNT_ID = '018af68d-ed3e-770d-ae36-e527f3847672';
    public const USER_SB_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_SB_CHF_ACCOUNT_ID = '018af68d-ef27-7370-8fc6-de891c0fd963';
    public const USER_SB_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_SB_CNY_ACCOUNT_ID = '018af68d-eefa-7d73-9cb1-c3a45f201cf6';
    public const USER_SB_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_SB_CZK_ACCOUNT_ID = '018af68d-efdd-70de-bec9-ffd1b8b95a7c';
    public const USER_SB_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_SB_DKK_ACCOUNT_ID = '018af68d-f02a-7b4a-aa2e-00b465b17f22';
    public const USER_SB_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_SB_EUR_ACCOUNT_ID = '018af68d-ee5f-7004-8b2d-6e7c78cc636b';
    public const USER_SB_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_SB_GBP_ACCOUNT_ID = '018af68d-ecd6-747f-89af-5c18fa803f90';
    public const USER_SB_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_SB_HKD_ACCOUNT_ID = '018af68d-edba-7931-bf39-020a59519c1f';
    public const USER_SB_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_SB_HUF_ACCOUNT_ID = '018af68d-ec6b-704f-b01b-0d3f9cf68632';
    public const USER_SB_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_SB_IDR_ACCOUNT_ID = '018af68d-eea0-7145-95c1-b1a2c518aea8';
    public const USER_SB_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_SB_ILS_ACCOUNT_ID = '018af68d-f0b9-7673-b0a2-189e37aa64fc';
    public const USER_SB_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_SB_INR_ACCOUNT_ID = '018af68d-eece-7975-9e01-e530ddfc2866';
    public const USER_SB_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_SB_ISK_ACCOUNT_ID = '018af68d-ec8d-78b2-86f3-8e2bb5207f60';
    public const USER_SB_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_SB_JPY_ACCOUNT_ID = '018af68d-f06d-78da-83b7-8c9f7dba47f0';
    public const USER_SB_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_SB_KRW_ACCOUNT_ID = '018af68d-ed7e-782f-bce1-ad502deb8f4b';
    public const USER_SB_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_SB_MXN_ACCOUNT_ID = '018af68d-ec45-7c76-ad71-8d87a225aefe';
    public const USER_SB_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_SB_MYR_ACCOUNT_ID = '018af68d-ecaf-77c9-b62b-633dabe2dbea';
    public const USER_SB_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_SB_NOK_ACCOUNT_ID = '018af68d-f04c-705b-812f-0a885046c29b';
    public const USER_SB_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_SB_NZD_ACCOUNT_ID = '018af68d-f08f-757e-9cdd-5e0ab7703a80';
    public const USER_SB_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_SB_PHP_ACCOUNT_ID = '018af68d-f1a9-725b-885e-0d70f648d795';
    public const USER_SB_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_SB_PLN_ACCOUNT_ID = '018af68d-f1d5-7c98-8ae3-3d91decb6b43';
    public const USER_SB_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_SB_RON_ACCOUNT_ID = '018af68d-ef52-70bc-97aa-c0958cd82266';
    public const USER_SB_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_SB_RUB_ACCOUNT_ID = '018af68d-f17d-7bef-bbf6-ff9358c93644';
    public const USER_SB_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_SB_SEK_ACCOUNT_ID = '018af68d-ef82-7075-8f39-d9e23cce2aa9';
    public const USER_SB_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_SB_SGD_ACCOUNT_ID = '018af68d-f0e4-7920-b38f-13ce66f78747';
    public const USER_SB_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_SB_THB_ACCOUNT_ID = '018af68d-f10f-7a22-a26f-306de964040a';
    public const USER_SB_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_SB_TRY_ACCOUNT_ID = '018af68d-efab-785f-91d0-91ef4b16dcb4';
    public const USER_SB_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_SB_USD_ACCOUNT_ID = '018af68d-f005-7b2a-a460-6fe26dfbee21';
    public const USER_SB_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_SB_ZAR_ACCOUNT_ID = '018af68d-ec28-748e-8358-2839fceb9566';
    public const USER_SB_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $client */
        $client = $manager->find(User::class, UserFixtures::USER_SEAN_BEAN_ID);

        $data = [
            self::USER_SB_AUD_ACCOUNT_ID => self::USER_SB_AUD_ACCOUNT_CURRENCY,
            self::USER_SB_BGN_ACCOUNT_ID => self::USER_SB_BGN_ACCOUNT_CURRENCY,
            self::USER_SB_BRL_ACCOUNT_ID => self::USER_SB_BRL_ACCOUNT_CURRENCY,
            self::USER_SB_CAD_ACCOUNT_ID => self::USER_SB_CAD_ACCOUNT_CURRENCY,
            self::USER_SB_CHF_ACCOUNT_ID => self::USER_SB_CHF_ACCOUNT_CURRENCY,
            self::USER_SB_CNY_ACCOUNT_ID => self::USER_SB_CNY_ACCOUNT_CURRENCY,
            self::USER_SB_CZK_ACCOUNT_ID => self::USER_SB_CZK_ACCOUNT_CURRENCY,
            self::USER_SB_DKK_ACCOUNT_ID => self::USER_SB_DKK_ACCOUNT_CURRENCY,
            self::USER_SB_EUR_ACCOUNT_ID => self::USER_SB_EUR_ACCOUNT_CURRENCY,
            self::USER_SB_GBP_ACCOUNT_ID => self::USER_SB_GBP_ACCOUNT_CURRENCY,
            self::USER_SB_HKD_ACCOUNT_ID => self::USER_SB_HKD_ACCOUNT_CURRENCY,
            self::USER_SB_HUF_ACCOUNT_ID => self::USER_SB_HUF_ACCOUNT_CURRENCY,
            self::USER_SB_IDR_ACCOUNT_ID => self::USER_SB_IDR_ACCOUNT_CURRENCY,
            self::USER_SB_ILS_ACCOUNT_ID => self::USER_SB_ILS_ACCOUNT_CURRENCY,
            self::USER_SB_INR_ACCOUNT_ID => self::USER_SB_INR_ACCOUNT_CURRENCY,
            self::USER_SB_ISK_ACCOUNT_ID => self::USER_SB_ISK_ACCOUNT_CURRENCY,
            self::USER_SB_JPY_ACCOUNT_ID => self::USER_SB_JPY_ACCOUNT_CURRENCY,
            self::USER_SB_KRW_ACCOUNT_ID => self::USER_SB_KRW_ACCOUNT_CURRENCY,
            self::USER_SB_MXN_ACCOUNT_ID => self::USER_SB_MXN_ACCOUNT_CURRENCY,
            self::USER_SB_MYR_ACCOUNT_ID => self::USER_SB_MYR_ACCOUNT_CURRENCY,
            self::USER_SB_NOK_ACCOUNT_ID => self::USER_SB_NOK_ACCOUNT_CURRENCY,
            self::USER_SB_NZD_ACCOUNT_ID => self::USER_SB_NZD_ACCOUNT_CURRENCY,
            self::USER_SB_PHP_ACCOUNT_ID => self::USER_SB_PHP_ACCOUNT_CURRENCY,
            self::USER_SB_PLN_ACCOUNT_ID => self::USER_SB_PLN_ACCOUNT_CURRENCY,
            self::USER_SB_RON_ACCOUNT_ID => self::USER_SB_RON_ACCOUNT_CURRENCY,
            self::USER_SB_RUB_ACCOUNT_ID => self::USER_SB_RUB_ACCOUNT_CURRENCY,
            self::USER_SB_SEK_ACCOUNT_ID => self::USER_SB_SEK_ACCOUNT_CURRENCY,
            self::USER_SB_SGD_ACCOUNT_ID => self::USER_SB_SGD_ACCOUNT_CURRENCY,
            self::USER_SB_THB_ACCOUNT_ID => self::USER_SB_THB_ACCOUNT_CURRENCY,
            self::USER_SB_TRY_ACCOUNT_ID => self::USER_SB_TRY_ACCOUNT_CURRENCY,
            self::USER_SB_USD_ACCOUNT_ID => self::USER_SB_USD_ACCOUNT_CURRENCY,
            self::USER_SB_ZAR_ACCOUNT_ID => self::USER_SB_ZAR_ACCOUNT_CURRENCY,
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
                    new Money(10099, new Currency($currency)),
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
