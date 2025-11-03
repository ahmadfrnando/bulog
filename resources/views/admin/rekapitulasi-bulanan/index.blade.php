@extends('admin.layouts.app')

@section('title', 'Rekapitulasi Bulanan')
@section('icon', 'fas fa-chart-line')

@section('content')
<div>
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Rekapitulasi Bulanan</h5>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Komoditas</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Harga Rata-Rata</th>
                        <th>Psersentase Perubahan Harga</th>
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
        var route = "{{ route('admin.rekapitulasi-bulanan.index') }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_komoditas',
                name: 'nama_komoditas',
            },
            {
                data: 'tahun',
                name: 'tahun',
            },
            {
                data: 'bulan',
                name: 'bulan',
            },
            {
                data: 'harga_rata_rata',
                name: 'harga_rata_rata',
            },
            {
                data: 'pst_perubahan_harga',
                name: 'pst_perubahan_harga',
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