<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom role & branch_id ke tabel users.
     * - owner   : Pak Jayusman, akses penuh ke semua cabang
     * - manager : Kepala cabang, akses ke 1 cabang
     * - cashier : Kasir, hanya bisa input transaksi di cabangnya
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['owner', 'manager', 'supervisor', 'cashier', 'warehouse'])->default('cashier')->after('email');
            $table->foreignId('branch_id')
                  ->nullable()
                  ->after('role')
                  ->constrained()
                  ->nullOnDelete();   // null berarti akses semua cabang (owner)
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn(['role', 'branch_id']);
        });
    }
};
