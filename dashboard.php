<?php
// Proteksi halaman
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: index.php"); // Kalau belum login, ke landing page
    exit;
}

require 'config.php';

 $stmt = $pdo->query("SELECT * FROM barang WHERE is_deleted = 0 ORDER BY id DESC");
 $barangs = $stmt->fetchAll(PDO::FETCH_ASSOC);

 $stmt_total = $pdo->query("SELECT COUNT(*) as total_jenis, SUM(stok) as total_stok, SUM(harga * stok) as total_nilai FROM barang WHERE is_deleted = 0");
 $stats = $stmt_total->fetch(PDO::FETCH_ASSOC);

 $totalJenis = $stats['total_jenis'] ?? 0;
 $totalStok = $stats['total_stok'] ?? 0;
 $totalNilai = $stats['total_nilai'] ?? 0;

 $chart_kategori = $pdo->query("SELECT kategori, COUNT(*) as total FROM barang WHERE is_deleted = 0 GROUP BY kategori")->fetchAll(PDO::FETCH_ASSOC);
 $chart_stok = $pdo->query("SELECT kategori, SUM(stok) as total_stok FROM barang WHERE is_deleted = 0 GROUP BY kategori")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        .card-gradient-blue { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; }
        .card-gradient-green { background: linear-gradient(135deg, #059669 0%, #10b981 100%); border: none; }
        .card-gradient-orange { background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); border: none; }
        .card-gradient-red { background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%); border: none; }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
        .table-premium thead th { background-color: #1e293b; color: #f1f5f9; border-bottom: none; font-weight: 600; letter-spacing: 0.5px; }
        .btn-action { padding: 0.35rem 0.65rem; border-radius: 6px; }
        .search-input { border: 2px solid #e2e8f0; border-radius: 10px; background-color: #ffffff; }
        .search-input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-4 shadow-sm">
        <h3 class="fw-bold mb-0" style="color: #4f46e5;"><i class="bi bi-box-seam-fill"></i> Inventaris Smart</h3>
        <div class="d-flex align-items-center gap-3">
            <span class="text-secondary fw-medium d-none d-md-inline"><i class="bi bi-person-circle"></i> Halo, <?= htmlspecialchars($_SESSION['username']); ?></span>
            <a href="log_aktivitas.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-clock-history"></i> Riwayat</a>
            <a href="sampah.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-recycle"></i> Sampah</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3"><i class="bi bi-box-arrow-right"></i> Logout</a>
            <button class="btn text-white px-3 rounded-pill" style="background-color: #4f46e5;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle"></i> Tambah Barang
            </button>
        </div>
    </div>

    <!-- DASHBOARD STATS + KURS DOLAR (REST API) -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-gradient-blue text-white shadow-sm card-hover rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><p class="text-uppercase small mb-1 opacity-75">Jenis Barang</p><h2 class="fw-bold mb-0"><?= $totalJenis; ?></h2></div>
                    <i class="bi bi-layers-fill opacity-50" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-gradient-green text-white shadow-sm card-hover rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><p class="text-uppercase small mb-1 opacity-75">Total Stok</p><h2 class="fw-bold mb-0"><?= $totalStok; ?></h2></div>
                    <i class="bi bi-box-seam opacity-50" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-gradient-orange text-white shadow-sm card-hover rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div><p class="text-uppercase small mb-1 opacity-75">Nilai Aset</p><h2 class="fw-bold mb-0">Rp <?= number_format($totalNilai, 0, ',', '.'); ?></h2></div>
                    <i class="bi bi-currency-exchange opacity-50" style="font-size: 2.5rem;"></i>
                </div>
            </div>
        </div>
        
        <!-- INI DIA REST API EKSTERNAL SESUAI PERMINTAAN ASDOS -->
        <div class="col-md-3 mb-3">
            <div class="card card-gradient-red text-white shadow-sm card-hover rounded-4">
                <div class="card-body">
                    <p class="text-uppercase small mb-1 opacity-75"><i class="bi bi-globe2 me-1"></i>Kurs USD -> IDR</p>
                    <h2 class="fw-bold mb-0">Rp <span id="usd-rate">Loading...</span></h2>
                    <small class="opacity-75">Data dari Server API Eksternal</small>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK DASHBOARD -->
    <div class="row mb-4">
        <div class="col-md-5 mb-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-pie-chart-fill me-2"></i>Komposisi Kategori</h6>
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-bar-chart-fill me-2"></i>Total Stok per Kategori</h6>
                    <canvas id="chartStok"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- SEARCH BAR & TOOLS -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <input type="text" id="search-input" class="form-control form-control-lg search-input flex-grow-1" placeholder="🔍 Cari nama barang atau kategori di sini...">
        <a href="export_excel.php" class="btn btn-success btn-lg rounded-3 text-white flex-shrink-0"><i class="bi bi-file-earmark-excel"></i> Excel</a>
        <button onclick="window.print()" class="btn btn-outline-dark btn-lg rounded-3 flex-shrink-0"><i class="bi bi-printer"></i> Print</button>
    </div>

    <!-- TABEL DATA -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-premium">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-barang">
                        <?php $no = 1; foreach($barangs as $b): ?>
                        <tr id="row-<?= $b['id']; ?>">
                            <td class="ps-4 fw-medium"><?= $no++; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($b['nama_barang']); ?></td>
                            <td><span class="badge rounded-pill bg-light text-dark border" style="font-size: 0.8rem;"><?= $b['kategori']; ?></span></td>
                            <td><?= $b['stok']; ?></td>
                            <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning btn-action text-white" onclick="editBarang(<?= $b['id']; ?>, '<?= htmlspecialchars($b['nama_barang'], ENT_QUOTES); ?>', '<?= $b['kategori']; ?>', <?= $b['stok']; ?>, <?= $b['harga']; ?>)"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger btn-action" onclick="hapusBarang(<?= $b['id']; ?>)"><i class="bi bi-trash3-fill"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($barangs)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data barang. Silakan tambah data baru.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header text-white border-0 rounded-top-4" style="background-color: #4f46e5;">
        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Barang Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form id="form-tambah">
          <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">NAMA BARANG</label>
            <input type="text" name="nama_barang" class="form-control rounded-3" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">KATEGORI</label>
            <select name="kategori" class="form-select rounded-3" required>
                <option value="">Pilih Kategori...</option>
                <option value="Elektronik">Elektronik</option>
                <option value="ATK">ATK (Alat Tulis)</option>
                <option value="Furnitur">Furnitur</option>
            </select>
          </div>
          <div class="row">
            <div class="mb-3 col-6">
              <label class="form-label text-secondary small fw-bold">STOK</label>
              <input type="number" name="stok" class="form-control rounded-3" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label text-secondary small fw-bold">HARGA (Rp)</label>
              <input type="number" name="harga" class="form-control rounded-3" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 pb-4 px-4">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-simpan" class="btn text-white rounded-pill px-4" style="background-color: #4f46e5;"><i class="bi bi-save me-1"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT DATA -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header bg-warning text-dark border-0 rounded-top-4">
        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form id="form-edit">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">NAMA BARANG</label>
            <input type="text" name="nama_barang" id="edit-nama" class="form-control rounded-3" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-secondary small fw-bold">KATEGORI</label>
            <select name="kategori" id="edit-kategori" class="form-select rounded-3" required>
                <option value="Elektronik">Elektronik</option>
                <option value="ATK">ATK (Alat Tulis)</option>
                <option value="Furnitur">Furnitur</option>
            </select>
          </div>
          <div class="row">
            <div class="mb-3 col-6">
              <label class="form-label text-secondary small fw-bold">STOK</label>
              <input type="number" name="stok" id="edit-stok" class="form-control rounded-3" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label text-secondary small fw-bold">HARGA (Rp)</label>
              <input type="number" name="harga" id="edit-harga" class="form-control rounded-3" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 pb-4 px-4">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="btn-update" class="btn btn-warning rounded-pill px-4"><i class="bi bi-save me-1"></i> Update</button>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// 1. SCRIPT TAMBAH DATA
document.getElementById('btn-simpan').addEventListener('click', function() {
    const form = document.getElementById('form-tambah');
    const formData = new FormData(form);
    fetch('tambah.php', { method: 'POST', body: formData })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
            modal.hide();
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, showConfirmButton: false, timer: 1500 })
            .then(() => { location.reload(); });
        } else { Swal.fire('Gagal!', data.message, 'error'); }
    });
});

