<?php

declare(strict_types=1);

namespace Component\Account\Validator\Specification;

use Component\Account\Operator\AccountSpecificationInterface;

interface AccountSpecificationValidatorInterface
{
    public function __invoke(AccountSpecificationInterface $specification): void;
}
