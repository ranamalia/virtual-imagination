<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom user_id ke tabel bookings dan
     * buat payment_method nullable (karena sekarang booking via WhatsApp).
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambah user_id jika belum ada
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')
                      ->references('id')->on('users')
                      ->onDelete('set null');
            }

            // Buat payment_method nullable (WhatsApp flow tidak butuh metode pembayaran di form)
            if (Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable()->default('whatsapp')->change();
            }

            // Normalise status default ke 'pending'
            $table->string('status')->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
