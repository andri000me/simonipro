<?php
class Kaprodi_model extends CI_Model {

    // Count data from tables
    // Menghitung jumlah data pada tabel mahasiswa
    public function count_all_mahasiswa() {
        return $this->db->count_all('mahasiswa');
    }

    // Menghitung jumlah data pada tabel dosen
    public function count_all_dosen() {
        return $this->db->count_all('dosen');
    }

    // Menghitung jumlah mahasiswa yang statusnya "rekomendasi"
    public function count_mahasiswa_rekomendasi() {
        $this->db->distinct();
        $this->db->select('mahasiswa_id');
        $this->db->from('absensi_bimbingan');
        $this->db->where('status', 'rekomendasi');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    // Menghitung jumlah draft sidang yang statusnya "approved"
    public function count_draft_sidang_approved() {
        $this->db->from('draft_sidang');
        $this->db->where('status', 'approved');
        return $this->db->count_all_results();
    }

    // Menghitung jumlah mahasiswa yang belum memenuhi syarat
    public function count_mahasiswa_belum_terpenuhi() {
        $total_mahasiswa = $this->count_all_mahasiswa();
        $mahasiswa_rekomendasi = $this->count_mahasiswa_rekomendasi();
        $mahasiswa_siap_sidang = $this->count_draft_sidang_approved();
        return $total_mahasiswa - ($mahasiswa_rekomendasi + $mahasiswa_siap_sidang);
    }
    // End count data from tables

}