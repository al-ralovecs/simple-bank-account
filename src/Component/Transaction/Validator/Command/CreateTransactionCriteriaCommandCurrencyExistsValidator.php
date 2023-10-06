<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Command;

use Component\Currency\Exception\CurrencyDoesNotExistException;
use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Money\Currencies;

final readonly class CreateTransactionCriteriaCommandCurrencyExistsValidator implements CreateTransactionCriteriaCommandValidatorInterface
{
    public function __construct(
        private Currencies $currencies,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaCommand $command): void
    {
        if (true === $this->currencies->contains($command->amount()->getCurrency())) {
            return;
        }

        throw new CurrencyDoesNotExistException($command->amount()->getCurrency());
    }
}
