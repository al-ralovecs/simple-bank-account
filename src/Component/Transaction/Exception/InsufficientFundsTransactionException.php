<?php

declare(strict_types=1);

namespace Component\Transaction\Exception;

use Money\Money;
use RuntimeException;

final class InsufficientFundsTransactionException extends RuntimeException
{
    private const MESSAGE = 'Account "%s" has "%s %s" at its balance, while it requires "%s %s" for transaction to be accomplished';

    public function __construct(string $accountId, Money $balance, Money $requiredAmount)
    {
        parent::__construct(sprintf(
            self::MESSAGE,
            $accountId,
            $balance->getAmount(),
            $balance->getCurrency()->getCode(),
            $requiredAmount->getAmount(),
            $requiredAmount->getCurrency()->getCode(),
        ), 400);
    }
}
