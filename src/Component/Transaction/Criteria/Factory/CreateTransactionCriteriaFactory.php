<?php

declare(strict_types=1);

namespace Component\Transaction\Criteria\Factory;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Criteria\CreateTransactionCriteria;
use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Money\Converter;

final readonly class CreateTransactionCriteriaFactory
{
    public function __construct(
        private Converter $currencyConverter,
    ) {
    }

    public function create(CreateTransactionCriteriaCommand $command): CreateTransactionCriteriaInterface
    {
        if ($command->sourceAccount()->currency()->equals($command->amount()->getCurrency())) {
            return $this->criteriaWithoutCurrencyConversion($command);
        }

        return $this->criteriaWithCurrencyConversion($command);
    }

    private function criteriaWithCurrencyConversion(CreateTransactionCriteriaCommand $command): CreateTransactionCriteriaInterface
    {
        $sourceAmount = $this->currencyConverter
            ->convert($command->amount(), $command->sourceAccount()->currency());

        return new CreateTransactionCriteria(
            $command->sourceAccount()->id(),
            $sourceAmount,
            $command->targetAccount()->id(),
            $command->amount(),
            $command->createdAt(),
        );
    }

    private function criteriaWithoutCurrencyConversion(CreateTransactionCriteriaCommand $command): CreateTransactionCriteriaInterface
    {
        return new CreateTransactionCriteria(
            $command->sourceAccount()->id(),
            $command->amount(),
            $command->targetAccount()->id(),
            $command->amount(),
            $command->createdAt(),
        );
    }
}
