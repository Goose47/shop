<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'extension', 'id'
    ];

    use HasFactory;

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getPathAttribute(): string
    {
        return "images/{$this->id}.{$this->extension}";
    }

    public function getFullLinkAttribute(): string
    {
        $link = env('APP_URL');

        return "$link/storage/{$this->path}";
    }
}
