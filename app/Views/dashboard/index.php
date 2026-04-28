<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard</h1>
    <span class="text-muted"><?= date('d F Y') ?></span>
</div>

<div class="row">
    <!-- Total Buku Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-primary border-4 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Buku</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_buku ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-journal-text fs-1 text-gray-300 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Anggota Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-success border-4 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Anggota</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fs-1 text-gray-300 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Aktif Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-info border-4 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Peminjaman Aktif
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $pinjam_aktif ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-arrow-right-circle fs-1 text-gray-300 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terlambat Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-warning border-4 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Buku Terlambat</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $terlambat ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-exclamation-circle fs-1 text-gray-300 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
            </div>
            <div class="card-body">
                <p>Halo <strong><?= session()->get('nama') ?></strong>, selamat datang di Sistem Informasi Perpustakaan SMKN 1 Selakau Timur. Gunakan menu di samping untuk mengelola data perpustakaan.</p>
                <div class="alert alert-info border-0 shadow-sm">
                    <i class="bi bi-info-circle-fill me-2"></i> Aplikasi ini dalam tahap pengembangan awal (Beta).
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Shortcut Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/admin/peminjaman/tambah" class="btn btn-outline-primary text-start">
                        <i class="bi bi-plus-circle me-2"></i> Input Peminjaman Baru
                    </a>
                    <a href="/admin/buku/tambah" class="btn btn-outline-success text-start">
                        <i class="bi bi-journal-plus me-2"></i> Tambah Koleksi Buku
                    </a>
                    <a href="/admin/anggota/tambah" class="btn btn-outline-info text-start">
                        <i class="bi bi-person-plus me-2"></i> Registrasi Anggota Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
