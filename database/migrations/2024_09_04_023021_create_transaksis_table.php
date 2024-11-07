<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id(); // Creates the id column
            $table->string('nm_konsumen'); // Name of the consumer
            $table->string('nohp'); // Phone number
            $table->foreignId('paket_id')->constrained('pakets')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->integer('wahana'); // Number of rides
            // $table->integer('porsi'); // Number of portions
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
