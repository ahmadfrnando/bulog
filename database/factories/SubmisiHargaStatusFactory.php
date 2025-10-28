<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmisiHargaStatus>
 */
class SubmisiHargaStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submisi_harga_id' => 1,
            'nama_status' => 'dikirim',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
