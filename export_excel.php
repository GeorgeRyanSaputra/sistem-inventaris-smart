<?php
// export_excel.php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

// Ambil data barang
 $stmt = $pdo->query("SELECT * FROM barang ORDER BY id DESC");
 $barangs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set header supaya browser mendownload file sebagai Excel (.xls)
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Inventaris_".date('d-m-Y').".xls");

// Buat tabel HTML yang akan dibaca sebagai Excel
echo "<h2>Laporan Inventaris Smart - ".date('d F Y')."</h2>";
echo "<p>Dicetak oleh: ".htmlspecialchars($_SESSION['username'])."</p>";
echo "<table border='1'>";
echo "<tr style='background-color: #1e293b; color: white; font-weight: bold;'>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Total Nilai</th>
      </tr>";

 $no = 1;
 $grandTotal = 0;

foreach($barangs as $b) {
    $totalNilai = $b['stok'] * $b['harga'];
    $grandTotal += $totalNilai;
    echo "<tr>
            <td>".$no++."</td>
            <td>".htmlspecialchars($b['nama_barang'])."</td>
            <td>".$b['kategori']."</td>
            <td>".$b['stok']."</td>
            <td>Rp ".number_format($b['harga'], 0, ',', '.')."</td>
            <td>Rp ".number_format($totalNilai, 0, ',', '.')."</td>
          </tr>";
}

echo "<tr style='font-weight: bold; background-color: #f8fafc;'>
        <td colspan='5' style='text-align: right;'>GRAND TOTAL ASET</td>
        <td>Rp ".number_format($grandTotal, 0, ',', '.')."</td>
      </tr>";

echo "</table>";
?>