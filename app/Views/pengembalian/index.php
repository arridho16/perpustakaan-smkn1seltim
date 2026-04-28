<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Proses Pengembalian</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Buku Belum Kembali</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th class="d-none d-md-table-cell">Kode Pinjam</th>
                            <th>Peminjam & Buku</th>
                            <th class="text-center">Jml</th>
                            <th>Tgl Pinjam</th>
                            <th class="d-none d-md-table-cell">Batas Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                         <tbody>
                             <?php if (empty($peminjaman)) : ?>
                                 <tr>
                                     <td colspan="7" class="text-center py-4 text-muted">Semua buku telah dikembalikan.</td>
                                 </tr>
                             <?php else : ?>
                                 <?php foreach ($peminjaman as $p) : ?>
                                     <tr>
                                         <td class="fw-bold d-none d-md-table-cell small"><?= $p['kode_pinjam'] ?></td>
                                         <td>
                                             <div class="fw-bold mb-0" data-bs-toggle="tooltip" data-bs-title="<?= $p['nama_anggota'] ?>"><?= $p['nama_anggota'] ?></div>
                                             <div class="small text-muted text-truncate" style="max-width: 150px;" data-bs-toggle="tooltip" data-bs-title="<?= $p['judul_buku'] ?>"><?= $p['judul_buku'] ?></div>
                                             <div class="small d-md-none text-primary fw-bold" style="font-size: 0.7rem;"><?= $p['kode_pinjam'] ?></div>
                                         </td>
                                         <td class="text-center">
                                             <?= $p['jumlah'] ?>
                                         </td>
                                        <td><?= date('d/m/Y', strtotime($p['tgl_pinjam'])) ?></td>
                                        <td class="d-none d-md-table-cell"><?= date('d/m/Y', strtotime($p['tgl_kembali'])) ?></td>
                                        <td>
                                            <?php if ($p['status'] == 'dikembalikan') : ?>
                                                <span class="badge bg-success">Dikembalikan</span>
                                            <?php elseif (strtotime($p['tgl_kembali']) < strtotime(date('Y-m-d'))) : ?>
                                                <span class="badge bg-danger">Terlambat</span>
                                            <?php else : ?>
                                                <span class="badge bg-info">Dipinjam</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['status'] != 'dikembalikan') : ?>
                                                <form action="/admin/pengembalian/proses/<?= $p['id'] ?>" method="POST">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill" onclick="return confirm('Konfirmasi pengembalian buku?')">
                                                        Proses Kembali
                                                    </button>
                                                </form>
                                            <?php else : ?>
                                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> Kembali</span>
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
    </div>
</div>
<?= $this->endSection() ?>
