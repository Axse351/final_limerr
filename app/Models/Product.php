<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'pemasok',
        'nomor_bukti',
        'name',
        'qty',
        'satuan',
        'harga_satuan',
        'total',
        'status',
    ];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
