<?php

declare(strict_types=1);

namespace Component\Transaction\Command\Factory;

use Component\Account\Operator\AccountFetcherInterface;
use Component\Transaction\Command\CreateTransactionCriteriaCommand;
use Component\Transaction\Operator\CreateTransactionCommandFactoryInterface;
use Component\Transaction\Operator\CreateTransactionCriteriaCommandCriteriaInterface;
use DateTimeImmutable;

final readonly class CreateTransactionCriteriaCommandFactory implements CreateTransactionCommandFactoryInterface
{
    public function __construct(
        private AccountFetcherInterface $accountFetcher,
    ) {
    }

    public function create(CreateTransactionCriteriaCommandCriteriaInterface $criteria): CreateTransactionCriteriaCommand
    {
        $sourceAccount = $this->accountFetcher->getById($criteria->sourceAccount());
        $targetAccount = $this->accountFetcher->getById($criteria->targetAccount());

        return new CreateTransactionCriteriaCommand(
            $sourceAccount,
            $targetAccount,
            $criteria->amount(),
            new DateTimeImmutable(),
        );
    }
}
