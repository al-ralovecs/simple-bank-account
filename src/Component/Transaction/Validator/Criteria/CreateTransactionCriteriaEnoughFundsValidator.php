<?php

declare(strict_types=1);

namespace Component\Transaction\Validator\Criteria;

use Component\Account\Operator\AccountBalanceFetcherInterface;
use Component\Transaction\Exception\InsufficientFundsTransactionException;
use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Money\Money;

final readonly class CreateTransactionCriteriaEnoughFundsValidator implements CreateTransactionCriteriaValidatorInterface
{
    public function __construct(
        private AccountBalanceFetcherInterface $accountBalanceFetcher,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaInterface $criteria): void
    {
        $intBalance = $this->accountBalanceFetcher->accountBalance($criteria->sourceAccount());
        $balance = new Money($intBalance, $criteria->sourceAmount()->getCurrency());
        if (0 <= $balance->compare($criteria->sourceAmount())) {
            return;
        }

        throw new InsufficientFundsTransactionException($criteria->sourceAccount(), $balance, $criteria->sourceAmount());
    }
}
