<?php

class Member_model extends CI_Model
{
    public function tampil_data()
    {
        $result = $this->db->order_by('role ASC', 'nama ASC')->get('user');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function tampil_data_verifikasi()
    {
        $result = $this->db->where('status', 'Tidak Aktif')->get('user');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function terima($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function tolak($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
