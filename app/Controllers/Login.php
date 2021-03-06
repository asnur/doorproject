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
        $user  = $model->where('username', $data['username'])->where('password', $data['password'])->first();

        if ($user) {
            $this->session->set('user', $user);
            $this->session->set('logged_in', true);
            $this->session->setFlashdata('success', 'Login Successful');
            return redirect()->to('/admin');
        }

        $this->session->setFlashdata('error', 'Username or Password is incorrect');
        return redirect()->to('/login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
