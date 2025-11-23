<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@vale.com',
                'password' => bcrypt('admin123'), // Password: admin123 (ubah setelah login pertama)
                'role' => 'admin',
            ]
        );

        // Buat beberapa user test
        User::firstOrCreate(
            ['username' => 'user1'],
            [
                'name' => 'User Test 1',
                'email' => 'user1@vale.com',
                'password' => bcrypt('user123'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['username' => 'user2'],
            [
                'name' => 'User Test 2',
                'email' => 'user2@vale.com',
                'password' => bcrypt('user123'),
                'role' => 'user',
            ]
        );
    }
}
