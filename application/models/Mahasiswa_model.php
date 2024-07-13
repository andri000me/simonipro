<?php 
class Mahasiswa_model extends CI_Model {    
    public function get_all_absensi_bimbingan() {
        $query = $this->db->get('absensi_bimbingan');
         return $query->result_array();
    }

    public function get_all_plotting() {
        $this->db->select('plotting.*, 
        k.nama as koordinator_nama, 
        dospem.nidn as dosen_pembimbing_nidn, dospem.nama as dosen_pembimbing_nama, 
        dp1.nidn as dosen_penguji_1_nidn, dp1.nama as dosen_penguji_1_nama, 
        dp2.nidn as dosen_penguji_2_nidn, dp2.nama as dosen_penguji_2_nama, 
        mhs.nama as mahasiswa_nama, mhs.npm as mahasiswa_npm, mhs.kelas, 
        p.nama_project as project_nama, 
        jp.nama as jenis_plotting_nama');
        $this->db->from('plotting');
        $this->db->join('koordinator k', 'k.id = plotting.koordinator_id', 'left');
        $this->db->join('dosen dospem', 'dospem.id = plotting.dosen_pembimbing_id', 'left');
        $this->db->join('dosen dp1', 'dp1.id = plotting.dosen_penguji_1_id', 'left');
        $this->db->join('dosen dp2', 'dp2.id = plotting.dosen_penguji_2_id', 'left');
        $this->db->join('mahasiswa mhs', 'mhs.id = plotting.mahasiswa_id', 'left');
        $this->db->join('project p', 'p.id = plotting.project_id', 'left');
        $this->db->join('jenis_plotting jp', 'jp.id = plotting.jenis_plotting_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
}