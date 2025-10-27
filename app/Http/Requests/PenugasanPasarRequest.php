<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenugasanPasarRequest extends FormRequest
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
            'pasar_id' => 'required|exists:pasar,id',
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'pasar_id.required' => 'Pasar harus dipilih.',
            'pasar_id.exists' => 'Pasar tidak ditemukan.',
            'user_id.required' => 'User harus dipilih.',
            'user_id.exists' => 'User tidak ditemukan.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Tanggal harus berupa tanggal.',
            'keterangan.required' => 'Keterangan harus diisi.',
        ];
    }
}
