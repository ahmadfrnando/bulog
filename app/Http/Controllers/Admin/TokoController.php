<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TokoRequest;
use App\Models\Pasar;
use App\Models\Toko;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Pasar $pasar)
    {
        if ($request->ajax()) {
            $data = $pasar->toko();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($pasar) {
                    $urlEdit = route('admin.pasar.toko.edit', [$pasar->id, $row->id]);
                    $btn = '<a href="' . $urlEdit . '" class="me-2 btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
                    $btn .= '<button type="button" data-id-toko="' . $row->id . '" data-id-pasar="' . $pasar->id . '" id="delete" class="me-2 btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pasar.toko.index', compact('pasar'));
    }

    public function create(Pasar $pasar)
    {
        return view('admin.pasar.toko.create', compact('pasar'));
    }

    public function edit(Pasar $pasar, Toko $toko)
    {
        return view('admin.pasar.toko.edit', compact('pasar', 'toko'));
    }


    public function store(TokoRequest $request, Pasar $pasar)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['pasar_id'] = $pasar->id;
            $pasar->toko()->create($validatedData);
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

    public function update(TokoRequest $request, Pasar $pasar, Toko $toko)
    {
        abort_unless($toko->pasar_id === $pasar->id, 404);
        try {
            $data = $request->validated();
            $toko->update($data);
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

    public function destroy(Pasar $pasar, Toko $toko)
    {
        abort_unless($toko->pasar_id === $pasar->id, 404);
        try {
            $toko->delete();
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
}
