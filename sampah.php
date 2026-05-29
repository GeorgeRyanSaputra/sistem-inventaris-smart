<?php
// sampah.php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

 $stmt = $pdo->query("SELECT * FROM barang WHERE is_deleted = 1 ORDER BY id DESC");
 $barangs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Recycle Bin - Inventaris Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .table-premium thead th { background-color: #1e293b; color: #f1f5f9; border-bottom: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-4 shadow-sm">
        <h3 class="fw-bold mb-0 text-secondary"><i class="bi bi-recycle"></i> Recycle Bin (Sampah)</h3>
        <!-- INI YANG DIPERBAIKI: href diganti ke dashboard.php -->
        <a href="dashboard.php" class="btn btn-outline-primary rounded-pill px-4"><i class="bi bi-arrow-left"></i> Kembali ke Inventaris</a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-premium">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($barangs as $b): ?>
                        <tr>
                            <td class="ps-4 fw-medium"><?= $no++; ?></td>
                            <td class="fw-semibold text-muted"><?= htmlspecialchars($b['nama_barang']); ?></td>
                            <td><span class="badge rounded-pill bg-light text-dark border"><?= $b['kategori']; ?></span></td>
                            <td class="text-muted"><?= $b['stok']; ?></td>
                            <td class="text-muted">Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="restore.php?id=<?= $b['id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Kembalikan barang ini?')"><i class="bi bi-arrow-counterclockwise"></i> Restore</a>
                                <a href="hapus_permanen.php?id=<?= $b['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('HATI-HATI! Data akan hilang selamanya. Lanjutkan?')"><i class="bi bi-x-circle"></i> Hapus Permanen</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($barangs)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-emoji-smile fs-3 d-block mb-2"></i>Tong sampah kosong.</td></tr>
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