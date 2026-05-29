<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Smart - Sistem Manajemen Aset Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .bg-hero {
            background: linear-gradient(135deg, #4f46e5 0%, #1e293b 100%);
            min-height: 85vh;
        }
        .text-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .feature-card {
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            border-color: #4f46e5;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1);
        }
        .navbar { z-index: 1000; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: #1e293b;">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="index.php"><i class="bi bi-box-seam-fill me-2"></i>Inventaris Smart</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex gap-2 mt-3 mt-lg-0">
                    <!-- SEMUA TOMBOL DI SINI PASTI KE LOGIN.PHP -->
                    <a href="login.php" class="btn btn-outline-light px-4 rounded-pill">Login</a>
                    <a href="login.php" class="btn btn-warning fw-bold px-4 rounded-pill text-dark">Coba Gratis</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="bg-hero text-white d-flex align-items-center">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">🔥 Level Industri 4.0</span>
                    <h1 class="display-4 fw-bold mb-3">Kelola Aset & Inventaris Tanpa Ribet.</h1>
                    <p class="lead opacity-75 mb-4">Sistem informasi digital yang aman, real-time, dan dilengkapi fitur profesional. Lindungi data asetmu dari kesalahan human error dengan teknologi Soft-Delete & Audit Trail.</p>
                    <!-- TOMBOL INI JUGA KE LOGIN.PHP -->
                    <a href="login.php" class="btn btn-warning btn-lg fw-bold px-5 rounded-pill text-dark me-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang
                    </a>
                    <a href="#fitur" class="btn btn-outline-light btn-lg px-4 rounded-pill">Pelajari Lebih</a>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body bg-white p-4">
                            <div class="d-flex gap-2 mb-3">
                                <span class="bg-danger rounded-circle" style="width:12px;height:12px;"></span>
                                <span class="bg-warning rounded-circle" style="width:12px;height:12px;"></span>
                                <span class="bg-success rounded-circle" style="width:12px;height:12px;"></span>
                            </div>
                            <div class="row g-2">
                                <div class="col-4"><div class="bg-primary bg-opacity-10 rounded-3 p-3 text-start"><small class="text-primary fw-bold">Jenis</small><h4 class="mb-0 text-dark">24</h4></div></div>
                                <div class="col-4"><div class="bg-success bg-opacity-10 rounded-3 p-3 text-start"><small class="text-success fw-bold">Stok</small><h4 class="mb-0 text-dark">150</h4></div></div>
                                <div class="col-4"><div class="bg-warning bg-opacity-10 rounded-3 p-3 text-start"><small class="text-warning fw-bold">Aset</small><h4 class="mb-0 text-dark">5M</h4></div></div>
                            </div>
                            <div class="mt-3 bg-light rounded-3 p-2">
                                <canvas id="mockupChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="fitur" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Kenapa Harus <span class="text-gradient">Inventaris Smart</span>?</h2>
                <p class="text-muted fs-5">Bukan sekadar CRUD biasa. Ini adalah standar sistem perusahaan modern.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 bg-white h-100">
                        <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-3 mb-3">
                            <i class="bi bi-shield-lock-fill text-primary fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Soft Delete (Recycle Bin)</h5>
                        <p class="text-muted">Salah hapus data? Tenang! Data tidak hilang permanen dan bisa dikembalikan (Restore) kapan saja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 bg-white h-100">
                        <div class="bg-success bg-opacity-10 d-inline-block p-3 rounded-3 mb-3">
                            <i class="bi bi-clock-history text-success fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Audit Trail (Riwayat)</h5>
                        <p class="text-muted">Lacak siapa yang menambah, mengubah, atau menghapus data. Transparansi penuh untuk manajemen!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 bg-white h-100">
                        <div class="bg-warning bg-opacity-10 d-inline-block p-3 rounded-3 mb-3">
                            <i class="bi bi-bar-chart-fill text-warning fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Dashboard Eksekutif</h5>
                        <p class="text-muted">Visualisasi data aset secara real-time dengan grafik interaktif dan laporan Export Excel instan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2024 Inventaris Smart - PWEB-1H. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('mockupChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    label: 'Aset Masuk',
                    data: [12, 19, 15, 25, 22],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true, tension: 0.4, borderWidth: 2
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } }
        });
    </script>
</body>
</html>