<?php
// tambah.php
session_start(); // Wajib ada biar tau siapa yang login
require 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $stmt = $pdo->prepare("INSERT INTO barang (nama_barang, kategori, stok, harga) VALUES (?, ?, ?, ?)");
    
    if($stmt->execute([$nama, $kategori, $stok, $harga])) {
        // === CATAT LOG AKTIVITAS ===
        $username = $_SESSION['username'] ?? 'System';
        $deskripsi = "Menambahkan barang baru: $nama";
        $log = $pdo->prepare("INSERT INTO log_aktivitas (username, aksi, deskripsi) VALUES (?, 'TAMBAH', ?)");
        $log->execute([$username, $deskripsi]);
        // ===========================

        echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan data.']);
    }
}
?>