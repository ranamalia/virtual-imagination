<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'category', 'description',
        'image', 'client', 'is_featured',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /** Only active items */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Featured items first, then by sort_order */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
