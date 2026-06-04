<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan firstOrCreate agar jika seeder dijalankan berulang kali, tidak error duplikat
        User::firstOrCreate(
            ['email' => 'admin@cikasdasulteng.go.id'],
            [
                'name' => 'Administrator CIKASDA',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
