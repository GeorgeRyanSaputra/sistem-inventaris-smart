<?php
// hapus_permanen.php
session_start();
if(!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

require 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ini baru DELETE FROM beneran
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ? AND is_deleted = 1");
    if($stmt->execute([$id])) {
        $username = $_SESSION['username'] ?? 'System';
        $log = $pdo->prepare("INSERT INTO log_aktivitas (username, aksi, deskripsi) VALUES (?, 'HAPUS PERMANEN', ?)");
        $log->execute([$username, "Menghapus permanen barang ID $id dari database"]);
    }
}

header("Location: sampah.php");
exit;
?>