<?php
// config.php
 $host = 'localhost';
 $dbname = 'db_inventaris';
 $user = 'root';
 $pass = ''; // Default XAMPP kosong

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Set mode error ke Exception (Biar tau kalau ada salah query)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
?>