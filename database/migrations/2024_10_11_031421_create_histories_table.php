<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            
            // Foreign key reference to the 'transaksis' table
            $table->foreignId('transaksi_id')->constrained('transaksis')->cascadeOnUpdate()->cascadeOnDelete();
            
            // New field for transaction type
            $table->string('jenis_transaksi');  
            
            // Fields for date and time of transaction
            $table->date('tanggal');            
            $table->time('jam');                
            
            // Quantity field with a default value
            $table->integer('qty')->default(0); 
            
            // New field for 'namawahana' to be retrieved from users table
            $table->string('namawahana')->nullable(); // You can also set it to not nullable based on your requirement
            
            // Timestamps for created and updated records
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
