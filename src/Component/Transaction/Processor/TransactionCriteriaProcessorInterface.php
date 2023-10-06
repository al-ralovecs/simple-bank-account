<?php

declare(strict_types=1);

namespace Component\Transaction\Processor;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;

interface TransactionCriteriaProcessorInterface
{
    public function __invoke(CreateTransactionCriteriaInterface $criteria): void;
}
