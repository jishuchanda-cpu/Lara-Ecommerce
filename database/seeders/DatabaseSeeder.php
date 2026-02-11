<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
        ]);

        // Create Test Customer
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed eCommerce data
        $this->call([
            CategorySeeder::class ,
            ProductSeeder::class ,
        ]);
    }
}
