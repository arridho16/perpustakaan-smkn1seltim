<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard</h1>
    <span class="text-muted small"><?= date('d F Y') ?></span>
</div>

<div class="row g-3">
    <!-- Total Buku Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-primary border-4 h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 0.7rem;">Total Buku</div>
                        <div class="h4 mb-0 font-weight-bold text-dark"><?= $total_buku ?></div>
                    </div>
                    <div class="ms-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3">
                            <i class="bi bi-journal-text text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Anggota Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-success border-4 h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 0.7rem;">Total Anggota</div>
                        <div class="h4 mb-0 font-weight-bold text-dark"><?= $total_anggota ?></div>
                    </div>
                    <div class="ms-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3">
                            <i class="bi bi-people text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Aktif Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-info border-4 h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 0.7rem;">Pinjam Aktif</div>
                        <div class="h4 mb-0 font-weight-bold text-dark"><?= $pinjam_aktif ?></div>
                    </div>
                    <div class="ms-3">
                        <div class="bg-info bg-opacity-10 p-2 rounded-3">
                            <i class="bi bi-arrow-right-circle text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terlambat Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-warning border-4 h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 0.7rem;">Terlambat</div>
                        <div class="h4 mb-0 font-weight-bold text-dark"><?= $terlambat ?></div>
                    </div>
                    <div class="ms-3">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3">
                            <i class="bi bi-exclamation-circle text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4 h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
            </div>
            <div class="card-body">
                <p class="text-muted">Halo <strong><?= session()->get('nama') ?></strong>, selamat datang di Sistem Informasi Perpustakaan SMKN 1 Selakau Timur. Kelola koleksi buku dan transaksi peminjaman dengan mudah melalui menu navigasi.</p>
                <p class="mb-0 small text-secondary">Gunakan shortcut di samping untuk aksi cepat mengelola data perpustakaan.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="m-0 font-weight-bold text-primary">Shortcut Cepat</h6>
            </div>
            <div class="card-body pt-0">
                <style>
                    .btn-shortcut {
                        transition: all 0.2s;
                        border: 1px solid transparent !important;
                    }
                    .btn-shortcut:hover {
                        transform: translateX(5px);
                        background-color: #f8f9fa !important;
                        border-color: #dee2e6 !important;
                    }
                </style>
                <div class="d-grid gap-2">
                    <a href="/admin/peminjaman/tambah" class="btn btn-shortcut text-start bg-light text-primary fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> Input Peminjaman
                    </a>
                    <a href="/admin/buku/tambah" class="btn btn-shortcut text-start bg-light text-success fw-bold">
                        <i class="bi bi-journal-plus me-2"></i> Tambah Koleksi
                    </a>
                    <a href="/admin/anggota/tambah" class="btn btn-shortcut text-start bg-light text-info fw-bold">
                        <i class="bi bi-person-plus me-2"></i> Registrasi Anggota
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
