<?php

declare(strict_types=1);

namespace Component\Pagination\Response;

use League\Fractal\Resource\Collection;
use Pagerfanta\PagerfantaInterface;

/**
 * @template T
 *
 * This is a generic class for returning paginated list of objects / arrays.
 * If you return objects, transformer is required.
 */
interface PaginatedResponseInterface extends ResponseInterface
{
    /**
     * @return PagerfantaInterface<T>
     */
    public function paginator(): PagerfantaInterface;

    public function toResource(): Collection;
}
