<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasUuids;

    protected $keyType    = 'string';
    public    $incrementing = false;

    protected $fillable = [
        'package_id',
        'full_name',
        'email',
        'phone',
        'service',
        'booking_date',
        'booking_time',
        'special_request',
        'payment_method',
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

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public static function generateBookingReference(): string
    {
        $year   = date('Y');
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return "VI-{$random}-{$year}";
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_reference)) {
                $model->booking_reference = self::generateBookingReference();
            }
            if (empty($model->status)) {
                $model->status = 'Pending';
            }
        });
    }
}
