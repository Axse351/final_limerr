<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_bukti',
        'gudang',
        'pemasok',
        'product_id',
        'qty',
        'satuan',
        'harga_satuan',
        'total',
        'date',
        'time',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
