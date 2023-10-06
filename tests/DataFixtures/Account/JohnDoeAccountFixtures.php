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

final class JohnDoeAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_JD_AUD_ACCOUNT_ID = '018af667-da28-760a-ae01-afb96bc7ea44';
    public const USER_JD_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_JD_BGN_ACCOUNT_ID = '018af667-da54-7714-b51d-d280c6f94076';
    public const USER_JD_BGN_ACCOUNT_CURRENCY = 'BGN';
    public const USER_JD_BRL_ACCOUNT_ID = '018af667-da80-760d-be6a-31bea5ac7d0a';
    public const USER_JD_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_JD_CAD_ACCOUNT_ID = '018af667-daa4-733b-86bb-191126f9b2b3';
    public const USER_JD_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_JD_CHF_ACCOUNT_ID = '018af667-dacf-7fc6-bf59-a7fdfff84609';
    public const USER_JD_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_JD_CNY_ACCOUNT_ID = '018af667-dafd-7b1d-ab32-4db3569904cf';
    public const USER_JD_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_JD_CZK_ACCOUNT_ID = '018af667-db29-7b3e-a17a-d5c31db8fe7d';
    public const USER_JD_CZK_ACCOUNT_CURRENCY = 'CZK';
    public const USER_JD_DKK_ACCOUNT_ID = '018af667-db89-7979-9b70-c56dd11bddd5';
    public const USER_JD_DKK_ACCOUNT_CURRENCY = 'DKK';
    public const USER_JD_EUR_ACCOUNT_ID = '018af667-dbbd-7033-a75c-a280269a1290';
    public const USER_JD_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_JD_GBP_ACCOUNT_ID = '018af667-dbe9-776e-bedd-4c6e33f9a788';
    public const USER_JD_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_JD_HKD_ACCOUNT_ID = '018af667-dc13-7f0c-8095-74c267e5805d';
    public const USER_JD_HKD_ACCOUNT_CURRENCY = 'HKD';
    public const USER_JD_HUF_ACCOUNT_ID = '018af667-dc33-7b72-b5cd-44b5bd5e8499';
    public const USER_JD_HUF_ACCOUNT_CURRENCY = 'HUF';
    public const USER_JD_IDR_ACCOUNT_ID = '018af667-dc57-765e-8b49-7b62945294a5';
    public const USER_JD_IDR_ACCOUNT_CURRENCY = 'IDR';
    public const USER_JD_ILS_ACCOUNT_ID = '018af667-dc7e-7fd8-bf35-da811937922e';
    public const USER_JD_ILS_ACCOUNT_CURRENCY = 'ILS';
    public const USER_JD_INR_ACCOUNT_ID = '018af667-dca8-7851-9bbf-927bedad7430';
    public const USER_JD_INR_ACCOUNT_CURRENCY = 'INR';
    public const USER_JD_ISK_ACCOUNT_ID = '018af667-dcd1-7d2d-b6ed-245c3eb992f5';
    public const USER_JD_ISK_ACCOUNT_CURRENCY = 'ISK';
    public const USER_JD_JPY_ACCOUNT_ID = '018af667-dd03-7b34-a8f0-766c428f4a0d';
    public const USER_JD_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_JD_KRW_ACCOUNT_ID = '018af667-dd33-7575-ac91-91c54d29e33e';
    public const USER_JD_KRW_ACCOUNT_CURRENCY = 'KRW';
    public const USER_JD_MXN_ACCOUNT_ID = '018af667-dd5f-7d0c-9175-5983475a34bd';
    public const USER_JD_MXN_ACCOUNT_CURRENCY = 'MXN';
    public const USER_JD_MYR_ACCOUNT_ID = '018af667-dd91-7a9e-96c5-60dd49808f30';
    public const USER_JD_MYR_ACCOUNT_CURRENCY = 'MYR';
    public const USER_JD_NOK_ACCOUNT_ID = '018af667-ddbe-75fc-b23f-4c33aa7150a2';
    public const USER_JD_NOK_ACCOUNT_CURRENCY = 'NOK';
    public const USER_JD_NZD_ACCOUNT_ID = '018af667-dde6-75b1-a0bf-5396b1800023';
    public const USER_JD_NZD_ACCOUNT_CURRENCY = 'NZD';
    public const USER_JD_PHP_ACCOUNT_ID = '018af667-de0d-7e2c-bc8c-204fb708fd10';
    public const USER_JD_PHP_ACCOUNT_CURRENCY = 'PHP';
    public const USER_JD_PLN_ACCOUNT_ID = '018af667-de30-7abd-b401-41200a1b3ff6';
    public const USER_JD_PLN_ACCOUNT_CURRENCY = 'PLN';
    public const USER_JD_RON_ACCOUNT_ID = '018af667-de50-70ca-8026-f98a7cc4f52c';
    public const USER_JD_RON_ACCOUNT_CURRENCY = 'RON';
    public const USER_JD_RUB_ACCOUNT_ID = '018af667-de76-7014-acb5-a13e2c7ad2b0';
    public const USER_JD_RUB_ACCOUNT_CURRENCY = 'RUB';
    public const USER_JD_SEK_ACCOUNT_ID = '018af667-de9e-7b7a-ade8-d48c93655f5d';
    public const USER_JD_SEK_ACCOUNT_CURRENCY = 'SEK';
    public const USER_JD_SGD_ACCOUNT_ID = '018af667-decc-755e-af53-9cc4fc3dbd35';
    public const USER_JD_SGD_ACCOUNT_CURRENCY = 'SGD';
    public const USER_JD_THB_ACCOUNT_ID = '018af667-def9-7043-b5b3-e879dd3193af';
    public const USER_JD_THB_ACCOUNT_CURRENCY = 'THB';
    public const USER_JD_TRY_ACCOUNT_ID = '018af667-df24-7aa8-b20c-ed09093525a7';
    public const USER_JD_TRY_ACCOUNT_CURRENCY = 'TRY';
    public const USER_JD_USD_ACCOUNT_ID = '018af667-df55-7634-bc29-0a1eabeb2b47';
    public const USER_JD_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_JD_ZAR_ACCOUNT_ID = '018af667-df82-7dc1-acb2-f9ce76a24dd0';
    public const USER_JD_ZAR_ACCOUNT_CURRENCY = 'ZAR';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $userJohnDoe */
        $userJohnDoe = $manager->find(User::class, UserFixtures::USER_JOHN_DOE_ID);

        $data = [
            self::USER_JD_AUD_ACCOUNT_ID => self::USER_JD_AUD_ACCOUNT_CURRENCY,
            self::USER_JD_BGN_ACCOUNT_ID => self::USER_JD_BGN_ACCOUNT_CURRENCY,
            self::USER_JD_BRL_ACCOUNT_ID => self::USER_JD_BRL_ACCOUNT_CURRENCY,
            self::USER_JD_CAD_ACCOUNT_ID => self::USER_JD_CAD_ACCOUNT_CURRENCY,
            self::USER_JD_CHF_ACCOUNT_ID => self::USER_JD_CHF_ACCOUNT_CURRENCY,
            self::USER_JD_CNY_ACCOUNT_ID => self::USER_JD_CNY_ACCOUNT_CURRENCY,
            self::USER_JD_CZK_ACCOUNT_ID => self::USER_JD_CZK_ACCOUNT_CURRENCY,
            self::USER_JD_DKK_ACCOUNT_ID => self::USER_JD_DKK_ACCOUNT_CURRENCY,
            self::USER_JD_EUR_ACCOUNT_ID => self::USER_JD_EUR_ACCOUNT_CURRENCY,
            self::USER_JD_GBP_ACCOUNT_ID => self::USER_JD_GBP_ACCOUNT_CURRENCY,
            self::USER_JD_HKD_ACCOUNT_ID => self::USER_JD_HKD_ACCOUNT_CURRENCY,
            self::USER_JD_HUF_ACCOUNT_ID => self::USER_JD_HUF_ACCOUNT_CURRENCY,
            self::USER_JD_IDR_ACCOUNT_ID => self::USER_JD_IDR_ACCOUNT_CURRENCY,
            self::USER_JD_ILS_ACCOUNT_ID => self::USER_JD_ILS_ACCOUNT_CURRENCY,
            self::USER_JD_INR_ACCOUNT_ID => self::USER_JD_INR_ACCOUNT_CURRENCY,
            self::USER_JD_ISK_ACCOUNT_ID => self::USER_JD_ISK_ACCOUNT_CURRENCY,
            self::USER_JD_JPY_ACCOUNT_ID => self::USER_JD_JPY_ACCOUNT_CURRENCY,
            self::USER_JD_KRW_ACCOUNT_ID => self::USER_JD_KRW_ACCOUNT_CURRENCY,
            self::USER_JD_MXN_ACCOUNT_ID => self::USER_JD_MXN_ACCOUNT_CURRENCY,
            self::USER_JD_MYR_ACCOUNT_ID => self::USER_JD_MYR_ACCOUNT_CURRENCY,
            self::USER_JD_NOK_ACCOUNT_ID => self::USER_JD_NOK_ACCOUNT_CURRENCY,
            self::USER_JD_NZD_ACCOUNT_ID => self::USER_JD_NZD_ACCOUNT_CURRENCY,
            self::USER_JD_PHP_ACCOUNT_ID => self::USER_JD_PHP_ACCOUNT_CURRENCY,
            self::USER_JD_PLN_ACCOUNT_ID => self::USER_JD_PLN_ACCOUNT_CURRENCY,
            self::USER_JD_RON_ACCOUNT_ID => self::USER_JD_RON_ACCOUNT_CURRENCY,
            self::USER_JD_RUB_ACCOUNT_ID => self::USER_JD_RUB_ACCOUNT_CURRENCY,
            self::USER_JD_SEK_ACCOUNT_ID => self::USER_JD_SEK_ACCOUNT_CURRENCY,
            self::USER_JD_SGD_ACCOUNT_ID => self::USER_JD_SGD_ACCOUNT_CURRENCY,
            self::USER_JD_THB_ACCOUNT_ID => self::USER_JD_THB_ACCOUNT_CURRENCY,
            self::USER_JD_TRY_ACCOUNT_ID => self::USER_JD_TRY_ACCOUNT_CURRENCY,
            self::USER_JD_USD_ACCOUNT_ID => self::USER_JD_USD_ACCOUNT_CURRENCY,
            self::USER_JD_ZAR_ACCOUNT_ID => self::USER_JD_ZAR_ACCOUNT_CURRENCY,
        ];

        foreach ($data as $accountId => $currency) {
            $specification = new AccountSpecification(
                $accountId,
                new Currency($currency),
                $createdAt,
            );
            $account = $userJohnDoe->createAccount($specification);

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
