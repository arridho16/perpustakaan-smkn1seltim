<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\AnggotaModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $bukuModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Riwayat Peminjaman',
            'uri'        => 'peminjaman',
            'peminjaman' => $this->peminjamanModel->getPeminjamanWithDetail(),
        ];

        return view('peminjaman/index', $data);
    }

    public function tambah()
    {
        // Generate kode_pinjam: PJM-YYYYMMDD-001
        $today = date('Ymd');
        $lastPinjam = $this->peminjamanModel->like('kode_pinjam', "PJM-{$today}-")->orderBy('id', 'DESC')->first();
        
        $nextNum = 1;
        if ($lastPinjam) {
            $lastNum = (int) substr($lastPinjam['kode_pinjam'], -3);
            $nextNum = $lastNum + 1;
        }
        $kodePinjam = "PJM-{$today}-" . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        $data = [
            'title'       => 'Input Peminjaman',
            'uri'         => 'peminjaman',
            'kode_pinjam' => $kodePinjam,
            'buku'        => $this->bukuModel->where('stok_tersedia >', 0)->findAll(),
            'anggota'     => $this->anggotaModel->where('status', 'aktif')->findAll(),
        ];

        return view('peminjaman/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'anggota_id'  => 'required',
            'buku_id'     => 'required',
            'jumlah'      => 'required|numeric|greater_than[0]',
            'tgl_pinjam'  => 'required|valid_date',
            'tgl_kembali' => 'required|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali data yang Anda masukkan.');
        }

        $bukuId = $this->request->getPost('buku_id');
        $jumlahPinjam = $this->request->getPost('jumlah');
        $buku = $this->bukuModel->find($bukuId);

        if ($buku['stok_tersedia'] < $jumlahPinjam) {
            return redirect()->back()->withInput()->with('error', "Stok buku tidak cukup. Tersedia: {$buku['stok_tersedia']}");
        }

        // Simpan peminjaman
        $this->peminjamanModel->save([
            'kode_pinjam' => $this->request->getPost('kode_pinjam'),
            'anggota_id'  => $this->request->getPost('anggota_id'),
            'buku_id'     => $bukuId,
            'jumlah'      => $jumlahPinjam,
            'tgl_pinjam'  => $this->request->getPost('tgl_pinjam'),
            'tgl_kembali' => $this->request->getPost('tgl_kembali'),
            'status'      => 'dipinjam',
            'petugas_id'  => session()->get('user_id'),
            'catatan'     => $this->request->getPost('catatan'),
        ]);

        // Kurangi stok_tersedia
        $this->bukuModel->update($bukuId, [
            'stok_tersedia' => $buku['stok_tersedia'] - $jumlahPinjam
        ]);

        return redirect()->to('/admin/peminjaman')->with('success', 'Peminjaman berhasil dicatat.');
    }
}
