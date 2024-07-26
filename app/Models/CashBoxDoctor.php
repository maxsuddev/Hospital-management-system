<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class CashBoxDoctor extends Model
{
    protected $table = 'cash_box_person';
    protected $fillable = ['doctor_id', 'order_service_id', 'sum', 'remains', 'comment'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderService::class);
    }

}
