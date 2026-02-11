<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating admin user...');
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->command->info('Creating sample customers...');
        User::factory(10)->customer()->create();

        $this->command->info('Seeding categories...');
        $this->call(CategorySeeder::class);

        $this->command->info('Seeding products...');
        $this->call(ProductSeeder::class);

        $this->command->info('Seeding orders...');
        $this->call(OrderSeeder::class);

        $this->command->info('E-commerce seeding completed successfully!');
    }
}
