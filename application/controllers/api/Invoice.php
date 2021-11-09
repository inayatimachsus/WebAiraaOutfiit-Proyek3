<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Invoice extends REST_Controller
{
    public function index_post()
    {
        $id = $this->post('id');
        $tgl_pesan = $this->post('tgl_pesan');
        $batas_bayar = $this->post('batas_bayar');
        $metode = $this->post('metode');

        $data = [
            'id' => $id,
            'tgl_pesan' => $tgl_pesan,
            'batas_bayar' => $batas_bayar,
            'metode' => $metode
        ];

        if ($this->db->insert('invoice', $data)) {
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

    public function index_get()
    {
        $data = $this->db->select('id_invoice')->order_by("id_invoice", "desc")->limit(1)->get('invoice')->row();
        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
                'message' => 'success'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to get last id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
