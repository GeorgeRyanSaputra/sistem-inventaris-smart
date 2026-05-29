<?php
// restore.php
session_start();
if(!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

require 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ubah is_deleted jadi 0 lagi
    $stmt = $pdo->prepare("UPDATE barang SET is_deleted = 0 WHERE id = ?");
    if($stmt->execute([$id])) {
        // Catat log
        $username = $_SESSION['username'] ?? 'System';
        $log = $pdo->prepare("INSERT INTO log_aktivitas (username, aksi, deskripsi) VALUES (?, 'RESTORE', ?)");
        $log->execute([$username, "Mengembalikan barang ID $id dari Recycle Bin"]);
    }
}

header("Location: sampah.php");
exit;
?>