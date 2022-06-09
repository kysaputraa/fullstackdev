
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('m_barang');
    }

    public function get_by_id_barang($id)
    {
        return $this->db->where('id_barang', $id)
            ->get('m_barang');
    }

    public function proses_tambah($data)
    {
        return $this->db->insert('m_barang', $data);
    }

    public function proses_ubah_data($id, $data)
    {
        $this->db->where('id_barang', $id)
            ->update('m_barang', $data);
        return $this->db->affected_rows();
    }

    public function proses_hapus($id)
    {
        $this->db->where('id_barang', $id)
            ->delete('m_barang');
        return $this->db->affected_rows();
    }
}
