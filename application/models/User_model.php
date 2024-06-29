<?php
class User_model extends CI_Model
{
    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    // Update data user
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }
    // Hapus data user
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }

    // ambil data user yang ada di tabel user berdasarkan id
    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row_array();
    }

    public function get_user_by_username($username) {
        $this->db->select('user.*, role.nama_role');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('user.username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Method untuk mendapatkan semua pengguna dengan join tabel roles
    public function get_all_user()
    {
        $this->db->select('user.*, role.nama_role');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan semua baris hasil query
    }

}