<?php

declare(strict_types=1);

namespace Component\Account\Operator;

use Component\Account\Criteria\GetUserAccountListCriteriaInterface;
use Pagerfanta\PagerfantaInterface;

interface AccountIteratorInterface
{
    /**
     * @return PagerfantaInterface<AccountBalanceInterface>
     */
    public function findByCriteria(GetUserAccountListCriteriaInterface $criteria): PagerfantaInterface;
}
