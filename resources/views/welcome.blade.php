<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPangan - Monitoring Harga Pangan Strategis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: white !important;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            color: white;
            padding: 60px 0 40px;
            margin-top: 56px;
        }

        .search-bar {
            background: white;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .search-bar input {
            border: none;
            padding: 10px 20px;
        }

        .search-bar input:focus {
            outline: none;
            box-shadow: none;
        }

        .filter-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 5px solid var(--accent-green);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--light-green) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .price-change.up {
            color: #dc3545;
        }

        .price-change.down {
            color: #28a745;
        }

        .price-change.stable {
            color: #6c757d;
        }

        #map {
            height: 500px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--light-green) 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 90, 61, 0.4);
        }

        .carousel-item {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .carousel-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(45, 90, 61, 0.6);
        }

        .carousel-caption {
            z-index: 10;
        }

        .section-title {
            color: var(--primary-green);
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--accent-green);
            border-radius: 2px;
        }

        .footer {
            background: var(--primary-green);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }

        .badge-custom {
            background: var(--accent-green);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-basket me-2"></i>SiPangan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#monitoring">Monitoring</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#data">Data & Tren</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <section id="home" class="hero-section">
        <div class="container">
            <div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner rounded-4 shadow-lg">
                    <div class="carousel-item active" style="background-image: linear-gradient(135deg, rgba(45, 90, 61, 0.8), rgba(74, 140, 96, 0.8)), url('https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=1200');">
                        <div class="carousel-caption">
                            <h2 class="display-5 fw-bold">Monitoring Harga Pangan Real-Time</h2>
                            <p class="lead">Pantau harga bahan pokok strategis di seluruh Indonesia</p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: linear-gradient(135deg, rgba(45, 90, 61, 0.8), rgba(74, 140, 96, 0.8)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200');">
                        <div class="carousel-caption">
                            <h2 class="display-5 fw-bold">Data Akurat & Terpercaya</h2>
                            <p class="lead">Informasi harga dari berbagai pasar tradisional dan modern</p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: linear-gradient(135deg, rgba(45, 90, 61, 0.8), rgba(74, 140, 96, 0.8)), url('https://images.unsplash.com/photo-1516594915697-87eb3b1c14ea?w=1200');">
                        <div class="carousel-caption">
                            <h2 class="display-5 fw-bold">Analisis Tren Harga</h2>
                            <p class="lead">Grafik dan statistik untuk mendukung keputusan Anda</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <div class="container">
        <div class="filter-card">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold"><i class="fas fa-store me-2"></i>Pasar</label>
                    <select class="form-select" id="pasarSelect">
                        <option selected>Semua Pasar</option>
                        <option>Pasar Tradisional</option>
                        <option>Pasar Modern</option>
                    </select>
                </div>
                <div class="col-8">
                    <div class="search-bar">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari komoditas atau pasar...">
                            <button class="btn btn-primary-custom" type="button">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section id="monitoring" class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">
                <i class="fas fa-chart-line me-2"></i>Ringkasan Harga Nasional
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon me-3">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-0">Beras Premium</h6>
                                <h3 class="mb-0 fw-bold">Rp 14.500<small class="text-muted">/kg</small></h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-custom">Rata-rata Nasional</span>
                            <span class="price-change up">
                                <i class="fas fa-arrow-up"></i> +2.3%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon me-3">
                                <i class="fas fa-fill-drip"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-0">Minyak Goreng</h6>
                                <h3 class="mb-0 fw-bold">Rp 16.200<small class="text-muted">/ltr</small></h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-custom">Rata-rata Nasional</span>
                            <span class="price-change down">
                                <i class="fas fa-arrow-down"></i> -1.5%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon me-3">
                                <i class="fas fa-egg"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-0">Telur Ayam</h6>
                                <h3 class="mb-0 fw-bold">Rp 28.500<small class="text-muted">/kg</small></h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-custom">Rata-rata Nasional</span>
                            <span class="price-change stable">
                                <i class="fas fa-minus"></i> 0.0%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats Row -->
            <div class="row g-4 mt-2">
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <div class="stat-icon mx-auto mb-3">
                            <i class="fas fa-pepper-hot"></i>
                        </div>
                        <h6 class="text-muted">Cabai Merah</h6>
                        <h4 class="fw-bold">Rp 42.000</h4>
                        <span class="price-change up"><i class="fas fa-arrow-up"></i> +5.2%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <div class="stat-icon mx-auto mb-3">
                            <i class="fas fa-drumstick-bite"></i>
                        </div>
                        <h6 class="text-muted">Daging Ayam</h6>
                        <h4 class="fw-bold">Rp 38.500</h4>
                        <span class="price-change down"><i class="fas fa-arrow-down"></i> -0.8%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <div class="stat-icon mx-auto mb-3">
                            <i class="fas fa-drumstick-bite"></i>
                        </div>
                        <h6 class="text-muted">Daging Sapi</h6>
                        <h4 class="fw-bold">Rp 135.000</h4>
                        <span class="price-change stable"><i class="fas fa-minus"></i> 0.0%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <div class="stat-icon mx-auto mb-3">
                            <i class="fas fa-apple-alt"></i>
                        </div>
                        <h6 class="text-muted">Bawang Merah</h6>
                        <h4 class="fw-bold">Rp 38.200</h4>
                        <span class="price-change up"><i class="fas fa-arrow-up"></i> +3.1%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-map-marked-alt me-2"></i>Peta Interaktif Harga Pasar
            </h2>
            <p class="text-muted mb-4">Klik marker pada peta untuk melihat detail harga di setiap pasar</p>
            <div id="map"></div>
        </div>
    </section>

    <!-- Chart Section -->
    <section id="data" class="py-5">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-chart-area me-2"></i>Tren Harga Komoditas
            </h2>
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="chart-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Grafik Pergerakan Harga</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-success active">7 Hari</button>
                                <button type="button" class="btn btn-sm btn-outline-success">30 Hari</button>
                                <button type="button" class="btn btn-sm btn-outline-success">90 Hari</button>
                            </div>
                        </div>
                        <canvas id="priceChart" height="80"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <h5 class="fw-bold mb-4">Komoditas Termonitor</h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-circle text-success me-2"></i>Beras</span>
                                <span class="badge bg-success">Stabil</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-circle text-warning me-2"></i>Minyak Goreng</span>
                                <span class="badge bg-warning">Fluktuatif</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-circle text-danger me-2"></i>Cabai</span>
                                <span class="badge bg-danger">Naik</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-circle text-success me-2"></i>Telur</span>
                                <span class="badge bg-success">Stabil</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-circle text-info me-2"></i>Gula</span>
                                <span class="badge bg-info">Turun</span>
                            </div>
                        </div>
                        <button class="btn btn-primary-custom w-100 mt-3">
                            <i class="fas fa-table me-2"></i>Lihat Data Lengkap
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Table Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">
                <i class="fas fa-table me-2"></i>Tabel Harga Lengkap
            </h2>
            <div class="chart-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>Komoditas</th>
                                <th>Satuan</th>
                                <th>Harga Hari Ini</th>
                                <th>Kemarin</th>
                                <th>Perubahan</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fas fa-seedling text-success me-2"></i>Beras Premium</td>
                                <td>Kg</td>
                                <td class="fw-bold">Rp 14.500</td>
                                <td>Rp 14.200</td>
                                <td><span class="price-change up">+2.1%</span></td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-fill-drip text-warning me-2"></i>Minyak Goreng</td>
                                <td>Liter</td>
                                <td class="fw-bold">Rp 16.200</td>
                                <td>Rp 16.500</td>
                                <td><span class="price-change down">-1.8%</span></td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-egg text-info me-2"></i>Telur Ayam</td>
                                <td>Kg</td>
                                <td class="fw-bold">Rp 28.500</td>
                                <td>Rp 28.500</td>
                                <td><span class="price-change stable">0.0%</span></td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-pepper-hot text-danger me-2"></i>Cabai Merah</td>
                                <td>Kg</td>
                                <td class="fw-bold">Rp 42.000</td>
                                <td>Rp 40.000</td>
                                <td><span class="price-change up">+5.0%</span></td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-drumstick-bite text-primary me-2"></i>Daging Ayam</td>
                                <td>Kg</td>
                                <td class="fw-bold">Rp 38.500</td>
                                <td>Rp 38.800</td>
                                <td><span class="price-change down">-0.8%</span></td>
                                <td>Jakarta</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-download me-2"></i>Download Data Lengkap (Excel/PDF)
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="section-title">Tentang SiPangan</h2>
                    <p class="lead">Sistem Informasi Monitoring Harga Pangan Strategis</p>
                    <p>SiPangan adalah platform monitoring harga pangan yang menyediakan informasi real-time tentang harga berbagai komoditas strategis di seluruh Indonesia. Kami berkomitmen untuk memberikan data akurat dan terpercaya untuk mendukung transparansi harga dan kebijakan pangan nasional.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Data harga real-time dari berbagai pasar</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Analisis tren dan statistik lengkap</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Peta interaktif lokasi pasar</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Akses data publik gratis</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=600" alt="About" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. Contoh No. 123, Jakarta</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+62 21 1234 5678</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@sipangan.go.id</li>
                        <li class="mb-2"><i class="fas fa-clock me-2"></i>Senin - Jumat: 08:00 - 17:00</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SiPangan - Sistem Informasi Harga Pangan. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Map
        const map = L.map('map').setView([-6.2088, 106.8456], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Market data with prices
        const markets = [{
                name: 'Pasar Tanah Abang',
                lat: -6.1857,
                lng: 106.8133,
                prices: {
                    beras: {
                        price: 14500,
                        change: 2.3
                    },
                    minyak: {
                        price: 16200,
                        change: -1.5
                    },
                    telur: {
                        price: 28500,
                        change: 0
                    }
                }
            },
            {
                name: 'Pasar Senen',
                lat: -6.1753,
                lng: 106.8406,
                prices: {
                    beras: {
                        price: 14200,
                        change: 1.8
                    },
                    minyak: {
                        price: 16500,
                        change: -0.8
                    },
                    telur: {
                        price: 28000,
                        change: -1.2
                    }
                }
            },
            {
                name: 'Pasar Minggu',
                lat: -6.2897,
                lng: 106.8451,
                prices: {
                    beras: {
                        price: 14800,
                        change: 3.1
                    },
                    minyak: {
                        price: 16000,
                        change: -2.2
                    },
                    telur: {
                        price: 29000,
                        change: 1.5
                    }
                }
            },
            {
                name: 'Pasar Jatinegara',
                lat: -6.2153,
                lng: 106.8706,
                prices: {
                    beras: {
                        price: 14300,
                        change: 1.5
                    },
                    minyak: {
                        price: 16300,
                        change: -1.0
                    },
                    telur: {
                        price: 28200,
                        change: -0.5
                    }
                }
            },
            {
                name: 'Pasar Blok M',
                lat: -6.2443,
                lng: 106.7993,
                prices: {
                    beras: {
                        price: 15000,
                        change: 4.2
                    },
                    minyak: {
                        price: 16800,
                        change: 0.5
                    },
                    telur: {
                        price: 29500,
                        change: 2.1
                    }
                }
            }
        ];

        // Custom green marker icon
        const greenIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Add markers with popup
        markets.forEach(market => {
            const changeIcon = (change) => {
                if (change > 0) return '<i class="fas fa-arrow-up"></i>';
                if (change < 0) return '<i class="fas fa-arrow-down"></i>';
                return '<i class="fas fa-minus"></i>';
            };

            const changeClass = (change) => {
                if (change > 0) return 'up';
                if (change < 0) return 'down';
                return 'stable';
            };

            const popupContent = `
                <div style="min-width: 250px;">
                    <h6 class="fw-bold mb-3" style="color: #2d5a3d;">
                        <i class="fas fa-store me-2"></i>${market.name}
                    </h6>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-seedling me-2" style="color: #4a8c60;"></i>Beras Premium</span>
                            <strong>Rp ${market.prices.beras.price.toLocaleString()}</strong>
                        </div>
                        <small class="price-change ${changeClass(market.prices.beras.change)}">
                            ${changeIcon(market.prices.beras.change)} ${Math.abs(market.prices.beras.change)}%
                        </small>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-fill-drip me-2" style="color: #4a8c60;"></i>Minyak Goreng</span>
                            <strong>Rp ${market.prices.minyak.price.toLocaleString()}</strong>
                        </div>
                        <small class="price-change ${changeClass(market.prices.minyak.change)}">
                            ${changeIcon(market.prices.minyak.change)} ${Math.abs(market.prices.minyak.change)}%
                        </small>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-egg me-2" style="color: #4a8c60;"></i>Telur Ayam</span>
                            <strong>Rp ${market.prices.telur.price.toLocaleString()}</strong>
                        </div>
                        <small class="price-change ${changeClass(market.prices.telur.change)}">
                            ${changeIcon(market.prices.telur.change)} ${Math.abs(market.prices.telur.change)}%
                        </small>
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted">Data per ${new Date().toLocaleDateString('id-ID')}</small>
                    </div>
                </div>
            `;

            L.marker([market.lat, market.lng], {
                    icon: greenIcon
                })
                .addTo(map)
                .bindPopup(popupContent);
        });

        // Initialize Chart
        const ctx = document.getElementById('priceChart').getContext('2d');
        const priceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Hari 1', 'Hari 2', 'Hari 3', 'Hari 4', 'Hari 5', 'Hari 6', 'Hari 7'],
                datasets: [{
                        label: 'Beras Premium',
                        data: [14200, 14300, 14100, 14400, 14350, 14450, 14500],
                        borderColor: '#2d5a3d',
                        backgroundColor: 'rgba(45, 90, 61, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Minyak Goreng',
                        data: [16800, 16700, 16600, 16500, 16400, 16300, 16200],
                        borderColor: '#66bb6a',
                        backgroundColor: 'rgba(102, 187, 106, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Telur Ayam',
                        data: [28300, 28400, 28500, 28450, 28500, 28550, 28500],
                        borderColor: '#4a8c60',
                        backgroundColor: 'rgba(74, 140, 96, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active nav link on scroll
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = document.querySelectorAll('section[id]');

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>