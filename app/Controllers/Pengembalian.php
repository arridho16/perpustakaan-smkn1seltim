<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;

class Pengembalian extends BaseController
{
    protected $peminjamanModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Pengembalian Buku',
            'uri'        => 'pengembalian',
            'peminjaman' => $this->peminjamanModel->whereIn('status', ['dipinjam', 'terlambat'])->getPeminjamanWithDetail(),
        ];

        return view('pengembalian/index', $data);
    }

    public function proses($id)
    {
        $pinjam = $this->peminjamanModel->find($id);
        
        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Update status peminjaman
        $this->peminjamanModel->update($id, [
            'tgl_dikembalikan' => date('Y-m-d'),
            'status'           => 'dikembalikan',
        ]);

        // Tambah stok_tersedia buku sesuai jumlah yang dipinjam
        $buku = $this->bukuModel->find($pinjam['buku_id']);
        $this->bukuModel->update($pinjam['buku_id'], [
            'stok_tersedia' => $buku['stok_tersedia'] + $pinjam['jumlah']
        ]);

        return redirect()->to('/admin/peminjaman')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function laporan()
    {
        $tgl_mulai = $this->request->getGet('tgl_mulai');
        $tgl_selesai = $this->request->getGet('tgl_selesai');

        $builder = $this->peminjamanModel->db->table('peminjaman');
        $builder->select('peminjaman.*, anggota.nama as nama_anggota, buku.judul as judul_buku, users.nama as nama_petugas');
        $builder->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $builder->join('buku', 'buku.id = peminjaman.buku_id');
        $builder->join('users', 'users.id = peminjaman.petugas_id');

        if ($tgl_mulai && $tgl_selesai) {
            $builder->where('tgl_pinjam >=', $tgl_mulai);
            $builder->where('tgl_pinjam <=', $tgl_selesai);
        }

        $laporan = $builder->orderBy('tgl_pinjam', 'DESC')->get()->getResultArray();

        $data = [
            'title'       => 'Laporan Transaksi',
            'uri'         => 'laporan',
            'laporan'     => $laporan,
            'tgl_mulai'   => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
        ];

        return view('pengembalian/laporan', $data);
    }
}
