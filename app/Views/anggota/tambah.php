<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="/admin/anggota" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Tambah Anggota Baru</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/admin/anggota/simpan" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Kode Anggota (NIS/NIP)</label>
                        <input type="text" name="kode_anggota" class="form-control <?= validation_show_error('kode_anggota') ? 'is-invalid' : '' ?>" placeholder="Contoh: 12345678" value="<?= old('kode_anggota') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('kode_anggota') ?></div>
                        <div class="form-text text-muted small">NIS untuk Siswa, NIP/NUPTK untuk Guru.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" placeholder="Masukkan nama lengkap" value="<?= old('nama') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama') ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Anggota</label>
                        <select name="jenis_anggota" class="form-select" required>
                            <option value="" selected disabled>Pilih Jenis</option>
                            <option value="siswa" <?= old('jenis_anggota') == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                            <option value="guru" <?= old('jenis_anggota') == 'guru' ? 'selected' : '' ?>>Guru</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">No. HP (WhatsApp)</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 0812xxxx" value="<?= old('no_hp') ?>">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow">Simpan Data Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="alert alert-warning border-0 shadow-sm p-4">
            <h5 class="fw-bold"><i class="bi bi-info-circle-fill me-2"></i> Petunjuk</h5>
            <ul class="mb-0 small ps-3">
                <li class="mb-2">Gunakan <strong>NIS/NIP</strong> sebagai Kode Anggota.</li>
                <li class="mb-2">Kode anggota bersifat unik (tidak boleh sama).</li>
                <li class="mb-2">Pastikan nomor HP aktif untuk notifikasi.</li>
                <li class="mb-0">Cek kembali nama sebelum disimpan.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
