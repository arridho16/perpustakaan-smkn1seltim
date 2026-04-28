<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4 d-print-none">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Laporan Transaksi</h1>
    <button class="btn btn-outline-primary shadow-sm" onclick="window.print()">
        <i class="bi bi-printer me-1"></i> Cetak Laporan
    </button>
</div>

<div class="card shadow-sm border-0 mb-4 d-print-none">
    <div class="card-body">
        <form action="/admin/pengembalian/laporan" method="GET">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai ?>">
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-filter me-1"></i> Filter Laporan
                    </button>
                    <a href="/admin/pengembalian/laporan" class="btn btn-light ms-2">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <!-- Judul Laporan (Hanya muncul saat print) -->
        <div class="print-header text-center mb-4">
            <h3 class="fw-bold mb-1">LAPORAN TRANSAKSI PERPUSTAKAAN</h3>
            <h5 class="mb-2">SMKN 1 Selakau Timur</h5>
            <?php if ($tgl_mulai && $tgl_selesai) : ?>
                <p class="mb-0">Periode: <?= date('d/m/Y', strtotime($tgl_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tgl_selesai)) ?></p>
            <?php endif; ?>
            <hr style="border-top: 2px solid #000; opacity: 1; margin-top: 10px;">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="col-print-show">#</th>
                        <th class="col-print-show">Kode Pinjam</th>
                        <th>Peminjam & Buku</th>
                        <th class="text-center">Jml</th>
                        <th>Tgl Pinjam</th>
                        <th class="col-print-show">Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($laporan)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Tidak ada data transaksi untuk periode ini.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($laporan as $index => $l) : ?>
                            <tr>
                                <td class="col-print-show"><?= $index + 1 ?></td>
                                <td class="small fw-bold col-print-show"><?= $l['kode_pinjam'] ?></td>
                                <td>
                                    <div class="fw-bold mb-0"><?= $l['nama_anggota'] ?></div>
                                    <div class="small text-muted">
                                        <?= $l['judul_buku'] ?>
                                    </div>
                                    <div class="small d-md-none d-print-none text-primary fw-bold" style="font-size: 0.7rem;"><?= $l['kode_pinjam'] ?></div>
                                </td>
                                <td class="text-center"><?= $l['jumlah'] ?></td>
                                <td><?= date('d/m/Y', strtotime($l['tgl_pinjam'])) ?></td>
                                <td class="col-print-show"><?= $l['tgl_dikembalikan'] ? date('d/m/Y', strtotime($l['tgl_dikembalikan'])) : '-' ?></td>
                                <td><span class="text-capitalize small badge <?= $l['status'] == 'dipinjam' ? 'bg-info' : ($l['status'] == 'terlambat' ? 'bg-danger' : 'bg-success') ?>"><?= $l['status'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan Petugas (Hanya muncul saat print) -->
        <div class="print-footer mt-5">
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4 text-center">
                    <p class="mb-5">Selakau Timur, <?= date('d/m/Y') ?><br>Petugas Perpustakaan,</p>
                    <br>
                    <p class="fw-bold mb-0 border-bottom d-inline-block px-3"><?= session()->get('nama') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Header dan Footer Print disembunyikan di layar */
.print-header, .print-footer { display: none; }

@media print {
    @page { margin: 1.5cm; }
    body { background: white !important; font-size: 11pt; color: black; }
    #sidebar, .navbar, .d-print-none, .btn-close, .breadcrumb, footer { display: none !important; }
    #content-wrapper { margin: 0 !important; padding: 0 !important; width: 100% !important; }
    #content { margin: 0 !important; padding: 0 !important; }
    .content-body { padding: 0 !important; margin: 0 !important; }
    .card { box-shadow: none !important; border: none !important; padding: 0 !important; }
    .card-body { padding: 0 !important; }
    .table { border: 1px solid #000 !important; width: 100% !important; margin-bottom: 20px; }
    .table th, .table td { border: 1px solid #000 !important; padding: 6px 8px !important; color: black !important; }
    .table thead th { background-color: #f8f9fa !important; color: black !important; }
    .badge { border: 1px solid #000 !important; color: #000 !important; background: transparent !important; }
    
    /* Tampilkan elemen khusus print */
    .print-header, .print-footer { display: block !important; }
    .col-print-show { display: table-cell !important; }
}

@media screen {
    .col-print-show { display: none; }
    @media (min-width: 768px) {
        .col-print-show { display: table-cell !important; }
    }
}
</style>
<?= $this->endSection() ?>
