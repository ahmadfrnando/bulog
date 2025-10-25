<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $routeParam = $this->route('petuga');
        $id = is_object($routeParam) ? $routeParam->id : $routeParam;

        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($id), // ganti 'users' & kolom kalau berbeda
            ],
            // Saat create wajib, saat update boleh kosong
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'confirmed',
                'min:8',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
}
