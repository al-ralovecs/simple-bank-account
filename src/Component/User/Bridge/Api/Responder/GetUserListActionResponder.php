<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Responder;

use Component\Pagination\Response\PaginatedResponse;
use Component\User\Bridge\Api\Transformer\UserTransformer;
use Component\User\Criteria\GetUserListCriteriaInterface;
use Component\User\Operator\UserFetcherInterface;
use Component\User\Operator\UserInterface;
use Pagerfanta\PagerfantaInterface;

final readonly class GetUserListActionResponder
{
    public function __construct(
        private UserFetcherInterface $userFetcher,
        private UserTransformer $transformer,
    ) {
    }

    /**
     * @return PaginatedResponse<UserInterface>
     */
    public function __invoke(GetUserListCriteriaInterface $criteria): PaginatedResponse
    {
        /** @var PagerfantaInterface<UserInterface> $users */
        $users = $this->userFetcher
            ->findByCriteria($criteria)
            ->setAllowOutOfRangePages(true)
            ->setMaxPerPage($criteria->limit())
            ->setCurrentPage($criteria->pageNumber());

        return new PaginatedResponse($users, $this->transformer);
    }
}
