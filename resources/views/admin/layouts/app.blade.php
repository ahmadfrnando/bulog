<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css') }}">
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @routes
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-store"></i> Admin Panel</h4>
            <p>Sistem Manajemen Pasar</p>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.petugas.index') }}" class="{{ request()->is('admin/petugas*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Petugas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pasar.index') }}" class="{{ request()->is('admin/pasar*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Pasar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.penugasan-pasar.index') }}" class="{{ request()->is('admin/penugasan-pasar*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Penugasan Pasar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.komoditas.index') }}" class="{{ request()->is('admin/komoditas*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Komoditas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.submisi-harga.index') }}" class="{{ request()->is('admin/submisi-harga*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Submisi Harga</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="logoutUser()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5><i class="@yield('icon') me-2"></i>@yield('title')</h5>
            <div class="user-info">
                <span>Admin User</span>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"></script>
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>