<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Criteria\Decorator;

use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Component\Transaction\Validator\Criteria\CreateTransactionCriteriaValidatorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final readonly class ChainCreateTransactionCriteriaValidator implements CreateTransactionCriteriaValidatorInterface
{
    /** @var PrioritizedCollection<CreateTransactionCriteriaValidatorInterface> */
    private PrioritizedCollection $validators;

    public function __construct()
    {
        $this->validators = new PrioritizedCollection();
    }

    public function add(CreateTransactionCriteriaValidatorInterface $criteriaValidator, int $priority = Priority::NORMAL): void
    {
        $this->validators->add($criteriaValidator, $priority);
    }

    public function __invoke(CreateTransactionCriteriaInterface $criteria): void
    {
        $this->validators->forAll(
            static function (CreateTransactionCriteriaValidatorInterface $criteriaValidator) use ($criteria): void {
                ($criteriaValidator)($criteria);
            },
        );
    }
}
