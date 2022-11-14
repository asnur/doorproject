<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Loging extends BaseController
{
    protected $log;
    protected $db;

    public function __construct()
    {
        $this->log = new LogModel();
        $this->db  = \Config\Database::connect();
    }

    public function accepted_log()
    {
        $title = 'Log Diterima';
        $log   = $this->db->query("SELECT l.uid, l.token, u.nama, m.nama_kontroller as access, l.waktu FROM tb_log l LEFT JOIN tb_user u ON l.uid=u.uid JOIN tb_mcu m ON m.token=l.token  WHERE l.log_status = 0 ORDER BY l.waktu DESC")->getResultArray();
        $access = $this->db->query("SELECT * FROM tb_mcu")->getResultArray();

        return view('admin/accepted_log', compact('title', 'log', 'access'));
    }

    public function rejected_log()
    {
        $title = 'Log Ditolak';
        $log   = $this->db->query("SELECT l.uid, l.token, u.nama, m.nama_kontroller as access, l.waktu FROM tb_log l LEFT JOIN tb_user u ON l.uid=u.uid JOIN tb_mcu m ON m.token=l.token  WHERE l.log_status = 1 ORDER BY l.waktu DESC")->getResultArray();
        $access = $this->db->query("SELECT * FROM tb_mcu")->getResultArray();

        return view('admin/rejected_log', compact('title', 'log', 'access'));
    }
}
