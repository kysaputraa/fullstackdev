
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function get_all()
    {
        return $this->db->select('username')
            ->from('t_user');
    }

    public function get_by_username($username)
    {
        return $this->db->where('username', $username)
            ->get('t_user');
    }

    public function proses_login($username, $password)
    {
        return $this->db->where('username', $username)
            ->where('password', $password)
            ->get('t_user');
    }

    public function proses_register($data)
    {
        return $this->db->insert('t_user', $data);
    }

    public function proses_ubah_data($username, $data)
    {
        return $this->db->where('username', $username)
            ->update('t_user', $data);
    }

    public function proses_hapus($username)
    {
        $this->db->where('username', $username)
            ->delete('t_user');
        return $this->db->affected_rows();
    }
}
