<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Normalise semua nilai status ke lowercase agar konsisten
     * dengan pengecekan strtolower() di blade dan controller.
     */
    public function up(): void
    {
        DB::table('bookings')->update([
            'status' => DB::raw("LOWER(status)")
        ]);
    }

    public function down(): void
    {
        // Tidak perlu di-rollback — lowercase sudah standar
    }
};
