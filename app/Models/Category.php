<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'satuan',
        'kelompok_produk',
    ];

    // public function product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
