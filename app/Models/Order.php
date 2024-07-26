<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'full_name',
        'address',
        'phone',
        'age',
    ];

    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->using(OrderService::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
