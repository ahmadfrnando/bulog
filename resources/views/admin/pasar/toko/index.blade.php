@extends('admin.layouts.app')

@section('title', 'Toko')
@section('icon', 'fas fa-store')

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
            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Informasi Detail Pasar</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-shopping-bag text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Nama Pasar</small>
                            <strong>{{ $pasar->nama ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Kecamatan</small>
                            <strong>{{ $pasar->kecamatan ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-pin text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Kelurahan</small>
                            <strong>{{ $pasar->kelurahan ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-home text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Alamat</small>
                            <strong>{{ $pasar->alamat ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Google Maps</small>
                            @if(!empty($pasar->lng && $pasar->lat))
                            <a href="{{ $pasar->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-external-link-alt me-1"></i>Lihat Lokasi
                            </a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-info-circle text-success me-3 mt-1"></i>
                        <div>
                            <small class="text-muted d-block">Keterangan</small>
                            <strong>{{ $pasar->keterangan ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section (tidak dimodifikasi) -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Toko</h5>
            <a href="{{ route('admin.pasar.toko.create', $pasar->id) }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Nomor Toko</th>
                        <th>Nama Pemilik Toko</th>
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
        var route = "{{ route('admin.pasar.toko.index', $pasar) }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_toko',
                name: 'nama_toko',
            },
            {
                data: 'nomor_kios',
                name: 'nomor_kios',
            },
            {
                data: 'nama_pemilik_toko',
                name: 'nama_pemilik_toko',
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
            var idPasar = $(this).data('id-pasar');
            var idToko = $(this).data('id-toko');
            var route = "{{ route('admin.pasar.toko.destroy', ['pasar' => ':idPasar', 'toko' => ':idToko']) }}";
            route = route.replace(':idPasar', idPasar);
            route = route.replace(':idToko', idToko);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush