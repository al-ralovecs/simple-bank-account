<?php

declare(strict_types=1);

namespace Application\Controller\Account;

use Component\Account\Bridge\Api\Request\GetUserAccountListRequest;
use Component\Account\Bridge\Api\Responder\GetUserAccountListActionResponder;
use Component\Account\Operator\AccountInterface;
use Component\Pagination\Response\PaginatedResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/user/{userId}/account',
    name: 'app.api.list_accounts',
    methods: [Request::METHOD_GET],
)]
final readonly class GetUserAccountListAction
{
    public function __construct(
        private GetUserAccountListActionResponder $responder,
    ) {
    }

    /**
     * @return PaginatedResponse<AccountInterface>
     */
    public function __invoke(
        string $userId,
        #[MapQueryParameter] ?int $limit,
        #[MapQueryParameter] ?int $offset,
    ): PaginatedResponse {
        return ($this->responder)(new GetUserAccountListRequest($userId, $limit, $offset));
    }
}
