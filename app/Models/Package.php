<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'price',
        'duration_minutes',
        'max_person',
        'bonus',
        'is_active',
        'thumbnail',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'is_active'  => 'boolean',
        'description' => 'array',
        'bonus'       => 'array',
    ];

    /**
     * Scope: only active packages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Relationship: a package has many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Helper: get a package by its slug.
     */
    public static function getBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Helper: formatted Indonesian Rupiah price string.
     */
    public function getFormattedPrice(): string
    {
        return 'Rp' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Helper: duration formatted in hours & minutes.
     */
    public function getFormattedDuration(): string
    {
        $mins = $this->duration_minutes;
        if ($mins < 60) {
            return $mins . ' menit';
        }
        $h = floor($mins / 60);
        $m = $mins % 60;
        return $h . ' jam' . ($m ? ' ' . $m . ' mnt' : '');
    }

    /**
     * Helper: get first 2-3 description points for card preview.
     */
    public function getDescriptionPreview(int $max = 3): array
    {
        $desc = $this->description;
        if (empty($desc)) return [];
        if (is_array($desc)) {
            return array_slice($desc, 0, $max);
        }
        // Fallback: split by newline if stored as string
        $lines = array_filter(array_map('trim', explode("\n", $desc)));
        return array_slice(array_values($lines), 0, $max);
    }
}
