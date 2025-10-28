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
            'toko_id' => 'required|exists:toko,id',
            'komoditas_id' => 'required|exists:komoditas,id',
            'harga' => 'required|numeric',
            'tanggal_observasi' => 'required|date',
            'waktu_observasi' => 'required|date_format:H:i',
            'url_foto' => 'nullable|url',
            'catatan' => 'nullable',
            'status' => 'required|in:dikirim,diterbitkan,ditandai,ditolak,dikoreksi',
            'tanggal_validasi' => 'required|date',
        ];
    }

    public function message(): array
    {
        return [
            'user_id.required' => 'Petugas harus dipilih.',
            'user_id.exists' => 'Petugas tidak ditemukan.',
            'pasar_id.required' => 'Pasar harus dipilih.',
            'pasar_id.exists' => 'Pasar tidak ditemukan.',
            'toko_id.required' => 'Toko harus dipilih.',
            'toko_id.exists' => 'Toko tidak ditemukan.',
            'komoditas_id.required' => 'Komoditas harus dipilih.',
            'komoditas_id.exists' => 'Komoditas tidak ditemukan.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'tanggal_observasi.required' => 'Tanggal observasi harus dipilih.',
            'tanggal_observasi.date' => 'Format tanggal observasi tidak valid.',
            'waktu_observasi.required' => 'Waktu observasi harus dipilih.',
            'waktu_observasi.date_format' => 'Format waktu observasi tidak valid.',
            'url_foto.url' => 'URL foto tidak valid.',
            'catatan.required' => 'Catatan harus diisi.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
