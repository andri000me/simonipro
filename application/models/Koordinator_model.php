<?php
class Koordinator_model extends CI_Model {

    // Kelola plotting    
    // query get data plotting_pembimbing by id
    public function getAllPlotting() {
        $this->db->select('plotting.*, 
        k.nama as koordinator_nama, 
        dospem.nidn as dosen_pembimbing_nidn, dospem.nama as dosen_pembimbing_nama, 
        dp1.nidn as dosen_penguji_1_nidn, dp1.nama as dosen_penguji_1_nama, 
        dp2.nidn as dosen_penguji_2_nidn, dp2.nama as dosen_penguji_2_nama, 
        mhs.nama as mahasiswa_nama, mhs.npm as mahasiswa_npm, 
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

    public function getPlottingById($id)
    {
        $this->db->select('plotting.*, k.nama as koordinator_nama, dospem.nama as dosen_pembimbing_nama, dp1.nama as dosen_penguji_1_nama, dp2.nama as dosen_penguji_2_nama, mhs.nama as mahasiswa_nama, mhs.npm as mahasiswa_npm, p.nama_project as project_nama, jp.nama as jenis_plotting_nama');
        $this->db->from('plotting');
        $this->db->join('koordinator k', 'k.id = plotting.koordinator_id', 'left');
        $this->db->join('dosen dospem', 'dospem.id = plotting.dosen_pembimbing_id', 'left');
        $this->db->join('dosen dp1', 'dp1.id = plotting.dosen_penguji_1_id', 'left');
        $this->db->join('dosen dp2', 'dp2.id = plotting.dosen_penguji_2_id', 'left');
        $this->db->join('mahasiswa mhs', 'mhs.id = plotting.mahasiswa_id', 'left');
        $this->db->join('project p', 'p.id = plotting.project_id', 'left');
        $this->db->join('jenis_plotting jp', 'jp.id = plotting.jenis_plotting_id', 'left');
        // cari berdasarkan id yang dikirim melalui parameter
        $this->db->where('plotting.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_plotting($data)
    {
        return $this->db->insert('plotting', $data);
    }

    public function updatePlotting($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('plotting', $data);
    }

    public function deletePlotting($id)
    {
        return $this->db->delete('plotting', ['id' => $id]);
    }

    // Ambil user id mahasiswa yang sudah dipilih
    public function get_selected_user_mhs_ids() {
        $this->db->select('mahasiswa_id');
        $this->db->from('plotting');
        $query = $this->db->get();
        $result = $query->result_array();
        $ids = array_column($result, 'mahasiswa_id'); // Ambil hanya kolom 'mahasiswa_id'
        return $ids;
    }

    // Dapatkan semua user mahasiswa yang sesuai dengan id
    public function get_all_user_match_by_role_as_mahasiswa($selectedUserIds) {
        $this->db->select('id, npm, nama');
        $this->db->from('mahasiswa');
        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('id', $selectedUserIds);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    // Akhir kelola plotting 

    // Kelola Jenis Plotting
    // ambil semua data yang ada di tabel jenis plotting
    public function get_all_jenis_plotting()
    {
        $query = $this->db->get('jenis_plotting');
        return $query->result_array();
    }
    // Akhir kelola jenis plotting

}