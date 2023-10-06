<?php

declare(strict_types=1);

namespace Component\Exchange\Bridge\Doctrine\Repository;

use Component\Exchange\Model\ExchangeRate;
use Component\Exchange\Model\ExchangeRateInterface;
use Component\Exchange\Operator\ExchangeRateFetcherInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Money\Currency;

/**
 * @extends ServiceEntityRepository<ExchangeRateInterface>
 */
final class ExchangeRateRepository extends ServiceEntityRepository implements ExchangeRateFetcherInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExchangeRate::class);
    }

    public function findByCurrencies(Currency $baseCurrency, Currency $counterCurrency): ?ExchangeRateInterface
    {
        return $this->findOneBy([
            'baseCurrency' => $baseCurrency->getCode(),
            'counterCurrency' => $counterCurrency->getCode(),
        ]);
    }
}
