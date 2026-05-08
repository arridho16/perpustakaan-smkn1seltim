<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $anggota = $this->db->table('anggota')->get()->getResultArray();
        $buku = $this->db->table('buku')->get()->getResultArray();
        $admin = $this->db->table('users')->where('username', 'admin')->get()->getRowArray();

        if (empty($anggota) || empty($buku) || empty($admin)) {
            return;
        }

        $data = [];
        foreach ($anggota as $i => $a) {
            $b = $buku[array_rand($buku)];
            
            // Tanggal pinjam acak dalam 7 hari terakhir
            $days_ago = rand(0, 7);
            $tgl_pinjam = date('Y-m-d', strtotime("-$days_ago days"));
            
            if ($a['jenis_anggota'] == 'siswa') {
                // Logika Siswa/Kelas: Jumlah banyak, kembali hari yang sama
                $jumlah = rand(20, 35);
                $tgl_kembali = $tgl_pinjam; // Harus kembali di hari yang sama
                
                // Peluang 80% sudah dikembalikan (karena durasi cuma sehari)
                $status = ($days_ago > 0 && rand(1, 10) > 2) ? 'dikembalikan' : 'dipinjam';
                $tgl_dikembalikan = ($status == 'dikembalikan') ? $tgl_pinjam : null;
            } else {
                // Logika Guru: Jumlah sedikit, durasi 7 hari
                $jumlah = rand(1, 2);
                $tgl_kembali = date('Y-m-d', strtotime("$tgl_pinjam +7 days"));
                
                $status = ($days_ago > 4 && rand(1, 10) > 5) ? 'dikembalikan' : 'dipinjam';
                $tgl_dikembalikan = ($status == 'dikembalikan') ? date('Y-m-d', strtotime("$tgl_pinjam +" . rand(1, 4) . " days")) : null;
            }

            $data[] = [
                'kode_pinjam' => 'TRX-' . date('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'anggota_id'  => $a['id'],
                'buku_id'     => $b['id'],
                'jumlah'      => $jumlah,
                'tgl_pinjam'  => $tgl_pinjam,
                'tgl_kembali' => $tgl_kembali,
                'tgl_dikembalikan' => $tgl_dikembalikan,
                'status'      => $status,
                'petugas_id'  => $admin['id'],
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
            
            // Update stok buku jika masih dipinjam
            if ($status == 'dipinjam') {
                $this->db->table('buku')->where('id', $b['id'])->decrement('stok_tersedia', $jumlah);
            }
        }

        $this->db->table('peminjaman')->insertBatch($data);
    }
}
