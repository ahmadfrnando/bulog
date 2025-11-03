@extends('admin.layouts.app')

@section('title', 'Detail Rekapitulasi Harian')
@section('icon', 'fas fa-chart-line')

@section('content')
<div>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
    <!-- Card Informasi Detail Pasar -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Informasi Rekapitulasi Harian</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-shopping-bag text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Tanggal</small>
                            <strong>{{ $rekapitulasi_harian->tanggal }}</strong>                         </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Komoditas</small>
                            <strong>{{ $rekapitulasi_harian->nama_komoditas }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-pin text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Jumlah Submisi</small>
                            <strong>{{ $rekapitulasi_harian->jumlah_submisi }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Harga Rata-Rata</small>
                            <strong>{{ $rekapitulasi_harian->harga_rata_rata }} / {{ $rekapitulasi_harian->komoditas?->unit }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Harga Median</small>
                            <strong>{{ $rekapitulasi_harian->harga_median }} / {{ $rekapitulasi_harian->komoditas?->unit }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Harga Minimal</small>
                            <strong>{{ $rekapitulasi_harian->harga_minimal }} / {{ $rekapitulasi_harian->komoditas?->unit }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Harga Maksimal</small>
                            <strong>{{ $rekapitulasi_harian->harga_maksimal }} / {{ $rekapitulasi_harian->komoditas?->unit }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Submisi </h5>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Toko</th>
                        <th>Pasar</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('admin.rekapitulasi-harian.show', $rekapitulasi_harian->id) }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'user.name',
                name: 'user.name',
            },
            {
                data: 'toko.nama_toko',
                name: 'toko.nama_toko',
            },
            {
                data: 'pasar.nama',
                name: 'pasar.nama',
            },
            {
                data: 'harga',
                name: 'harga',
            },
        ];
        var table = initializeDataTable(selector, route, columns);
    })
</script>
@endpush