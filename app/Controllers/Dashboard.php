<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $anggotaModel = new AnggotaModel();
        $pinjamModel = new PeminjamanModel();

        $data = [
            'title' => 'Dashboard',
            'uri'   => 'dashboard',
            'total_buku'    => $bukuModel->countAll(),
            'total_anggota' => $anggotaModel->countAll(),
            'pinjam_aktif'  => $pinjamModel->where('status', 'dipinjam')->countAllResults(),
            'terlambat'     => $pinjamModel->where('status', 'terlambat')->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}
