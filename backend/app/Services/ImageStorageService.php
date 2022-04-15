<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageStorageService
{
    public function saveImage(UploadedFile $image): Image
    {
        $savedImage = $this->getImageModel($image->getClientOriginalExtension());

        Storage::putFileAs("images/", $image, "{$savedImage->id}.{$image->getClientOriginalExtension()}");

        return $savedImage;
    }

    public function deleteImage(Image $image)
    {
        Storage::delete("/images/{$image->id}.{$image->extension}");

        $image->delete();
    }

    public function getImageModel(string $extension): Image
    {
        return new Image([
            'id' => Str::uuid(),
            'extension' => $extension
        ]);
    }
}
