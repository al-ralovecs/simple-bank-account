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

final class BrianCoxAccountFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public const USER_BC_EUR_ACCOUNT_ID = '018af1fd-8d04-7082-b134-1e2e79bdf35c';
    public const USER_BC_EUR_ACCOUNT_CURRENCY = 'EUR';
    public const USER_BC_GBP_ACCOUNT_ID = '018af1fd-8d24-72af-9066-01c6e3394b3e';
    public const USER_BC_GBP_ACCOUNT_CURRENCY = 'GBP';
    public const USER_BC_USD_ACCOUNT_ID = '018af1fd-8d49-765a-ac2c-2bc2e37d6874';
    public const USER_BC_USD_ACCOUNT_CURRENCY = 'USD';
    public const USER_BC_JPY_ACCOUNT_ID = '018af1fd-8d6c-76c6-a1f0-86cf3ddcc373';
    public const USER_BC_JPY_ACCOUNT_CURRENCY = 'JPY';
    public const USER_BC_CHF_ACCOUNT_ID = '018af1fd-8d94-7397-9f4f-763a82fd0e7f';
    public const USER_BC_CHF_ACCOUNT_CURRENCY = 'CHF';
    public const USER_BC_AUD_ACCOUNT_ID = '018af1fd-8dc0-75d2-a450-4cab4d0c9436';
    public const USER_BC_AUD_ACCOUNT_CURRENCY = 'AUD';
    public const USER_BC_EUR2_ACCOUNT_ID = '018af1fd-8de4-75d4-8eea-89dd013ad6f6';
    public const USER_BC_EUR2_ACCOUNT_CURRENCY = 'EUR';
    public const USER_BC_BRL_ACCOUNT_ID = '018af1fd-8e0f-7ac9-9055-0d5e6ba9315d';
    public const USER_BC_BRL_ACCOUNT_CURRENCY = 'BRL';
    public const USER_BC_CAD_ACCOUNT_ID = '018af1fd-8e3c-7764-981e-1e5a404fdf76';
    public const USER_BC_CAD_ACCOUNT_CURRENCY = 'CAD';
    public const USER_BC_CNY_ACCOUNT_ID = '018af1fd-8e6b-7983-ba66-b4908bf5065b';
    public const USER_BC_CNY_ACCOUNT_CURRENCY = 'CNY';
    public const USER_BC_EGP_ACCOUNT_ID = '018af1fd-8e9c-7f3c-b130-bcda1705f46c';
    public const USER_BC_EGP_ACCOUNT_CURRENCY = 'EGP';
    public const USER_BC_GNF_ACCOUNT_ID = '018af1fd-8ecf-7932-a454-338ec0951db8';
    public const USER_BC_GNF_ACCOUNT_CURRENCY = 'GNF';
    public const USER_BC_HUF_ACCOUNT_ID = '018af1fd-8f01-74e8-bb65-bd4103ce73d8';
    public const USER_BC_HUF_ACCOUNT_CURRENCY = 'HUF';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        /** @var UserInterface $userBrianCox */
        $userBrianCox = $manager->find(User::class, UserFixtures::USER_BRIAN_COX_ID);

        foreach ([
            self::USER_BC_EUR_ACCOUNT_ID => self::USER_BC_EUR_ACCOUNT_CURRENCY,
            self::USER_BC_GBP_ACCOUNT_ID => self::USER_BC_GBP_ACCOUNT_CURRENCY,
            self::USER_BC_USD_ACCOUNT_ID => self::USER_BC_USD_ACCOUNT_CURRENCY,
            self::USER_BC_JPY_ACCOUNT_ID => self::USER_BC_JPY_ACCOUNT_CURRENCY,
            self::USER_BC_CHF_ACCOUNT_ID => self::USER_BC_CHF_ACCOUNT_CURRENCY,
            self::USER_BC_AUD_ACCOUNT_ID => self::USER_BC_AUD_ACCOUNT_CURRENCY,
            self::USER_BC_EUR2_ACCOUNT_ID => self::USER_BC_EUR2_ACCOUNT_CURRENCY,
            self::USER_BC_BRL_ACCOUNT_ID => self::USER_BC_BRL_ACCOUNT_CURRENCY,
            self::USER_BC_CAD_ACCOUNT_ID => self::USER_BC_CAD_ACCOUNT_CURRENCY,
            self::USER_BC_CNY_ACCOUNT_ID => self::USER_BC_CNY_ACCOUNT_CURRENCY,
            self::USER_BC_EGP_ACCOUNT_ID => self::USER_BC_EGP_ACCOUNT_CURRENCY,
            self::USER_BC_GNF_ACCOUNT_ID => self::USER_BC_GNF_ACCOUNT_CURRENCY,
            self::USER_BC_HUF_ACCOUNT_ID => self::USER_BC_HUF_ACCOUNT_CURRENCY,
                 ] as $accountId => $currency) {
            $accountSpecification = new AccountSpecification(
                $accountId,
                new Currency($currency),
                $createdAt,
            );
            $account = $userBrianCox->createAccount($accountSpecification);

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
