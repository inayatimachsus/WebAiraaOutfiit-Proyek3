<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{
    public function index_get()
    {
        $username = $this->get('username');
        $password = $this->get('password');

        $result = $this->db->where('username', $username)
            ->where('password', $password)
            ->limit(1)
            ->get('user');
        if ($result->num_rows() > 0) {
            $data = $result->row();
        } else {
            $data = null;
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data not found!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = [
            'id'    => '',
            'nama'  => $this->post('nama'),
            'email'  => $this->post('email'),
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'username'  => $this->post('username'),
            'password'  => $this->post('password'),
            'role'  => 2,
            'status' => 'Tidak Aktif'
        ];

        if ($this->auth_model->registrasi($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new user has been created!'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new user!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $where = array(
            'email' => $this->put('email')
        );

        $data = [
            'status' => $this->put('status')
        ];

        if ($this->member_model->terima($where, $data, 'user') > 0) {
            $this->response([
                'status' => true,
                'message' => 'user has been activated!'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to activate user!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
