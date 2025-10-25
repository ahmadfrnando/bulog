<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasarRequest extends FormRequest
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
            'nama' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
            'keterangan' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Pasar harus diisi.',
            'lat.required' => 'Latitude harus diisi.',
            'lng.required' => 'Longitude harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'kelurahan.required' => 'Kelurahan harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',
        ];
    }
}
