@extends('admin.layouts.app')

@section('title', 'Rekapitulasi Harian')
@section('icon', 'fas fa-chart-line')

@section('content')
<div>
    <!-- Table Section -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Rekapitulasi Harian</h5>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Komoditas</th>
                        <th>Jumlah Submisi</th>
                        <th>Harga Rata-Rata</th>
                        <th>Harga Median</th>
                        <th>Harga Terbesar</th>
                        <th>Harga Terkecil</th>
                        <th>Aksi</th>
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
        var route = "{{ route('admin.rekapitulasi-harian.index') }}";
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
                data: 'nama_komoditas',
                name: 'nama_komoditas',
            },
            {
                data: 'jumlah_submisi',
                name: 'jumlah_submisi',
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
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];
        var table = initializeDataTable(selector, route, columns);

    });
</script>
@endpush