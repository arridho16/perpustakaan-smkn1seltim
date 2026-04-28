<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_buku'    => 'BK-001',
                'judul'        => 'Matematika Kelas X',
                'pengarang'    => 'Kemdikbud',
                'penerbit'     => 'Erlangga',
                'tahun_terbit' => '2021',
                'stok'         => 40,
                'stok_tersedia'=> 40,
                'cover'        => 'default.jpg',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku'    => 'BK-002',
                'judul'        => 'Bahasa Indonesia Kelas XI',
                'pengarang'    => 'Kemdikbud',
                'penerbit'     => 'Balai Pustaka',
                'tahun_terbit' => '2022',
                'stok'         => 35,
                'stok_tersedia'=> 35,
                'cover'        => 'default.jpg',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku'    => 'BK-003',
                'judul'        => 'Pemrograman Dasar SMK',
                'pengarang'    => 'Andi Publisher',
                'penerbit'     => 'Informatika',
                'tahun_terbit' => '2023',
                'stok'         => 25,
                'stok_tersedia'=> 25,
                'cover'        => 'default.jpg',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'kode_buku'    => 'BK-004',
                'judul'        => 'Sejarah Indonesia',
                'pengarang'    => 'Yudhistira',
                'penerbit'     => 'Yudhistira',
                'tahun_terbit' => '2020',
                'stok'         => 30,
                'stok_tersedia'=> 30,
                'cover'        => 'default.jpg',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('buku')->insertBatch($data);
    }
}
