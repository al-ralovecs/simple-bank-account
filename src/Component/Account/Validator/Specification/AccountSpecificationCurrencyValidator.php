<?php

declare(strict_types=1);

namespace Component\Account\Validator\Specification;

use Component\Account\Operator\AccountSpecificationInterface;
use Component\Currency\Exception\CurrencyDoesNotExistException;
use Money\Currencies\ISOCurrencies;

final readonly class AccountSpecificationCurrencyValidator implements AccountSpecificationValidatorInterface
{
    public function __invoke(AccountSpecificationInterface $specification): void
    {
        $validator = new ISOCurrencies();
        if (true === $validator->contains($specification->currency())) {
            return;
        }

        throw new CurrencyDoesNotExistException($specification->currency());
    }
}
