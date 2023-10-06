<?php

declare(strict_types=1);

namespace Component\Transaction\Command\Handler;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Criteria\Factory\CreateTransactionCriteriaFactory;
use Component\Transaction\Processor\TransactionCriteriaProcessorInterface;
use Component\Transaction\Validator\Command\CreateTransactionCriteriaCommandValidatorInterface;

final readonly class CreateTransactionCriteriaHandler
{
    public function __construct(
        private CreateTransactionCriteriaCommandValidatorInterface $commandValidator,
        private CreateTransactionCriteriaFactory $criteriaFactory,
        private TransactionCriteriaProcessorInterface $transactionCriteriaProcessor,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaCommand $command): void
    {
        ($this->commandValidator)($command);

        $criteria = $this->criteriaFactory->create($command);

        ($this->transactionCriteriaProcessor)($criteria);
    }
}
