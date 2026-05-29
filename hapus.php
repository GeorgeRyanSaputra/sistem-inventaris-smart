<?php
// hapus.php (Sekarang jadi Soft Delete)
session_start();
require 'config.php';
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        // Ubah is_deleted jadi 1, BUKAN menghapus data!
        $stmt = $pdo->prepare("UPDATE barang SET is_deleted = 1 WHERE id = ?");
        
        if($stmt->execute([$id])) {
            // === CATAT LOG AKTIVITAS ===
            $username = $_SESSION['username'] ?? 'System';
            $deskripsi = "Memindahkan barang ID $id ke Recycle Bin";
            $log = $pdo->prepare("INSERT INTO log_aktivitas (username, aksi, deskripsi) VALUES (?, 'HAPUS', ?)");
            $log->execute([$username, $deskripsi]);
            // ===========================

            echo json_encode(['status' => 'success', 'message' => 'Barang dipindahkan ke Recycle Bin!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memindahkan barang.']);
        }
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error Database: ' . $e->getMessage()]);
    }
    exit;
}
?>