// 2. SCRIPT HAPUS DATA (Soft Delete)
function hapusBarang(id) {
    Swal.fire({
        title: 'Pindahkan ke Recycle Bin?',
        text: "Barang ini tidak akan hilang permanen dan bisa dikembalikan!",
        icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Buang!', cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('hapus.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'id=' + id })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({ icon: 'success', title: 'Dibuang!', text: data.message, showConfirmButton: false, timer: 1500 })
                    .then(() => { location.reload(); });
                } else { Swal.fire('Gagal!', data.message, 'error'); }
            });
        }
    });
}

// 3. SCRIPT EDIT DATA
function editBarang(id, nama, kategori, stok, harga) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-stok').value = stok;
    document.getElementById('edit-harga').value = harga;
    const kategoriSelect = document.getElementById('edit-kategori');
    for(let i = 0; i < kategoriSelect.options.length; i++) {
        if(kategoriSelect.options[i].value === kategori) { kategoriSelect.selectedIndex = i; break; }
    }
    const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
    modal.show();
}

document.getElementById('btn-update').addEventListener('click', function() {
    const form = document.getElementById('form-edit');
    const formData = new FormData(form);
    fetch('edit.php', { method: 'POST', body: formData })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalEdit'));
            modal.hide();
            Swal.fire({ icon: 'success', title: 'Diupdate!', text: data.message, showConfirmButton: false, timer: 1500 })
            .then(() => { location.reload(); });
        } else { Swal.fire('Gagal!', data.message, 'error'); }
    });
});

