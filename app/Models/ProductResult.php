<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan',
        'bahan_model',
        'qty',
        'date',
        'time',
        'status',
    ];
}
