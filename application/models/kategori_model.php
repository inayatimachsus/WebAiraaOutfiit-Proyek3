<?php

class Kategori_model extends CI_Model
{
    public function data_programming()
    {
        return $this->db->get_where('course', array('kategori' => 'Programming'));
    }

    public function data_web_development()
    {
        return $this->db->get_where('course', array('kategori' => 'Web Development'));
    }

    public function data_mobile_apps()
    {
        return $this->db->get_where('course', array('kategori' => 'Mobile Apps'));
    }
}
