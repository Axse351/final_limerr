<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{

    protected $table = 'histories';
    protected $fillable = [
        'transaksi_id',
        'jenis_transaksi',
        'tanggal',
        'jam',
        'qty',
        'user_id', // Assuming you add a user_id column
        'namawahana', // Optional if you want to store it directly in Histories
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id'); // Ensure foreign key matches
    }
}
