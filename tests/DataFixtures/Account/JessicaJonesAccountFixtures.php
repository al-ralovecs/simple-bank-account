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

final class JessicaJonesAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_JJ_AUD_ACCOUNT_ID = '018af683-4022-763e-a3ea-fb7054a65c26';
    public const USER_JJ_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_JJ_BGN_ACCOUNT_ID = '018af683-4415-76a4-9ab5-21e31263ccf0';
    public const USER_JJ_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_JJ_BRL_ACCOUNT_ID = '018af683-44b2-71d7-a7a3-352950e124b5';
    public const USER_JJ_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_JJ_CAD_ACCOUNT_ID = '018af683-4078-700d-8b26-aec67b6ff6a2';
    public const USER_JJ_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_JJ_CHF_ACCOUNT_ID = '018af683-4315-786b-bcdb-9aa556f6b19f';
    public const USER_JJ_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_JJ_CNY_ACCOUNT_ID = '018af683-43ea-7fe3-a56f-2ec6ac0a0316';
    public const USER_JJ_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_JJ_CZK_ACCOUNT_ID = '018af683-4141-715a-946f-1b51aff18a3d';
    public const USER_JJ_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_JJ_DKK_ACCOUNT_ID = '018af683-3fc7-74d2-85b5-85265507198c';
    public const USER_JJ_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_JJ_EUR_ACCOUNT_ID = '018af683-3f61-7346-bc6e-6869d6d78525';
    public const USER_JJ_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_JJ_GBP_ACCOUNT_ID = '018af683-41e0-783b-b32e-980068a147e0';
    public const USER_JJ_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_JJ_HKD_ACCOUNT_ID = '018af683-4520-7fce-8d4c-90222dec3bf7';
    public const USER_JJ_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_JJ_HUF_ACCOUNT_ID = '018af683-40af-74e8-9e7a-ccc4e25f4b64';
    public const USER_JJ_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_JJ_IDR_ACCOUNT_ID = '018af683-3f97-79e9-bcc5-53906a448322';
    public const USER_JJ_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_JJ_ILS_ACCOUNT_ID = '018af683-43b4-71c1-acec-1ce7351429ee';
    public const USER_JJ_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_JJ_INR_ACCOUNT_ID = '018af683-446e-732d-9990-29c12e279abe';
    public const USER_JJ_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_JJ_ISK_ACCOUNT_ID = '018af683-4266-72bf-9ddd-e9c4b400d5b4';
    public const USER_JJ_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_JJ_JPY_ACCOUNT_ID = '018af683-404a-7ba4-ba49-5150e3a0e6e2';
    public const USER_JJ_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_JJ_KRW_ACCOUNT_ID = '018af683-4556-775b-afde-da8a38a65280';
    public const USER_JJ_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_JJ_MXN_ACCOUNT_ID = '018af683-4170-75c6-89a6-07277c450bf4';
    public const USER_JJ_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_JJ_MYR_ACCOUNT_ID = '018af683-4383-7766-ae2c-d2601103715f';
    public const USER_JJ_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_JJ_NOK_ACCOUNT_ID = '018af683-42ea-72d4-a663-d284b4382b8e';
    public const USER_JJ_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_JJ_NZD_ACCOUNT_ID = '018af683-44eb-7335-b7e8-184a549b5241';
    public const USER_JJ_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_JJ_PHP_ACCOUNT_ID = '018af683-3ff1-7330-b1e1-9518f50c0f84';
    public const USER_JJ_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_JJ_PLN_ACCOUNT_ID = '018af683-4210-7238-8be6-c7dba4271707';
    public const USER_JJ_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_JJ_RON_ACCOUNT_ID = '018af683-410e-72e6-ade9-8a833bc59870';
    public const USER_JJ_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_JJ_RUB_ACCOUNT_ID = '018af683-423f-7d3a-8542-171ed2269791';
    public const USER_JJ_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_JJ_SEK_ACCOUNT_ID = '018af683-3ef8-7190-8c5f-c12dcc17fbc8';
    public const USER_JJ_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_JJ_SGD_ACCOUNT_ID = '018af683-42b9-79b3-91e4-5baed2f34941';
    public const USER_JJ_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_JJ_THB_ACCOUNT_ID = '018af683-41ab-79fd-aee2-0de7cc48e7fe';
    public const USER_JJ_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_JJ_TRY_ACCOUNT_ID = '018af683-428c-7614-98bd-f3f5d9a80461';
    public const USER_JJ_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_JJ_USD_ACCOUNT_ID = '018af683-4350-7596-a1a3-7a1a135678fe';
    public const USER_JJ_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_JJ_ZAR_ACCOUNT_ID = '018af683-40dd-782b-a78d-b0da0b062118';
    public const USER_JJ_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $client */
        $client = $manager->find(User::class, UserFixtures::USER_JESSICA_JONES_ID);

        $data = [
            self::USER_JJ_AUD_ACCOUNT_ID => self::USER_JJ_AUD_ACCOUNT_CURRENCY,
            self::USER_JJ_BGN_ACCOUNT_ID => self::USER_JJ_BGN_ACCOUNT_CURRENCY,
            self::USER_JJ_BRL_ACCOUNT_ID => self::USER_JJ_BRL_ACCOUNT_CURRENCY,
            self::USER_JJ_CAD_ACCOUNT_ID => self::USER_JJ_CAD_ACCOUNT_CURRENCY,
            self::USER_JJ_CHF_ACCOUNT_ID => self::USER_JJ_CHF_ACCOUNT_CURRENCY,
            self::USER_JJ_CNY_ACCOUNT_ID => self::USER_JJ_CNY_ACCOUNT_CURRENCY,
            self::USER_JJ_CZK_ACCOUNT_ID => self::USER_JJ_CZK_ACCOUNT_CURRENCY,
            self::USER_JJ_DKK_ACCOUNT_ID => self::USER_JJ_DKK_ACCOUNT_CURRENCY,
            self::USER_JJ_EUR_ACCOUNT_ID => self::USER_JJ_EUR_ACCOUNT_CURRENCY,
            self::USER_JJ_GBP_ACCOUNT_ID => self::USER_JJ_GBP_ACCOUNT_CURRENCY,
            self::USER_JJ_HKD_ACCOUNT_ID => self::USER_JJ_HKD_ACCOUNT_CURRENCY,
            self::USER_JJ_HUF_ACCOUNT_ID => self::USER_JJ_HUF_ACCOUNT_CURRENCY,
            self::USER_JJ_IDR_ACCOUNT_ID => self::USER_JJ_IDR_ACCOUNT_CURRENCY,
            self::USER_JJ_ILS_ACCOUNT_ID => self::USER_JJ_ILS_ACCOUNT_CURRENCY,
            self::USER_JJ_INR_ACCOUNT_ID => self::USER_JJ_INR_ACCOUNT_CURRENCY,
            self::USER_JJ_ISK_ACCOUNT_ID => self::USER_JJ_ISK_ACCOUNT_CURRENCY,
            self::USER_JJ_JPY_ACCOUNT_ID => self::USER_JJ_JPY_ACCOUNT_CURRENCY,
            self::USER_JJ_KRW_ACCOUNT_ID => self::USER_JJ_KRW_ACCOUNT_CURRENCY,
            self::USER_JJ_MXN_ACCOUNT_ID => self::USER_JJ_MXN_ACCOUNT_CURRENCY,
            self::USER_JJ_MYR_ACCOUNT_ID => self::USER_JJ_MYR_ACCOUNT_CURRENCY,
            self::USER_JJ_NOK_ACCOUNT_ID => self::USER_JJ_NOK_ACCOUNT_CURRENCY,
            self::USER_JJ_NZD_ACCOUNT_ID => self::USER_JJ_NZD_ACCOUNT_CURRENCY,
            self::USER_JJ_PHP_ACCOUNT_ID => self::USER_JJ_PHP_ACCOUNT_CURRENCY,
            self::USER_JJ_PLN_ACCOUNT_ID => self::USER_JJ_PLN_ACCOUNT_CURRENCY,
            self::USER_JJ_RON_ACCOUNT_ID => self::USER_JJ_RON_ACCOUNT_CURRENCY,
            self::USER_JJ_RUB_ACCOUNT_ID => self::USER_JJ_RUB_ACCOUNT_CURRENCY,
            self::USER_JJ_SEK_ACCOUNT_ID => self::USER_JJ_SEK_ACCOUNT_CURRENCY,
            self::USER_JJ_SGD_ACCOUNT_ID => self::USER_JJ_SGD_ACCOUNT_CURRENCY,
            self::USER_JJ_THB_ACCOUNT_ID => self::USER_JJ_THB_ACCOUNT_CURRENCY,
            self::USER_JJ_TRY_ACCOUNT_ID => self::USER_JJ_TRY_ACCOUNT_CURRENCY,
            self::USER_JJ_USD_ACCOUNT_ID => self::USER_JJ_USD_ACCOUNT_CURRENCY,
            self::USER_JJ_ZAR_ACCOUNT_ID => self::USER_JJ_ZAR_ACCOUNT_CURRENCY,
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
