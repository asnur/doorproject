<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class API extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $uid = $this->request->getPost('uid');
        $token = $this->request->getPost('token');
        if (isset($uid) && isset($token)) {
            $data = $this->db->query('SELECT * FROM tb_entry')->getFirstRow();
            if (!empty($data) && $data->state == 1) {
                $query = $this->db->query("UPDATE tb_entry SET uid = '$uid' WHERE state = 1");
                if ($query) {
                    $data = [
                        'error' => 200,
                        'result' => 'add user',
                        'message' => 'ADD USER OK',
                        'access' => 1
                    ];
                } else {
                    $data = [
                        'error' => 500,
                        'result' => 'add user',
                        'message' => 'SERVICE BUSY',
                        'access' => 1
                    ];
                }
                return json_encode($data);
            } else {
                $this->loging($uid, $token);
            }
        } else {
            $response = [
                'error' => 500,
                'message' => 'REQUEST NOT VALID'
            ];

            return json_encode($response);
        }
    }

    public function loging($uid, $token)
    {
        $data = count($this->db->query("SELECT * FROM tb_user WHERE uid = '$uid' AND block = '0'")->getResultArray());
        $time = date('Y-m-d H:i:s');
        if ($data > 0) {
            $this->db->query("INSERT INTO tb_log VALUES ('$uid', '$token', '$time', '0')");
            $response = [
                'error' => 200,
                'resut' => 'access door lock',
                'message' => 'ACCESS ALLOWED',
                'uid' => $uid,
                'access' => 0
            ];
        } else {
            $this->db->query("INSERT INTO tb_log VALUES ('$uid', '$token', '$time', '1')");
            $response = [
                'error' => 200,
                'resut' => 'access door lock',
                'message' => 'ACCESS DENIED',
                'uid' => $uid,
                'access' => 1
            ];
        }

        return json_encode($response);
    }

    public function settings()
    {
        $token = $this->request->getPost('token');
        if (isset($token)) {
            $data = $this->db->query("SELECT * FROM tb_entry WHERE token = '$token'")->getFirstRow();
            $value = [
                'name' => $data->name,
                'type' => $data->type,
                'delay' => $data->delay,
                'keypad' => $data->keypad_password,
                'token' => $data->token,
            ];
            if (empty($data) || empty($value)) {
                $response = [
                    'error' => 500,
                    'result' => 'GET SETTINGS',
                    'data' => null
                ];
            } else {
                $response = [
                    'error' => 200,
                    'result' => 'GET SETTINGS',
                    'data' => $value
                ];
            }

            return json_encode($response);
        } else {
            $response = [
                'error' => 400,
                'result' => 'TOKEN NOT FOUND'
            ];

            return json_encode($response);
        }
    }
}
