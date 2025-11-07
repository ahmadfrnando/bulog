@extends('petugas.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/petugas/riwayat.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Main Information -->
            <div class="detail-card">
                <div class="card-header-custom">
                    <h5>
                        <i class="fas fa-info-circle"></i>
                        Informasi Submisi
                    </h5>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-store"></i>
                                    Nama Pasar
                                </div>
                                <div class="info-value">
                                    {{ $riwayat->nama_pasar }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-shopping-bag"></i>
                                    Nama Toko
                                </div>
                                <div class="info-value">
                                    {{ $riwayat->nama_toko }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-box"></i>
                                    Komoditas
                                </div>
                                <div class="info-value">
                                    {{ $riwayat->nama_komoditas }} ({{ $riwayat->komoditas?->code }})
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-weight"></i>
                                    Satuan
                                </div>
                                <div class="info-value">
                                    {{ $riwayat->unit }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Display -->
                    <div class="price-display">
                        <i class="fas fa-tag"></i> Rp {{ number_format($riwayat->harga, 0, ',', '.') }} / {{ $riwayat->unit }}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-user-tie"></i>
                                    Petugas Lapangan
                                </div>
                                <div class="info-value">
                                    {{ $riwayat->nama_petugas }}
                                    <br>
                                    <small class="text-muted">ID: {{ $riwayat->user?->username }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-calendar-check"></i>
                                    Tanggal Observasi
                                </div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($riwayat->tanggal_observasi)->locale('id_ID')->formatLocalized('%A, %d %B %Y') }}

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="info-group">
                        <div class="info-label">
                            <i class="fas fa-comment-alt"></i>
                            Catatan Petugas
                        </div>
                        <div class="notes-box">
                            <i class="fas fa-quote-left" style="color: #ffc107; margin-right: 10px;"></i>
                            {{ $riwayat->catatan }}
                            <i class="fas fa-quote-right" style="color: #ffc107; margin-left: 10px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Evidence -->
            <div class="detail-card">
                <div class="card-header-custom">
                    <h5>
                        <i class="fas fa-camera"></i>
                        Foto Bukti
                    </h5>
                </div>
                <div class="card-body-custom">
                    @if(empty($riwayat->url_foto))
                    <div class="photo-container">
                        <span>Foto Bukti Harga Tidak Tersedia</span>
                    </div>
                    @else
                    <div class="photo-container">
                        <img src="{{ asset('storage/' . $riwayat->url_foto) }}"
                            alt="Foto Bukti Harga"
                            class="photo-preview">
                        <div class="mt-3">
                            <a href="{{ asset('storage/' . $riwayat->url_foto) }}"
                                target="_blank"
                                class="btn btn-action btn-correct">
                                <i class="fas fa-expand"></i>
                                Lihat Ukuran Penuh
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Timeline/History -->
            <div class="detail-card">
                <div class="card-header-custom">
                    <h5>
                        <i class="fas fa-history"></i>
                        Riwayat Status
                    </h5>
                </div>
                <div id="riwayat-status-container">
                    @include('admin.submisi-harga._riwayat-status', ['riwayat' => $riwayat->submisi_harga_status()->orderBy('created_at', 'desc')->get()])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection