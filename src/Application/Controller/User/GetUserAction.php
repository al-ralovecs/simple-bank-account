<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Component\Pagination\Response\Response;
use Component\User\Bridge\Api\Request\GetUserRequest;
use Component\User\Bridge\Api\Responder\GetUserActionResponder;
use Component\User\Operator\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/user/{userId}',
    name: 'app.api.user',
    methods: [Request::METHOD_GET],
)]
final readonly class GetUserAction
{
    public function __construct(
        private GetUserActionResponder $getUserActionResponder,
    ) {
    }

    /**
     * @return Response<UserInterface>
     */
    public function __invoke(string $userId): Response
    {
        return ($this->getUserActionResponder)(new GetUserRequest($userId));
    }
}
