<?php

class Registrasi extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama Wajib diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Email Wajib diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Username Wajib diisi!'
        ]);
        $this->form_validation->set_rules('password_1', 'Password', 'required', [
            'required' => 'Password Wajib diisi!'
        ]);
        $this->form_validation->set_rules('password_2', 'Password', 'required|matches[password_1]', [
            'required' => 'Password Wajib diisi!',
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('registrasi');
            $this->load->view('templates/footer');
        } else {
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'id'    => '',
                'nama'  => $this->input->post('nama'),
                'email'  => $this->input->post('email'),
                'tanggal_daftar' => date('Y-m-d H:i:s'),
                'username'  => $this->input->post('username'),
                'password'  => $this->input->post('password_1'),
                'role'  => 2,
                'status' => 'Tidak Aktif'
            );

            $this->db->insert('user', $data);
            redirect('auth/login');
        }
    }
}
