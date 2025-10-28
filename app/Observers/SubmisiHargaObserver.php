<?php

namespace App\Observers;

use App\Models\RekapitulasiHarian;
use App\Models\SubmisiHarga;

class SubmisiHargaObserver
{
    /**
     * Handle the SubmisiHarga "created" event.
     */
    public function created(SubmisiHarga $submisiHarga): void
    {
        //
    }

    /**
     * Handle the SubmisiHarga "updated" event.
     */
    public function updated(SubmisiHarga $submisiHarga): void
    {
        if ($submisiHarga->status == 'diterbitkan') {
            $rekapitulasiHarian = RekapitulasiHarian::where('tanggal', $submisiHarga->tanggal)->where('komoditas_id', $submisiHarga->komoditas_id)->first();
            if (!$rekapitulasiHarian) {
                RekapitulasiHarian::create([
                    'komoditas_id' => $submisiHarga->komoditas_id,
                    'nama_komoditas' => $submisiHarga->nama_komoditas,
                    'tanggal' => $submisiHarga->tanggal_observasi,
                    'harga_rata_rata' => $submisiHarga->harga,
                    'harga_median' => $submisiHarga->harga,
                    'harga_minimal' => $submisiHarga->harga,
                    'harga_maksimal' => $submisiHarga->harga,
                    'jumlah_submisi' => 1,
                ]);
            } else {
                $hargaMedian = SubmisiHarga::where('tanggal', $submisiHarga->tanggal)
                    ->where('komoditas_id', $submisiHarga->komoditas_id)
                    ->orderBy('harga', 'asc')
                    ->pluck('harga') // Ambil hanya nilai harga
                    ->toArray(); // Ubah menjadi array biasa

                $count = count($hargaMedian);
                if ($count % 2 == 0) {
                    // Jika jumlah data genap
                    $median = ($hargaMedian[$count / 2 - 1] + $hargaMedian[$count / 2]) / 2;
                } else {
                    // Jika jumlah data ganjil
                    $median = $hargaMedian[floor($count / 2)];
                }
                $rekapitulasiHarian->harga_rata_rata = ($rekapitulasiHarian->harga_rata_rata * $rekapitulasiHarian->jumlah_submisi + $submisiHarga->harga) / ($rekapitulasiHarian->jumlah_submisi + 1);
                $rekapitulasiHarian->harga_median = $median;  // Gunakan median yang dihitung sebelumnya
                $rekapitulasiHarian->harga_minimal = min($rekapitulasiHarian->harga_minimal, $submisiHarga->harga);
                $rekapitulasiHarian->harga_maksimal = max($rekapitulasiHarian->harga_maksimal, $submisiHarga->harga);
                $rekapitulasiHarian->jumlah_submisi += 1;
                $rekapitulasiHarian->save();  // Gunakan save() daripada update() setelah melakukan perubahan
            }
        }
    }

    /**
     * Handle the SubmisiHarga "deleted" event.
     */
    public function deleted(SubmisiHarga $submisiHarga): void
    {
        //
    }

    /**
     * Handle the SubmisiHarga "restored" event.
     */
    public function restored(SubmisiHarga $submisiHarga): void
    {
        //
    }

    /**
     * Handle the SubmisiHarga "force deleted" event.
     */
    public function forceDeleted(SubmisiHarga $submisiHarga): void
    {
        //
    }
}
