<?php

class Course_model extends CI_Model
{
    public function tampil_data($table)
    {
        return $this->db->get($table);
    }

    public function tampil_data_id($table, $id)
    {
        return $this->db->get_where($table, ['id_course' => $id]);
    }

    public function tampil_data_kategori($table, $kategori)
    {
        return $this->db->get_where($table, ['kategori' => $kategori]);
    }

    public function tambah_course($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function edit_course($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id_course', $id)
            ->limit(1)
            ->get('course');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->like('nama_course', $keyword);
        $this->db->or_like('keterangan', $keyword);
        $this->db->or_like('kategori', $keyword);
        return $this->db->get()->result();
    }
}
