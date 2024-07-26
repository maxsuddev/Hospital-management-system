<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
    protected $table = 'cash_box';

    protected $fillable = ['sum', 'remains', 'comment'];

}
