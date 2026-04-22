<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Buat akun admin default jika belum ada.
     * Email: admin@virtual.com | Password: password
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@virtual.com'],
            [
                'name'     => 'Admin Virtual Imagination',
                'email'    => 'admin@virtual.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );
    }
}
