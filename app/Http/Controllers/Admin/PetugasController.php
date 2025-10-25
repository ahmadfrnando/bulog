<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class PetugasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereKeyNot(auth()->id())->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('admin.petugas.edit', $row->id);
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
        return view('admin.petugas.index');
    }

    public function create()
    {
        return view('admin.petugas.create');
    }
    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view('admin.petugas.edit', compact('model'));
    }

    public function store(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($validatedData['password']);
            User::create($validatedData);
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

    public function update(UserRequest $request, User $petuga)
    {
        try {
            $data = $request->validated();
            if (array_key_exists('password', $data)) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            $petuga->update($data);

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

    public function destroy(string $id)
    {
        try {
            $data = User::findOrFail($id);
            $data->delete();
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
