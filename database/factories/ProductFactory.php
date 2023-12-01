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
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'featured' => $this->faker->boolean,
            'recommended' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'category_id' => \App\Models\StoreCategory::factory(),
            'size_id' => null, // Puedes ajustar según tus necesidades
            'status' => $this->faker->boolean
        ];
    }
}
