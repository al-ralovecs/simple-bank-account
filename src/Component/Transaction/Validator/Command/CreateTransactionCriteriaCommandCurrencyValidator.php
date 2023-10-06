<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Command;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Exception\CurrencyMismatchTransactionException;

final readonly class CreateTransactionCriteriaCommandCurrencyValidator implements CreateTransactionCriteriaCommandValidatorInterface
{
    public function __invoke(CreateTransactionCriteriaCommand $command): void
    {
        if ($command->amount()->getCurrency()->equals($command->targetAccount()->currency())) {
            return;
        }

        throw new CurrencyMismatchTransactionException($command->amount()->getCurrency(), $command->targetAccount()->currency());
    }
}
