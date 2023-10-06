<?php

declare(strict_types=1);

namespace Application\Controller\Account;

use Component\Account\Bridge\Api\Request\CreateAccountRequest;
use Component\Account\Bridge\Api\Responder\CreateAccountActionResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/user/{userId}/account',
    name: 'app.api.create_account',
    methods: [Request::METHOD_POST],
)]
final readonly class CreateAccountAction
{
    public function __construct(
        private CreateAccountActionResponder $createAccountActionResponder,
    ) {
    }

    public function __invoke(
        string $userId,
        #[MapRequestPayload()] CreateAccountRequest $request,
    ): Response {
        $request->changeUserId($userId);

        return ($this->createAccountActionResponder)($request);
    }
}
