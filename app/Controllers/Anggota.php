<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Data Anggota',
            'uri'     => 'anggota',
            'anggota' => $this->anggotaModel->findAll(),
        ];

        return view('anggota/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Anggota',
            'uri'   => 'anggota',
        ];

        return view('anggota/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode_anggota'  => [
                'rules'  => 'required|is_unique[anggota.kode_anggota]',
                'errors' => [
                    'required'  => 'Kode anggota (NISN/NIP) harus diisi.',
                    'is_unique' => 'NISN/NIP ini sudah terdaftar sebagai anggota lain.'
                ]
            ],
            'nama'          => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nama lengkap harus diisi.']
            ],
            'jenis_anggota' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Silakan pilih jenis anggota.']
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $this->anggotaModel->save([
            'kode_anggota'  => $this->request->getPost('kode_anggota'),
            'nama'          => $this->request->getPost('nama'),
            'jenis_anggota' => $this->request->getPost('jenis_anggota'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'status'        => 'aktif',
        ]);

        return redirect()->to('/admin/anggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'   => 'Edit Anggota',
            'uri'     => 'anggota',
            'anggota' => $this->anggotaModel->find($id),
        ];

        return view('anggota/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'kode_anggota'  => [
                'rules'  => "required|is_unique[anggota.kode_anggota,id,{$id}]",
                'errors' => [
                    'required'  => 'Kode anggota harus diisi.',
                    'is_unique' => 'NISN/NIP ini sudah digunakan oleh anggota lain.'
                ]
            ],
            'nama'          => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nama harus diisi.']
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $this->anggotaModel->update($id, [
            'kode_anggota'  => $this->request->getPost('kode_anggota'),
            'nama'          => $this->request->getPost('nama'),
            'jenis_anggota' => $this->request->getPost('jenis_anggota'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/anggota')->with('success', 'Anggota berhasil diupdate.');
    }

    public function hapus($id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/admin/anggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
