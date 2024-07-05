<?php
class Koordinator_model extends CI_Model {

    // Kelola plotting pembimbing
    public function get_all_plotting_pembimbing() {
        $this->db->select('plotting_pembimbing.id, koordinator.nama AS koordinator_nama, dosen.nama AS dosen_pembimbing_nama, dosen.nidn AS dosen_pembimbing_nidn, mahasiswa.nama AS mahasiswa_nama, mahasiswa.npm AS mahasiswa_npm');
        $this->db->from('plotting_pembimbing');
        $this->db->join('koordinator', 'plotting_pembimbing.koordinator_id = koordinator.id', 'left');
        $this->db->join('dosen', 'plotting_pembimbing.dosen_pembimbing_id = dosen.id', 'left');
        $this->db->join('mahasiswa', 'plotting_pembimbing.mahasiswa_id = mahasiswa.id', 'left');

        $query = $this->db->get();
        return $query->result_array();
    }    

    // Ambil user id mahasiswa yang sudah dipilih
    public function get_selected_user_mhs_ids() {
        $this->db->select('mahasiswa_id');
        $this->db->from('plotting_pembimbing');
        $query = $this->db->get();
        $result = $query->result_array();
        $ids = array_column($result, 'mahasiswa_id'); // Ambil hanya kolom 'mahasiswa_id'
        return $ids;
    }

    // Dapatkan semua user mahasiswa yang sesuai dengan id
    public function get_all_user_match_by_role_as_mahasiswa($selectedUserIds) {
        $this->db->select('id, nama');
        $this->db->from('mahasiswa');
        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('id', $selectedUserIds);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    // query get data plotting_pembimbing by id
    public function get_plotting_pembimbing_by_id($id) {
        $this->db->select('plotting_pembimbing.*, koordinator.nama AS koordinator_nama, dosen.nama AS dosen_nama, mahasiswa.nama AS mahasiswa_nama');
        $this->db->from('plotting_pembimbing');
        $this->db->join('koordinator', 'plotting_pembimbing.koordinator_id = koordinator.id', 'left');
        $this->db->join('dosen', 'plotting_pembimbing.dosen_pembimbing_id = dosen.id', 'left');
        $this->db->join('mahasiswa', 'plotting_pembimbing.mahasiswa_id = mahasiswa.id', 'left');
        $this->db->where('plotting_pembimbing.id', $id);
        return $this->db->get()->row_array();
    }

    public function insert_plotting_pembimbing($data)
    {
        return $this->db->insert('plotting_pembimbing', $data);
    }

    public function update_plotting_pembimbing($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('plotting_pembimbing', $data);
    }
    // Akhir kelola plotting pembimbing

}