<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasar>
 */
class PasarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'lng' => $this->faker->longitude(),
            'lat' => $this->faker->latitude(),
            'kecamatan' => $this->faker->city(),
            'kelurahan' => $this->faker->streetName(),
            'tipe_pasar' => $this->faker->randomElement(['tradisional', 'modern', 'lainnya']),
            'keterangan' => $this->faker->text(),
        ];
    }
}
