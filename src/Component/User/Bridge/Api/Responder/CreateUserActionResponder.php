<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Responder;

use Component\User\Bridge\Api\Request\CreateUserRequest;
use Component\User\Command\Handler\CreateUserHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class CreateUserActionResponder
{
    public function __construct(
        private CreateUserHandler $createUserHandler,
    ) {
    }

    public function __invoke(CreateUserRequest $request): Response
    {
        $command = $request->toCommand();

        ($this->createUserHandler)($command);

        return new JsonResponse([
            'status' => 'success',
            'user_id' => $command->id(),
            '@see' => sprintf('GET /api/user/%s', $command->id()),
        ], Response::HTTP_CREATED);
    }
}
