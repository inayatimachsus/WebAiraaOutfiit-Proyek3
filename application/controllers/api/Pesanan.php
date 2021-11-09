<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pesanan extends REST_Controller
{
    public function index_post()
    {
        $id_invoice = $this->post('id_invoice');
        $id_course = $this->post('id_course');
        $jumlah = $this->post('jumlah');

        $data = [
            'id_invoice' => $id_invoice,
            'id_course' => $id_course,
            'jumlah' => $jumlah,
        ];

        if ($this->db->insert('pesanan', $data)) {
            $this->response([
                'status' => true,
                'message' => 'success'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
