<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenugasanPasar>
 */
class PenugasanPasarFactory extends Factory
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
            'user_id' => $this->faker->numberBetween(2, 10),
            'tanggal' => now(),
            'is_aktif' => $this->faker->boolean(),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
