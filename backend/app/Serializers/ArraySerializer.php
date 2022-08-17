<?php

namespace App\Serializers;

/**
 * A serializer class used in fractal.php config for removing 'data' wrapper in included collections
 * by passing 'false' string in resourceKey property of collection method of Transformer class
 */
class ArraySerializer extends \League\Fractal\Serializer\ArraySerializer
{
    /**
     * {@inheritDoc}
     */
    public function collection(string $resourceKey, array $data): array
    {
        if ($resourceKey === 'false') {
            return $data;
        }

        return [$resourceKey ?: 'data' => $data];
    }
}
