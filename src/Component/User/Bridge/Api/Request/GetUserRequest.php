<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetUserRequest
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(),
            new Assert\Type('string'),
            new Assert\Uuid(),
        ])]
        private string $userId,
    ) {
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
