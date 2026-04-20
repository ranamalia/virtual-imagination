<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name'             => 'Basic Photography',
                'slug'             => 'basic-photography',
                'description'      => 'Sesi foto profesional 1 jam, 10 foto editan digital siap cetak.',
                'price'            => 300000,
                'duration_minutes' => 60,
                'is_active'        => true,
            ],
            [
                'name'             => 'Prewedding',
                'slug'             => 'prewedding',
                'description'      => 'Sesi foto prewedding outdoor/indoor, 3 jam, 30 foto editan + album digital.',
                'price'            => 1500000,
                'duration_minutes' => 180,
                'is_active'        => true,
            ],
            [
                'name'             => 'Event Coverage',
                'slug'             => 'event-coverage',
                'description'      => 'Liputan foto event selama 4 jam, full-resolution galeri digital.',
                'price'            => 500000,
                'duration_minutes' => 240,
                'is_active'        => true,
            ],
            [
                'name'             => 'Videography',
                'slug'             => 'videography',
                'description'      => 'Produksi video sinematik 3 jam, hasil edit 5–10 menit full HD.',
                'price'            => 800000,
                'duration_minutes' => 180,
                'is_active'        => true,
            ],
        ];

        foreach ($packages as $data) {
            Package::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
