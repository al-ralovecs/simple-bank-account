<?php

declare(strict_types=1);

namespace Component\User\Operator;

use Component\User\Criteria\GetUserListCriteriaInterface;
use Pagerfanta\PagerfantaInterface;

interface UserFetcherInterface
{
    public function getById(string $userId): UserInterface;

    public function findByEmail(string $userEmail): ?UserInterface;

    /** @return PagerfantaInterface<UserInterface> */
    public function findByCriteria(GetUserListCriteriaInterface $criteria): PagerfantaInterface;
}
