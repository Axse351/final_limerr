<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';

    protected $fillable = [
        'nm_paket',
        'wahana',
        'porsi',
    ];

     public function transaksis()
     {
         return $this->hasMany(Transaksi::class, 'paket_id');
     }
}
