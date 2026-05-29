<?php
// edit.php
session_start(); // Wajib ada biar tau siapa yang login
require 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $stmt = $pdo->prepare("UPDATE barang SET nama_barang = ?, kategori = ?, stok = ?, harga = ? WHERE id = ?");
    
    if($stmt->execute([$nama, $kategori, $stok, $harga, $id])) {
        // === CATAT LOG AKTIVITAS ===
        $username = $_SESSION['username'] ?? 'System';
        $deskripsi = "Mengedit barang: $nama";
        $log = $pdo->prepare("INSERT INTO log_aktivitas (username, aksi, deskripsi) VALUES (?, 'EDIT', ?)");
        $log->execute([$username, $deskripsi]);
        // ===========================

        echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data.']);
    }
}
?>