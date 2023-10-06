<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Command;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;

interface CreateTransactionCriteriaCommandValidatorInterface
{
    public function __invoke(CreateTransactionCriteriaCommand $command): void;
}
