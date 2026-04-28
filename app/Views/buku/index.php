<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Koleksi Buku</h1>
    <a href="/admin/buku/tambah" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="d-none d-md-table-cell">#</th>
                        <th>Cover</th>
                        <th>Informasi Buku</th>
                        <th>Stok</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($buku)) : ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada koleksi buku.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($buku as $index => $b) : ?>
                            <tr>
                                <td class="d-none d-md-table-cell"><?= $index + 1 ?></td>
                                <td>
                                    <?php 
                                    $coverPath = 'uploads/covers/' . $b['cover'];
                                    if (!file_exists($coverPath) || empty($b['cover'])) {
                                        $coverPath = 'uploads/covers/default.jpg';
                                    }
                                    ?>
                                    <img src="/<?= $coverPath ?>" alt="Cover" class="rounded shadow-sm" width="50" height="70" style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-primary text-truncate mb-0" style="max-width: 150px;" data-bs-toggle="tooltip" data-bs-title="<?= $b['judul'] ?>"><?= $b['judul'] ?></div>
                                    <div class="small text-muted" style="font-size: 0.75rem;">
                                        <span class="d-block d-md-inline me-md-2 text-dark fw-medium"><?= $b['kode_buku'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small fw-bold">Tersedia: <?= $b['stok_tersedia'] ?> / <?= $b['stok'] ?></div>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <?php $percent = ($b['stok'] > 0) ? ($b['stok_tersedia'] / $b['stok'] * 100) : 0; ?>
                                        <div class="progress-bar bg-<?= ($percent < 20) ? 'danger' : (($percent < 50) ? 'warning' : 'success') ?>" role="progressbar" style="width: <?= $percent ?>%"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="/admin/buku/edit/<?= $b['id'] ?>" class="btn btn-sm btn-outline-info me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/buku/hapus/<?= $b['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                       title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
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
