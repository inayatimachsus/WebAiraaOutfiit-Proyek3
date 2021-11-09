<?php
class Invoice_model extends CI_Model
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $metode = $this->input->post('metode');

        $invoice = array(
            'id' => $this->session->userdata('id'),
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'batas_bayar' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
            'metode' => $metode
        );

        $this->db->insert('invoice', $invoice);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $item) {
            $data = array(
                'id_invoice' => $id_invoice,
                'id_course' => $item['id'],
                'jumlah' => $item['qty']
            );

            $this->db->insert('pesanan', $data);
        }

        return TRUE;
    }

    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('user', 'user.id = invoice.id');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function ambil_id_invoice($id_invoice)
    {
        $result = $this->db->where('id_invoice', $id_invoice)->get('invoice');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function ambil_id_pesanan($id_invoice)
    {
        $this->db->select('*');
        $this->db->from('pesanan');
        $this->db->where('pesanan.id_invoice', $id_invoice);
        $this->db->join('course', 'course.id_course = pesanan.id_course');
        $this->db->join('invoice', 'invoice.id_invoice = pesanan.id_invoice');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
