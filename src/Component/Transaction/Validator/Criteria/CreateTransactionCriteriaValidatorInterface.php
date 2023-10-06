<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Criteria;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;

interface CreateTransactionCriteriaValidatorInterface
{
    public function __invoke(CreateTransactionCriteriaInterface $criteria): void;
}
