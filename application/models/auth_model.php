<?php

class Auth_model extends CI_Model
{
    public function cek_login()
    {
        $username = set_value('username');
        $password = $this->input->post('password');

        $result = $this->db->where('username', $username)
            ->where('password', $password)
            ->limit(1)
            ->get('user');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function registrasi($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }
}
