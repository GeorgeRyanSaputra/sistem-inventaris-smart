SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS db_inventaris;
USE db_inventaris;

DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS log_aktivitas;
DROP TABLE IF EXISTS users;

-- =========================
-- TABLE BARANG
-- =========================

CREATE TABLE barang (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nama_barang VARCHAR(100) NOT NULL,
  kategori VARCHAR(50) NOT NULL,
  stok INT(11) NOT NULL,
  harga DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  is_deleted TINYINT(1) DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO barang
(id, nama_barang, kategori, stok, harga, created_at, is_deleted)
VALUES
(28,'kursi','Furnitur',5,10000.00,'2026-05-29 13:25:30',0),
(29,'penghapus','ATK',2,15000.00,'2026-05-29 13:26:10',0);

-- =========================
-- TABLE LOG AKTIVITAS
-- =========================

CREATE TABLE log_aktivitas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  aksi VARCHAR(50) NOT NULL,
  deskripsi TEXT NOT NULL,
  waktu TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO log_aktivitas
(id, username, aksi, deskripsi, waktu)
VALUES
(1,'admin','HAPUS','Menghapus barang: Mouse Logitech','2026-05-28 18:21:09'),
(2,'admin','TAMBAH','Menambahkan barang baru: Mouse Logitech','2026-05-28 18:25:02'),
(3,'admin','TAMBAH','Menambahkan barang baru: pensil','2026-05-28 18:25:39'),
(4,'admin','TAMBAH','Menambahkan barang baru: pensil','2026-05-28 18:27:29'),
(5,'admin','TAMBAH','Menambahkan barang baru: pulpen','2026-05-28 18:27:53'),
(6,'admin','TAMBAH','Menambahkan barang baru: penghapus','2026-05-28 18:28:23'),
(7,'admin','TAMBAH','Menambahkan barang baru: mouse','2026-05-28 18:29:00'),
(8,'admin','HAPUS','Menghapus barang: mouse','2026-05-28 18:29:13'),
(9,'admin','HAPUS','Menghapus barang: penghapus','2026-05-28 18:29:17'),
(10,'admin','HAPUS','Menghapus barang: pulpen','2026-05-28 18:29:21');

-- =========================
-- TABLE USERS
-- =========================

CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users
(id, username, password)
VALUES
(1,'admin','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- =========================
-- AUTO INCREMENT
-- =========================

ALTER TABLE barang AUTO_INCREMENT=31;
ALTER TABLE log_aktivitas AUTO_INCREMENT=71;
ALTER TABLE users AUTO_INCREMENT=2;

COMMIT;
