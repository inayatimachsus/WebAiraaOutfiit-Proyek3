<?php

class Welcome extends CI_Controller
{
    public function index()
    {
        $data['course'] = $this->course_model->tampil_data('course')->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['course'] = $this->course_model->get_keyword($keyword);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
