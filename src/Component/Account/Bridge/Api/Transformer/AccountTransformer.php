<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Transformer;

use Component\Account\Operator\AccountInterface;
use League\Fractal\TransformerAbstract;

final class AccountTransformer extends TransformerAbstract
{
    /**
     * @return array<string, string>
     */
    public function transform(AccountInterface $account): array
    {
        return [
            'id' => $account->id(),
            'currency' => $account->currency()->getCode(),
            'created_at' => $account->createdAt()->format('Y-m-d H:i:s'),
        ];
    }
}
