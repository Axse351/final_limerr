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
        Schema::create('product_results', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_produksi');
            $table->string('karyawan');
            $table->string('bagian');
            $table->date('date');
            $table->string('product');
            $table->integer('qty')->default(0);
            $table->string('satuan');
            $table->integer('harga_satuan')->default(0);
            $table->integer('total')->default(0);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_results');
    }
};
