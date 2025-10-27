<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenugasanPasarRequest;
use App\Models\Pasar;
use App\Models\PenugasanPasar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenugasanPasarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PenugasanPasar::with('pasar', 'user')->select('*');

            if ($request->has('data') && $request->data !== null) {
                $data->where('pasar_id', $request->data);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('admin.penugasan-pasar.edit', $row->id);
                    $btn = '<a href="' . $urlEdit . '" class="me-2 btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->addColumn('map', function ($row) {
                    return '<a href="' . $row->pasar->google_maps_url . '" target="_blank" rel="noopener">Lihat di Google Maps</a>';
                })
                ->rawColumns(['action', 'map'])
                ->make(true);
        }
        $pasars = Pasar::all();
        return view('admin.penugasan-pasar.index', compact('pasars'));
    }

    public function create()
    {
        return view('admin.penugasan-pasar.create');
    }
    public function edit(String $id)
    {
        $model = PenugasanPasar::findOrFail($id);
        return view('admin.penugasan-pasar.edit', compact('model'));
    }

    public function store(PenugasanPasarRequest $request)
    {
        try {
            $validatedData = $request->validated();
            PenugasanPasar::create($validatedData);
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

    public function update(PenugasanPasarRequest $request, String $id)
    {
        try {
            $data = $request->validated();
            PenugasanPasar::findOrFail($id)->update($data);
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
            PenugasanPasar::findOrFail($id)->delete();
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
