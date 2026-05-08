<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="/admin/buku" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit Buku</h1>
</div>

<form action="/admin/buku/update/<?= $buku['id'] ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control <?= validation_show_error('judul') ? 'is-invalid' : '' ?>" value="<?= old('judul', $buku['judul']) ?>">
                        <div class="invalid-feedback"><?= validation_show_error('judul') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Kode Buku / ISBN</label>
                            <input type="text" name="kode_buku" class="form-control <?= validation_show_error('kode_buku') ? 'is-invalid' : '' ?>" value="<?= old('kode_buku', $buku['kode_buku']) ?>">
                            <div class="invalid-feedback"><?= validation_show_error('kode_buku') ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" value="<?= old('pengarang', $buku['pengarang']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="<?= old('penerbit', $buku['penerbit']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control" value="<?= old('tahun_terbit', $buku['tahun_terbit']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required value="<?= old('stok', $buku['stok']) ?>">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Deskripsi / Sinopsis</label>
                        <textarea name="deskripsi" class="form-control" rows="4"><?= old('deskripsi', $buku['deskripsi']) ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Cover</h6>
                </div>
                <div class="card-body text-center">
                    <img id="imgPreview" src="/uploads/covers/<?= $buku['cover'] ?>" class="img-fluid rounded mb-3 shadow-sm" style="max-height: 250px;">
                    <input type="file" name="cover" class="form-control" id="inputCover" onchange="previewImg()">
                    <div class="small text-muted mt-2">Biarkan kosong jika tidak ingin mengganti cover.</div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg shadow">Update Koleksi Buku</button>
            </div>
        </div>
    </div>
</form>

<script>
    function previewImg() {
        const cover = document.querySelector('#inputCover');
        const imgPreview = document.querySelector('#imgPreview');

        const fileCover = new FileReader();
        fileCover.readAsDataURL(cover.files[0]);

        fileCover.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection() ?>
