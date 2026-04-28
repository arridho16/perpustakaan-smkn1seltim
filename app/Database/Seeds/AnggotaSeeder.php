<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_anggota'  => 'SIS-001',
                'nama'          => 'Andi Pratama',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567890',
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota'  => 'SIS-002',
                'nama'          => 'Budi Santoso',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567891',
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota'  => 'SIS-003',
                'nama'          => 'Citra Lestari',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567892',
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota'  => 'GRU-001',
                'nama'          => 'Bp. Hendra Wijaya',
                'jenis_anggota' => 'guru',
                'no_hp'         => '085234567801',
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_anggota'  => 'GRU-002',
                'nama'          => 'Ibu Maya Sari',
                'jenis_anggota' => 'guru',
                'no_hp'         => '085234567802',
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('anggota')->insertBatch($data);
    }
}
