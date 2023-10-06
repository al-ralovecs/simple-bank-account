<?php

declare(strict_types=1);

namespace Component\Exchange\Model;

use DateTimeImmutable;
use Money\Currency;

interface ExchangeRateInterface
{
    public function baseCurrency(): Currency;

    public function counterCurrency(): Currency;

    /**
     * @return numeric-string
     */
    public function ratio(): string;

    public function createdAt(): DateTimeImmutable;
}
