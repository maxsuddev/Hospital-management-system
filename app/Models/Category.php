<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
   protected $fillable = ['name', 'is_public', 'category_id'];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }


    public function services():HasMany
   {
       return $this->hasMany(Service::class);
   }
    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class,'category_doctor', 'category_id', 'doctor_id');
    }

}
