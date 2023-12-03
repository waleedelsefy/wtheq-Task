<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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

    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Create a user and use its ID
            'name' => $this->faker->word,
            'short_description' => $this->faker->sentence,
            'long_description' => $this->faker->paragraph,
            'available_quantity' => $this->faker->numberBetween(10, 100),
            'original_price' => $this->faker->randomFloat(2, 10, 100),
            'purchase_price' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}
