<?php

class Auth extends CI_Controller
{
    public function login()
    {
        $this->form_validation->set_rules('username', 'username', 'required', [
            'required' => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required', [
            'required' => 'Password wajib diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('form_login');
            $this->load->view('templates/footer');
        } else {
            $auth = $this->auth_model->cek_login();

            if ($auth == FALSE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username atau Password Salah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('auth/login');
            } else {
                $this->session->set_userdata('username', $auth->username);
                $this->session->set_userdata('role', $auth->role);
                $this->session->set_userdata('id', $auth->id);
                $this->session->set_userdata('nama', $auth->nama);
                $this->session->set_userdata('email', $auth->email);
                $this->session->set_userdata('status', $auth->status);

                switch ($auth->role) {
                    case 1:
                        redirect('admin/dashboard_admin');
                        break;
                    case 2:
                        redirect('dashboard');
                        break;
                    default:
                        break;
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome');
    }
}
