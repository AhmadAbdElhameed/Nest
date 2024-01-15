<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => fake()->text(30),
            'description' => fake()->paragraph(5),
            'slug' => fake()->slug(),
            'status' => fake()->boolean(),
            'price' => fake()->numberBetween(100,9999),
            'manage_stock' => false,
            'sku' => fake()->word(),
            'in_stock' => fake()->boolean(),
        ];
    }
}
