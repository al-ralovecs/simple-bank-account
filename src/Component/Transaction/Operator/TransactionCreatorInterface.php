<?php

declare(strict_types=1);

namespace Component\Transaction\Operator;

interface TransactionCreatorInterface
{
    public function create(CreateTransactionCriteriaInterface $criteria): void;
}
