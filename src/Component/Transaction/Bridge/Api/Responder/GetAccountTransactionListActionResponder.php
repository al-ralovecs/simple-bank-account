<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Api\Responder;

use Component\Pagination\Response\PaginatedResponse;
use Component\Transaction\Bridge\Api\Transformer\TransactionTransformer;
use Component\Transaction\Criteria\GetAccountTransactionListCriteriaInterface;
use Component\Transaction\Model\TransactionInterface;
use Component\Transaction\Operator\TransactionIteratorInterface;
use Pagerfanta\PagerfantaInterface;

final readonly class GetAccountTransactionListActionResponder
{
    public function __construct(
        private TransactionIteratorInterface $transactionIterator,
        private TransactionTransformer $transactionTransformer,
    ) {
    }

    /**
     * @return PaginatedResponse<TransactionInterface>
     */
    public function __invoke(GetAccountTransactionListCriteriaInterface $criteria): PaginatedResponse
    {
        /** @var PagerfantaInterface<TransactionInterface> $transactions */
        $transactions = $this->transactionIterator
            ->findByCriteria($criteria)
            ->setAllowOutOfRangePages(true)
            ->setMaxPerPage($criteria->limit())
            ->setCurrentPage($criteria->pageNumber());

        return new PaginatedResponse($transactions, $this->transactionTransformer);
    }
}
