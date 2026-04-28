<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Pengaturan Profil</h1>
    <p class="text-muted">Kelola nama, username, dan password akun Anda.</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/admin/profile/update" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= old('nama', $user['nama']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= old('username', $user['username']) ?>" required>
                    </div>
                    <hr class="my-4">
                    <div class="mb-3">
                        <label class="form-label">Password Baru (Kosongkan jika tidak diganti)</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 5 karakter">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Ulangi password baru">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary shadow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mt-4 mt-lg-0">
        <div class="alert alert-info border-0 shadow-sm">
            <h5 class="fw-bold"><i class="bi bi-shield-lock-fill me-2"></i> Keamanan Akun</h5>
            <ul class="mb-0 small">
                <li>Gunakan username yang unik dan mudah diingat.</li>
                <li>Gunakan kombinasi password yang kuat.</li>
                <li>Jika Anda mengganti password, Anda akan tetap dalam keadaan login.</li>
                <li>Nama lengkap akan muncul di sidebar dan laporan.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
