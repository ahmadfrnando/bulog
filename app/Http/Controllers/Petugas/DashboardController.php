<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Pasar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $pasars = Pasar::all();
        $komoditas = Komoditas::all();
        return view('petugas.index', compact('pasars', 'komoditas'));
    }
}
