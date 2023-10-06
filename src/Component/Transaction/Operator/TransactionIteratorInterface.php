<?php

declare(strict_types=1);

namespace Component\Transaction\Operator;

use Component\Transaction\Criteria\GetAccountTransactionListCriteriaInterface;
use Component\Transaction\Model\TransactionInterface;
use Pagerfanta\PagerfantaInterface;

interface TransactionIteratorInterface
{
    /**
     * @return PagerfantaInterface<TransactionInterface>
     */
    public function findByCriteria(GetAccountTransactionListCriteriaInterface $criteria): PagerfantaInterface;
}
