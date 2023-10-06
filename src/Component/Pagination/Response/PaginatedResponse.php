<?php

declare(strict_types=1);

namespace Component\Pagination\Response;

use Component\Pagination\Transformer\NullArrayDataTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Pagerfanta\Pagerfanta;
use Pagerfanta\PagerfantaInterface;
use Webmozart\Assert\Assert;

/**
 * @template T
 *
 * @implements PaginatedResponseInterface<T>
 */
readonly class PaginatedResponse implements PaginatedResponseInterface
{
    private TransformerAbstract $transformer;

    /**
     * @param PagerfantaInterface<T> $paginator
     */
    public function __construct(
        private PagerfantaInterface $paginator,
        TransformerAbstract $transformer = null,
    ) {
        $this->transformer = $transformer ?? new NullArrayDataTransformer();
    }

    /**
     * @return PagerfantaInterface<T>
     */
    public function paginator(): PagerfantaInterface
    {
        return $this->paginator;
    }

    public function toResource(): Collection
    {
        Assert::isInstanceOf($this->paginator, Pagerfanta::class);

        return new Collection(
            [...$this->paginator->getCurrentPageResults()],
            $this->transformer,
        );
    }
}
