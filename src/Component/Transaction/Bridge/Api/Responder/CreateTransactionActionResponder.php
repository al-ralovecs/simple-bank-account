<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Api\Responder;

use Component\Transaction\Command\Handler\CreateTransactionCriteriaHandler;
use Component\Transaction\Operator\CreateTransactionCommandFactoryInterface;
use Component\Transaction\Operator\CreateTransactionCriteriaCommandCriteriaInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class CreateTransactionActionResponder
{
    public function __construct(
        private CreateTransactionCommandFactoryInterface $createTransactionCommandFactory,
        private CreateTransactionCriteriaHandler $createTransactionHandler,
    ) {
    }

    public function __invoke(CreateTransactionCriteriaCommandCriteriaInterface $criteria): Response
    {
        $command = $this->createTransactionCommandFactory->create($criteria);

        ($this->createTransactionHandler)($command);

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Transaction accomplished',
        ], Response::HTTP_CREATED);
    }
}
