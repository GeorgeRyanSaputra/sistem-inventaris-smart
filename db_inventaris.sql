-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 06:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `kategori`, `stok`, `harga`, `created_at`, `is_deleted`) VALUES
(28, 'kursi', 'Furnitur', 5, 10000.00, '2026-05-29 13:25:30', 0),
(29, 'penghapus', 'ATK', 2, 15000.00, '2026-05-29 13:26:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `aksi` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `username`, `aksi`, `deskripsi`, `waktu`) VALUES
(1, 'admin', 'HAPUS', 'Menghapus barang: Mouse Logitech', '2026-05-28 18:21:09'),
(2, 'admin', 'TAMBAH', 'Menambahkan barang baru: Mouse Logitech', '2026-05-28 18:25:02'),
(3, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-28 18:25:39'),
(4, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-28 18:27:29'),
(5, 'admin', 'TAMBAH', 'Menambahkan barang baru: pulpen', '2026-05-28 18:27:53'),
(6, 'admin', 'TAMBAH', 'Menambahkan barang baru: penghapus', '2026-05-28 18:28:23'),
(7, 'admin', 'TAMBAH', 'Menambahkan barang baru: mouse', '2026-05-28 18:29:00'),
(8, 'admin', 'HAPUS', 'Menghapus barang: mouse', '2026-05-28 18:29:13'),
(9, 'admin', 'HAPUS', 'Menghapus barang: penghapus', '2026-05-28 18:29:17'),
(10, 'admin', 'HAPUS', 'Menghapus barang: pulpen', '2026-05-28 18:29:21'),
(11, 'admin', 'HAPUS', 'Menghapus barang: pensil', '2026-05-28 18:29:25'),
(12, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-28 19:01:51'),
(13, 'admin', 'HAPUS', 'Memindahkan barang ID 12 ke Recycle Bin', '2026-05-28 19:02:00'),
(14, 'admin', 'RESTORE', 'Mengembalikan barang ID 12 dari Recycle Bin', '2026-05-28 19:02:10'),
(15, 'admin', 'HAPUS', 'Memindahkan barang ID 12 ke Recycle Bin', '2026-05-28 19:02:19'),
(16, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 12 dari database', '2026-05-28 19:03:01'),
(17, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-28 19:05:09'),
(18, 'admin', 'TAMBAH', 'Menambahkan barang baru: radio', '2026-05-28 19:05:25'),
(19, 'admin', 'TAMBAH', 'Menambahkan barang baru: meja', '2026-05-28 19:05:43'),
(20, 'admin', 'HAPUS', 'Memindahkan barang ID 15 ke Recycle Bin', '2026-05-28 19:05:49'),
(21, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 15 dari database', '2026-05-28 19:05:58'),
(22, 'admin', 'HAPUS', 'Memindahkan barang ID 14 ke Recycle Bin', '2026-05-28 19:06:56'),
(23, 'admin', 'HAPUS', 'Memindahkan barang ID 13 ke Recycle Bin', '2026-05-28 19:07:00'),
(24, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-28 19:08:56'),
(25, 'admin', 'TAMBAH', 'Menambahkan barang baru: es teh', '2026-05-29 03:32:37'),
(26, 'admin', 'HAPUS', 'Memindahkan barang ID 17 ke Recycle Bin', '2026-05-29 03:33:24'),
(27, 'admin', 'TAMBAH', 'Menambahkan barang baru: laser tompel', '2026-05-29 03:34:27'),
(28, 'admin', 'HAPUS', 'Memindahkan barang ID 16 ke Recycle Bin', '2026-05-29 03:34:36'),
(29, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 17 dari database', '2026-05-29 06:47:48'),
(30, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 16 dari database', '2026-05-29 06:47:51'),
(31, 'admin', 'RESTORE', 'Mengembalikan barang ID 14 dari Recycle Bin', '2026-05-29 06:47:54'),
(32, 'admin', 'HAPUS', 'Memindahkan barang ID 18 ke Recycle Bin', '2026-05-29 07:40:30'),
(33, 'admin', 'TAMBAH', 'Menambahkan barang baru: penggaris', '2026-05-29 07:45:31'),
(34, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 18 dari database', '2026-05-29 07:45:59'),
(35, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 13 dari database', '2026-05-29 07:46:01'),
(36, 'admin', 'HAPUS', 'Memindahkan barang ID 19 ke Recycle Bin', '2026-05-29 07:46:42'),
(37, 'admin', 'HAPUS', 'Memindahkan barang ID 14 ke Recycle Bin', '2026-05-29 07:46:46'),
(38, 'admin', 'TAMBAH', 'Menambahkan barang baru: penggaris', '2026-05-29 07:47:03'),
(39, 'admin', 'TAMBAH', 'Menambahkan barang baru: meja', '2026-05-29 07:47:39'),
(40, 'admin', 'TAMBAH', 'Menambahkan barang baru: radio', '2026-05-29 08:49:34'),
(41, 'admin', 'HAPUS', 'Memindahkan barang ID 22 ke Recycle Bin', '2026-05-29 08:54:45'),
(42, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-29 08:55:18'),
(43, 'admin', 'HAPUS', 'Memindahkan barang ID 21 ke Recycle Bin', '2026-05-29 08:55:38'),
(44, 'admin', 'HAPUS', 'Memindahkan barang ID 20 ke Recycle Bin', '2026-05-29 08:55:42'),
(45, 'admin', 'HAPUS', 'Memindahkan barang ID 23 ke Recycle Bin', '2026-05-29 09:01:03'),
(46, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-29 09:05:32'),
(47, 'admin', 'HAPUS', 'Memindahkan barang ID 24 ke Recycle Bin', '2026-05-29 09:21:58'),
(48, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil ika', '2026-05-29 09:24:17'),
(49, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 24 dari database', '2026-05-29 09:25:11'),
(50, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 23 dari database', '2026-05-29 09:25:14'),
(51, 'admin', 'HAPUS', 'Memindahkan barang ID 25 ke Recycle Bin', '2026-05-29 09:27:39'),
(52, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil ia', '2026-05-29 09:29:22'),
(53, 'admin', 'HAPUS', 'Memindahkan barang ID 26 ke Recycle Bin', '2026-05-29 12:37:32'),
(54, 'admin', 'TAMBAH', 'Menambahkan barang baru: pensil', '2026-05-29 13:22:46'),
(55, 'admin', 'HAPUS', 'Memindahkan barang ID 27 ke Recycle Bin', '2026-05-29 13:23:41'),
(56, 'admin', 'RESTORE', 'Mengembalikan barang ID 27 dari Recycle Bin', '2026-05-29 13:23:55'),
(57, 'admin', 'HAPUS', 'Memindahkan barang ID 27 ke Recycle Bin', '2026-05-29 13:24:04'),
(58, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 27 dari database', '2026-05-29 13:24:11'),
(59, 'admin', 'TAMBAH', 'Menambahkan barang baru: kursi', '2026-05-29 13:25:30'),
(60, 'admin', 'TAMBAH', 'Menambahkan barang baru: penghapus', '2026-05-29 13:26:10'),
(61, 'admin', 'TAMBAH', 'Menambahkan barang baru: radio', '2026-05-29 13:26:41'),
(62, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 26 dari database', '2026-05-29 16:51:33'),
(63, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 25 dari database', '2026-05-29 16:51:36'),
(64, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 22 dari database', '2026-05-29 16:51:40'),
(65, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 21 dari database', '2026-05-29 16:51:42'),
(66, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 20 dari database', '2026-05-29 16:51:44'),
(67, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 19 dari database', '2026-05-29 16:51:46'),
(68, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 14 dari database', '2026-05-29 16:51:49'),
(69, 'admin', 'HAPUS', 'Memindahkan barang ID 30 ke Recycle Bin', '2026-05-29 16:51:55'),
(70, 'admin', 'HAPUS PERMANEN', 'Menghapus permanen barang ID 30 dari database', '2026-05-29 16:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
