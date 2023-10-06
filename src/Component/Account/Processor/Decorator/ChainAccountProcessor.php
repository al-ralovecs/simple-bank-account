<?php

declare(strict_types=1);

namespace Component\Account\Processor\Decorator;

use Component\Account\Operator\AccountInterface;
use Component\Account\Processor\AccountProcessorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final readonly class ChainAccountProcessor implements AccountProcessorInterface
{
    /** @var PrioritizedCollection<AccountProcessorInterface> */
    private PrioritizedCollection $processors;

    public function __construct()
    {
        $this->processors = new PrioritizedCollection();
    }

    public function add(AccountProcessorInterface $accountProcessor, int $priority = Priority::NORMAL): void
    {
        $this->processors->add($accountProcessor, $priority);
    }

    public function __invoke(AccountInterface $account): void
    {
        $this->processors->forAll(
            static function (AccountProcessorInterface $accountProcessor) use ($account): void {
                ($accountProcessor)($account);
            },
        );
    }
}
