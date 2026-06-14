<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function __map()
    {
        // Fungsi ini tidak sengaja ke-typo bawaan stub kadang, pastikan namanya 'up'
    }

    public function up(): void
    {
        Schema::table('users', function (Blueprint $schema) {
            // Menambahkan kolom is_active setelah kolom role, default-nya true (aktif)
            $schema->boolean('is_active')->default(true)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $schema) {
            $schema->dropColumn('is_active');
        });
    }
};