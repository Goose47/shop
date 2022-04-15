<?php

namespace App\UseCases\Products;

use App\Models\Product;
use App\Services\ImageStorageService;

class ProductDeleteUseCase
{
    private ImageStorageService $storage;

    public function __construct(ImageStorageService $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(Product $product): bool
    {
        foreach($product->images as $image) {
            $this->storage->deleteImage($image);
        }

        $product->delete();

        return true;
    }
}
