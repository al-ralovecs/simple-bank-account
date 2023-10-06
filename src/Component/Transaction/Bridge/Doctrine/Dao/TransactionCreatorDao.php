<?php

declare(strict_types=1);

namespace Component\Transaction\Bridge\Doctrine\Dao;

use Component\Transaction\Exception\TransactionFailedException;
use Component\Transaction\Operator\CreateTransactionCriteriaInterface;
use Component\Transaction\Operator\TransactionCreatorInterface;
use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception as DBALException;
use Exception;
use Money\Money;
use Symfony\Component\Uid\Uuid;

final readonly class TransactionCreatorDao implements TransactionCreatorInterface
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    /**
     * @throws DBALException
     */
    public function create(CreateTransactionCriteriaInterface $criteria): void
    {
        $this->connection->beginTransaction();

        try {
            $this->createTransaction($criteria->sourceAccount(), $criteria->targetAccount(), $criteria->sourceAmount()->negative(), $criteria->operationTime());
            $this->createTransaction($criteria->targetAccount(), $criteria->sourceAccount(), $criteria->targetAmount(), $criteria->operationTime());

            $this->connection->commit();
        } catch (Exception $exception) {
            $this->connection->rollBack();

            throw new TransactionFailedException($exception->getMessage(), 400);
        }
    }

    /**
     * @throws DBALException
     */
    private function createTransaction(
        string $accountId,
        string $sourceAccountId,
        Money $amount,
        DateTimeImmutable $operationTime,
    ): void {
        $this->connection->insert('transaction', [
            'id' => (string) Uuid::v7(),
            'account_id' => $accountId,
            'source_account_id' => $sourceAccountId,
            'amount' => $amount->getAmount(),
            'currency' => $amount->getCurrency()->getCode(),
            'created_at' => $operationTime->format('Y-m-d H:i:s'),
        ]);
    }
}
