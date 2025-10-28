<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmisiHargaRequest;
use App\Models\SubmisiHarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubmisiHargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubmisiHarga::with('pasar', 'user')->select('*');

            if ($request->has('data') && $request->data !== null) {
                $data->where('pasar_id', $request->data);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlShow = route('admin.submisi-harga.show', $row->id);
                    $btn = '<a href="' . $urlShow . '" class="me-2 btn btn-sm btn-outline-primary">Detail</a>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->editColumn('harga', function ($row) {
                    $harga = number_format($row->harga, 0, ',', '.');
                    return 'Rp ' . $harga;
                })
                ->editColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'pending':
                            return '<span class="badge bg-warning status-badge">' . $row->status . '</span>';
                            break;
                        case 'diterbitkan':
                            return '<span class="badge bg-success status-badge">' . $row->status . '</span>';
                            break;
                        case 'ditandai':
                            return '<span class="badge bg-info status-badge">' . $row->status . '</span>';
                            break;
                        case 'ditolak':
                            return '<span class="badge bg-danger status-badge">' . $row->status . '</span>';
                            break;
                        case 'dikoreksi':
                            return '<span class="badge bg-primary status-badge">' . $row->status . '</span>';
                            break;
                    }
                })
                ->rawColumns(['action', 'harga', 'status'])
                ->make(true);
        }
        return view('admin.submisi-harga.index');
    }

    public function create()
    {
        //
    }
    public function edit(String $id)
    {
        //
    }
    public function show(SubmisiHarga $submisi_harga)
    {
        return view('admin.submisi-harga.show', compact('submisi_harga'));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(SubmisiHargaRequest $request, SubmisiHarga $submisi_harga)
    {
        //
    }

    public function updateStatus(Request $request, SubmisiHarga $submisi_harga)
    {
        $validatedData = $request->validate([
            'nama_status' => 'required|in:dikirim,diterbitkan,ditandai,ditolak,dikoreksi',
            'alasan' => 'nullable|string',
        ]);

        $lastStatus = $submisi_harga->submisi_harga_status()->latest()->first();

        if (!$lastStatus || $lastStatus->nama_status !== $validatedData['nama_status']) {
            $submisi_harga->submisi_harga_status()->create([
                'nama_status' => $validatedData['nama_status']
            ]);
        }

        try {
            DB::beginTransaction();
            $submisi_harga->update([
                'status' => $validatedData['nama_status']
            ]);
            $submisi_harga->submisi_harga_status()->updateOrCreate(
                ['nama_status' => $validatedData['nama_status']],
                ['alasan' => $validatedData['alasan']]
            );
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getRiwayatStatus(SubmisiHarga $submisi_harga)
    {
        $riwayat = $submisi_harga->submisi_harga_status()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.submisi-harga._riwayat-status', compact('riwayat'))->render();
    }


    public function destroy(SubmisiHarga $submisi_harga)
    {
        //
    }
}
