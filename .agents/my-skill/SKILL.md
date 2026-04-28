# SKILL: Sistem Informasi Manajemen Perpustakaan
## SMKN 1 Selakau Timur — Capstone Project UT

---

## 1. KONTEKS PROYEK

| Item | Detail |
|------|--------|
| Nama Sistem | Sistem Informasi Perpustakaan Berbasis Web pada SMKN 1 Selakau Timur |
| Institusi | SMKN 1 Selakau Timur, Kalimantan Barat |
| Tujuan | Mendigitalisasi pencatatan peminjaman & pengembalian buku yang sebelumnya manual |
| Metode Pengembangan | Waterfall |
| Tim | 5 orang |

---

## 2. TECH STACK

| Layer | Teknologi | Versi |
|-------|-----------|-------|
| Framework Backend | CodeIgniter 4 | 4.7.x |
| Bahasa Pemrograman | PHP | 8.2 |
| Database | MySQL (via XAMPP) | MariaDB 10.4 |
| Frontend CSS | Bootstrap | 5.3 |
| Server Lokal | XAMPP (Apache) | 8.2.12 |
| Package Manager | Composer | latest |
| Code Editor | VS Code / Antigravity | - |

---

## 3. FITUR SISTEM

### Modul Admin (Petugas Perpustakaan)
- [x] Login & Logout
- [x] Dashboard (statistik: total buku, total anggota, peminjaman aktif, buku terlambat)
- [x] Manajemen Buku (CRUD: tambah, edit, hapus, lihat detail)
- [x] Manajemen Anggota — siswa & guru dalam satu tabel (CRUD)
- [x] Proses Peminjaman Buku (admin input kode anggota + pilih buku + jumlah)
- [x] Proses Pengembalian Buku (admin konfirmasi pengembalian, otomatis update stok)
- [x] Laporan Transaksi (peminjaman & pengembalian per periode)
- [x] Manajemen Profil (Ubah nama, username, dan password admin)

> **Catatan:**
> - Tidak ada fitur denda — sekolah tidak menerapkan denda keterlambatan.
> - Hanya ada satu role yaitu **admin** (petugas perpustakaan).
> - Siswa/anggota tidak perlu login — semua transaksi dilayani oleh admin.

---

## 4. STRUKTUR DATABASE

