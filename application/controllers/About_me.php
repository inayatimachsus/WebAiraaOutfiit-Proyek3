<?php

class About_me extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('about_me');
        $this->load->view('templates/footer');
    }
}
