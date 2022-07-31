<?php

namespace App\UseCases\Products;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Models\Image;
use App\Models\Product;
use App\Services\ImageStorageService;
use DB;

class ProductStoreUseCase
{
    private ImageStorageService $storage;

    public function __construct(ImageStorageService $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(ProductStoreRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price') * 100,
        ]);

        if ($request->has('images')) {
            foreach($request->file('images') as $image) {
                $image = $this->storage->saveImage($image);

                $product->images()->save($image);
            }
        }

        return $product->refresh();
    }
}
