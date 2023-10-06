<?php

declare(strict_types=1);

namespace Component\Exchange\Model;

use Component\Exchange\Command\CreateExchangeRateCommand;
use DateTimeImmutable;
use Money\Currency;

final readonly class ExchangeRate implements ExchangeRateInterface
{
    public function __construct(
        /** @var non-empty-string $baseCurrency */
        private string $baseCurrency,
        /** @var non-empty-string $counterCurrency */
        private string $counterCurrency,
        /** @var numeric-string $ratio */
        private string $ratio,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public static function create(CreateExchangeRateCommand $command): self
    {
        return new self(
            $command->specification()->baseCurrency()->getCode(),
            $command->specification()->counterCurrency()->getCode(),
            $command->specification()->ratio(),
            $command->specification()->createdAt(),
        );
    }

    public function baseCurrency(): Currency
    {
        return new Currency($this->baseCurrency);
    }

    public function counterCurrency(): Currency
    {
        return new Currency($this->counterCurrency);
    }

    /**
     * @return numeric-string
     */
    public function ratio(): string
    {
        return $this->ratio;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
