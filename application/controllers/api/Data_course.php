<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Data_course extends REST_Controller
{
    public function index_get()
    {
        $id = $this->get('id');
        $kategori = $this->get('kategori');

        if ($kategori == '' && $id == '') {
            $data = $this->course_model->tampil_data('course', null)->result_array();
        } else if ($kategori != '') {
            $data = $this->course_model->tampil_data_kategori('course', $kategori)->result_array();
        } else if ($id != '') {
            $data = $this->course_model->tampil_data_id('course', $id)->result_array();
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
        $nama_course = $this->post('nama');
        $keterangan = $this->post('keterangan');
        $kategori = $this->post('kategori');
        $harga = $this->post('harga');
        $gambar = $this->post('gambar');

        $data = array(
            'nama_course' => $nama_course,
            'keterangan' => $keterangan,
            'kategori' => $kategori,
            'harga' => $harga,
            'gambar' => $gambar
        );

        if ($this->course_model->tambah_course($data, 'course') > 0) {
            $this->response([
                'status' => true,
                'message' => 'new course has been created!'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new course!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $nama_course = $this->put('nama_course');
        $keterangan = $this->put('keterangan');
        $kategori = $this->put('kategori');
        $harga = $this->put('harga');
        $nama_pengajar = $this->put('nama_pengajar');
        $foto_pengajar = $this->put('$foto_pengajar');
        $rating = $this->put('$rating');

        $data = array(
            'nama_course' => $nama_course,
            'keterangan' => $keterangan,
            'kategori' => $kategori,
            'harga' => $harga,
            'nama_pengajar' => $nama_pengajar,
            'foto_pengajar' => $foto_pengajar,
            'rating' => $rating
        );

        $id = $this->put('id');
        $where = array('id_course' => $id);

        if ($this->course_model->update_data($where, $data, 'course') > 0) {
            $this->response([
                'status' => true,
                'message' => 'data course has been updated!'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $where = array('id_course' => $id);

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->course_model->hapus_data($where, 'course') > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted!'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
