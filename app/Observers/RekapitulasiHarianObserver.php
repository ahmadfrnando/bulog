<?php

namespace App\Observers;

use App\Models\RekapitulasiBulanan;
use App\Models\RekapitulasiHarian;

class RekapitulasiHarianObserver
{
    /**
     * Handle the RekapitulasiHarian "created" event.
     */
    public function created(RekapitulasiHarian $rekapitulasiHarian): void
    {
        $bulan = date('m', strtotime($rekapitulasiHarian->tanggal));
        $tahun = date('Y', strtotime($rekapitulasiHarian->tanggal));
        $data = RekapitulasiBulanan::where('bulan', $bulan)->where('tahun', $tahun)->first();
        if ($data) {
            $hargaRataRata = ($data->harga_rata_rata + $rekapitulasiHarian->harga_rata_rata) / 2;
            $persentasePerubahanHarga = (($rekapitulasiHarian->harga_rata_rata - $data->harga_rata_rata) / $data->harga_rata_rata) * 100;
            $data->update([
                'harga_rata_rata' => $hargaRataRata,
                'pst_perubahan_harga' => $persentasePerubahanHarga
            ]);
        } else {
            RekapitulasiBulanan::create([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'komoditas_id' => $rekapitulasiHarian->komoditas_id,
                'nama_komoditas' => $rekapitulasiHarian->komoditas?->nama ?? null,
                'harga_rata_rata' => $rekapitulasiHarian->harga_rata_rata,
                'pst_perubahan_harga' => 0
            ]);
        }
    }

    /**
     * Handle the RekapitulasiHarian "updated" event.
     */
    public function updated(RekapitulasiHarian $rekapitulasiHarian): void
    {
        $bulan = date('m', strtotime($rekapitulasiHarian->tanggal));
        $tahun = date('Y', strtotime($rekapitulasiHarian->tanggal));
        $data = RekapitulasiBulanan::where('bulan', $bulan)->where('tahun', $tahun)->first();
        if ($data->exists()) {
            $hargaRataRata = ($data->harga_rata_rata + $rekapitulasiHarian->harga_rata_rata) / 2;
            $persentasePerubahanHarga = ($rekapitulasiHarian->harga_rata_rata - $data->harga_rata_rata) / $data->pst_perubahan_harga * 100;
            $data->update([
                'harga_rata_rata' => $hargaRataRata,
                'pst_perubahan_harga' => $persentasePerubahanHarga
            ]);
        } else {
            RekapitulasiBulanan::create([
                'tahun' => $tahun,
                'bulan' => $bulan,
                'komoditas_id' => $rekapitulasiHarian->komoditas_id,
                'nama_komoditas' => $rekapitulasiHarian->komoditas?->nama,
                'harga_rata_rata' => $rekapitulasiHarian->harga_rata_rata,
                'pst_perubahan_harga' => 0
            ]);
        }
    }

    /**
     * Handle the RekapitulasiHarian "deleted" event.
     */
    public function deleted(RekapitulasiHarian $rekapitulasiHarian): void
    {
        //
    }

    /**
     * Handle the RekapitulasiHarian "restored" event.
     */
    public function restored(RekapitulasiHarian $rekapitulasiHarian): void
    {
        //
    }

    /**
     * Handle the RekapitulasiHarian "force deleted" event.
     */
    public function forceDeleted(RekapitulasiHarian $rekapitulasiHarian): void
    {
        //
    }
}
