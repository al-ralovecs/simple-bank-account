<?php

declare(strict_types=1);

namespace Component\User\Processor\Decorator;

use Component\User\Operator\UserInterface;
use Component\User\Processor\UserProcessorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final class ChainUserProcessor implements UserProcessorInterface
{
    /**
     * @var PrioritizedCollection<UserProcessorInterface>
     */
    private PrioritizedCollection $collection;

    public function __construct()
    {
        $this->collection = new PrioritizedCollection();
    }

    public function add(UserProcessorInterface $userProcessor, int $priority = Priority::NORMAL): void
    {
        $this->collection->add($userProcessor, $priority);
    }

    public function __invoke(UserInterface $user): void
    {
        $this->collection->forAll(
            static function (UserProcessorInterface $userProcessor) use ($user): void {
                ($userProcessor)($user);
            },
        );
    }
}
