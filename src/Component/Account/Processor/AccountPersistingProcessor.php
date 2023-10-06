<?php

declare(strict_types=1);

namespace Component\Account\Processor;

use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountPersisterInterface;

final readonly class AccountPersistingProcessor implements AccountProcessorInterface
{
    public function __construct(
        private AccountPersisterInterface $accountPersister,
    ) {
    }

    public function __invoke(AccountInterface $account): void
    {
        $this->accountPersister->save($account);
    }
}
