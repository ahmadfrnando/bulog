<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Petugas Lapangan SiPangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #2d5a3d;
            --light-green: #4a8c60;
            --soft-green: #e8f5e9;
            --accent-green: #66bb6a;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(45, 90, 61, 0.15);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        
        .login-left {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 500px;
        }
        
        .login-left .icon-wrapper {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        
        .login-left i {
            font-size: 60px;
        }
        
        .login-left h2 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .login-left .features {
            margin-top: 30px;
            text-align: left;
        }
        
        .login-left .features div {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }
        
        .login-left .features i {
            font-size: 24px;
            margin-right: 15px;
            width: 30px;
        }
        
        .login-right {
            padding: 60px 50px;
            background: white;
        }
        
        .login-right .brand {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-right .brand h3 {
            color: var(--primary-green);
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .login-right .brand p {
            color: var(--light-green);
            margin-bottom: 0;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.15);
        }
        
        .input-group-text {
            background: white;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--light-green);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--accent-green);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            color: white;
            border-radius: 10px;
            transition: all 0.3s;
            font-size: 16px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 90, 61, 0.3);
            color: white;
        }
        
        .form-check-input:checked {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
        }
        
        .forgot-link {
            color: var(--light-green);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .forgot-link:hover {
            color: var(--primary-green);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider span {
            padding: 0 15px;
            color: #999;
            font-size: 14px;
        }
        
        .info-box {
            background: var(--soft-green);
            border-left: 4px solid var(--accent-green);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .info-box strong {
            color: var(--primary-green);
        }
        
        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
            
            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
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
                
                <form id="loginForm">
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
                                class="form-control" 
                                placeholder="Masukkan username" 
                                required
                                autocomplete="username"
                            >
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
                                placeholder="Masukkan password" 
                                required
                                autocomplete="current-password"
                            >
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
        
        // Handle Form Submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const username = this.querySelector('input[type="text"]').value;
            const password = this.querySelector('input[type="password"]').value;
            
            // Simple validation (for demo)
            if (username === 'petugas01' && password === 'demo123') {
                alert('Login berhasil! Selamat datang, ' + username);
                // Redirect to dashboard or next page
                // window.location.href = 'dashboard.html';
            } else {
                alert('Username atau password salah!');
            }
        });
    </script>
</body>
</html>