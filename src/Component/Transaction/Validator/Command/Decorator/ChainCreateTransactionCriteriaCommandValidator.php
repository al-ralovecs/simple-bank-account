<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Command\Decorator;

use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Validator\Command\CreateTransactionCriteriaCommandValidatorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final readonly class ChainCreateTransactionCriteriaCommandValidator implements CreateTransactionCriteriaCommandValidatorInterface
{
    /** @var PrioritizedCollection<CreateTransactionCriteriaCommandValidatorInterface> */
    private PrioritizedCollection $validators;

    public function __construct()
    {
        $this->validators = new PrioritizedCollection();
    }

    public function add(CreateTransactionCriteriaCommandValidatorInterface $validator, int $priority = Priority::NORMAL): void
    {
        $this->validators->add($validator, $priority);
    }

    public function __invoke(CreateTransactionCriteriaCommand $command): void
    {
        $this->validators->forAll(
            static function (CreateTransactionCriteriaCommandValidatorInterface $validator) use ($command): void {
                ($validator)($command);
            },
        );
    }
}
