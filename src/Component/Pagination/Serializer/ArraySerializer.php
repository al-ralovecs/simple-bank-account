<?php

declare(strict_types=1);

namespace Component\Pagination\Serializer;

use League\Fractal\Serializer\ArraySerializer as BaseSerializer;

final class ArraySerializer extends BaseSerializer
{
    /**
     * @param array<mixed> $meta
     *
     * @return array<mixed>
     */
    public function meta(array $meta): array
    {
        return $meta;
    }
}
