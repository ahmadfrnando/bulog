<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapitulasiBulanan;
use App\Models\RekapitulasiHarian;
use App\Models\SubmisiHarga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RekapitulasiBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RekapitulasiBulanan::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlShow = route('admin.rekapitulasi-bulanan.show', $row->id);
                    $btn = '<a href="' . $urlShow . '" class="me-2 btn btn-sm btn-outline-success">Detail</a>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->editColumn('harga_rata_rata', function ($row) {
                    $harga = number_format($row->harga_rata_rata, 0, ',', '.');
                    return 'Rp ' . $harga;
                })
                ->editColumn('pst_perubahan_harga', function ($row) {
                    $harga = number_format($row->pst_perubahan_harga, 0, ',', '.');
                    return $harga . ' %';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.rekapitulasi-bulanan.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, RekapitulasiBulanan $rekapitulasi_bulanan)
    {
        if ($request->ajax()) {
            $data = RekapitulasiHarian::whereYear('tanggal', $rekapitulasi_bulanan->tahun)->whereMonth('tanggal', $rekapitulasi_bulanan->bulan)->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('harga_rata_rata', function ($row) {
                    $harga = number_format($row->harga_rata_rata, 0, ',', '.');
                    $satuan = $row->komoditas?->unit;
                    return 'Rp ' . $harga . ' / ' . $satuan;
                })
                ->editColumn('harga_median', function ($row) {
                    $harga = number_format($row->harga_median, 0, ',', '.');
                    $satuan = $row->komoditas?->unit;
                    return 'Rp ' . $harga . ' / ' . $satuan;
                })
                ->editColumn('harga_minimal', function ($row) {
                    $harga = number_format($row->harga_minimal, 0, ',', '.');
                    $satuan = $row->komoditas?->unit;
                    return 'Rp ' . $harga . ' / ' . $satuan;
                })
                ->editColumn('harga_maksimal', function ($row) {
                    $harga = number_format($row->harga_maksimal, 0, ',', '.');
                    $satuan = $row->komoditas?->unit;
                    return 'Rp ' . $harga . ' / ' . $satuan;
                })
                ->make(true);
        }
        return view('admin.rekapitulasi-bulanan.show', compact('rekapitulasi_bulanan'));
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
