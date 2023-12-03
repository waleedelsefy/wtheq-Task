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
        $productNames = $this->faker->unique()->words(3, true);

        // Ensure $productNames is an array
        if (!is_array($productNames)) {
            $productNames = explode(' ', $productNames);
        }

        $productName = implode(' ', $productNames);

        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $productName,
            'slug' => str_replace(' ', '-', $productName),
            'image' => $this->faker->imageUrl(),
            'is_active' => true,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
