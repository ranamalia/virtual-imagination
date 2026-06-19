<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'nama_pemilik',
        'whatsapp_number',
    ];

    /**
     * Ambil satu record pengaturan pembayaran yang aktif.
     * Jika belum ada, kembalikan instance kosong.
     */
    public static function getCurrent(): self
    {
        return self::first() ?? new self([
            'nama_bank'       => '-',
            'nomor_rekening'  => '-',
            'nama_pemilik'    => '-',
            'whatsapp_number' => '6281514191380',
        ]);
    }
}
