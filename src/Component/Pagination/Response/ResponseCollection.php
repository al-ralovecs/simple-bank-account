<?php

declare(strict_types=1);

namespace Component\Pagination\Response;

use Component\Pagination\Transformer\NullArrayDataTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 * @template T
 */
readonly class ResponseCollection implements ResponseInterface
{
    private TransformerAbstract $transformer;

    /**
     * @param array<T> $response
     */
    public function __construct(
        private array $response,
        TransformerAbstract $transformer = null,
    ) {
        $this->transformer = $transformer ?? new NullArrayDataTransformer();
    }

    public function toResource(): Collection
    {
        return new Collection($this->response, $this->transformer);
    }
}
