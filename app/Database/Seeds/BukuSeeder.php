<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul'         => 'Matematika Kelas XII',
                'pengarang'     => 'Kemdikbud',
                'penerbit'      => 'Pusat Perbukuan',
                'tahun_terbit'  => 2022,
                'stok'          => 200,
                'stok_tersedia' => 200,
                'kode_buku'     => 'MTK-XII-001',
                'deskripsi'     => 'Buku panduan matematika tingkat akhir sekolah menengah.',
                'cover'         => 'default.jpg'
            ],
            [
                'judul'         => 'Pemrograman Web dengan PHP & CI4',
                'pengarang'     => 'Budi Raharjo',
                'penerbit'      => 'Informatika',
                'tahun_terbit'  => 2023,
                'stok'          => 100,
                'stok_tersedia' => 100,
                'kode_buku'     => 'PROG-001',
                'deskripsi'     => 'Panduan lengkap membangun aplikasi web modern.',
                'cover'         => 'default.jpg'
            ],
            [
                'judul'         => 'Laskar Pelangi',
                'pengarang'     => 'Andrea Hirata',
                'penerbit'      => 'Bentang Pustaka',
                'tahun_terbit'  => 2005,
                'stok'          => 50,
                'stok_tersedia' => 50,
                'kode_buku'     => 'FIK-001',
                'deskripsi'     => 'Novel inspiratif tentang perjuangan anak sekolah di Belitung.',
                'cover'         => 'default.jpg'
            ],
            [
                'judul'         => 'Bahasa Inggris: English for SMK',
                'pengarang'     => 'Siti Nurhayati',
                'penerbit'      => 'Erlangga',
                'tahun_terbit'  => 2021,
                'stok'          => 150,
                'stok_tersedia' => 150,
                'kode_buku'     => 'ENG-SMK-001',
                'deskripsi'     => 'Materi bahasa Inggris khusus untuk siswa kejuruan.',
                'cover'         => 'default.jpg'
            ],
            [
                'judul'         => 'Dasar-Dasar Teknik Mesin',
                'pengarang'     => 'Ir. Suharyanto',
                'penerbit'      => 'Andi Offset',
                'tahun_terbit'  => 2020,
                'stok'          => 120,
                'stok_tersedia' => 120,
                'kode_buku'     => 'TM-001',
                'deskripsi'     => 'Konsep dasar permesinan dan otomotif.',
                'cover'         => 'default.jpg'
            ],
            [
                'judul'         => 'Bumi',
                'pengarang'     => 'Tere Liye',
                'penerbit'      => 'Gramedia',
                'tahun_terbit'  => 2014,
                'stok'          => 80,
                'stok_tersedia' => 80,
                'kode_buku'     => 'FIK-002',
                'deskripsi'     => 'Novel petualangan dunia paralel yang sangat populer.',
                'cover'         => 'default.jpg'
            ],
        ];

        foreach ($data as $b) {
            $this->db->table('buku')->insert($b);
        }
    }
}
