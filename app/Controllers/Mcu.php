<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\McuModel;
use App\Models\UserModel;
use App\Models\ListAccessModel;

class Mcu extends BaseController
{
    protected $mcu;
    protected $user;
    protected $list_access;

    public function __construct()
    {
        $this->mcu = new McuModel();
        $this->user = new UserModel();
        $this->list_access = new ListAccessModel();
    }

    public function controller()
    {
        $title = 'Pengaturan Kontroler Pintu';
        $mcu    = $this->mcu->findAll();
        return view('admin/controller', compact('title', 'mcu'));
    }

    public function save_controller()
    {
        $data = $this->request->getPost();
        $data['delay'] = $data['delay'] * 1000;
        $this->mcu->insert($data);
        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('/admin/settings/controller');
    }

    public function edit_controller()
    {
        $data = $this->request->getPost();
        $data['delay'] = $data['delay'] * 1000;
        $this->mcu->update($data['token'], $data);
        $this->session->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/admin/settings/controller');
    }

    public function delete_controller($token)
    {
        $this->mcu->delete($token);
        $this->session->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/admin/settings/controller');
    }

    public function user_block()
    {
        $title = 'Pengaturan Blok User';
        $user    = $this->user->findAll();
        $access  = $this->mcu->findAll();
        foreach ($user as $i => $u) {
            $u['access'] = [];
            $list_access = $this->list_access->where('uid', $u['uid'])->findAll();
            foreach ($list_access as $a) {
                array_push($u['access'], $a['token']);
            }
            $user[$i] = $u;
        }

        return view('admin/user_block', compact('title', 'user', 'access'));
    }

    public function blocking_user($uid, $status)
    {
        $status = $status == 'block' ? '1' : '0';
        $this->user->update($uid, ['block' => $status]);
        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('/admin/settings/user_block');
    }

    public function save_access_user()
    {
        $uid = $this->request->getPost('uid');
        $access = $this->request->getPost('access');
        $this->list_access->where('uid', $uid)->delete();
        if ($access == null) {
            $this->session->setFlashdata('error', 'Anda harus memilih setidaknya 1 akses');
            return redirect()->to('/admin/settings/user_block');
        }
        foreach ($access as $a) {
            $this->list_access->insert(['uid' => $uid, 'token' => $a]);
        }
        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('/admin/settings/user_block');
    }
}
