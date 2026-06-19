<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rename phone → whatsapp jika belum ada kolom whatsapp
            if (Schema::hasColumn('bookings', 'phone') && !Schema::hasColumn('bookings', 'whatsapp')) {
                $table->renameColumn('phone', 'whatsapp');
            } elseif (!Schema::hasColumn('bookings', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('email');
            }

            // Hapus payment_method jika ada
            if (Schema::hasColumn('bookings', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            // Ubah default status
            $table->string('status')->default('menunggu_konfirmasi')->change();
        });

        // Update semua status lama ke nilai baru yang paling dekat
        DB::table('bookings')->where('status', 'pending')->update(['status' => 'menunggu_konfirmasi']);
        DB::table('bookings')->where('status', 'confirmed')->update(['status' => 'terkonfirmasi']);
        DB::table('bookings')->where('status', 'scheduled')->update(['status' => 'menunggu_pembayaran']);
        DB::table('bookings')->where('status', 'rejected')->update(['status' => 'ditolak']);
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'whatsapp') && !Schema::hasColumn('bookings', 'phone')) {
                $table->renameColumn('whatsapp', 'phone');
            }
            if (!Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable()->default('whatsapp');
            }
            $table->string('status')->default('pending')->change();
        });
    }
};
