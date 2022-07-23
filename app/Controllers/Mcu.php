<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\McuModel;

class Mcu extends BaseController
{
    protected $mcu;

    public function __construct()
    {
        $this->mcu = new McuModel();
    }

    public function controller()
    {
        $title = 'Controller';
        $mcu    = $this->mcu->findAll();
        return view('admin/controller', compact('title', 'mcu'));
    }

    public function save_controller()
    {
        $data = $this->request->getPost();
        $this->mcu->insert($data);
        $this->session->setFlashdata('success', 'Data has been saved');
        return redirect()->to('/admin/settings/controller');
    }

    public function edit_controller()
    {
        $data = $this->request->getPost();
        $this->mcu->update($data['token'], $data);
        $this->session->setFlashdata('success', 'Data has been saved');
        return redirect()->to('/admin/settings/controller');
    }

    public function delete_controller($token)
    {
        $this->mcu->delete($token);
        $this->session->setFlashdata('success', 'Data has been deleted');
        return redirect()->to('/admin/settings/controller');
    }
}
