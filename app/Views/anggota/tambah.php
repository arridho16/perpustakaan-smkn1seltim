<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="/admin/anggota" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Tambah Anggota Baru</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/admin/anggota/simpan" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Kode Anggota (NIS/NIP)</label>
                        <input type="text" name="kode_anggota" class="form-control" placeholder="Contoh: 12345678" required value="<?= old('kode_anggota') ?>">
                        <div class="form-text text-muted small">NIS untuk Siswa, NIP/NUPTK untuk Guru.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required value="<?= old('nama') ?>">
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
                        <button type="submit" class="btn btn-primary">Simpan Data Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
