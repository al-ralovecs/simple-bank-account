<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Api\Request;

use Component\Transaction\Operator\CreateTransactionCriteriaCommandCriteriaInterface;
use Money\Currency;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateTransactionCriteriaCommandRequest implements CreateTransactionCriteriaCommandCriteriaInterface
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
            new Assert\Uuid(),
        ])]
        public string $sourceAccount,

        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
            new Assert\Uuid(),
        ])]
        public string $targetAccount,

        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
        ])]
        public string $currency,

        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('integer'),
        ])]
        public int $amount,
    ) {
    }

    public function sourceAccount(): string
    {
        return $this->sourceAccount;
    }

    public function targetAccount(): string
    {
        return $this->targetAccount;
    }

    public function amount(): Money
    {
        /** @var non-empty-string $currency */
        $currency = $this->currency;

        return new Money($this->amount, new Currency($currency));
    }
}
