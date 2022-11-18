<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\LogModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $admin;
    protected $log;
    protected $user;

    public function __construct()
    {
        $this->admin = new LoginModel();
        $this->log   = new LogModel();
        $this->user  = new UserModel();
    }
    public function dashboard()
    {
        $admin = $this->admin->countAllResults();
        $log   = $this->log->countAllResults();
        $user  = $this->user->countAllResults();
        $title = 'Dashboard';

        return view('admin/dashboard', compact('admin', 'log', 'user', 'title'));
    }
}
