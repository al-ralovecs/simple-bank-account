<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Api\Transformer;

use Component\Money\Bridge\Factory\MoneyAmountFactory;
use Component\Transaction\Model\TransactionInterface;
use League\Fractal\TransformerAbstract;

final class TransactionTransformer extends TransformerAbstract
{
    /**
     * @return array<string, string>
     */
    public function transform(TransactionInterface $transaction): array
    {
        return [
            'id' => $transaction->id(),
            'amount' => MoneyAmountFactory::amount($transaction->amount()),
            'source_account' => $transaction->sourceAccount(),
            'created_at' => $transaction->createdAt()->format('Y-m-d H:i:s'),
        ];
    }
}
