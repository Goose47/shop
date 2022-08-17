<?php

namespace App\Models;

use App\Filters\OrderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'user_id'
    ];

    public function scopeFilter($query, OrderFilter $filter)
    {
        return $filter->apply($query);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
