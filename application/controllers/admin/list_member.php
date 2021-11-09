<?php

class List_member extends CI_Controller
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
        $data['member'] = $this->member_model->tampil_data();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/list_member', $data);
        $this->load->view('templates_admin/footer');
    }

    public function edit()
    {
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->member_model->hapus_data($where, 'user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Data Karyawan Berhasil Dihapus!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
        redirect('admin/list_member');
    }

    public function laporan_pdf()
    {
        $this->load->library('pdf');

        $data['member'] = $this->member_model->tampil_data();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "list-member.pdf";
        $this->pdf->load_view('laporan/list_member', $data);
    }
}
