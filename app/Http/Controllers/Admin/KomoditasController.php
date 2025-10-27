<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KomoditasRequest;
use App\Models\Komoditas;
use App\Models\PenugasanPasar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Komoditas::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('admin.komoditas.edit', $row->id);
                    $btn = '<a href="' . $urlEdit . '" class="me-2 btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.komoditas.index');
    }

    public function create()
    {
        return view('admin.komoditas.create');
    }
    public function edit(Komoditas $komodita)
    {
        return view('admin.komoditas.edit', compact('komodita'));
    }

    public function store(KomoditasRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Komoditas::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(KomoditasRequest $request, Komoditas $komodita)
    {
        try {
            $data = $request->validated();
            $komodita->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Komoditas $komodita)
    {
        try {
            $komodita->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function status(Komoditas $komodita)
    {
        try {
            $komodita->update(['is_aktif' => !$komodita->is_aktif]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
