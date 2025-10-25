@extends('admin.layouts.app')

@section('title', 'Tambah Toko Pasar')
@section('icon', 'fas fa-store')

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
            Form Input Toko Pasar
        </h5>

        <form id="inputForm">
            @csrf
            <div class="row g-4">
                <!-- Nama -->
                <div class="col-md-4">
                    <label class="form-label">
                        Nama Toko
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="nama_toko"
                            class="form-control"
                            placeholder="Contoh: Kios Pak Haji Sayur"
                            value="{{ old('nama_toko') }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama toko</small>
                </div>

                <!-- Nama pemilik kios-->
                <div class="col-md-4">
                    <label class="form-label">
                        Nama Pemilik Toko
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="nama_pemilik_toko"
                            class="form-control"
                            placeholder="Contoh: Pak Haji Ahmad"
                            value="{{ old('nama_pemilik_toko') }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama toko</small>
                </div>

                <!-- nomor kios -->
                <div class="col-md-4">
                    <label class="form-label">
                        Nomor Kios
                        <span class="text-muted">(Opsional)</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="nomor_kios"
                            class="form-control"
                            placeholder="Contoh: 219"
                            value="{{ old('nomor_kios') }}">
                    </div>
                    <small class="text-muted">Masukkan nama pemilik toko</small>
                </div>

                <!-- Buttons -->
                <div class="col-12">
                    <hr class="my-4">
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Simpan Data
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
        let actionUrl = "{{ route('admin.pasar.toko.store', $pasar->id) }}";
        let successMessage = 'Data berhasil disimpan!';
        var redirectUrl = "{{ route('admin.pasar.toko.index', $pasar->id) }}";
        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
    });
</script>
@endpush