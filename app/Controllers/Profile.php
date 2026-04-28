<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Profil',
            'uri'   => 'profile',
            'user'  => $this->userModel->find(session()->get('user_id')),
        ];

        return view('profile/index', $data);
    }

    public function update()
    {
        $id = session()->get('user_id');
        $user = $this->userModel->find($id);

        $rules = [
            'nama'     => 'required',
            'username' => "required|is_unique[users.username,id,{$id}]",
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[5]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Cek kembali inputan Anda.');
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);

        // Update session
        session()->set('nama', $data['nama']);

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diupdate.');
    }
}
