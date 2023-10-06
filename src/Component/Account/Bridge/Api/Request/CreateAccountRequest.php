<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Request;

use Component\Account\Command\CreateAccountCommand;
use Component\Account\Specification\AccountSpecification;
use DateTimeImmutable;
use Money\Currency;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateAccountRequest
{
    private string $userId;

    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
        ])]
        public readonly string $currency,
    ) {
    }

    public function changeUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function toCommand(): CreateAccountCommand
    {
        /** @var non-empty-string $currency */
        $currency = strtoupper($this->currency);

        return new CreateAccountCommand(
            $this->userId,
            new AccountSpecification(
                (string) Uuid::v7(),
                new Currency($currency),
                new DateTimeImmutable(),
            ),
        );
    }
}
