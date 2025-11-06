@extends('petugas.layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-calendar-day me-2"></i>Riwayat Submisi Harga Pasar</h4>
            <p><i class="fas fa-clock me-2"></i>Tanggal: <strong id="currentDate"></strong></p>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-success fs-6 px-3 py-2">
                <i class="fas fa-check-circle me-2"></i>Status: Aktif
            </span>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="form-card">
    <h5 class="form-section-title">
        <i class="fas fa-edit"></i>
        Semua Riwayat
    </h5>

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
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('petugas.riwayat.index') }}";
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