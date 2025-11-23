<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vale.example',
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Change this in production
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create sample regular users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@vale.example',
            'username' => 'johndoe',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@vale.example',
            'username' => 'janesmith',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
