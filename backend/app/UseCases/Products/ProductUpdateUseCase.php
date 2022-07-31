<?php

namespace App\UseCases\Products;

use App\Http\Requests\Products\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ImageStorageService;
use Illuminate\Support\Collection;

class ProductUpdateUseCase
{
    private ImageStorageService $storage;

    public function __construct(ImageStorageService $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(ProductUpdateRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price') * 100,
        ]);

        if($request->has('images')){
            $previousImages = $product->images;
            $imagesToStay = $request->input('images');
            $imagesToSave = $request->file('images');

            $imagesToDelete = $previousImages->filter(function($value, $key) use ($imagesToStay) {
                 return !collect($imagesToStay)->contains($value->id);
            });
            $this->delete($imagesToDelete);

            $this->save($imagesToSave, $product);
        }

        return $product->refresh();
    }

    private function delete(Collection $images)
    {
        foreach($images as $image) {
            $this->storage->deleteImage($image);
        }
    }

    private function save(?array $images, Product $product)
    {
        if(is_null($images)) {
            return;
        }

        foreach($images as $image) {
            $imageToSave = $this->storage->saveImage($image);

            $product->images()->save($imageToSave);
        }
    }
}
