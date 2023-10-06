<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Component\Pagination\Response\PaginatedResponse;
use Component\User\Bridge\Api\Request\GetUserListRequest;
use Component\User\Bridge\Api\Responder\GetUserListActionResponder;
use Component\User\Operator\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/user',
    name: 'app.api.list_users',
    methods: [Request::METHOD_GET],
)]
final readonly class GetUserListAction
{
    public function __construct(
        private GetUserListActionResponder $getUserListActionResponder,
    ) {
    }

    /**
     * @return PaginatedResponse<UserInterface>
     */
    public function __invoke(
        #[MapQueryParameter] ?int $limit,
        #[MapQueryParameter] ?int $offset,
    ): PaginatedResponse {
        return ($this->getUserListActionResponder)(new GetUserListRequest($limit, $offset));
    }
}
