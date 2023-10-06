<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures\Exchange;

use Component\Exchange\Command\CreateExchangeRateCommand;
use Component\Exchange\Model\ExchangeRate;
use Component\Exchange\Specification\ExchangeRateSpecification;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;

final class EurExchangeRateFixtures extends AbstractFixture
{
    public const EUR_TO_AUD = 1.6470853379;
    public const EUR_TO_BGN = 1.9484877332;
    public const EUR_TO_BRL = 5.3064855468;
    public const EUR_TO_CAD = 1.433060112;
    public const EUR_TO_CHF = 0.9618505007;
    public const EUR_TO_CNY = 7.6516755665;
    public const EUR_TO_CZK = 24.3836953826;
    public const EUR_TO_DKK = 7.4561282488;
    public const EUR_TO_EUR = 1;
    public const EUR_TO_GBP = 0.8668015587;
    public const EUR_TO_HKD = 8.2052213722;
    public const EUR_TO_HRK = 7.3802792767;
    public const EUR_TO_HUF = 388.5008547262;
    public const EUR_TO_IDR = 16250.9717647573;
    public const EUR_TO_ILS = 4.0223865307;
    public const EUR_TO_INR = 87.2293265738;
    public const EUR_TO_ISK = 146.5795516261;
    public const EUR_TO_JPY = 157.0401791615;
    public const EUR_TO_KRW = 1417.158974101;
    public const EUR_TO_MXN = 18.5192317522;
    public const EUR_TO_MYR = 4.9414237439;
    public const EUR_TO_NOK = 11.3725034845;
    public const EUR_TO_NZD = 1.7637557544;
    public const EUR_TO_PHP = 59.4049326748;
    public const EUR_TO_PLN = 4.6148677025;
    public const EUR_TO_RON = 4.9725304396;
    public const EUR_TO_RUB = 103.8399335265;
    public const EUR_TO_SEK = 11.5823568309;
    public const EUR_TO_SGD = 1.4390865355;
    public const EUR_TO_THB = 38.8174913853;
    public const EUR_TO_TRY = 28.7529198061;
    public const EUR_TO_USD = 1.0480640665;
    public const EUR_TO_ZAR = 20.1400730567;

    public function load(ObjectManager $manager): void
    {
        $eur = new Currency('EUR');
        $now = new DateTimeImmutable();

        $eurToAud = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('AUD'), (string) self::EUR_TO_AUD, $now));
        $eurToBgn = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('BGN'), (string) self::EUR_TO_BGN, $now));
        $eurToBrl = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('BRL'), (string) self::EUR_TO_BRL, $now));
        $eurToCad = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('CAD'), (string) self::EUR_TO_CAD, $now));
        $eurToChf = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('CHF'), (string) self::EUR_TO_CHF, $now));
        $eurToCny = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('CNY'), (string) self::EUR_TO_CNY, $now));
        $eurToCzk = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('CZK'), (string) self::EUR_TO_CZK, $now));
        $eurToDkk = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('DKK'), (string) self::EUR_TO_DKK, $now));
        $eurToEur = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('EUR'), (string) self::EUR_TO_EUR, $now));
        $eurToGbp = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('GBP'), (string) self::EUR_TO_GBP, $now));
        $eurToHkd = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('HKD'), (string) self::EUR_TO_HKD, $now));
        $eurToHrk = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('HRK'), (string) self::EUR_TO_HRK, $now));
        $eurToHuf = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('HUF'), (string) self::EUR_TO_HUF, $now));
        $eurToIdr = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('IDR'), (string) self::EUR_TO_IDR, $now));
        $eurToIls = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('ILS'), (string) self::EUR_TO_ILS, $now));
        $eurToInr = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('INR'), (string) self::EUR_TO_INR, $now));
        $eurToIsk = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('ISK'), (string) self::EUR_TO_ISK, $now));
        $eurToJpy = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('JPY'), (string) self::EUR_TO_JPY, $now));
        $eurToKrw = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('KRW'), (string) self::EUR_TO_KRW, $now));
        $eurToMxn = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('MXN'), (string) self::EUR_TO_MXN, $now));
        $eurToMyr = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('MYR'), (string) self::EUR_TO_MYR, $now));
        $eurToNok = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('NOK'), (string) self::EUR_TO_NOK, $now));
        $eurToNzd = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('NZD'), (string) self::EUR_TO_NZD, $now));
        $eurToPhp = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('PHP'), (string) self::EUR_TO_PHP, $now));
        $eurToPln = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('PLN'), (string) self::EUR_TO_PLN, $now));
        $eurToRon = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('RON'), (string) self::EUR_TO_RON, $now));
        $eurToRub = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('RUB'), (string) self::EUR_TO_RUB, $now));
        $eurToSek = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('SEK'), (string) self::EUR_TO_SEK, $now));
        $eurToSgd = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('SGD'), (string) self::EUR_TO_SGD, $now));
        $eurToThb = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('THB'), (string) self::EUR_TO_THB, $now));
        $eurToTry = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('TRY'), (string) self::EUR_TO_TRY, $now));
        $eurToUsd = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('USD'), (string) self::EUR_TO_USD, $now));
        $eurToZar = new CreateExchangeRateCommand(new ExchangeRateSpecification($eur, new Currency('ZAR'), (string) self::EUR_TO_ZAR, $now));

        $manager->persist(ExchangeRate::create($eurToAud));
        $manager->persist(ExchangeRate::create($eurToBgn));
        $manager->persist(ExchangeRate::create($eurToBrl));
        $manager->persist(ExchangeRate::create($eurToCad));
        $manager->persist(ExchangeRate::create($eurToChf));
        $manager->persist(ExchangeRate::create($eurToCny));
        $manager->persist(ExchangeRate::create($eurToCzk));
        $manager->persist(ExchangeRate::create($eurToDkk));
        $manager->persist(ExchangeRate::create($eurToEur));
        $manager->persist(ExchangeRate::create($eurToGbp));
        $manager->persist(ExchangeRate::create($eurToHkd));
        $manager->persist(ExchangeRate::create($eurToHrk));
        $manager->persist(ExchangeRate::create($eurToHuf));
        $manager->persist(ExchangeRate::create($eurToIdr));
        $manager->persist(ExchangeRate::create($eurToIls));
        $manager->persist(ExchangeRate::create($eurToInr));
        $manager->persist(ExchangeRate::create($eurToIsk));
        $manager->persist(ExchangeRate::create($eurToJpy));
        $manager->persist(ExchangeRate::create($eurToKrw));
        $manager->persist(ExchangeRate::create($eurToMxn));
        $manager->persist(ExchangeRate::create($eurToMyr));
        $manager->persist(ExchangeRate::create($eurToNok));
        $manager->persist(ExchangeRate::create($eurToNzd));
        $manager->persist(ExchangeRate::create($eurToPhp));
        $manager->persist(ExchangeRate::create($eurToPln));
        $manager->persist(ExchangeRate::create($eurToRon));
        $manager->persist(ExchangeRate::create($eurToRub));
        $manager->persist(ExchangeRate::create($eurToSek));
        $manager->persist(ExchangeRate::create($eurToSgd));
        $manager->persist(ExchangeRate::create($eurToThb));
        $manager->persist(ExchangeRate::create($eurToTry));
        $manager->persist(ExchangeRate::create($eurToUsd));
        $manager->persist(ExchangeRate::create($eurToZar));

        $manager->flush();
    }
}
