<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Komoditas>
 */
class KomoditasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomNumber(6),
            'nama' => $this->faker->name(),
            'unit' => $this->faker->numberBetween(1, 1000),
            'kategori' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
