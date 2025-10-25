<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Toko>
 */
class TokoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pasar_id' => 1,
            'nama_toko' => $this->faker->company(),
            'nama_pemilik_toko' => $this->faker->name(),
            'nomor_kios' => $this->faker->unique()->ean13(),
        ];
    }
}
