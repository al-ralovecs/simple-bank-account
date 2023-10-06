<?php

declare(strict_types=1);

namespace Component\Transaction\Processor;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Component\Transaction\Validator\Criteria\CreateTransactionCriteriaValidatorInterface;

final readonly class TransactionCriteriaValidatingProcessor implements TransactionCriteriaProcessorInterface
{
    public function __construct(
        private CreateTransactionCriteriaValidatorInterface $criteriaValidator,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaInterface $criteria): void
    {
        ($this->criteriaValidator)($criteria);
    }
}
