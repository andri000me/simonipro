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

    // Kelola Kegiatan
    // query view all data kegiatan join with jadwal
    public function get_all_kegiatan() {
        $this->db->select('kegiatan.*, jadwal.nama_jadwal');
        $this->db->from('kegiatan');
        $this->db->join('jadwal', 'jadwal.id = kegiatan.jadwal_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kegiatan_by_id($id) {
        $this->db->select('kegiatan.*, jadwal.nama_jadwal');
        $this->db->from('kegiatan');
        $this->db->join('jadwal', 'kegiatan.jadwal_id = jadwal.id', 'left');
        $this->db->where('kegiatan.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // query update data kegiatan
    public function update_kegiatan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kegiatan', $data);
    }

    // Hapus data kegiatan
    public function delete_kegiatan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kegiatan');
    }
    // Akhir kelola kegiatan

    // for calendar
    public function get_all_events() {
        $this->db->select('id, nama_kegiatan as title, tgl_awal as start, tgl_selesai as end');
        $this->db->from('kegiatan');
        $this->db->where('DATE(tgl_awal) <=', date('Y-m-d'));
        $this->db->where('DATE(tgl_selesai) >=', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result_array();
    }
}
