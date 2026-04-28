<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'   => $user['id'],
                    'nama'      => $user['nama'],
                    'username'  => $user['username'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ];
                session()->set($sessionData);
                return redirect()->to('/admin/dashboard');
            } else {
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
