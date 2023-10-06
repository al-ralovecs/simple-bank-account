<?php

declare(strict_types=1);

namespace Application\Controller\Transaction;

use Component\Transaction\Bridge\Api\Request\CreateTransactionCriteriaCommandRequest;
use Component\Transaction\Bridge\Api\Responder\CreateTransactionActionResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/transaction',
    name: 'app.api.create_transaction',
    methods: [Request::METHOD_POST],
)]
final readonly class CreateTransactionAction
{
    public function __construct(
        private CreateTransactionActionResponder $createTransactionActionResponder,
    ) {
    }

    public function __invoke(
        #[MapRequestPayload()] CreateTransactionCriteriaCommandRequest $request,
    ): Response {
        return ($this->createTransactionActionResponder)($request);
    }
}