### Tabel: `users`
```sql
CREATE TABLE users (
  id          INT PRIMARY KEY AUTO_INCREMENT,
  nama        VARCHAR(100) NOT NULL,
  username    VARCHAR(50) UNIQUE NOT NULL,
  password    VARCHAR(255) NOT NULL,       -- bcrypt
  role        ENUM('admin') DEFAULT 'admin',
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel: `anggota`
```sql
CREATE TABLE anggota (
  id              INT PRIMARY KEY AUTO_INCREMENT,
  kode_anggota    VARCHAR(20) UNIQUE NOT NULL,  -- NIS untuk siswa, NIP/NUPTK untuk guru
  nama            VARCHAR(100) NOT NULL,
  jenis_anggota   ENUM('siswa','guru') NOT NULL,
  no_hp           VARCHAR(20),
  status          ENUM('aktif','nonaktif') DEFAULT 'aktif',
  created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at      DATETIME ON UPDATE CURRENT_TIMESTAMP
);
```

-- Tabel Kategori Dihapus (Penyederhanaan Sistem)

### Tabel: `buku`
```sql
CREATE TABLE buku (
  id          INT PRIMARY KEY AUTO_INCREMENT,
  kode_buku   VARCHAR(20) UNIQUE NOT NULL,
  judul       VARCHAR(200) NOT NULL,
  pengarang   VARCHAR(100),
  penerbit    VARCHAR(100),
  tahun_terbit YEAR,
  stok        INT DEFAULT 1,
  stok_tersedia INT DEFAULT 1,            -- berubah dinamis saat pinjam/kembali
  cover       VARCHAR(255),               -- path gambar cover
  deskripsi   TEXT,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel: `peminjaman`
```sql
CREATE TABLE peminjaman (
  id            INT PRIMARY KEY AUTO_INCREMENT,
  kode_pinjam   VARCHAR(20) UNIQUE NOT NULL,  -- format: PJM-YYYYMMDD-001
  anggota_id    INT NOT NULL,
  buku_id       INT NOT NULL,
  jumlah        INT NOT NULL DEFAULT 1,      -- jumlah buku yang dipinjam
  tgl_pinjam    DATE NOT NULL,
  tgl_kembali   DATE NOT NULL,               -- batas pengembalian
  tgl_dikembalikan DATE,                     -- NULL jika belum kembali
  status        ENUM('dipinjam','dikembalikan','terlambat') DEFAULT 'dipinjam',
  petugas_id    INT NOT NULL,                -- user yang melayani (ID dari tabel users)
  catatan       TEXT,
  created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (anggota_id) REFERENCES anggota(id),
  FOREIGN KEY (buku_id) REFERENCES buku(id),
  FOREIGN KEY (petugas_id) REFERENCES users(id)
);
```

---

## 5. STRUKTUR FOLDER CI4

```
perpustakaan/
├── app/
│   ├── Config/
│   │   ├── App.php
│   │   ├── Database.php
│   │   └── Routes.php          ← definisi semua route
│   ├── Controllers/
│   │   ├── Auth.php            ← login, logout
│   │   ├── Dashboard.php       ← statistik
│   │   ├── Buku.php            ← CRUD buku
│   │   ├── Anggota.php         ← CRUD anggota
│   │   ├── Profile.php         ← edit profil admin
│   │   ├── Peminjaman.php      ← proses pinjam
│   │   └── Pengembalian.php    ← proses kembali + laporan
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BukuModel.php
│   │   ├── AnggotaModel.php
│   │   └── PeminjamanModel.php
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── main.php        ← layout utama (navbar, sidebar, footer)
│   │   │   └── auth.php        ← layout halaman login
│   │   ├── auth/
│   │   │   └── login.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── buku/
│   │   │   ├── index.php
│   │   │   ├── tambah.php
│   │   │   └── edit.php
│   │   ├── anggota/
│   │   │   ├── index.php
│   │   │   ├── tambah.php
│   │   │   └── edit.php
│   │   ├── peminjaman/
│   │   │   ├── index.php
│   │   │   └── tambah.php
│   │   └── pengembalian/
│   │       ├── index.php
│   │       └── laporan.php
│   └── Filters/
│       └── AuthFilter.php      ← proteksi halaman wajib login
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── uploads/
│       └── covers/             ← upload cover buku
├── writable/
├── .env
└── composer.json
```

---

## 6. ROUTING (Routes.php)

```php
// Auth
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Protected routes (gunakan AuthFilter)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    // Buku
    $routes->get('buku', 'Buku::index');
    $routes->get('buku/tambah', 'Buku::tambah');
    $routes->post('buku/simpan', 'Buku::simpan');
    $routes->get('buku/edit/(:num)', 'Buku::edit/$1');
    $routes->post('buku/update/(:num)', 'Buku::update/$1');
    $routes->get('buku/hapus/(:num)', 'Buku::hapus/$1');

    // Anggota
    $routes->get('anggota', 'Anggota::index');
    $routes->get('anggota/tambah', 'Anggota::tambah');
    $routes->post('anggota/simpan', 'Anggota::simpan');
    $routes->get('anggota/edit/(:num)', 'Anggota::edit/$1');
    $routes->post('anggota/update/(:num)', 'Anggota::update/$1');
    $routes->get('anggota/hapus/(:num)', 'Anggota::hapus/$1');

    // Profile
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    // Peminjaman
    $routes->get('peminjaman', 'Peminjaman::index');
    $routes->get('peminjaman/tambah', 'Peminjaman::tambah');
    $routes->post('peminjaman/simpan', 'Peminjaman::simpan');

    // Pengembalian
    $routes->get('pengembalian', 'Pengembalian::index');
    $routes->post('pengembalian/proses/(:num)', 'Pengembalian::proses/$1');
    $routes->get('pengembalian/laporan', 'Pengembalian::laporan');
});
```

---

## 7. PANDUAN PENYUSUNAN DIAGRAM (LAPORAN)

### 7.1 Use Case Diagram
Gunakan aplikasi seperti StarUML atau Draw.io.
- **Aktor**: Admin (Petugas Perpustakaan).
- **Garis Hubung**: Tarik garis dari aktor ke semua Use Case berikut.
- **Use Case (Bulatan Oval)**:
  1. `Login`: Masuk ke sistem.
  2. `Logout`: Keluar dari sistem.
  3. `Dashboard`: Melihat statistik ringkas.
  4. `Manajemen Buku`: Tambah, edit, hapus data buku.
  5. `Manajemen Anggota`: Tambah, edit, hapus data anggota.
  6. `Peminjaman Buku`: Proses pencatatan peminjaman.
  7. `Pengembalian Buku`: Konfirmasi buku kembali & update stok.
  8. `Laporan Transaksi`: Lihat/Cetak laporan peminjaman.
  9. `Manajemen Profil`: Ubah data diri & password admin.

### 7.2 Entity Relationship Diagram (ERD)
Gunakan notasi Crow's Foot (kaki gagak) untuk relasi.
- **Entitas `users`**: Atribut (`id` PK, `nama`, `username`, `password`, `role`).
- **Entitas `anggota`**: Atribut (`id` PK, `kode_anggota`, `nama`, `jenis_anggota`, `no_hp`, `status`).
- **Entitas `buku`**: Atribut (`id` PK, `kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `stok`, `stok_tersedia`, `cover`, `deskripsi`).
- **Entitas `peminjaman`**: Atribut (`id` PK, `kode_pinjam`, `anggota_id` FK, `buku_id` FK, `jumlah`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `status`, `petugas_id` FK, `catatan`).
- **Relasi (Hubungan)**:
  - `users` ke `peminjaman`: One-to-Many (Garis 1 ke N). Satu user (petugas) bisa mencatat banyak peminjaman.
  - `anggota` ke `peminjaman`: One-to-Many (Garis 1 ke N). Satu anggota bisa melakukan banyak transaksi peminjaman.
  - `buku` ke `peminjaman`: One-to-Many (Garis 1 ke N). Satu buku bisa dipinjam dalam banyak transaksi peminjaman.

### 7.3 Flowchart Proses Peminjaman
1. **Terminal (Mulai)**: Start.
2. **Input (Data Peminjaman)**: Admin pilih anggota, buku, jumlah, dan tanggal.
3. **Decision (Cek Stok)**: Apakah `stok_tersedia` >= `jumlah`?
   - **Tidak**: Tampilkan pesan "Stok Tidak Cukup", kembali ke input.
   - **Ya**: Lanjut ke proses simpan.
4. **Process (Simpan)**: Simpan data ke tabel `peminjaman`.
5. **Process (Update Stok)**: Kurangi `stok_tersedia` di tabel `buku`.
6. **Output (Berhasil)**: Tampilkan pesan sukses.
7. **Terminal (Selesai)**: End.

### 7.4 Flowchart Proses Pengembalian
1. **Terminal (Mulai)**: Start.
2. **Process (Pilih Data)**: Admin memilih transaksi yang akan dikembalikan.
3. **Process (Simpan)**: Update `tgl_dikembalikan` dan ubah status menjadi `dikembalikan`.
4. **Process (Update Stok)**: Tambah `stok_tersedia` di tabel `buku` sesuai jumlah yang dikembalikan.
5. **Output (Berhasil)**: Tampilkan pesan sukses.
6. **Terminal (Selesai)**: End.

---

## 8. ATURAN CODING

### Controller
- Selalu validasi input dengan `$this->validate()`
- Gunakan `session()->setFlashdata()` untuk pesan sukses/error
- Proteksi semua route admin dengan `AuthFilter`

### Model
- Gunakan `$allowedFields` untuk mass assignment protection
- Gunakan `$validationRules` di dalam model
- Selalu gunakan `$useTimestamps = true`

### View
- Layout utama di `Views/layouts/main.php`
- Gunakan Bootstrap 5 komponen: card, table, modal, alert
- Sidebar navigasi sesuai menu: Dashboard, Buku, Anggota, Peminjaman, Pengembalian, Laporan

### Keamanan
- Password di-hash dengan `password_hash()` (bcrypt)
- Session menggunakan CI4 native session
- Filter CSRF aktif untuk semua form POST
- Upload file validasi: hanya jpg/png, max 2MB

---

## 9. INSTRUKSI UNTUK CLAUDE CODE

Ketika membantu proyek ini:
1. **Selalu gunakan CI4 pattern** — MVC strict, jangan campur logika di View
2. **Gunakan nama Bahasa Indonesia** untuk variabel dan fungsi yang berkaitan dengan domain (misal: `$dataBuku`, `$anggotaId`, `tanggalPinjam`)
3. **Sertakan komentar** dalam Bahasa Indonesia
4. **Setiap controller** wajib ada validasi input sebelum menyimpan ke database
5. **Konsisten** dengan struktur folder di bagian 5
6. Jika diminta buat fitur baru, **tanyakan dulu** apakah perlu migrasi database
7. **Jangan tambah fitur denda** — sekolah tidak menerapkan denda keterlambatan
8. **Jangan tambah role superadmin** — hanya ada satu role yaitu `admin`

---

## 10. PERINTAH YANG SERING DIPAKAI

```bash
# Jalankan server CI4 (alternatif XAMPP)
php spark serve

# Buat controller baru
php spark make:controller NamaController

# Buat model baru
php spark make:model NamaModel

# Buat migration
php spark make:migration NamaMigration

# Jalankan migration
php spark migrate

# Rollback migration
php spark migrate:rollback
```

---

*Skill ini dibuat untuk Capstone Project UT — SMKN 1 Selakau Timur*
*Update terakhir: April 2026*
