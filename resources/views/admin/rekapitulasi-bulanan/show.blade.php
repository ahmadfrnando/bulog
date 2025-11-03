@extends('admin.layouts.app')

@section('title', 'Detail Rekapitulasi Bulanan')
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
            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Informasi Rekapitulasi Bulanan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-shopping-bag text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Komoditas</small>
                            <strong>{{ $rekapitulasi_bulanan->nama_komoditas }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Bulan</small>
                            <strong>{{ $rekapitulasi_bulanan->bulan }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-pin text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Tahun</small>
                            <strong>{{ $rekapitulasi_bulanan->tahun }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Harga Rata-Rata</small>
                            <strong>{{ $rekapitulasi_bulanan->harga_rata_rata }} / {{ $rekapitulasi_bulanan->komoditas?->unit }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Persentase Perubahan Harga</small>
                            <strong>{{ number_format($rekapitulasi_bulanan->persentase_perubahan_harga, 0, ',', '.'); }} %</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Rekapitulasi Harian </h5>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Harga Rata-Rata</th>
                        <th>Harga Median</th>
                        <th>Harga Tertinggi</th>
                        <th>Harga Terendah</th>
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
        var route = "{{ route('admin.rekapitulasi-bulanan.show', $rekapitulasi_bulanan->id) }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'tanggal',
                name: 'tanggal',
                render: function(data, type, row) {
                    return moment(data).locale('id').format('ll') ?? '-';
                }
            },
            {
                data: 'harga_rata_rata',
                name: 'harga_rata_rata',
            },
            {
                data: 'harga_median',
                name: 'harga_median',
            },
            {
                data: 'harga_minimal',
                name: 'harga_minimal',
            },
            {
                data: 'harga_maksimal',
                name: 'harga_maksimal',
            },
        ];
        var table = initializeDataTable(selector, route, columns);
    })
</script>
@endpush