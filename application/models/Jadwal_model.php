<?php
class Jadwal_model extends CI_Model {
    // query tambah data jadwal
    public function insert_jadwal($data) {
        $this->db->insert('jadwal', $data);
    }

    // query tambah data kegiatan
    public function insert_kegiatan($data) {
        $this->db->insert('kegiatan', $data);
    }

    // query view all data jadwal
    public function get_all_jadwal() {
        return $this->db->get('jadwal')->result_array();
    }

    // query get data jadwal by id
    public function get_jadwal_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('jadwal')->row_array();
    }

    // query get data kegiatan by jadwal id
    public function get_kegiatan_by_jadwal_id($jadwal_id) {
        $this->db->where('jadwal_id', $jadwal_id);
        return $this->db->get('kegiatan')->result_array();
    }

    // query update data jadwal
    public function update_jadwal($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('jadwal', $data);
    }
}
