<?php

class Data_course extends CI_Controller
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
        $data['course'] = $this->course_model->tampil_data('course')->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_course', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nama_course = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $kategori = $this->input->post('kategori');
            $harga = $this->input->post('harga');
            $gambar = $_FILES['gambar'];
            $gambar_ = $_FILES['gambar']['name'];
            $nama_pengajar = $this->input->post('nama_pengajar');
            $foto_pengajar = $_FILES['foto_pengajar'];
            $foto_pengajar_ = $_FILES['foto_pengajar']['name'];
            $rating = $this->input->post('rating');

            if ($gambar = '' || $foto_pengajar = '') {
                echo 'Gambar atau Foto Pengajar Tidak Ada!';
            } else {
                $config['upload_path'] = './assets/uploads';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 1024; //1MB

                $this->load->library('upload', $config);

                $file1 = $this->upload->do_upload('gambar');
                $file2 = $this->upload->do_upload('foto_pengajar');

                if (!$file1 || !$file2) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal Menambahkan Course!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    redirect('admin/data_course');
                    die();
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
            }

            $data = array(
                'nama_course' => $nama_course,
                'keterangan' => $keterangan,
                'kategori' => $kategori,
                'harga' => $harga,
                'gambar' => $gambar_,
                'nama_pengajar' => $nama_pengajar,
                'foto_pengajar' => $foto_pengajar_,
                'rating' => $rating
            );

            $this->course_model->tambah_course($data, 'course');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil Menambahkan Course!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('admin/data_course');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required', [
            'required' => 'Nama Course wajib diisi!'
        ]);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required', [
            'required' => 'Keterangan Course wajib diisi!'
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required', [
            'required' => 'Kategori Course wajib diisi!'
        ]);
        $this->form_validation->set_rules('harga', 'harga', 'required', [
            'required' => 'Harga Course wajib diisi!'
        ]);
        $this->form_validation->set_rules('nama_pengajar', 'nama_pengajar', 'required', [
            'required' => 'Nama Pengajar Course wajib diisi!'
        ]);
        $this->form_validation->set_rules('rating', 'rating', 'required', [
            'required' => 'Rating Course wajib diisi!'
        ]);
    }

    public function edit($id)
    {
        $where = array('id_course' => $id);
        $data['course'] = $this->course_model->edit_course($where, 'course')->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_course', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $nama_course = $this->input->post('nama_course');
        $keterangan = $this->input->post('keterangan');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');

        $data = array(
            'nama_course' => $nama_course,
            'keterangan' => $keterangan,
            'kategori' => $kategori,
            'harga' => $harga
        );

        $where = array(
            'id_course' => $id
        );

        $this->course_model->update_data($where, $data, 'course');
        redirect('admin/data_course');
    }

    public function hapus($id)
    {
        $where = array('id_course' => $id);

        $this->course_model->hapus_data($where, 'course');
        redirect('admin/data_course');
    }

    public function laporan_pdf()
    {
        $this->load->library('pdf');

        $data['course'] = $this->course_model->tampil_data('course')->result();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "list-course.pdf";
        $this->pdf->load_view('laporan/list_course', $data);
    }
}
