<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Command;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Exception\InvalidAccountTransactionException;

final readonly class CreateTransactionCriteriaCommandSameAccountValidator implements CreateTransactionCriteriaCommandValidatorInterface
{
    public function __invoke(CreateTransactionCriteriaCommand $command): void
    {
        if ($command->sourceAccount()->id() !== $command->targetAccount()->id()) {
            return;
        }

        throw InvalidAccountTransactionException::sameAccount($command->sourceAccount()->id());
    }
}
