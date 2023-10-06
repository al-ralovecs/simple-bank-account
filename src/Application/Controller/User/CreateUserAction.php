<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Component\User\Bridge\Api\Request\CreateUserRequest;
use Component\User\Bridge\Api\Responder\CreateUserActionResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/user',
    name: 'app.api.create_user',
    methods: [Request::METHOD_POST],
)]
final readonly class CreateUserAction
{
    public function __construct(
        private CreateUserActionResponder $createUserActionResponder,
    ) {
    }

    public function __invoke(#[MapRequestPayload()] CreateUserRequest $request): Response
    {
        return ($this->createUserActionResponder)($request);
    }
}
