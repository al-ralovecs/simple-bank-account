<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Transformer;

use Component\User\Operator\UserInterface;
use League\Fractal\TransformerAbstract;

final class UserTransformer extends TransformerAbstract
{
    /**
     * @return array<string, string>
     */
    public function transform(UserInterface $user): array
    {
        return [
            'id' => $user->id(),
            'email' => $user->email(),
            'created_at' => $user->createdAt()->format('Y-m-d H:i:s'),
        ];
    }
}
