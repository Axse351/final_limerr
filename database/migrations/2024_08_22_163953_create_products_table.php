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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('pemasok');
            $table->string('nomor_bukti');
            $table->string('name');
            $table->integer('qty')->default(0);
            $table->string('satuan');
            $table->integer('harga_satuan')->default(0);
            $table->integer('total')->default(0);
            $table->enum('status', ['Belum Validasi', 'Validasi'])->default('Belum Validasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
