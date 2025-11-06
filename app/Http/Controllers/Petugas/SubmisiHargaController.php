<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmisiHargaRequest;
use App\Models\Komoditas;
use App\Models\Pasar;
use App\Models\SubmisiHarga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmisiHargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubmisiHargaRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $user = User::where('id', $validatedData['user_id'])->first();
            $pasar = Pasar::where('id', $validatedData['pasar_id'])->first();
            $komoditas = Komoditas::where('id', $validatedData['komoditas_id'])->first();

            if (!$user || !$pasar || !$komoditas) {
                throw new \Exception('Data tidak ditemukan');
            }

            $validatedData['nama_petugas'] = $user->name;
            $validatedData['nama_pasar'] = $pasar->nama;
            $validatedData['nama_komoditas'] = $komoditas->nama;
            $validatedData['unit'] = $komoditas->unit;

            DB::transaction(function () use ($validatedData, &$submisiHarga) {
                $submisiHarga = SubmisiHarga::create($validatedData);
                $submisiHarga->submisi_harga_status()->create([
                    'nama_status' => 'dikirim',
                    'alasan' => null
                ]);
            });

            if ($submisiHarga) {
                return redirect()->route('petugas.dashboard')->with('success', 'Data berhasil disimpan');
            } else {
                throw new \Exception('Gagal membuat data submisi harga');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }
    //  Error: SQLSTATE[HY000]: General error: 1364 Field 'tanggal_validasi' doesn't have a default value (Connection: mysql, SQL: insert into `submisi_harga` (`user_id`, `pasar_id`, `nama_toko`, `komoditas_id`, `harga`, `tanggal_observasi`, `catatan`, `nama_petugas`, `nama_pasar`, `nama_komoditas`, `unit`, `updated_at`, `created_at`) values (2, 1, Deleniti ad vitae no aassad, 1, 10000, 2025-01-01, ddd, petugas, Walker, Lowe and Padberg, Miss Kacie Lindgren, 776, 2025-11-03 09:08:20, 2025-11-03 09:08:20))
    // 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
