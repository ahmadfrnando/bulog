@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('icon', 'fas fa-home')

@section('content')
<div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="stats-card green">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>48</h3>
                <p>Total Petugas</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card light-green">
                <div class="icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <h3>12</h3>
                <p>Total Pasar</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card accent">
                <div class="icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3>35</h3>
                <p>Penugasan Aktif</p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-list me-2"></i>Data Penugasan Terbaru</h5>
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Pasar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ahmad Fadli</td>
                        <td>Pasar Sentral</td>
                        <td>22 Okt 2025</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Aminah</td>
                        <td>Pasar Induk</td>
                        <td>22 Okt 2025</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Budi Santoso</td>
                        <td>Pasar Pagi</td>
                        <td>22 Okt 2025</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection