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
                <!-- Nama -->
                <div class="col-md-6">
                    <label class="form-label">
                        Nama Pasar
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Contoh: Pasar Peringgan"
                            value="{{ old('nama', $model->nama) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama pasar</small>
                </div>

                <!-- tipe pasar -->
                <div class="col-md-6">
                    <label class="form-label">
                        Pilih Tipe Pasar
                        <span class="required-star">*</span>
                    </label>
                    <select class="form-select" name="tipe_pasar" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="tradisional" {{ old('tipe_pasar', $model->tipe_pasar) == 'tradisional' ? 'selected' : '' }}>Tradisional</option>
                        <option value="modern" {{ old('tipe_pasar', $model->tipe_pasar) == 'modern' ? 'selected' : '' }}>Modern</option>
                        <option value="lainnya" {{ old('tipe_pasar', $model->tipe_pasar) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="col-12">
                    <label class="form-label">
                        Alamat
                    </label>
                    <textarea
                        class="form-control"
                        rows="3"
                        name="alamat">{{ old('alamat', $model->alamat) }}</textarea>
                </div>

                <!-- kecamatan -->
                <div class="col-md-6">
                    <label class="form-label">
                        Kecamatan
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="kecamatan"
                            class="form-control"
                            placeholder="Contoh: Medan Baru"
                            value="{{ old('kecamatan', $model->kecamatan) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama kecamatan</small>
                </div>

                <!-- kelurahan -->
                <div class="col-md-6">
                    <label class="form-label">
                        Kelurahan
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="text"
                            name="kelurahan"
                            class="form-control"
                            placeholder="Contoh: Sei Putih Tengah"
                            value="{{ old('kelurahan', $model->kelurahan) }}"
                            required>
                    </div>
                    <small class="text-muted">Masukkan nama kelurahan</small>
                </div>

                <!-- Keterangan -->
                <div class="col-12">
                    <label class="form-label">
                        Keterangan
                        <span class="text-muted">(Opsional)</span>
                    </label>
                    <textarea
                        class="form-control"
                        rows="4"
                        name="keterangan"
                        placeholder="Tambahkan keterangan tambahan seperti lokasi pasar dekat dengan fasilitas bangunan apa saja...">{{ old('keterangan', $model->keterangan) }}</textarea>
                </div>

                <!-- url map -->
                <div class="col-12">
                    <label class="form-label">
                        Url
                    </label>
                    <div class="input-group">
                        <input
                            type="url"
                            class="form-control"
                            id="maps_url">
                    </div>
                    <small class="text-muted">Tempel link Google Maps di sini</small>
                    <small id="latlng_preview" style="display:block;margin-top:.25rem;color:#6c757d"></small>
                    <input type="hidden" name="lat" value="{{ old('lat', $model->lat) }}" id="latitude">
                    <input type="hidden" name="lng" value="{{ old('lat', $model->lng) }}" id="longitude">
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
        let actionUrl = "{{route('admin.pasar.update', $model->id)}}";
        let successMessage = 'Data berhasil diubah!';
        var redirectUrl = "{{ route('admin.pasar.index') }}";
        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    })
    // Helper: cek apakah string angka (termasuk minus & desimal)
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    // Parse lat,lng dari beragam format URL Google Maps
    function parseGoogleMapsLatLng(url) {
        try {
            const u = new URL(url);
            let lat = null,
                lng = null;

            // 1) Pattern /@LAT,LNG,ZOOM ...
            //    contoh: .../@3.5803786,98.6568239,17z/...
            const atMatch = u.pathname.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
            if (atMatch) {
                lat = parseFloat(atMatch[1]);
                lng = parseFloat(atMatch[2]);
            }

            // 2) Pattern !3dLAT!4dLNG (sering muncul di /data=)
            //    contoh: ...!3d3.5803786!4d98.6593988!...
            if ((lat === null || lng === null)) {
                const bangMatch = u.pathname.match(/!3d(-?\d+\.?\d*)!4d(-?\d+\.?\d*)/);
                if (bangMatch) {
                    lat = parseFloat(bangMatch[1]);
                    lng = parseFloat(bangMatch[2]);
                }
            }

            // 3) Query param q=lat,lng atau ll=lat,lng
            if ((lat === null || lng === null)) {
                for (const key of ['q', 'll']) {
                    const v = u.searchParams.get(key);
                    if (v) {
                        const parts = v.split(/[,\s]+/).filter(Boolean);
                        if (parts.length >= 2 && isNumeric(parts[0]) && isNumeric(parts[1])) {
                            lat = parseFloat(parts[0]);
                            lng = parseFloat(parts[1]);
                            break;
                        }
                    }
                }
            }

            // 4) Fallback: sebagian link menaruh @LAT,LNG di search (jarang)
            if ((lat === null || lng === null)) {
                const searchAt = u.search.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
                if (searchAt) {
                    lat = parseFloat(searchAt[1]);
                    lng = parseFloat(searchAt[2]);
                }
            }

            if (lat !== null && lng !== null && isFinite(lat) && isFinite(lng)) {
                return {
                    lat,
                    lng
                };
            }
            return null;
        } catch (e) {
            return null; // URL tidak valid
        }
    }

    // Isi hidden input ketika user paste/ubah URL
    const urlInput = document.getElementById('maps_url');
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const preview = document.getElementById('latlng_preview');

    function updateLatLngFromUrl() {
        const url = urlInput.value.trim();
        const parsed = parseGoogleMapsLatLng(url);

        if (parsed) {
            latInput.value = parsed.lat;
            lngInput.value = parsed.lng;
            if (preview) {
                preview.textContent = `Koordinat terdeteksi: ${parsed.lat}, ${parsed.lng}`;
            }
        } else {
            latInput.value = '';
            lngInput.value = '';
            if (preview) {
                preview.textContent = 'Tidak dapat mendeteksi koordinat dari link tersebut.';
            }
        }
    }

    // Trigger saat user paste/ubah/keluar dari field
    urlInput.addEventListener('change', updateLatLngFromUrl);
    urlInput.addEventListener('input', updateLatLngFromUrl);
    urlInput.addEventListener('paste', () => setTimeout(updateLatLngFromUrl, 0));
</script>
@endpush