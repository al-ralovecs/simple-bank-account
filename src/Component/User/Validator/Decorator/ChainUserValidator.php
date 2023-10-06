<?php

declare(strict_types=1);

namespace Component\User\Validator\Decorator;

use Component\User\Operator\UserInterface;
use Component\User\Validator\UserValidatorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final class ChainUserValidator implements UserValidatorInterface
{
    /**
     * @var PrioritizedCollection<UserValidatorInterface>
     */
    private PrioritizedCollection $collection;

    public function __construct()
    {
        $this->collection = new PrioritizedCollection();
    }

    public function add(UserValidatorInterface $userValidator, int $priority = Priority::NORMAL): void
    {
        $this->collection->add($userValidator, $priority);
    }

    public function __invoke(UserInterface $user): void
    {
        $this->collection->forAll(
            static function (UserValidatorInterface $userValidator) use ($user): void {
                ($userValidator)($user);
            },
        );
    }
}
