<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasUuids;

    protected $keyType    = 'string';
    public    $incrementing = false;

    // ── Status Constants ──────────────────────────────────────────────────────
    const STATUS_MENUNGGU_KONFIRMASI = 'menunggu_konfirmasi';
    const STATUS_DITOLAK             = 'ditolak';
    const STATUS_MENUNGGU_PEMBAYARAN = 'menunggu_pembayaran';
    const STATUS_MENUNGGU_VERIFIKASI = 'menunggu_verifikasi';
    const STATUS_PEMBAYARAN_DITOLAK  = 'pembayaran_ditolak';
    const STATUS_TERKONFIRMASI       = 'terkonfirmasi';

    const STATUSES = [
        self::STATUS_MENUNGGU_KONFIRMASI,
        self::STATUS_DITOLAK,
        self::STATUS_MENUNGGU_PEMBAYARAN,
        self::STATUS_MENUNGGU_VERIFIKASI,
        self::STATUS_PEMBAYARAN_DITOLAK,
        self::STATUS_TERKONFIRMASI,
    ];

    protected $fillable = [
        'user_id',
        'package_id',
        'full_name',
        'email',
        'whatsapp',
        'service',
        'booking_date',
        'booking_time',
        'special_request',
        'booking_reference',
        'status',
        'price',
        'payment_proof',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'price'        => 'decimal:2',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    public static function generateBookingReference(): string
    {
        $year   = date('Y');
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return "VI-{$random}-{$year}";
    }

    /**
     * Label status dalam Bahasa Indonesia.
     */
    public function statusLabel(): string
    {
        return match($this->status) {
            self::STATUS_MENUNGGU_KONFIRMASI => 'Menunggu Konfirmasi Admin',
            self::STATUS_DITOLAK             => 'Ditolak',
            self::STATUS_MENUNGGU_PEMBAYARAN => 'Menunggu Pembayaran',
            self::STATUS_MENUNGGU_VERIFIKASI => 'Menunggu Verifikasi Pembayaran',
            self::STATUS_PEMBAYARAN_DITOLAK  => 'Pembayaran Ditolak',
            self::STATUS_TERKONFIRMASI       => 'Booking Terkonfirmasi',
            default                          => ucfirst($this->status),
        };
    }

    /**
     * Warna badge CSS (class suffix) per status.
     */
    public function statusColor(): string
    {
        return match($this->status) {
            self::STATUS_MENUNGGU_KONFIRMASI => 'warning',
            self::STATUS_DITOLAK             => 'danger',
            self::STATUS_MENUNGGU_PEMBAYARAN => 'info',
            self::STATUS_MENUNGGU_VERIFIKASI => 'purple',
            self::STATUS_PEMBAYARAN_DITOLAK  => 'danger',
            self::STATUS_TERKONFIRMASI       => 'success',
            default                          => 'secondary',
        };
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_reference)) {
                $model->booking_reference = self::generateBookingReference();
            }
            if (empty($model->status)) {
                $model->status = self::STATUS_MENUNGGU_KONFIRMASI;
            }
        });
    }
}
