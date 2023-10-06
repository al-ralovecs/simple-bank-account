<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Gateway\Exchange;

use Component\Gateway\Operator\ResponseInterface;

final readonly class Response implements ResponseInterface
{
    public function __construct(
        private float $ratio,
    ) {
    }

    /**
     * @return numeric-string
     */
    public function ratio(): string
    {
        return (string) $this->ratio;
    }
}
