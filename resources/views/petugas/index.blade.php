@extends('petugas.layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-calendar-day me-2"></i>Input Data Harian</h4>
            <p><i class="fas fa-clock me-2"></i>Tanggal: <strong id="currentDate"></strong></p>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-success fs-6 px-3 py-2">
                <i class="fas fa-check-circle me-2"></i>Status: Aktif
            </span>
        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success-custom alert-custom">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Success:</strong> {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger-custom alert-custom">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Error:</strong> {{ session('error') }}
</div>
@endif
<!-- Info Alert -->
<div class="alert alert-info-custom alert-custom">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Petunjuk:</strong> Pastikan data yang diinput sudah sesuai dengan kondisi pasar saat ini. Data akan diverifikasi oleh admin sebelum dipublikasikan.
</div>

<!-- Form Card -->
<div class="form-card">
    <h5 class="form-section-title">
        <i class="fas fa-edit"></i>
        Form Input Harga Komoditas
    </h5>

    <form id="inputForm" action="{{ route('petugas.submisi-harga.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(auth()->check())
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endif
        <div class="row g-4">
            <!-- Pilih Pasar -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-store me-2"></i>Pilih Pasar
                    <span class="required-star">*</span>
                </label>
                <select class="form-select" name="pasar_id" required>
                    @foreach ($pasars as $pasar)
                    <option value="{{ $pasar->id }}" {{ old('pasar_id') == $pasar->id ? 'selected' : '' }}>{{ $pasar->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Toko -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-store me-2"></i>Nama Toko
                    <span class="required-star">*</span>
                </label>
                <div class="input-group">
                    <input
                        type="text"
                        name="nama_toko"
                        class="form-control"
                        placeholder="Contoh: Toko Pak Haji Ahmad"
                        value="{{ old('nama_toko') }}"
                        required>
                </div>
                <small class="text-muted">Masukkan nama toko</small>
            </div>

            <!-- Pilih Komoditas -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-box me-2"></i>Pilih Komoditas
                    <span class="required-star">*</span>
                </label>
                <select class="form-select" name="komoditas_id" required>
                    @foreach ($komoditas as $komoditas)
                    <option value="{{ $komoditas->id }}" {{ old('komoditas_id') == $komoditas->id ? 'selected' : '' }}>{{ $komoditas->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Observasi-->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-calendar me-2"></i>Tanggal Observasi
                    <span class="required-star">*</span>
                </label>
                <div class="input-group">
                    <input
                        type="date"
                        name="tanggal_observasi"
                        class="form-control"
                        value="{{ old('tanggal_observasi') }}"
                        required>
                </div>
                <small class="text-muted">Masukkan tanggal observasi</small>
            </div>

            <!-- Harga Satuan -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-money-bill-wave me-2"></i>Harga Satuan
                    <span class="required-star">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        class="form-control"
                        placeholder="Contoh: 14500"
                        min="0"
                        step="100"
                        required>
                </div>
                <small class="text-muted">Masukkan harga dalam Rupiah (tanpa titik atau koma)</small>
            </div>

            <!-- Catatan -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-comment-alt me-2"></i>Catatan
                    <span class="text-muted">(Opsional)</span>
                </label>
                <textarea
                    class="form-control"
                    name="catatan"
                    rows="4"
                    placeholder="Tambahkan catatan tambahan seperti kondisi stok, kualitas barang, atau informasi penting lainnya...">{{ old('catatan') }}</textarea>
            </div>

            <!-- Foto Bukti -->
            <div class="col-12">
                <label class="form-label">
                    <i class="fas fa-camera me-2"></i>Foto Bukti
                    <span class="text-muted">(Opsional)</span>
                </label>
                <div class="photo-upload-area" onclick="document.getElementById('photoInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Klik atau seret foto ke sini</p>
                    <small>Format: JPG, PNG, JPEG (Maksimal 5MB)</small>
                </div>
                <input
                    type="file"
                    name="url_foto"
                    id="photoInput"
                    accept="image/jpeg,image/png,image/jpg"
                    style="display: none;">
                <div class="photo-preview" id="photoPreview">
                    <img id="previewImage" src="" alt="Preview">
                    <button type="button" class="remove-photo" onclick="removePhoto()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
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
@endsection
@push('scripts')
<script type="text/javascript">
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 5MB.');
                this.value = '';
                return;
            }

            // Check file type
            if (!file.type.match('image/(jpeg|jpg|png)')) {
                alert('Format file tidak valid! Gunakan JPG, JPEG, atau PNG.');
                this.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('photoPreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Remove Photo
    function removePhoto() {
        document.getElementById('photoInput').value = '';
        document.getElementById('photoPreview').style.display = 'none';
        document.getElementById('previewImage').src = '';
    }

    // // Form Submit Handler
    // document.getElementById('inputForm').addEventListener('submit', function(e) {
    //     e.preventDefault();

    //     // Show success message
    //     const alertDiv = document.createElement('div');
    //     alertDiv.className = 'alert alert-success alert-dismissible fade show';
    //     alertDiv.style.borderRadius = '10px';
    //     alertDiv.innerHTML = `
    //             <i class="fas fa-check-circle me-2"></i>
    //             <strong>Berhasil!</strong> Data harga telah berhasil disimpan dan menunggu validasi admin.
    //             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    //         `;

    //     this.insertBefore(alertDiv, this.firstChild);

    //     // Scroll to top
    //     window.scrollTo({
    //         top: 0,
    //         behavior: 'smooth'
    //     });

    //     // Reset form after 2 seconds
    //     setTimeout(() => {
    //         this.reset();
    //         removePhoto();
    //         alertDiv.remove();
    //     }, 3000);
    // });

    // Reset Form Handler
    document.getElementById('inputForm').addEventListener('reset', function() {
        removePhoto();
    });
</script>
@endpush