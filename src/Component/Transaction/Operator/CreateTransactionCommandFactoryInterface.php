<?php

declare(strict_types=1);

namespace Component\Transaction\Operator;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;

interface CreateTransactionCommandFactoryInterface
{
    public function create(CreateTransactionCriteriaCommandCriteriaInterface $criteria): CreateTransactionCriteriaCommand;
}
