<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        $price = fake()->randomFloat(2, 10, 1000);
        $comparePrice = fake()->optional(0.3)->randomFloat(2, $price, $price * 1.5);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraphs(3, true),
            'price' => $price,
            'compare_price' => $comparePrice,
            'sku' => strtoupper(fake()->unique()->bothify('???-####')),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'track_quantity' => true,
            'is_active' => true,
            'images' => [
                fake()->imageUrl(640, 480, 'product'),
                fake()->optional(0.5)->imageUrl(640, 480, 'product'),
            ],
            'category_id' => Category::factory(),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => 0,
        ]);
    }

    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => fake()->numberBetween(1, 5),
        ]);
    }

    public function onSale(): static
    {
        return $this->state(function (array $attributes) {
            $price = fake()->randomFloat(2, 10, 1000);

            return [
                'price' => $price * 0.8,
                'compare_price' => $price,
            ];
        });
    }
}
