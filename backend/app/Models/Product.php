<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
    ];

    use HasFactory;

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
