<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="/admin/peminjaman" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
    </a>
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Input Peminjaman Baru</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/admin/peminjaman/simpan" method="POST">
                    <?= csrf_field() ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Peminjaman</label>
                            <input type="text" name="kode_pinjam" class="form-control bg-light" value="<?= $kode_pinjam ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Anggota (Peminjam)</label>
                        <select name="anggota_id" class="form-select select2" required>
                            <option value="" selected disabled>Cari Anggota...</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value="<?= $a['id'] ?>"><?= $a['kode_anggota'] ?> - <?= $a['nama'] ?> (<?= ucfirst($a['jenis_anggota']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Buku yang Dipinjam</label>
                        <select name="buku_id" class="form-select select2" required>
                            <option value="" selected disabled>Cari Buku...</option>
                            <?php foreach ($buku as $b) : ?>
                                <option value="<?= $b['id'] ?>"><?= $b['kode_buku'] ?> - <?= $b['judul'] ?> (Stok: <?= $b['stok_tersedia'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Batas Pengembalian</label>
                            <input type="date" name="tgl_kembali" class="form-control" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Catatan (Opsional)</label>
                            <input type="text" name="catatan" class="form-control" placeholder="Contoh: Kondisi buku baik">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow">Proses Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="alert alert-warning border-0 shadow-sm">
            <h5 class="fw-bold"><i class="bi bi-info-circle-fill me-2"></i> Aturan Pinjam</h5>
            <ul class="mb-0 small">
                <li>Pastikan stok buku tersedia.</li>
                <li>Hanya anggota dengan status <strong>Aktif</strong> yang bisa meminjam.</li>
                <li>Satu kali transaksi berlaku untuk satu buku.</li>
                <li>Batas pengembalian normal adalah 7 hari.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
