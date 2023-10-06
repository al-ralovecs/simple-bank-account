<?php

declare(strict_types=1);

namespace Component\Pagination\Transformer;

use League\Fractal\TransformerAbstract;

final class NullArrayDataTransformer extends TransformerAbstract
{
    /**
     * @param array<mixed, mixed> $data
     *
     * @return array<mixed, mixed>
     */
    public function transform(array $data): array
    {
        return $data;
    }
}
