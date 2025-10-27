@extends('admin.layouts.app')

@section('title', 'Ubah Data Pasar')
@section('icon', 'fas fa-shopping-basket')

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
            Form Input Pasar
        </h5>

        <form id="inputForm">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <!-- COde -->
                <div class="col-md-6">
                    <label class="form-label">
                        Code
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="number"
                            name="code"
                            class="form-control"
                            placeholder="Contoh: 01111"
                            value="{{ old('code', $komodita->code) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan code komoditas</small>
                </div>

                <!-- naam komoditas -->
                <div class="col-md-6">
                    <label class="form-label">
                        Nama Komoditas
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Contoh: Beras"
                            value="{{ old('nama', $komodita->nama) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama komoditas</small>
                </div>

                <!-- Unit -->
                <div class="col-md-6">
                    <label class="form-label">
                        Unit(Satuan)
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="unit"
                            class="form-control"
                            placeholder="Contoh: Kg"
                            value="{{ old('unit', $komodita->unit) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan unit komoditas</small>
                </div>

                <!-- kategori-->
                <div class="col-md-6">
                    <label class="form-label">
                        Kategori
                        <span class="text-muted">(opsional)</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="kategori"
                            class="form-control"
                            placeholder="Contoh: Pangan Rakyat"
                            value="{{ old('kategori', $komodita->kategori) }}"
                            >
                    </div>
                    <small class="text-muted">Masukkan kategori komoditas</small>
                </div>

                <!-- Buttons -->
                <div class="col-12">
                    <hr class="my-4">
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan Data
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
        let actionUrl = "{{route('admin.komoditas.update', $komodita->id)}}";
        let successMessage = 'Data berhasil diubah!';
        var redirectUrl = "{{ route('admin.komoditas.index') }}";
        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    })
</script>
@endpush