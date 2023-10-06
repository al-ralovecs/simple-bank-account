<?php

declare(strict_types=1);

namespace Component\Pagination\Response;

use League\Fractal\Resource\ResourceInterface;

/**
 * Generic response class to return either an object or data array.
 */
interface ResponseInterface
{
    public function toResource(): ResourceInterface;
}
