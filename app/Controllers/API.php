<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class API extends ResourceController
{
    use ResponseTrait;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $uid = $request['data'];
        $token = $request['key'];
        if (isset($uid) && isset($token)) {
            $data = $this->db->query('SELECT * FROM tb_entry')->getFirstRow();
            if (!empty($data) && $data->state == 1) {
                $query = $this->db->query("UPDATE tb_entry SET uid = '$uid' WHERE state = 1");
                if ($query) {
                    $data = [
                        'error' => 200,
                        'result' => 'add user',
                        'message' => 'TAMBAH USER OK',
                        'access' => 1
                    ];
                } else {
                    $data = [
                        'error' => 500,
                        'result' => 'add user',
                        'message' => 'COBA LAGI',
                        'access' => 1
                    ];
                }
                return $this->respond($data, $data['error']);
            } else {
                return $this->loging($uid, $token);
            }
        } else {
            $response = [
                'error' => 500,
                'message' => 'REQUEST INVALID'
            ];

            return $this->respond($response, 500);
        }
    }

    public function loging($uid, $token)
    {
        $data = count($this->db->query("SELECT * FROM tb_user WHERE uid = '$uid' AND block = '0'")->getResultArray());
        $time = date('Y-m-d H:i:s');
        $response = [
            'error' => 500,
            'message' => 'Tested Request'
        ];
        if ($data > 0) {
            $this->db->query("INSERT INTO tb_log VALUES ('$uid', '$token', '$time', '0')");
            $response = [
                'error' => 200,
                'result' => 'access door lock',
                'message' => 'AKSES DITERIMA',
                'uid' => $uid,
                'access' => 0
            ];
        } else {
            $this->db->query("INSERT INTO tb_log VALUES ('$uid', '$token', '$time', '1')");
            $response = [
                'error' => 200,
                'result' => 'access door lock',
                'message' => 'AKSES DITOLAK',
                'uid' => $uid,
                'access' => 1
            ];
        }

        return $this->respond($response, 200);
    }

    public function settings()
    {
        $token = $this->request->getPost('token');
        if (isset($token)) {
            $data = $this->db->query("SELECT * FROM tb_mcu WHERE token = '$token'")->getFirstRow();
            $value = [
                'name' => $data->nama_kontroller,
                'type' => $data->type,
                'delay' => $data->delay,
                'keypad' => $data->keypad_password,
                'token' => $data->token,
            ];
            if (empty($data) || empty($value)) {
                $response = [
                    'error' => 500,
                    'result' => 'AMBIL PENGATURAN',
                    'data' => null
                ];
            } else {
                $response = [
                    'error' => 200,
                    'result' => 'AMBIL PENGATURAN',
                    'data' => $value
                ];
            }

            return $this->respond($response, 200);
        } else {
            $response = [
                'error' => 400,
                'result' => 'TOKEN TIDAK DITEMUKAN'
            ];

            return $this->respond($response, 200);
        }
    }

    public function delete_entries()
    {
        $this->db->query("DELETE FROM tb_entry");
        return true;
    }
}
