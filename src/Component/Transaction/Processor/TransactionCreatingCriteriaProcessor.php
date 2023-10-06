<?php

declare(strict_types=1);

namespace Component\Transaction\Processor;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Component\Transaction\Operator\TransactionCreatorInterface;

final readonly class TransactionCreatingCriteriaProcessor implements TransactionCriteriaProcessorInterface
{
    public function __construct(
        private TransactionCreatorInterface $transactionCreator,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaInterface $criteria): void
    {
        $this->transactionCreator->create($criteria);
    }
}
