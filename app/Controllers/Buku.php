<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'uri'   => 'buku',
            'buku'  => $this->bukuModel->getBuku(),
        ];

        return view('buku/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'    => 'Tambah Buku',
            'uri'      => 'buku',
        ];

        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode_buku' => 'required|is_unique[buku.kode_buku]',
            'judul'     => 'required',
            'stok'      => 'required|numeric',
            'cover'     => 'permit_empty|max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Cek kembali inputan Anda.');
        }

        $fileCover = $this->request->getFile('cover');
        $namaCover = 'default.jpg';

        if ($fileCover->getError() != 4) {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('uploads/covers', $namaCover);
        }

        $stok = $this->request->getPost('stok');

        $this->bukuModel->save([
            'kode_buku'    => $this->request->getPost('kode_buku'),
            'judul'        => $this->request->getPost('judul'),
            'pengarang'    => $this->request->getPost('pengarang'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $stok,
            'stok_tersedia'=> $stok,
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'cover'        => $namaCover,
        ]);

        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Buku',
            'uri'      => 'buku',
            'buku'     => $this->bukuModel->find($id),
        ];

        return view('buku/edit', $data);
    }

    public function update($id)
    {
        $bukuLama = $this->bukuModel->find($id);

        if (!$this->validate([
            'kode_buku' => "required|is_unique[buku.kode_buku,id,{$id}]",
            'judul'     => 'required',
            'stok'      => 'required|numeric',
            'cover'     => 'permit_empty|max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $fileCover = $this->request->getFile('cover');
        $namaCover = $bukuLama['cover'];

        if ($fileCover->getError() != 4) {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('uploads/covers', $namaCover);
            
            if ($bukuLama['cover'] != 'default.jpg' && file_exists('uploads/covers/' . $bukuLama['cover'])) {
                unlink('uploads/covers/' . $bukuLama['cover']);
            }
        }

        $stokBaru = $this->request->getPost('stok');
        $selisihStok = $stokBaru - $bukuLama['stok'];
        $stokTersediaBaru = $bukuLama['stok_tersedia'] + $selisihStok;

        $this->bukuModel->update($id, [
            'kode_buku'    => $this->request->getPost('kode_buku'),
            'judul'        => $this->request->getPost('judul'),
            'pengarang'    => $this->request->getPost('pengarang'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $stokBaru,
            'stok_tersedia'=> $stokTersediaBaru,
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'cover'        => $namaCover,
        ]);

        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil diupdate.');
    }

    public function hapus($id)
    {
        $buku = $this->bukuModel->find($id);
        if ($buku['cover'] != 'default.jpg' && file_exists('uploads/covers/' . $buku['cover'])) {
            unlink('uploads/covers/' . $buku['cover']);
        }

        $this->bukuModel->delete($id);
        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil dihapus.');
    }
}
