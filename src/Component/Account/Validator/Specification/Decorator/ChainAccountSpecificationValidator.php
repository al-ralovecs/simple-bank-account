<?php

declare(strict_types=1);

namespace Component\Account\Validator\Specification\Decorator;

use Component\Account\Operator\AccountSpecificationInterface;
use Component\Account\Validator\Specification\AccountSpecificationValidatorInterface;
use SN\Collection\Enum\Priority;
use SN\Collection\Model\PrioritizedCollection;

final readonly class ChainAccountSpecificationValidator implements AccountSpecificationValidatorInterface
{
    /** @var PrioritizedCollection<AccountSpecificationValidatorInterface> */
    private PrioritizedCollection $validators;

    public function __construct()
    {
        $this->validators = new PrioritizedCollection();
    }

    public function add(AccountSpecificationValidatorInterface $accountSpecificationValidator, int $priority = Priority::NORMAL): void
    {
        $this->validators->add($accountSpecificationValidator, $priority);
    }

    public function __invoke(AccountSpecificationInterface $specification): void
    {
        $this->validators->forAll(
            static function (AccountSpecificationValidatorInterface $validator) use ($specification): void {
                ($validator)($specification);
            },
        );
    }
}
