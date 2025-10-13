<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Harian - SiPangan</title>
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
            background: linear-gradient(135deg, #f5f5f5 0%, #e8f5e9 100%);
            min-height: 100vh;
            padding-top: 76px;
        }
        
        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            padding: 8px 20px !important;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white !important;
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white !important;
        }
        
        .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.5);
            padding: 8px 12px;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .user-info {
            display: flex;
            align-items: center;
            color: white;
            padding: 8px 15px;
            background: rgba(255,255,255,0.1);
            border-radius: 25px;
            margin-left: 15px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
            font-weight: bold;
            margin-right: 10px;
        }
        
        /* Content Styles */
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 15px;
        }
        
        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .page-header h4 {
            color: var(--primary-green);
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .page-header p {
            color: #666;
            margin: 0;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .form-section-title {
            color: var(--primary-green);
            font-weight: bold;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--soft-green);
            display: flex;
            align-items: center;
        }
        
        .form-section-title i {
            margin-right: 10px;
            font-size: 24px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 8px;
        }
        
        .required-star {
            color: #dc3545;
            margin-left: 3px;
        }
        
        .form-control,
        .form-select {
            padding: 12px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.15);
        }
        
        .input-group-text {
            background: var(--soft-green);
            border: 2px solid #e0e0e0;
            border-right: none;
            color: var(--primary-green);
            font-weight: 600;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--accent-green);
        }
        
        /* Photo Upload Styles */
        .photo-upload-area {
            border: 3px dashed var(--accent-green);
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: var(--soft-green);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .photo-upload-area:hover {
            background: #d4edd6;
            border-color: var(--primary-green);
        }
        
        .photo-upload-area i {
            font-size: 48px;
            color: var(--accent-green);
            margin-bottom: 15px;
        }
        
        .photo-upload-area p {
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .photo-upload-area small {
            color: #666;
        }
        
        .photo-preview {
            display: none;
            position: relative;
            margin-top: 20px;
        }
        
        .photo-preview img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .remove-photo {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .remove-photo:hover {
            background: #c82333;
            transform: scale(1.1);
        }
        
        /* Button Styles */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            border: none;
            padding: 14px 35px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 16px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 90, 61, 0.3);
            color: white;
        }
        
        .btn-secondary-custom {
            background: white;
            border: 2px solid var(--accent-green);
            padding: 14px 35px;
            border-radius: 10px;
            color: var(--primary-green);
            font-weight: 600;
            transition: all 0.3s;
            font-size: 16px;
        }
        
        .btn-secondary-custom:hover {
            background: var(--soft-green);
            border-color: var(--primary-green);
            color: var(--primary-green);
        }
        
        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }
        
        .alert-info-custom {
            background: #e3f2fd;
            color: #1976d2;
            border-left: 4px solid #1976d2;
        }
        
        /* Dropdown Icon */
        .dropdown-toggle::after {
            margin-left: 8px;
        }
        
        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: none;
            padding: 10px 0;
        }
        
        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s;
        }
        
        .dropdown-item:hover {
            background: var(--soft-green);
            color: var(--primary-green);
        }
        
        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-card {
                padding: 25px 20px;
            }
            
            .page-header {
                padding: 20px;
            }
            
            .user-info span {
                display: none;
            }
            
            .user-info {
                padding: 8px;
                margin-left: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-basket"></i>
                SiPangan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-plus-circle me-2"></i>Input Data
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-history me-2"></i>Riwayat
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            <span class="d-none d-lg-inline">Ahmad Zulfikar</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-key"></i>Ubah Password
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="signOut()">
                                    <i class="fas fa-sign-out-alt"></i>Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4><i class="fas fa-calendar-day me-2"></i>Input Data Harian</h4>
                    <p><i class="fas fa-clock me-2"></i>Tanggal: <strong id="currentDate"></strong></p>
                </div>
                <div class="d-none d-md-block">
                    <span class="badge bg-success fs-6 px-3 py-2">
                        <i class="fas fa-check-circle me-2"></i>Status: Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info-custom alert-custom">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Petunjuk:</strong> Pastikan data yang diinput sudah sesuai dengan kondisi pasar saat ini. Data akan diverifikasi oleh admin sebelum dipublikasikan.
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <h5 class="form-section-title">
                <i class="fas fa-edit"></i>
                Form Input Harga Komoditas
            </h5>

            <form id="inputForm">
                <div class="row g-4">
                    <!-- Pilih Pasar -->
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="fas fa-store me-2"></i>Pilih Pasar
                            <span class="required-star">*</span>
                        </label>
                        <select class="form-select" required>
                            <option value="">-- Pilih Pasar --</option>
                            <option value="tanah-abang">Pasar Tanah Abang</option>
                            <option value="senen">Pasar Senen</option>
                            <option value="minggu">Pasar Minggu</option>
                            <option value="jatinegara">Pasar Jatinegara</option>
                            <option value="blok-m">Pasar Blok M</option>
                            <option value="cikini">Pasar Cikini</option>
                            <option value="mayestik">Pasar Mayestik</option>
                        </select>
                    </div>

                    <!-- Pilih Komoditas -->
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="fas fa-box me-2"></i>Pilih Komoditas
                            <span class="required-star">*</span>
                        </label>
                        <select class="form-select" required>
                            <option value="">-- Pilih Komoditas --</option>
                            <optgroup label="Beras">
                                <option value="beras-premium">Beras Premium</option>
                                <option value="beras-medium">Beras Medium</option>
                                <option value="beras-ekonomi">Beras Ekonomi</option>
                            </optgroup>
                            <optgroup label="Minyak & Telur">
                                <option value="minyak-goreng">Minyak Goreng</option>
                                <option value="telur-ayam">Telur Ayam</option>
                            </optgroup>
                            <optgroup label="Daging">
                                <option value="daging-ayam">Daging Ayam</option>
                                <option value="daging-sapi">Daging Sapi</option>
                            </optgroup>
                            <optgroup label="Sayuran">
                                <option value="cabai-merah">Cabai Merah</option>
                                <option value="cabai-rawit">Cabai Rawit</option>
                                <option value="bawang-merah">Bawang Merah</option>
                                <option value="bawang-putih">Bawang Putih</option>
                                <option value="tomat">Tomat</option>
                            </optgroup>
                            <optgroup label="Lainnya">
                                <option value="gula-pasir">Gula Pasir</option>
                                <option value="garam">Garam</option>
                                <option value="tepung-terigu">Tepung Terigu</option>
                            </optgroup>
                        </select>
                    </div>

                    <!-- Harga Satuan -->
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="fas fa-money-bill-wave me-2"></i>Harga Satuan
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="number" 
                                class="form-control" 
                                placeholder="Contoh: 14500" 
                                min="0"
                                step="100"
                                required
                            >
                        </div>
                        <small class="text-muted">Masukkan harga dalam Rupiah (tanpa titik atau koma)</small>
                    </div>

                    <!-- Satuan -->
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="fas fa-weight me-2"></i>Satuan
                            <span class="required-star">*</span>
                        </label>
                        <select class="form-select" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="kg">Kilogram (Kg)</option>
                            <option value="liter">Liter</option>
                            <option value="ons">Ons</option>
                            <option value="buah">Buah</option>
                            <option value="ikat">Ikat</option>
                            <option value="pack">Pack</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="col-12">
                        <label class="form-label">
                            <i class="fas fa-comment-alt me-2"></i>Catatan
                            <span class="text-muted">(Opsional)</span>
                        </label>
                        <textarea 
                            class="form-control" 
                            rows="4" 
                            placeholder="Tambahkan catatan tambahan seperti kondisi stok, kualitas barang, atau informasi penting lainnya..."
                        ></textarea>
                    </div>

                    <!-- Foto Bukti -->
                    <div class="col-12">
                        <label class="form-label">
                            <i class="fas fa-camera me-2"></i>Foto Bukti
                            <span class="text-muted">(Opsional)</span>
                        </label>
                        <div class="photo-upload-area" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik atau seret foto ke sini</p>
                            <small>Format: JPG, PNG, JPEG (Maksimal 5MB)</small>
                        </div>
                        <input 
                            type="file" 
                            id="photoInput" 
                            accept="image/jpeg,image/png,image/jpg" 
                            style="display: none;"
                        >
                        <div class="photo-preview" id="photoPreview">
                            <img id="previewImage" src="" alt="Preview">
                            <button type="button" class="remove-photo" onclick="removePhoto()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-12">
                        <hr class="my-4">
                        <div class="d-flex gap-3 flex-wrap">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                            <button type="reset" class="btn btn-secondary-custom">
                                <i class="fas fa-redo me-2"></i>Reset Form
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Lama</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Baru</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-check me-2"></i>Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current date
        function updateDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const date = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('currentDate').textContent = date;
        }
        updateDate();

        // Photo Upload Handler
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    this.value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image/(jpeg|jpg|png)')) {
                    alert('Format file tidak valid! Gunakan JPG, JPEG, atau PNG.');
                    this.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('photoPreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove Photo
        function removePhoto() {
            document.getElementById('photoInput').value = '';
            document.getElementById('photoPreview').style.display = 'none';
            document.getElementById('previewImage').src = '';
        }

        // Form Submit Handler
        document.getElementById('inputForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show';
            alertDiv.style.borderRadius = '10px';
            alertDiv.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                <strong>Berhasil!</strong> Data harga telah berhasil disimpan dan menunggu validasi admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            this.insertBefore(alertDiv, this.firstChild);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Reset form after 2 seconds
            setTimeout(() => {
                this.reset();
                removePhoto();
                alertDiv.remove();
            }, 3000);
        });

        // Reset Form Handler
        document.getElementById('inputForm').addEventListener('reset', function() {
            removePhoto();
        });

        // Change Password Form Handler
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPass = this.querySelectorAll('input[type="password"]')[1].value;
            const confirmPass = this.querySelectorAll('input[type="password"]')[2].value;
            
            if (newPass !== confirmPass) {
                alert('Password baru dan konfirmasi password tidak cocok!');
                return;
            }
            
            alert('Password berhasil diubah!');
            bootstrap.Modal.getInstance(document.getElementById('changePasswordModal')).hide();
            this.reset();
        });

        // Sign Out Function
        function signOut() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                alert('Anda telah berhasil logout.');
                // Redirect to login page
                // window.location.href = 'login.html';
            }
        }

        // Auto-close navbar on mobile after click
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    const navbarToggler = document.querySelector('.navbar-toggler');
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                }
            });
        });
    </script>
</body>
</html>