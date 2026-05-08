<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Riwayat Peminjaman</h1>
    <a href="/admin/peminjaman/tambah" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Input Pinjam Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Kode Pinjam</th>
                        <th>Peminjam & Buku</th>
                        <th class="text-center">Jml</th>
                        <th>Tgl Pinjam</th>
                        <th class="d-none d-md-table-cell">Batas Kembali</th>
                        <th>Status</th>
                        <th width="120" class="text-center">Info Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($peminjaman)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat transaksi.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($peminjaman as $index => $p) : ?>
                            <tr>
                                <td class="d-none d-md-table-cell"><?= $index + 1 ?></td>
                                <td class="fw-bold small d-none d-md-table-cell"><?= $p['kode_pinjam'] ?></td>
                                <td>
                                    <div class="fw-bold text-dark mb-0" data-bs-toggle="tooltip" data-bs-title="<?= $p['nama_anggota'] ?>"><?= $p['nama_anggota'] ?></div>
                                    <div class="small text-muted text-truncate" style="max-width: 150px;" data-bs-toggle="tooltip" data-bs-title="<?= $p['judul_buku'] ?>">
                                        <?= $p['judul_buku'] ?>
                                    </div>
                                    <div class="small d-md-none text-primary fw-bold" style="font-size: 0.7rem;"><?= $p['kode_pinjam'] ?></div>
                                </td>
                                <td class="text-center">
                                    <?= $p['jumlah'] ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($p['tgl_pinjam'])) ?></td>
                                <td class="d-none d-md-table-cell"><?= date('d/m/Y', strtotime($p['tgl_kembali'])) ?></td>
                                <td>
                                    <?php 
                                    $statusClass = 'bg-info';
                                    if ($p['status'] == 'dikembalikan') $statusClass = 'bg-success';
                                    if ($p['status'] == 'terlambat') $statusClass = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $statusClass ?> text-capitalize"><?= $p['status'] ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if ($p['status'] == 'dikembalikan') : ?>
                                        <span class="text-success small fw-bold">
                                            <i class="bi bi-check-circle"></i> <?= date('d/m/Y', strtotime($p['tgl_dikembalikan'])) ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="text-muted small italic">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
