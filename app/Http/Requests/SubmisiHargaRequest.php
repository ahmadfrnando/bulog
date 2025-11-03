<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmisiHargaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'pasar_id' => 'required|exists:pasar,id',
            'nama_toko' => 'required|string',
            'komoditas_id' => 'required|exists:komoditas,id',
            'harga' => 'required|numeric',
            'tanggal_observasi' => 'required|date',
            'catatan' => 'nullable',
        ];
    }

    public function message(): array
    {
        return [
            'user_id.required' => 'Petugas harus dipilih.',
            'user_id.exists' => 'Petugas tidak ditemukan.',
            'pasar_id.required' => 'Pasar harus dipilih.',
            'pasar_id.exists' => 'Pasar tidak ditemukan.',
            'nama_toko.required' => 'Nama toko harus diisi.',
            'komoditas_id.required' => 'Komoditas harus dipilih.',
            'komoditas_id.exists' => 'Komoditas tidak ditemukan.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'tanggal_observasi.required' => 'Tanggal observasi harus dipilih.',
            'tanggal_observasi.date' => 'Format tanggal observasi tidak valid.',
            'catatan.required' => 'Catatan harus diisi.',
        ];
    }
}
