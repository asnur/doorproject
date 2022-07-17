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
        $title = 'Accepted Log';
        $log   = $this->db->query("SELECT l.uid, l.token, u.username, m.name as access, l.date_time FROM tb_log l RIGHT JOIN tb_user u ON l.uid=u.uid JOIN tb_mcu m ON m.token=l.token  WHERE l.log_status = 1")->getResultArray();
        // dd($log);
        return view('admin/accepted_log', compact('title', 'log'));
    }

    public function rejected_log()
    {
        $title = 'Rejected Log';
        $log   = $this->db->query("SELECT l.uid, l.token, u.username, m.name as access, l.date_time FROM tb_log l RIGHT JOIN tb_user u ON l.uid=u.uid JOIN tb_mcu m ON m.token=l.token  WHERE l.log_status = 0")->getResultArray();
        // dd($log);
        return view('admin/rejected_log', compact('title', 'log'));
    }
}
