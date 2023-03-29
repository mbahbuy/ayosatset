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
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => collect($this->faker->paragraphs(mt_rand(1, 2)))
                ->map(fn ($p) => "<p>$p</p>")
                ->implode(''),
            'price' => $this->faker->randomFloat('2', 5000, 50000),
            'quantity' => $this->faker->randomDigitNotNull()
        ];
    }
}
