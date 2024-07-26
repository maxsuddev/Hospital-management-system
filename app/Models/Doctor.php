<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $table = 'persons';
    protected $fillable = [

        'category_id',
        'first_name',
        'telegram_id',
        'last_name',
        'phone',
        'birthday',
        'balance',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_doctor', 'doctor_id', 'category_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function box(): HasMany
    {
        return $this->hasMany(CashBoxDoctor::class);
    }
}
