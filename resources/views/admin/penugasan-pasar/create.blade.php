@extends('admin.layouts.app')

@section('title', 'Penugasan Pasar')
@section('icon', 'fas fa-clipboard-list')

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
            Form Input Penugasan Pasar
        </h5>

        <form id="inputForm">
            @csrf
            <div class="row g-4">
                <!-- pasar -->
                <div class="col-md-6">
                    <label class="form-label">
                        Pilih Pasar
                        <span class="required-star">*</span>
                    </label>
                    <select class="form-select" name="pasar_id" id="pasar_id" required>
                    </select>
                </div>

                <!-- petugas -->
                <div class="col-md-6">
                    <label class="form-label">
                        Pilih Petugas
                        <span class="required-star">*</span>
                    </label>
                    <select class="form-select" name="user_id" id="user_id" required>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="col-md-6">
                    <label class="form-label">
                        Tanggal Penugasan
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            placeholder="dd-mm-yyyy"
                            value="{{ old('tanggal') }}"
                            min="{{ date('Y-m-d') }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan tanggal</small>
                </div>

                <!-- Keterangan -->
                <div class="col-md-6">
                    <label class="form-label">
                        Keterangan
                        <span class="text-muted">(Opsional)</span>
                    </label>
                    <textarea
                        class="form-control"
                        rows="4"
                        name="keterangan"
                        value="{{ old('keterangan') }}"
                        required
                        placeholder="Tambahkan keterangan tambahan seperti jenis penugasan apa saja...">{{ old('keterangan') }}</textarea>
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
        let actionUrl = "{{ route('admin.penugasan-pasar.store') }}";
        let successMessage = 'Data berhasil disimpan!';
        var redirectUrl = "{{ route('admin.penugasan-pasar.index') }}";
        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

        $("#pasar_id").select2({
            placeholder: 'Pilih Pasar',
            allowClear: true,
            ajax: {
                url: "{{ route('search.pasar') }}",
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term || ''
                }),
                processResults: data => ({
                    results: data.map(res => ({
                        id: res.id,
                        text: res.nama
                    }))
                }),
                cache: true
            }
        });

        $("#user_id").select2({
            placeholder: 'Pilih Petugas',
            allowClear: true,
            ajax: {
                url: "{{ route('search.petugas') }}",
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term || ''
                }),
                processResults: data => ({
                    results: data.map(res => ({
                        id: res.id,
                        text: res.name
                    }))
                }),
                cache: true
            }
        });
    });
</script>
@endpush