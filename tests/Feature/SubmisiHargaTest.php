<?php

namespace Tests\Feature;

use App\Models\Komoditas;
use App\Models\Pasar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SubmisiHargaTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_dapat_menyimpan_submisi_harga()
    {
        // Buat data dummy
        $user = User::factory()->create();
        $pasar = Pasar::factory()->create();
        $komoditas = Komoditas::factory()->create([
            'nama' => 'Cabai Merah',
            'unit' => 'kg'
        ]);

        // Fake storage untuk testing upload
        Storage::fake('public');

        // Kirim request POST ke route store
        $response = $this->post(route('petugas.submisi-harga.store'), [
            'user_id' => $user->id,
            'pasar_id' => $pasar->id,
            'nama_toko' => 'Toko Sejahtera',
            'komoditas_id' => $komoditas->id,
            'komoditas_nama' => $komoditas->nama,
            'harga' => 20000,
            'tanggal_observasi' => now()->format('Y-m-d'),
            'url_foto' => UploadedFile::fake()->image('foto.jpg'),
        ]);

        // Pastikan redirect sukses
        $response->assertRedirect(route('petugas.dashboard'));

        // Pastikan flash message sukses muncul
        $response->assertSessionHas('success', 'Data berhasil disimpan');

        // Pastikan file tersimpan di storage
        Storage::assertDirectoryExists('public/foto-bukti');

        // Pastikan data benar-benar masuk ke database
        $this->assertDatabaseHas('submisi_harga', [
            'nama_toko' => 'Toko Sejahtera',
            'nama_komoditas' => $komoditas->nama,
        ]);
    }
}
