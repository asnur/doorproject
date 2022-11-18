<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];

        $model = new \App\Models\LoginModel();
        $user  = $model->where('username', $data['username'])->where('password', md5($data['password']))->first();

        if ($user) {
            $this->session->set('user', $user);
            $this->session->set('logged_in', true);
            $this->session->setFlashdata('success', 'Login Berhasil');
            return redirect()->to('/dashboard');
        }

        $this->session->setFlashdata('error', 'Username atau Password yang anda masukkan salah!');
        return redirect()->to('/login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
