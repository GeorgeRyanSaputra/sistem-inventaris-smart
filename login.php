<?php
// login.php
session_start();

// Kalau dia udah login, langsung lempar ke dashboard
if(isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Inventaris Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-login { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .form-section { background-color: #f0f2f5; }
        .input-group {
            background: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden; border: 1px solid #e9ecef; transition: all 0.3s ease;
        }
        .input-group:focus-within { border-color: #6610f2; box-shadow: 0 4px 12px rgba(102, 16, 242, 0.15); }
        .input-group .form-control, .input-group .input-group-text { border: None; background: transparent; }
        .input-group .form-control:focus { box-shadow: none; }
        .btn-login {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); border: none;
            font-weight: 600; letter-spacing: 0.5px; border-radius: 10px; padding: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #520dc2 100%);
            transform: translateY(-2px); box-shadow: 0 6px 15px rgba(102, 16, 242, 0.3);
        }
    </style>
</head>
<body>

<div class="row vh-100 m-0">
    <div class="col-md-6 bg-login d-none d-md-flex flex-column justify-content-center align-items-center text-white p-5">
        <i class="bi bi-box-seam-fill display-1 mb-4" style="text-shadow: 0 4px 10px rgba(0,0,0,0.2);"></i>
        <h1 class="fw-bold text-center display-5">Inventaris Smart</h1>
        <p class="text-center opacity-75 fs-5 mt-2">Sistem Manajemen Aset & Inventaris Digital Terpadu</p>
        <div class="mt-5 d-flex gap-4 opacity-75">
            <i class="bi bi-shield-lock-fill fs-4"></i>
            <i class="bi bi-speedometer2 fs-4"></i>
            <i class="bi bi-cloud-arrow-up-fill fs-4"></i>
        </div>
    </div>

    <div class="col-md-6 d-flex justify-content-center align-items-center form-section p-5">
        <div class="w-100" style="max-width: 380px;">
            <div class="text-center mb-4 d-md-none">
                <i class="bi bi-box-seam-fill text-primary display-4"></i>
                <h3 class="fw-bold mt-2">Inventaris Smart</h3>
            </div>

            <h3 class="fw-bold text-dark mb-1">Selamat Datang!</h3>
            <p class="text-muted mb-4">Silakan masuk untuk mengakses sistem.</p>

            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger d-flex align-items-center border-0 rounded-3" role="alert" style="background-color: #fff0f0;">
                    <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
                    <div>Username atau Password salah!</div>
                </div>
            <?php endif; ?>

            <form action="auth_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-bold mb-2">USERNAME</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="username" class="form-control py-2" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold mb-2">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" class="form-control py-2" placeholder="Masukkan password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login w-100 fs-6 text-white">
                    <i class="bi bi-box-arrow-in-right me-2"></i> LOGIN
                </button>
            </form>

            <p class="text-center text-muted mt-5" style="font-size: 12px;">&copy; 2026 Inventaris Smart - PWEB-1H</p>
        </div>
    </div>
</div>

</body>
</html>
