<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya insert jika belum ada data
        if (DB::table('payment_settings')->count() === 0) {
            DB::table('payment_settings')->insert([
                'nama_bank'       => 'BCA',
                'nomor_rekening'  => '1234567890',
                'nama_pemilik'    => 'Virtual Imagination Studio',
                'whatsapp_number' => '6281514191380',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
