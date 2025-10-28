<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmisiHargaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SubmisiHargaStatus::factory()->create([
            'nama_status' => 'dikirim',
            'submisi_harga_id' => 1,
            'alasan' => null,
            'created_at' => now()->subHour(3),
            'updated_at' => now(),
        ]);
        \App\Models\SubmisiHargaStatus::factory()->create([
            'nama_status' => 'dikoreksi',
            'submisi_harga_id' => 1,
            'alasan' => 'Data Submisi dikoreksi pada bagaian code komoditas',
            'created_at' => now()->subHours(2),
            'updated_at' => now(),
        ]);
    }
}
