<?php

declare(strict_types=1);

namespace Application\Controller\Transaction;

use Component\Pagination\Response\PaginatedResponse;
use Component\Transaction\Bridge\Api\Request\GetAccountTransactionListRequest;
use Component\Transaction\Bridge\Api\Responder\GetAccountTransactionListActionResponder;
use Component\Transaction\Model\TransactionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/account/{accountId}/transaction',
    name: 'app.api.list_transactions',
    methods: [Request::METHOD_GET],
)]
final readonly class GetAccountTransactionListAction
{
    public function __construct(
        private GetAccountTransactionListActionResponder $responder,
    ) {
    }

    /**
     * @return PaginatedResponse<TransactionInterface>
     */
    public function __invoke(
        string $accountId,
        #[MapQueryParameter] ?int $limit,
        #[MapQueryParameter] ?int $offset,
    ): PaginatedResponse {
        return ($this->responder)(new GetAccountTransactionListRequest($accountId, $limit, $offset));
    }
}
