<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\SubmisiHarga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $petugas;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->petugas = auth()->user();
            return $next($request);
        });
    }
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = SubmisiHarga::with('pasar', 'user')->where('user_id', $this->petugas->id)->select('*');

            if ($request->has('data') && $request->data !== null) {
                $data->where('pasar_id', $request->data);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlShow = route('petugas.riwayat.show', $row->id);
                    $btn = '<a href="' . $urlShow . '" class="me-2 btn btn-sm btn-outline-success">Detail</a>';
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
                        case 'dikirim':
                            return '<span class="badge bg-info status-badge">' . $row->status . '</span>';
                            break;
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
        return view('petugas.riwayat.index');
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
    public function show(SubmisiHarga $riwayat)
    {
        return view('petugas.riwayat.show', compact('riwayat'));
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
