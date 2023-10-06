<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Responder;

use Component\Account\Bridge\Api\Request\CreateAccountRequest;
use Component\Account\Command\Handler\CreateAccountHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class CreateAccountActionResponder
{
    public function __construct(
        private CreateAccountHandler $createAccountHandler,
    ) {
    }

    public function __invoke(CreateAccountRequest $request): Response
    {
        $command = $request->toCommand();

        ($this->createAccountHandler)($command);

        return new JsonResponse([
            'status' => 'success',
            'account_id' => $command->specification()->id(),
        ], Response::HTTP_CREATED);
    }
}
