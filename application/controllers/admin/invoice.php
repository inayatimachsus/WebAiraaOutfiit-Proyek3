<?php
class Invoice extends CI_Controller
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
        $data['invoice'] = $this->invoice_model->tampil_data();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/invoice', $data);
        $this->load->view('templates_admin/footer');
    }

    public function detail($id_invoice)
    {
        $data['invoice'] = $this->invoice_model->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->invoice_model->ambil_id_pesanan($id_invoice);

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/detail_invoice', $data);
        $this->load->view('templates_admin/footer');
    }

    public function hapus($id_invoice)
    {
        $where = array('id_invoice' => $id_invoice);

        $this->invoice_model->hapus_data($where, 'invoice');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Data Invoice Berhasil Dihapus!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
        redirect('admin/invoice');
    }

    public function laporan_pdf()
    {
        $this->load->library('pdf');

        $data['invoice'] = $this->invoice_model->tampil_data();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "list-invoice.pdf";
        $this->pdf->load_view('laporan/list_invoice', $data);
    }
}
