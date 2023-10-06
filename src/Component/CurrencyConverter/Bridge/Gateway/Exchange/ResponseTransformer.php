<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Gateway\Exchange;

use Component\Gateway\Response\Transformer\AbstractClientJsonResponseTransformer;

final readonly class ResponseTransformer extends AbstractClientJsonResponseTransformer
{
    protected function parseResponseData(mixed $data): Response
    {
        assert(is_array($data));
        assert(array_key_exists('data', $data));
        assert(1 === count($data['data']));

        /** @var array<string, float> $result */
        $result = $data['data'];

        /** @var float $ratio */
        $ratio = current($result);

        return new Response($ratio);
    }
}
