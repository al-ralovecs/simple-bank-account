<?php

declare(strict_types=1);

namespace Component\Pagination\Response;

use Component\Pagination\Exception\InvalidResponseArgumentException;
use Component\Pagination\Transformer\NullArrayDataTransformer;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * @template T
 */
class Response implements ResponseInterface
{
    private readonly TransformerAbstract $transformer;

    /**
     * @param T $response
     */
    public function __construct(
        private readonly mixed $response,
        TransformerAbstract $transformer = null,
    ) {
        if ((null === $transformer) && !is_array($response)) {
            throw InvalidResponseArgumentException::missingTransformer($response);
        }
        $this->transformer = $transformer ?? new NullArrayDataTransformer();
    }

    public function toResource(): Item
    {
        return new Item(
            $this->response,
            $this->transformer,
        );
    }
}
