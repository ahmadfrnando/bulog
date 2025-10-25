<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Petugas Lapangan SiPangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/auth/styles.css') }}">
</head>

<body>
    <div class="login-card">
        <div class="row g-0">
            <!-- Left Side - Illustration -->
            <div class="col-md-5 login-left">
                <div class="icon-wrapper">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h2>Portal Petugas Lapangan</h2>
                <p class="lead">Sistem Informasi Monitoring<br>Harga Pangan Strategis</p>

                <div class="features w-100">
                    <div>
                        <i class="fas fa-clock"></i>
                        <span>Input Data Real-Time</span>
                    </div>
                    <div>
                        <i class="fas fa-chart-line"></i>
                        <span>Monitoring Harga Akurat</span>
                    </div>
                    <div>
                        <i class="fas fa-check-circle"></i>
                        <span>Laporan Tervalidasi</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-md-7 login-right">
                <div class="brand">
                    <h3><i class="fas fa-shopping-basket me-2"></i>SiPangan</h3>
                    <p>Login untuk melanjutkan</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                required
                                autocomplete="username"
                                autofocus
                                value="{{ old('username') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                class="form-control"
                                id="passwordInput"
                                name="password"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password">
                            <span class="input-group-text" style="cursor: pointer; border-left: none; border-radius: 0 10px 10px 0;" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>

                <div class="text-center">
                    <small class="text-muted">
                        Hubungi admin jika mengalami kesulitan login
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('swal'))
    <script>
        Swal.fire(@json(session('swal')));
    </script>
    @endif
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>