<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key check sementara untuk truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate semua tabel
        $this->db->table('peminjaman')->truncate();
        $this->db->table('anggota')->truncate();
        $this->db->table('buku')->truncate();
        $this->db->table('users')->truncate();

        // Aktifkan kembali foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

        // Jalankan Seeder
        $this->call('AdminSeeder');
        $this->call('AnggotaSeeder');
        $this->call('BukuSeeder');
    }
}
