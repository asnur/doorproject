<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserModel;
use App\Models\EntryModel;

class Management extends BaseController
{
    protected $admin;
    protected $user;
    protected $entry;
    protected $db;

    public function __construct()
    {
        $this->admin = new LoginModel();
        $this->user  = new UserModel();
        $this->entry = new EntryModel();
        $this->db    = \Config\Database::connect();
    }

    public function admin_user()
    {
        $title = 'Manajemen Admin';
        $user  = $this->admin->findAll();
        return view('admin/admin_user', compact('title', 'user'));
    }

    public function save_admin_user()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password'))
        ];

        if (!$this->validate([
            'username' => 'required|min_length[5]',
            'password' => 'required|min_length[5]'
        ])) {
            $this->session->setFlashdata('error', 'Username dan Password minimal 5 karakter');
            return redirect()->route('admin_user');
        } else {
            $this->admin->insert($data);
            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->route('admin_user');
        }
    }

    public function edit_admin_user()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password'))
        ];

        if (!$this->validate([
            'username' => 'required|min_length[5]',
            'password' => 'required|min_length[5]'
        ])) {
            $this->session->setFlashdata('error', 'Username dan Password minimal 5 karakter');
            return redirect()->route('admin_user');
        } else {
            $this->admin->update($data['id'], $data);
            $this->session->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->route('admin_user');
        }
    }

    public function delete_admin_user($id)
    {
        $this->admin->delete($id);
        $this->session->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->route('admin_user');
    }

    public function set_state()
    {
        $state = $this->db->query("DELETE FROM tb_entry");
        if ($state) {
            $this->db->query("INSERT INTO tb_entry (state, uid) VALUES (1, '')");
        }
    }

    public function guest_user()
    {
        $title = 'Manajemen User';
        $user  = $this->user->findAll();
        $this->set_state();

        return view('admin/guest_user', compact('title', 'user'));
    }

    public function save_guest_user()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'uid' => $this->request->getPost('uid')
        ];
        $data['block'] = 1;

        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'uid' => 'required'
        ])) {
            $this->session->setFlashdata('error', 'Nama atau UID harus diisi');
            return redirect()->route('guest_user');
        } else {
            $this->user->insert($data);
            $this->db->query("DELETE FROM tb_entry");
            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->route('guest_user');
        }
    }

    public function get_entries()
    {
        $uid = $this->entry->select('uid')->first();
        return json_encode($uid['uid']);
    }

    public function edit_guest_user()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'uid' => $this->request->getPost('uid')
        ];

        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'uid' => 'required'
        ])) {
            $this->session->setFlashdata('error', 'Nama atau UID harus diisi');
            return redirect()->route('guest_user');
        } else {
            $this->user->update($data['uid'], $data);
            $this->session->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->route('guest_user');
        }
    }

    public function delete_guest_user($id)
    {
        $this->user->delete($id);
        $this->session->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->route('guest_user');
    }
}
