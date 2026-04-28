<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Data Anggota</h1>
    <a href="/admin/anggota/tambah" class="btn btn-primary shadow-sm">
        <i class="bi bi-person-plus me-1"></i> Tambah Anggota
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Kode</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis</th>
                        <th class="d-none d-md-table-cell">No. HP</th>
                        <th>Status</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($anggota)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data anggota.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($anggota as $index => $a) : ?>
                            <tr>
                                <td class="d-none d-md-table-cell"><?= $index + 1 ?></td>
                                <td class="fw-bold text-primary d-none d-md-table-cell"><?= $a['kode_anggota'] ?></td>
                                <td>
                                    <div class="fw-bold mb-0"><?= $a['nama'] ?></div>
                                    <div class="small d-md-none text-muted"><?= $a['kode_anggota'] ?></div>
                                </td>
                                <td>
                                    <span class="badge <?= $a['jenis_anggota'] == 'guru' ? 'bg-info' : 'bg-secondary' ?> text-capitalize">
                                        <?= $a['jenis_anggota'] ?>
                                    </span>
                                </td>
                                <td class="d-none d-md-table-cell"><?= $a['no_hp'] ?? '-' ?></td>
                                <td>
                                    <span class="badge <?= $a['status'] == 'aktif' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $a['status'] ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="/admin/anggota/edit/<?= $a['id'] ?>" class="btn btn-sm btn-outline-info me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/anggota/hapus/<?= $a['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
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
