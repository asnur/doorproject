<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;

class Management extends BaseController
{
    protected $admin;

    public function __construct()
    {
        $this->admin = new LoginModel();
    }

    public function admin_user()
    {
        $title = 'Admin User';
        $user  = $this->admin->findAll();
        return view('admin/admin_user', compact('title', 'user'));
    }

    public function save_admin_user()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];

        if (!$this->validate([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]'
        ])) {
            $this->session->setFlashdata('error', 'Username or Password is Minimal 3 Character and Required');
            return redirect()->route('admin_user');
        } else {
            $this->admin->insert($data);
            $this->session->setFlashdata('success', 'Data has been saved');
            return redirect()->route('admin_user');
        }
    }

    public function edit_admin_user()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];

        if (!$this->validate([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]'
        ])) {
            $this->session->setFlashdata('error', 'Username or Password is Minimal 3 Character and Required');
            return redirect()->route('admin_user');
        } else {
            $this->admin->update($data['id'], $data);
            $this->session->setFlashdata('success', 'Data has been updated');
            return redirect()->route('admin_user');
        }
    }

    public function delete_admin_user($id)
    {
        $this->admin->delete($id);
        $this->session->setFlashdata('success', 'Data has been deleted');
        return redirect()->route('admin_user');
    }
}
