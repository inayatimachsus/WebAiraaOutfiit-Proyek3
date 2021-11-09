<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda Belum Login!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('auth/login');
        }
    }

    public function programming()
    {
        $data['programming'] = $this->kategori_model->data_programming()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/programming', $data);
        $this->load->view('templates/footer');
    }

    public function web_development()
    {
        $data['web_development'] = $this->kategori_model->data_web_development()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/web_development', $data);
        $this->load->view('templates/footer');
    }

    public function mobile_apps()
    {
        $data['mobile_apps'] = $this->kategori_model->data_mobile_apps()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/mobile_apps', $data);
        $this->load->view('templates/footer');
    }
}
