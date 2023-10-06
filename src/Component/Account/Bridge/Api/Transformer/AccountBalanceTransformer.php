<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Transformer;

use Component\Account\Operator\AccountBalanceInterface;
use Component\Money\Bridge\Factory\MoneyAmountFactory;
use League\Fractal\TransformerAbstract;

final class AccountBalanceTransformer extends TransformerAbstract
{
    /**
     * @return array<string, mixed>
     */
    public function transform(AccountBalanceInterface $result): array
    {
        return [
            'id' => $result->id(),
            'balance' => [
                'amount' => MoneyAmountFactory::amount($result->balance()),
                'currency' => $result->balance()->getCurrency()->getCode(),
            ],
            'created_at' => $result->createdAt()->format('Y-m-d H:i:s'),
        ];
    }
}
