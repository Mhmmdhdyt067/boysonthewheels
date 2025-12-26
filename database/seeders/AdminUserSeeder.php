<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@boysonthewheels.com',
            'password' => Hash::make('boysonthewheels2025'), // Ganti dengan password yang kuat
        ]);
    }
}
