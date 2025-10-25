@extends('admin.layouts.app')

@section('title', 'Ubah Data Petugas')
@section('icon', 'fas fa-users')

@section('content')
<div>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
    <div class="form-card">
        <h5 class="form-section-title">
            <i class="fas fa-edit"></i>
            Form Input Petugas
        </h5>

        <form id="inputForm">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <!-- Nama -->
                <div class="col-md-6">
                    <label class="form-label">
                        Nama Petugas
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Contoh: Andi"
                            value="{{ old('name') ?? $model->name }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama petugas</small>
                </div>

                <!-- username -->
                <div class="col-md-6">
                    <label class="form-label">
                        Username Akun
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            placeholder="Contoh: andi123"
                            value="{{ old('username') ? old('username') : $model->username }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan username akun</small>
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label class="form-label">
                        Password Akun
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="passwordInput"
                            class="form-control"
                            autocomplete="off"
                            >
                        <span class="input-group-text" style="cursor: pointer; border-left: none; border-radius: 0 10px 10px 0;" onclick="togglePassword(passwordInput, toggleIcon)">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                    <small class="text-muted">Masukkan password akun</small>
                </div>

                <!-- Ulangi Password -->
                <div class="col-md-6">
                    <label class="form-label">
                        Password Akun
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="passwordConfirmationInput"
                            class="form-control"
                            
                            autocomplete="off">
                        <span class="input-group-text" style="cursor: pointer; border-left: none; border-radius: 0 10px 10px 0;" onclick="togglePassword(passwordConfirmationInput, toggleIcon2)">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </span>
                    </div>
                    <small class="text-muted">Masukkan password akun</small>
                </div>

                <!-- Buttons -->
                <div class="col-12">
                    <hr class="my-4">
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Ubah Data
                        </button>
                        <button type="reset" class="btn btn-secondary-custom">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        let formSelector = '#inputForm';
        let actionUrl = "{{ route('admin.petugas.update', $model->id) }}";
        let successMessage = 'Data berhasil diubah!';
        var redirectUrl = "{{ route('admin.petugas.index') }}";
        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
    })
</script>
@endpush