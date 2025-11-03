<?php

namespace Database\Factories;

use App\Models\Komoditas;
use App\Models\Pasar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmisiHarga>
 */
class SubmisiHargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $pasar = Pasar::findOrFail(1);
        $komoditas = Komoditas::findOrFail(1);
        $user = User::findOrFail(2);
        return [
            'user_id' => $user->id,
            'nama_petugas' => $user->name,
            'pasar_id' => $pasar->id,
            'nama_pasar' => $pasar->nama,
            'nama_toko' => $this->faker->company(),
            'komoditas_id' => $komoditas->id,
            'unit' => $komoditas->unit,
            'nama_komoditas' => $komoditas->nama,
            'harga' => $this->faker->randomFloat(2, 0, 1000),
            'tanggal_observasi' => $this->faker->date(),
            'url_foto' => $this->faker->imageUrl(),
            'catatan' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['dikirim', 'diterbitkan', 'ditandai', 'ditolak', 'dikoreksi']),
            'tanggal_validasi' => $this->faker->date(),
        ];
    }
}
