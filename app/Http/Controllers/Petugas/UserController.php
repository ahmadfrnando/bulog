<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function ubahPassword(ChangePasswordRequest $request, User $user)
    {
        try {
            $validatedData = $request->validated();
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
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
}
