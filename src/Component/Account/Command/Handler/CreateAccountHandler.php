<?php

declare(strict_types=1);

namespace Component\Account\Command\Handler;

use Component\Account\Command\CreateAccountCommand;
use Component\Account\Processor\AccountProcessorInterface;
use Component\Account\Validator\Specification\AccountSpecificationValidatorInterface;
use Component\User\Operator\UserFetcherInterface;

final readonly class CreateAccountHandler
{
    public function __construct(
        private AccountSpecificationValidatorInterface $accountSpecificationValidator,
        private UserFetcherInterface $userFetcher,
        private AccountProcessorInterface $accountProcessor,
    ) {
    }

    public function __invoke(CreateAccountCommand $command): void
    {
        ($this->accountSpecificationValidator)($command->specification());

        $user = $this->userFetcher->getById($command->userId());
        $account = $user->createAccount($command->specification());

        ($this->accountProcessor)($account);
    }
}
