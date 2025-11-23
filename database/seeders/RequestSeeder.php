<?php

namespace Database\Seeders;

use App\Models\Request as RequestModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for October 2025
        $statuses = ['pending', 'proses', 'selesai'];
        
        // October 2025
        for ($i = 1; $i <= 30; $i++) {
            RequestModel::create([
                'user_id' => rand(2, 3), // user 2-3
                'nama' => 'Request Sample ' . $i,
                'nomor' => 'EMP00' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'category' => ['data', 'support_system', 'menu_system', 'maintenance', 'training'][array_rand(['data', 'support_system', 'menu_system', 'maintenance', 'training'])],
                'description' => 'This is a sample request description for request number ' . $i,
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subMonths(1)->subDays(rand(0, 29)),
                'updated_at' => now()->subMonths(1)->subDays(rand(0, 29)),
            ]);
        }

        // November 2025
        for ($i = 31; $i <= 50; $i++) {
            RequestModel::create([
                'user_id' => rand(2, 3),
                'nama' => 'Request Sample ' . $i,
                'nomor' => 'EMP00' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'category' => ['data', 'support_system', 'menu_system', 'maintenance', 'training'][array_rand(['data', 'support_system', 'menu_system', 'maintenance', 'training'])],
                'description' => 'This is a sample request description for request number ' . $i,
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subDays(rand(0, 20)),
                'updated_at' => now()->subDays(rand(0, 20)),
            ]);
        }
    }
}
