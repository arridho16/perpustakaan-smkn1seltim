<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="/admin/anggota" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit Anggota</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/admin/anggota/update/<?= $anggota['id'] ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Kode Anggota (NIS/NIP)</label>
                        <input type="text" name="kode_anggota" class="form-control <?= validation_show_error('kode_anggota') ? 'is-invalid' : '' ?>" value="<?= old('kode_anggota', $anggota['kode_anggota']) ?>">
                        <div class="invalid-feedback"><?= validation_show_error('kode_anggota') ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" value="<?= old('nama', $anggota['nama']) ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Anggota</label>
                            <select name="jenis_anggota" class="form-select" required>
                                <option value="siswa" <?= old('jenis_anggota', $anggota['jenis_anggota']) == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                                <option value="guru" <?= old('jenis_anggota', $anggota['jenis_anggota']) == 'guru' ? 'selected' : '' ?>>Guru</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="aktif" <?= old('status', $anggota['status']) == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="nonaktif" <?= old('status', $anggota['status']) == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">No. HP (WhatsApp)</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp', $anggota['no_hp']) ?>">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow">Update Data Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="alert alert-info border-0 shadow-sm p-4">
            <h5 class="fw-bold"><i class="bi bi-pencil-square me-2"></i> Info Edit</h5>
            <ul class="mb-0 small ps-3">
                <li class="mb-2">Perubahan <strong>Kode Anggota</strong> tetap akan divalidasi keunikannya.</li>
                <li class="mb-2">Jika anggota sudah lulus/berhenti, ubah status menjadi <strong>Nonaktif</strong>.</li>
                <li class="mb-0">Pastikan Nama Lengkap sudah sesuai ijazah/SK.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
