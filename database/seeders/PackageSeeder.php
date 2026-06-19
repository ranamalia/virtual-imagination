<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // ── PRICELIST 2026 PACKAGES ──────────────────────────────────────────
            [
                'name'             => 'Photo Graduation SILVER Package',
                'category'         => 'graduation',
                'description'      => [
                    'Unlimited shot',
                    'All file koreksi upload Google Drive',
                    'Cetak 10R, 2 lembar',
                    '15 file edited tone',
                ],
                'price'            => 300000,
                'duration_minutes' => 30,
                'max_person'       => 6,
                'is_active'        => true,
            ],
            [
                'name'             => 'Photo Graduation GOLD Package',
                'category'         => 'graduation',
                'description'      => [
                    'Unlimited shot',
                    'All file koreksi upload Google Drive',
                    'Cetak 10R, 5 lembar',
                    '1 frame minimalis',
                    '30 file edited tone',
                ],
                'price'            => 550000,
                'duration_minutes' => 60,
                'max_person'       => 10,
                'is_active'        => true,
            ],
            [
                'name'             => 'Photo Family Package',
                'category'         => 'family',
                'description'      => [
                    'Unlimited shot',
                    'All file koreksi upload Google Drive',
                    'Cetak 10RL, 2 lembar',
                    '15 file edited tone',
                ],
                'price'            => 300000,
                'duration_minutes' => 30,
                'max_person'       => 6,
                'is_active'        => true,
            ],
            [
                'name'             => 'Photo Maternity Package',
                'category'         => 'maternity',
                'description'      => [
                    'Unlimited shot',
                    'All file koreksi upload Google Drive',
                    'Cetak 10RL, 2 lembar',
                    '30 file edited tone',
                ],
                'price'            => 550000,
                'duration_minutes' => 60,
                'max_person'       => null,
                'is_active'        => true,
            ],
            [
                'name'             => 'Photo Group Package',
                'category'         => 'group',
                'description'      => [
                    'Unlimited shot',
                    'All file koreksi upload Google Drive',
                    'Cetak 10RL, 2 lembar',
                    '25 file edited tone',
                ],
                'price'            => 400000,
                'duration_minutes' => 60,
                'max_person'       => 10,
                'is_active'        => true,
            ],
            [
                'name'             => 'Prewedding SILVER Package',
                'category'         => 'prewedding',
                'description'      => [
                    'Background 2 tema',
                    'Cetak foto 12RL 1 lembar + laminasi',
                    'Frame minimalis',
                    'Cetak 8RL 2 lembar',
                    'All file koreksi upload Google Drive',
                    '30 file editing tone',
                ],
                'price'            => 850000,
                'duration_minutes' => 120,
                'is_active'        => true,
            ],
            [
                'name'             => 'Prewedding Indoor GOLD Package',
                'category'         => 'prewedding',
                'description'      => [
                    'Background all tema',
                    'Cetak foto 16RL 1 lembar + laminasi',
                    'Frame minimalis',
                    'Cetak 10R 4 lembar',
                    'All file koreksi upload Google Drive',
                    '40 file editing tone',
                ],
                'price'            => 1000000,
                'duration_minutes' => 180,
                'is_active'        => true,
            ],
        ];

        foreach ($packages as $data) {
            $slug = Str::slug($data['name']);
            $data['slug'] = $slug;

            Package::updateOrCreate(
                ['slug' => $slug],
                $data
            );
        }
    }
}
