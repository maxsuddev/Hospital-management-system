<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Log;

class OrderService extends Pivot
{
    protected $table = 'order_service';
    protected $fillable = ['order_id', 'service_id', 'quantity', 'price'];




    public $incrementing = true; // Pivot modelida ID ustuni mavjudligini belgilash uchun



}
