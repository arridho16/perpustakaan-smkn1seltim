<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key check sementara
        if ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = OFF;');
        } else {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        }

        // Truncate semua tabel
        $this->db->table('peminjaman')->truncate();
        $this->db->table('anggota')->truncate();
        $this->db->table('buku')->truncate();
        $this->db->table('users')->truncate();

        // Aktifkan kembali foreign key check
        if ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = ON;');
        } else {
            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Jalankan Seeder
        $this->call('AdminSeeder');
        $this->call('AnggotaSeeder');
        $this->call('BukuSeeder');
    }
}
