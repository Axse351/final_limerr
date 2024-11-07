<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan statement raw untuk mengubah enum
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'staff', 'scan1', 'scan2', 'scan3') DEFAULT 'staff'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan perubahan dengan menghapus nilai yang ditambahkan
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'staff') DEFAULT 'staff'");
    }
};
