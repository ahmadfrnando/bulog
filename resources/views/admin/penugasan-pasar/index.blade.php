@extends('admin.layouts.app')

@section('title', 'Penugasan Pasar')
@section('icon', 'fas fa-clipboard-list')

@section('content')
<div>
    <!-- Table Section -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Penugasan Pasar</h5>
            <a href="{{ route('admin.penugasan-pasar.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <div class="my-4">
                <label for="pasar_id" class="form-label">Pilih Pasar</label>
                <select class="js-example-basic-multiple js-states" id="pasar_id" name="pasar_id" style="width: 40%;">
                </select>
            </div>
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Nama Pasar</th>
                        <th>Tipe Pasar</th>
                        <th>Map</th>
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
        var route = "{{ route('admin.penugasan-pasar.index') }}";
        var selectFilter = "#pasar_id"
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
                orderable: true,
                searchable: true
            },
            {
                data: 'pasar.nama',
                name: 'pasar.nama',
                orderable: true,
                searchable: true
            },
            {
                data: 'pasar.tipe_pasar',
                name: 'pasar.tipe_pasar',
                orderable: true,
                searchable: true
            },
            {
                data: 'map',
                name: 'map',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];
        var table = initializeDataTableWithSelectFilter(selector, route, columns, selectFilter);

        $(selectFilter).change(function() {
            table.ajax.reload();
        });

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.penugasan-pasar.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });

        $(document).ready(function() {
            $("#pasar_id").select2({
                placeholder: 'Pilih Pasar',
                allowClear: true,
                ajax: {
                    url: "{{ route('search.pasar') }}",
                    dataType: 'json',
                    delay: 250,
                    data: params => ({
                        q: params.term || ''
                    }),
                    processResults: data => ({
                        results: data.map(res => ({
                            id: res.id,
                            text: res.nama
                        }))
                    }),
                    cache: true
                }
            });
        });
    })
</script>
@endpush