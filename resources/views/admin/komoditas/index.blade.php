@extends('admin.layouts.app')

@section('title', 'Komoditas')
@section('icon', 'fas fa-list')

@section('content')
<div>
    <!-- Table Section -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Komoditas</h5>
            <a href="{{ route('admin.komoditas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Nama Komoditas</th>
                        <th>Unit</th>
                        <th>Kategori</th>
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
        var route = "{{ route('admin.komoditas.index') }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'code',
                name: 'code',
            },
            {
                data: 'nama',
                name: 'nama',
            },
            {
                data: 'unit',
                name: 'unit',
            },
            {
                data: 'kategori',
                name: 'kategori',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];
        var table = initializeDataTable(selector, route, columns);

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.komoditas.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });

    });
</script>
@endpush