// 4. SCRIPT LIVE SEARCH
document.getElementById('search-input').addEventListener('keyup', function() {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tabel-barang tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
});

// 5. SCRIPT GRAFIK
const warnaGrafik = ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
const kategoriLabels = [<?php foreach($chart_kategori as $c) { echo "'" . $c['kategori'] . "',"; } ?>];
const kategoriData = [<?php foreach($chart_kategori as $c) { echo $c['total'] . ","; } ?>];
const stokData = [<?php foreach($chart_stok as $c) { echo $c['total_stok'] . ","; } ?>];

new Chart(document.getElementById('chartKategori').getContext('2d'), {
    type: 'doughnut', data: { labels: kategoriLabels, datasets: [{ label: 'Jumlah Jenis', data: kategoriData, backgroundColor: warnaGrafik, borderWidth: 0, hoverOffset: 8 }] },
    options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { font: { family: 'Inter' } } } } }
});

new Chart(document.getElementById('chartStok').getContext('2d'), {
    type: 'bar', data: { labels: kategoriLabels, datasets: [{ label: 'Total Stok', data: stokData, backgroundColor: warnaGrafik, borderRadius: 8, borderWidth: 0 }] },
    options: { responsive: true, scales: { y: { beginAtZero: true, grid: { color: '#f1f5f9' } }, x: { grid: { display: false } } }, plugins: { legend: { display: false } } }
});

// 6. SCRIPT REST API EKSTERNAL (KURS DOLAR)
// Ini yang diminta asdos: Ambil data dari server lain (exchangerate-api)
async function getExchangeRate() {
    try {
        const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');
        const data = await response.json();
        const idrRate = data.rates.IDR;
        document.getElementById('usd-rate').innerText = new Intl.NumberFormat('id-ID').format(idrRate);
    } catch (error) {
        document.getElementById('usd-rate').innerText = 'Error';
        console.error('Gagal mengambil data API Kurs:', error);
    }
}
getExchangeRate(); // Panggil saat halaman dibuka

</script>

</body>
</html>