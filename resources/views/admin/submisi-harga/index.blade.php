@extends('admin.layouts.app')

@section('title', 'Submisi Harga')
@section('icon', 'fas fa-chart-bar')

@section('content')
<div>
    <!-- Table Section -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Submisi Harga</h5>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Pasar</th>
                        <th>Toko</th>
                        <th>Komoditas</th>
                        <th>Harga</th>
                        <th>Status</th>
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
        var route = "{{ route('admin.submisi-harga.index') }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_petugas',
                name: 'nama_petugas',
            },
            {
                data: 'nama_pasar',
                name: 'nama_pasar',
            },
            {
                data: 'nama_toko',
                name: 'nama_toko',
            },
            {
                data: 'nama_komoditas',
                name: 'nama_komoditas',
            },
            {
                data: 'harga',
                name: 'harga',
            },
            {
                data: 'status',
                name: 'status',
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