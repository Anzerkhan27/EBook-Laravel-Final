<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'genre' => fake()->name(),
            'description' => fake()->realText(300),
            'credit_price' => fake()->numberBetween(20, 200),
            'file' => '1672816162.pdf'

        ];
    }
}
