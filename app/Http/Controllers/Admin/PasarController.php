<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasarRequest;
use App\Models\Pasar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasar::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('admin.pasar.edit', $row->id);
                    $urlShow = route('admin.pasar.toko.index', $row->id);
                    $btn = '<a href="' . $urlShow . '" class="me-2 btn btn-sm btn-outline-success"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . $urlEdit . '" class="me-2 btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->addColumn('map', function ($row) {
                    return '<a href="'.$row->google_maps_url.'" target="_blank" rel="noopener">Lihat di Google Maps</a>';
                })
                ->rawColumns(['action', 'map'])
                ->make(true);
        }
        return view('admin.pasar.index');
    }

    public function create()
    {
        return view('admin.pasar.create');
    }
    public function edit(String $id)
    {   
        $model = Pasar::findOrFail($id);
        return view('admin.pasar.edit', compact('model'));
    }

    public function store(PasarRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Pasar::create($validatedData);
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

    public function update(PasarRequest $request, String $id)
    {
        try {
            $data = $request->validated();
            Pasar::findOrFail($id)->update($data);
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

    public function destroy(String $id)
    {
        try {
            Pasar::findOrFail($id)->delete();
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
