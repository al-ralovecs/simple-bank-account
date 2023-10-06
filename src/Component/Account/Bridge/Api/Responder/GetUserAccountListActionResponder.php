<?php

declare(strict_types=1);

namespace Component\Account\Bridge\Api\Responder;

use Component\Account\Bridge\Api\Transformer\AccountBalanceTransformer;
use Component\Account\Criteria\GetUserAccountListCriteriaInterface;
use Component\Account\Operator\AccountInterface;
use Component\Account\Operator\AccountIteratorInterface;
use Component\Pagination\Response\PaginatedResponse;
use Pagerfanta\PagerfantaInterface;

final readonly class GetUserAccountListActionResponder
{
    public function __construct(
        private AccountIteratorInterface $accountIterator,
        private AccountBalanceTransformer $accountBalanceTransformer,
    ) {
    }

    /**
     * @return PaginatedResponse<AccountInterface>
     */
    public function __invoke(GetUserAccountListCriteriaInterface $criteria): PaginatedResponse
    {
        /** @var PagerfantaInterface<AccountInterface> $accounts */
        $accounts = $this->accountIterator
            ->findByCriteria($criteria)
            ->setAllowOutOfRangePages(true)
            ->setMaxPerPage($criteria->limit())
            ->setCurrentPage($criteria->pageNumber());

        return new PaginatedResponse($accounts, $this->accountBalanceTransformer);
    }
}
