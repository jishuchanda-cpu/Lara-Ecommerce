<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategorySeeder first.');

            return;
        }

        foreach ($categories as $category) {
            Product::factory(5)->create([
                'category_id' => $category->id,
            ]);
        }

        Product::factory(10)->create();

        Product::factory(3)->outOfStock()->create();
        Product::factory(3)->lowStock()->create();
        Product::factory(5)->onSale()->create();
        Product::factory(2)->inactive()->create();
    }
}
