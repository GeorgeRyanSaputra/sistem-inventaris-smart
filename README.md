## Inventaris Smart - PWEB-1H
Sistem Informasi Inventaris Digital yang inovatif untuk mendukung SDG 9 (Industri, Inovasi, dan Infrastruktur). Aplikasi ini dirancang untuk mengatasi permasalahan pengelolaan aset industri/UMKM yang rentan terhadap human error, kurang akuntabel, dan sulit diintegrasikan dengan data real-time.

Dibangun menggunakan teknologi web modern dengan fitur Soft Delete, Audit Trail, REST API Eksternal, dan Dashboard Interaktif.

## Fitur
Landing Page dan Dashboard terpisah.
Login dengan Enkripsi Password (Bcrypt).
CRUD tanpa reload halaman (AJAX/Fetch API & SweetAlert2).
Soft Delete (Recycle Bin) & Restore Data.
Audit Trail untuk melacak riwayat perubahan data.
Dashboard interaktif pakai Chart.js.
Integrasi REST API Kurs Dolar real-time dari server luar.
Export laporan ke format Excel.
Teknologi
PHP (PDO & Session)
MySQL
HTML, CSS (Bootstrap 5), JS (Fetch API, Chart.js)
XAMPP
## Cara Menjalankan
Download atau clone repository ini.
Ekstrak dan taruh foldernya di C:\xampp\htdocs\. Rename folder jadi inventarisk-genius.
Nyalakan Apache dan MySQL di XAMPP.
Buka browser, ketik localhost/phpmyadmin.
Buat database baru dengan nama db_inventaris.
Pilih tab Import, pilih file db_inventaris.sql yang ada di folder ini, klik Go/Kirim.
Buka tab baru, akses http://localhost/inventarisk-genius/
Klik tombol Login, lalu masuk pakai akun:
Username: admin
Password: password
## Tim PWEB-1H
George Ryan Saputra (5240311048)
Prasetyo Budi Utomo (5240311035)
Yoga Abdullah (5240311034)
