<?php

class Verifikasi_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda Belum Login!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['member'] = $this->member_model->tampil_data_verifikasi();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/verifikasi_member', $data);
        $this->load->view('templates_admin/footer');
    }

    public function terima($id)
    {
        $status = 'Aktif';
        $data = array(
            'status' => $status
        );

        $where = array(
            'id' => $id
        );

        $this->member_model->terima($where, $data, 'user');
        redirect('admin/verifikasi_member');
    }

    public function tolak($id)
    {
        $where = array(
            'id' => $id
        );
        $this->member_model->tolak($where, 'user');
        redirect('admin/verifikasi_member');
    }
}
