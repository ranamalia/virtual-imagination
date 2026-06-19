<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'category', 'description',
        'image', 'client', 'is_featured',
        'show_in_about', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'show_in_about' => 'boolean',
        'is_active'     => 'boolean',
    ];

    /** Only active items */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Featured items */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /** Items flagged for About section */
    public function scopeInAbout($query)
    {
        return $query->where('is_active', true)->where('show_in_about', true);
    }

    /** Ordered for display */
    public function scopeOrdered($query)
    {
        return $query->orderByDesc('is_featured')
                     ->orderBy('sort_order')
                     ->orderByDesc('created_at');
    }

    /** Full URL for the image */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    /** Human-readable category */
    public static function categories(): array
    {
        return [
            'events'      => 'Photo Events',
            'graduation'  => 'Photo Graduation',
            'personal'    => 'Photo Personal',
            'group'       => 'Photo Group',
            'prewedding'  => 'Photo Prewedding',
            'product'     => 'Product Photography',
            'general'     => 'General',
        ];
    }
}
