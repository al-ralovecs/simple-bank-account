<?php

declare(strict_types=1);

namespace Component\Transaction\Processor\Decorator;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Component\Transaction\Processor\TransactionCriteriaProcessorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final readonly class ChainTransactionCriteriaProcessor implements TransactionCriteriaProcessorInterface
{
    /** @var PrioritizedCollection<TransactionCriteriaProcessorInterface> */
    private PrioritizedCollection $processors;

    public function __construct()
    {
        $this->processors = new PrioritizedCollection();
    }

    public function add(TransactionCriteriaProcessorInterface $transactionCriteriaProcessor, int $priority = Priority::NORMAL): void
    {
        $this->processors->add($transactionCriteriaProcessor, $priority);
    }

    public function __invoke(CreateTransactionCriteriaInterface $criteria): void
    {
        $this->processors->forAll(
            static function (TransactionCriteriaProcessorInterface $criteriaProcessor) use ($criteria): void {
                ($criteriaProcessor)($criteria);
            },
        );
    }
}
