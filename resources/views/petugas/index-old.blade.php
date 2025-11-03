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

    <form id="inputForm">
        <div class="row g-4">
            <!-- Pilih Pasar -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-store me-2"></i>Pilih Pasar
                    <span class="required-star">*</span>
                </label>
                <select class="form-select" required>
                    @foreach ($pasars as $pasar)
                    <option value="{{ $pasar->id }}">{{ $pasar->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Komoditas -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-box me-2"></i>Pilih Komoditas
                    <span class="required-star">*</span>
                </label>
                <select class="form-select" required>
                    <option value="">-- Pilih Komoditas --</option>
                    <optgroup label="Beras">
                        <option value="beras-premium">Beras Premium</option>
                        <option value="beras-medium">Beras Medium</option>
                        <option value="beras-ekonomi">Beras Ekonomi</option>
                    </optgroup>
                    <optgroup label="Minyak & Telur">
                        <option value="minyak-goreng">Minyak Goreng</option>
                        <option value="telur-ayam">Telur Ayam</option>
                    </optgroup>
                    <optgroup label="Daging">
                        <option value="daging-ayam">Daging Ayam</option>
                        <option value="daging-sapi">Daging Sapi</option>
                    </optgroup>
                    <optgroup label="Sayuran">
                        <option value="cabai-merah">Cabai Merah</option>
                        <option value="cabai-rawit">Cabai Rawit</option>
                        <option value="bawang-merah">Bawang Merah</option>
                        <option value="bawang-putih">Bawang Putih</option>
                        <option value="tomat">Tomat</option>
                    </optgroup>
                    <optgroup label="Lainnya">
                        <option value="gula-pasir">Gula Pasir</option>
                        <option value="garam">Garam</option>
                        <option value="tepung-terigu">Tepung Terigu</option>
                    </optgroup>
                </select>
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
                        class="form-control"
                        placeholder="Contoh: 14500"
                        min="0"
                        step="100"
                        required>
                </div>
                <small class="text-muted">Masukkan harga dalam Rupiah (tanpa titik atau koma)</small>
            </div>

            <!-- Satuan -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="fas fa-weight me-2"></i>Satuan
                    <span class="required-star">*</span>
                </label>
                <select class="form-select" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="kg">Kilogram (Kg)</option>
                    <option value="liter">Liter</option>
                    <option value="ons">Ons</option>
                    <option value="buah">Buah</option>
                    <option value="ikat">Ikat</option>
                    <option value="pack">Pack</option>
                </select>
            </div>

            <!-- Catatan -->
            <div class="col-12">
                <label class="form-label">
                    <i class="fas fa-comment-alt me-2"></i>Catatan
                    <span class="text-muted">(Opsional)</span>
                </label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Tambahkan catatan tambahan seperti kondisi stok, kualitas barang, atau informasi penting lainnya..."></textarea>
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