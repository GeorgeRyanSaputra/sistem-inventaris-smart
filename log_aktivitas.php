<?php
// log_aktivitas.php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

 $stmt = $pdo->query("SELECT * FROM log_aktivitas ORDER BY waktu DESC");
 $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Aktivitas - Inventaris Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .table-premium thead th { background-color: #1e293b; color: #f1f5f9; border-bottom: none; font-weight: 600; letter-spacing: 0.5px; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-4 shadow-sm">
        <h3 class="fw-bold mb-0" style="color: #4f46e5;"><i class="bi bi-clock-history"></i> Riwayat Aktivitas</h3>
        <div class="d-flex align-items-center gap-3">
            <!-- INI YANG DIPERBAIKI: href diganti ke dashboard.php -->
            <a href="dashboard.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-arrow-left"></i> Kembali ke Inventaris</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <!-- TABEL LOG -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-premium">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($logs as $log): ?>
                        <tr>
                            <td class="ps-4 fw-medium"><?= $no++; ?></td>
                            <td class="text-muted" style="min-width: 180px;"><?= date('d M Y, H:i:s', strtotime($log['waktu'])); ?> WIB</td>
                            <td>
                                <span class="fw-bold text-dark"><i class="bi bi-person-fill"></i> <?= htmlspecialchars($log['username']); ?></span>
                            </td>
                            <td>
                                <?php 
                                    $aksi = $log['aksi'];
                                    $badge_class = 'bg-secondary';
                                    if($aksi == 'TAMBAH') $badge_class = 'bg-success';
                                    if($aksi == 'EDIT') $badge_class = 'bg-warning text-dark';
                                    if($aksi == 'HAPUS') $badge_class = 'bg-danger';
                                    if($aksi == 'RESTORE') $badge_class = 'bg-info text-dark';
                                ?>
                                <span class="badge rounded-pill <?= $badge_class; ?> px-3 py-2" style="font-size: 0.8rem;"><?= $aksi; ?></span>
                            </td>
                            <td><?= htmlspecialchars($log['deskripsi']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($logs)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-5">Belum ada aktivitas tercatat.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>