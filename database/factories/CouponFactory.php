<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['percentage', 'fixed']);

        return [
            'code' => strtoupper(fake()->bothify('????####')),
            'description' => fake()->sentence(),
            'type' => $type,
            'value' => $type === 'percentage' ? fake()->numberBetween(5, 50) : fake()->randomFloat(2, 5, 100),
            'min_order_amount' => fake()->randomFloat(2, 0, 50),
            'max_uses' => fake()->optional()->numberBetween(10, 1000),
            'max_uses_per_user' => fake()->optional()->numberBetween(1, 5),
            'used_count' => 0,
            'starts_at' => fake()->optional(0.7)->dateTimeBetween('-1 month', '+1 month'),
            'expires_at' => fake()->optional(0.7)->dateTimeBetween('+1 week', '+6 months'),
            'is_active' => true,
        ];
    }

    public function percentage(float $value = 20): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'percentage',
            'value' => $value,
        ]);
    }

    public function fixed(float $value = 25): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'fixed',
            'value' => $value,
        ]);
    }

    public function expired(): self
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => now()->subDay(),
        ]);
    }

    public function inactive(): self
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function unlimited(): self
    {
        return $this->state(fn (array $attributes) => [
            'max_uses' => null,
            'max_uses_per_user' => null,
        ]);
    }
}
