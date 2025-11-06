@extends('admin.layouts.app')

@section('title', 'Detail Submisi Harga')
@section('icon', 'fas fa-chart-bar')

@section('content')
<style>
    .detail-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
        color: white;
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .card-header-custom h5 i {
        margin-right: 10px;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .status-pending {
        background: #ffc107;
        color: #000;
    }

    .status-published {
        background: #28a745;
        color: white;
    }

    .status-rejected {
        background: #dc3545;
        color: white;
    }

    .status-corrected {
        background: #17a2b8;
        color: white;
    }

    .status-flagged {
        background: #fd7e14;
        color: white;
    }

    .card-body-custom {
        padding: 30px;
    }

    .info-group {
        margin-bottom: 25px;
    }

    .info-label {
        font-weight: 600;
        color: var(--primary-green);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .info-label i {
        margin-right: 10px;
        width: 20px;
        color: var(--accent-green);
    }

    .info-value {
        color: #333;
        font-size: 16px;
        padding: 12px 15px;
        background: var(--soft-green);
        border-radius: 8px;
        border-left: 4px solid var(--accent-green);
    }

    .price-display {
        font-size: 32px;
        font-weight: bold;
        color: var(--primary-green);
        padding: 20px;
        background: linear-gradient(135deg, var(--soft-green) 0%, white 100%);
        border-radius: 12px;
        border: 3px solid var(--accent-green);
        text-align: center;
        margin: 20px 0;
    }

    .photo-preview {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 3px solid var(--soft-green);
    }

    .photo-container {
        background: var(--soft-green);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
    }

    .notes-box {
        background: #fff9e6;
        border-left: 4px solid #ffc107;
        padding: 20px;
        border-radius: 8px;
        color: #333;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-publish {
        background: #28a745;
        color: white;
    }

    .btn-publish:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-correct {
        background: #17a2b8;
        color: white;
    }

    .btn-correct:hover {
        background: #138496;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    }

    .btn-reject {
        background: #dc3545;
        color: white;
    }

    .btn-reject:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-flag {
        background: #fd7e14;
        color: white;
    }

    .btn-flag:hover {
        background: #e96b05;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .timeline-item {
        padding: 15px 0;
        border-left: 3px solid var(--accent-green);
        padding-left: 25px;
        margin-left: 10px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 20px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: var(--accent-green);
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--soft-green);
    }

    .timeline-item:last-child {
        border-left-color: transparent;
    }

    .timeline-date {
        font-size: 12px;
        color: #666;
        font-weight: 600;
    }

    .timeline-content {
        margin-top: 5px;
        color: #333;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px 25px;
    }

    .form-control:focus {
        border-color: var(--accent-green);
        box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.15);
    }

    @media (max-width: 768px) {
        .card-header-custom {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .price-display {
            font-size: 24px;
        }
    }
</style>

<div class="container-fluid">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Status Update Section -->
     @if($submisi_harga->status != 'diterbitkan')
    <div class="detail-card">
        <div class="card-header-custom">
            <h5>
                <i class="fas fa-edit"></i>
                Update Status Submisi
            </h5>
            <span class="status-badge status-pending">
                <i class="fas fa-clock"></i>
                Pending Review
            </span>
        </div>
        <div class="card-body-custom">
            <div class="action-buttons">
                <button class="btn-action btn-publish" data-bs-toggle="modal" data-bs-target="#publishModal">
                    <i class="fas fa-check-circle"></i>
                    Terbitkan
                </button>
                <button class="btn-action btn-correct" data-bs-toggle="modal" data-bs-target="#correctModal">
                    <i class="fas fa-edit"></i>
                    Minta Koreksi
                </button>
                <button class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    <i class="fas fa-times-circle"></i>
                    Tolak
                </button>
                <button class="btn-action btn-flag" data-bs-toggle="modal" data-bs-target="#flagModal">
                    <i class="fas fa-flag"></i>
                    Tandai
                </button>
            </div>
        </div>
    </div>
    @endif

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
                                    {{ $submisi_harga->nama_pasar }}
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
                                    {{ $submisi_harga->nama_toko }}
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
                                    {{ $submisi_harga->nama_komoditas }} ({{ $submisi_harga->komoditas?->code }})
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
                                    {{ $submisi_harga->unit }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Display -->
                    <div class="price-display">
                        <i class="fas fa-tag"></i> Rp {{ number_format($submisi_harga->harga, 0, ',', '.') }} / {{ $submisi_harga->unit }}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="info-label">
                                    <i class="fas fa-user-tie"></i>
                                    Petugas Lapangan
                                </div>
                                <div class="info-value">
                                    {{ $submisi_harga->nama_petugas }}
                                    <br>
                                    <small class="text-muted">ID: {{ $submisi_harga->user?->username }}</small>
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
                                    {{ \Carbon\Carbon::parse($submisi_harga->tanggal_observasi)->locale('id_ID')->formatLocalized('%A, %d %B %Y') }}

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
                            {{ $submisi_harga->catatan }}
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
                    @if(empty($submisi_harga->url_foto))
                    <div class="photo-container">
                        <span>Foto Bukti Harga Tidak Tersedia</span>
                    </div>
                    @else
                    <div class="photo-container">
                        <img src="{{ asset('storage/' . $submisi_harga->url_foto) }}"
                            alt="Foto Bukti Harga"
                            class="photo-preview">
                        <div class="mt-3">
                            <a href="https://images.unsplash.com/photo-1586201375761-83865001e31c?w=1200"
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
                    @include('admin.submisi-harga._riwayat-status', ['riwayat' => $submisi_harga->submisi_harga_status()->orderBy('created_at', 'desc')->get()])
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="publishModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>
                    Terbitkan Submisi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <p>Apakah Anda yakin ingin menerbitkan submisi ini? Data akan dipublikasikan ke sistem monitoring harga.</p>
                <form id="publishForm" class="status-form" data-success-message="Status sukses diperbarui" action="{{ route('admin.submisi-harga.status', $submisi_harga->id) }}" method="POST" data-redirect-url="{{ route('admin.submisi-harga.show', $submisi_harga->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nama_status" value="diterbitkan" readonly>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Catatan Admin (Opsional)</label>
                        <textarea class="form-control" name="alasan" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-action btn-publish">
                            <i class="fas fa-check"></i> Ya, Terbitkan
                        </button>
                        <button type="button" class="btn-action btn-back" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Correct Modal -->
<div class="modal fade" id="correctModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>
                    Minta Koreksi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <p>Kirim permintaan koreksi kepada petugas lapangan untuk memperbaiki data submisi ini.</p>
                <form id="correctForm" class="status-form" data-success-message="Status sukses diperbarui" action="{{ route('admin.submisi-harga.status', $submisi_harga->id) }}" data-redirect-url="{{ route('admin.submisi-harga.show', $submisi_harga->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nama_status" value="dikoreksi" readonly>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alasan Koreksi <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alasan" rows="4" placeholder="Jelaskan apa yang perlu diperbaiki..." required></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-action btn-correct">
                            <i class="fas fa-paper-plane"></i> Kirim Permintaan
                        </button>
                        <button type="button" class="btn-action btn-back" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle me-2"></i>
                    Tolak Submisi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan:</strong> Submisi yang ditolak tidak dapat dipublikasikan dan akan diarsipkan.
                </div>
                <form id="rejectForm" class="status-form" data-success-message="Status sukses diperbarui" action="{{ route('admin.submisi-harga.status', $submisi_harga->id) }}" method="POST" data-redirect-url="{{ route('admin.submisi-harga.show', $submisi_harga->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nama_status" value="ditolak" readonly>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" name="alasan" placeholder="Jelaskan alasan penolakan..." required></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-action btn-reject">
                            <i class="fas fa-ban"></i> Ya, Tolak Submisi
                        </button>
                        <button type="button" class="btn-action btn-back" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Flag Modal -->
<div class="modal fade" id="flagModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom" style="background: linear-gradient(135deg, #fd7e14 0%, #e96b05 100%);">
                <h5 class="modal-title">
                    <i class="fas fa-flag me-2"></i>
                    Tandai Submisi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <p>Tandai submisi ini untuk review lebih lanjut atau keperluan khusus.</p>
                <form id="flagForm" class="status-form" data-success-message="Status sukses diperbarui" action="{{ route('admin.submisi-harga.status', $submisi_harga->id) }}" method="POST" data-redirect-url="{{ route('admin.submisi-harga.show', $submisi_harga->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nama_status" value="ditandai" readonly>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alasan <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" name="alasan" placeholder="Tambahkan catatan..." required></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-action btn-flag">
                            <i class="fas fa-flag"></i> Tandai Submisi
                        </button>
                        <button type="button" class="btn-action btn-back" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).on('submit', '.status-form', function(e) {
        e.preventDefault();

        const $form = $(this);

        // Jika pakai jQuery Validate, hormati validasinya
        if ($.fn.valid && !$form.valid()) return;

        const actionUrl = $form.attr('action');
        const successMsg = $form.data('success-message') || 'Status berhasil diperbarui!';
        const redirectUrl = $form.data('redirect-url');
        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: $form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                $('#riwayat-status-container').html('<p class="text-center text-muted">Memuat...</p>');
                $('#riwayat-status-container').load("{{ route('admin.submisi-harga.riwayat', $submisi_harga->id) }}");
                $('.modal').modal('hide');
                $form.trigger('reset');
                setTimeout(function() {
                    showToast('success', successMsg);
                }, 500);
                // Swal.fire({
                //     icon: 'success',
                //     title: successMsg || `${response.message}`,
                //     confirmButtonText: 'Oke',
                //     confirmButtonColor: '#2d5a3d'
                // }).then((result) => {
                //     if (result.isConfirmed && redirectUrl) {
                //         window.location.href = redirectUrl;
                //     }
                // });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let res = xhr.responseJSON;
                    let errorMessages = Object.values(res.errors).flat().join('\n');
                    Swal.fire('Validasi Gagal', errorMessages, 'error');
                } else {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan.', 'error');
                }
            }
        })
    });
</script>

@endpush