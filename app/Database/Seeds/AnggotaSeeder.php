<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Data Kelas (Siswa kolektif)
            [
                'kode_anggota'  => 'KLS-XII-TKJA',
                'nama'          => 'Kelas XII TKJ A',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567800',
                'status'        => 'aktif'
            ],
            [
                'kode_anggota'  => 'KLS-XI-APAT',
                'nama'          => 'Kelas XI APAT',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567801',
                'status'        => 'aktif'
            ],
            [
                'kode_anggota'  => 'KLS-X-TBSM',
                'nama'          => 'Kelas X TBSM',
                'jenis_anggota' => 'siswa',
                'no_hp'         => '081234567802',
                'status'        => 'aktif'
            ],
            // Data Guru (Individu)
            [
                'kode_anggota'  => '197501012005011001',
                'nama'          => 'Budi Santoso, S.Pd',
                'jenis_anggota' => 'guru',
                'no_hp'         => '085245678912',
                'status'        => 'aktif'
            ],
            [
                'kode_anggota'  => '198805122015022003',
                'nama'          => 'Siti Aminah, S.Pd',
                'jenis_anggota' => 'guru',
                'no_hp'         => '082156789034',
                'status'        => 'aktif'
            ],
        ];

        foreach ($data as $a) {
            $this->db->table('anggota')->insert($a);
        }
    }
}
