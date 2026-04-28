# Sistem Informasi Perpustakaan - SMKN 1 Selakau Timur

Sistem Informasi Manajemen Perpustakaan berbasis web yang dirancang untuk mendigitalisasi proses pencatatan peminjaman dan pengembalian buku di SMKN 1 Selakau Timur. Sistem ini dibangun menggunakan framework CodeIgniter 4 dengan antarmuka yang responsif menggunakan Bootstrap 5.

## 🚀 Fitur Utama

- **Dashboard Statistik**: Visualisasi data total buku, anggota, peminjaman aktif, dan buku terlambat.
- **Manajemen Buku**: Pengelolaan data buku (CRUD) beserta stok dan sampul buku.
- **Manajemen Anggota**: Pengelolaan data siswa dan guru dalam satu sistem.
- **Transaksi Peminjaman**: Pencatatan peminjaman buku dengan pengecekan stok otomatis.
- **Transaksi Pengembalian**: Proses pengembalian buku yang terintegrasi dengan pembaruan stok.
- **Laporan Transaksi**: Cetak laporan peminjaman dan pengembalian per periode.
- **Manajemen Profil**: Pengaturan akun admin (Nama, Username, Password).

## 🛠️ Tech Stack

- **Backend**: PHP 8.2 (CodeIgniter 4.x)
- **Frontend**: Bootstrap 5.3, Vanilla JavaScript
- **Database**: MySQL / MariaDB
- **Server**: XAMPP 8.2.12 (Apache)

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lingkungan lokal:

1. **Clone Repository**
   ```bash
   git clone https://github.com/arridho16/perpustakaan-smkn1seltim.git
   cd perpustakaan-smkn1seltim
   ```

2. **Instal Dependensi**
   Pastikan Anda sudah menginstal [Composer](https://getcomposer.org/).
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   - Buat database baru di phpMyAdmin dengan nama `perpustakaan`.
   - Import file SQL (jika tersedia) atau jalankan migrasi/seeder:
     ```bash
     php spark migrate
     php spark db:seed DatabaseSeeder
     ```

4. **Konfigurasi Environment**
   - Rename file `env` menjadi `.env`.
   - Sesuaikan pengaturan database:
     ```env
     database.default.hostname = localhost
     database.default.database = perpustakaan
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```

5. **Jalankan Aplikasi**
   ```bash
   php spark serve
   ```
   Buka browser dan akses `http://localhost:8080`.

## 🔐 Akun Default (Admin)

- **Username**: `admin`
- **Password**: `admin123`