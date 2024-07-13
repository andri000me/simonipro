<?php
class Koordinator_model extends CI_Model {

    // Kelola Project
    public function get_all_projects()
    {
        $this->db->select('project.*, prodi.nama_prodi');
        $this->db->from('project');
        $this->db->join('prodi', 'project.prodi_id = prodi.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    // get a project by ID
    public function get_project_by_id($id)
    {
        $this->db->select('project.*, prodi.nama_prodi');
        $this->db->from('project');
        $this->db->join('prodi', 'project.prodi_id = prodi.id');
        $this->db->where('project.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Function to insert a new project
    public function insert_project($data)
    {
        return $this->db->insert('project', $data);
    }

    // function to update project data
    public function update_project($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('project', $data);
    }
    // Akhir kelola project

    // Kelola plotting    
    // query get data plotting_pembimbing
    public function getAllPlotting() {
        $this->db->select('plotting.*, k.nama as koordinator_nama, dospem.nama as dosen_pembimbing_nama, dospem.nidn as dosen_pembimbing_nidn, dp1.nama as dosen_penguji_1_nama, dp2.nama as dosen_penguji_2_nama, mhs.nama as mahasiswa_nama, mhs.npm as mahasiswa_npm, mhs.kelas_id as mahasiswa_kelas, p.nama_project as project_nama, jp.nama as jenis_plotting_nama');
        $this->db->from('plotting');
        $this->db->join('koordinator k', 'k.id = plotting.koordinator_id', 'left');
        $this->db->join('kelompok kel', 'kel.id = plotting.kelompok_id', 'left');
        $this->db->join('dosen dospem', 'dospem.id = kel.dosen_pembimbing_id', 'left');  // Menggunakan dosen_pembimbing_id dari tabel kelompok
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
        $this->db->select('plotting.*, k.nama as koordinator_nama, dospem.nama as dosen_pembimbing_nama, dospem.nidn as dosen_pembimbing_nidn, dp1.nama as dosen_penguji_1_nama, dp2.nama as dosen_penguji_2_nama, mhs.nama as mahasiswa_nama, mhs.npm as mahasiswa_npm, mhs.kelas_id as mahasiswa_kelas, p.nama_project as project_nama, jp.nama as jenis_plotting_nama');
        $this->db->from('plotting');
        $this->db->join('koordinator k', 'k.id = plotting.koordinator_id', 'left');
        $this->db->join('kelompok kel', 'kel.id = plotting.kelompok_id', 'left');
        $this->db->join('dosen dospem', 'dospem.id = kel.dosen_pembimbing_id', 'left');  // Menggunakan dosen_pembimbing_id dari tabel kelompok
        $this->db->join('dosen dp1', 'dp1.id = plotting.dosen_penguji_1_id', 'left');
        $this->db->join('dosen dp2', 'dp2.id = plotting.dosen_penguji_2_id', 'left');
        $this->db->join('mahasiswa mhs', 'mhs.id = plotting.mahasiswa_id', 'left');
        $this->db->join('project p', 'p.id = plotting.project_id', 'left');
        $this->db->join('jenis_plotting jp', 'jp.id = plotting.jenis_plotting_id', 'left');
        $this->db->where('plotting.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_plotting($data)
    {
        return $this->db->insert('plotting', $data);
    }

    public function updatePlotting($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('plotting', $data);
        return $this->db->affected_rows(); // Mengembalikan jumlah baris yang dipengaruhi
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


    // Kelola kelompok
    public function get_all_kelompok() {
        $this->db->select('kelompok.*, dosen.nama AS nama_pembimbing, dosen.nidn AS dosen_pembimbing_nidn, kelas.nama_kelas, prodi.nama_prodi, prodi.jenjang');
        $this->db->from('kelompok');
        $this->db->join('dosen', 'kelompok.dosen_pembimbing_id = dosen.id');
        $this->db->join('kelas', 'kelompok.kelas_id = kelas.id');
        $this->db->join('prodi', 'kelas.prodi_id = prodi.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_last_kelompok() 
    {
        $this->db->select('kode_kelompok');
        $this->db->from('kelompok');
        $this->db->order_by('kode_kelompok', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    // Ambil user id dosen yang sudah dipilih
    public function get_selected_user_dsn_ids() {
        $this->db->select('dosen_pembimbing_id');
        $this->db->from('kelompok');
        $query = $this->db->get();
        $result = $query->result_array();
        $ids = array_column($result, 'dosen_pembimbing_id'); // Ambil hanya kolom 'dosen_pembimbing_id'
        return $ids;
    }

    // Dapatkan semua user dosen yang sesuai dengan id
    public function get_all_user_match_by_role_as_dosen($selectedUserIds) {
        $this->db->select('id, nidn, nama');
        $this->db->from('dosen');
        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('id', $selectedUserIds);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kelompok_by_id($id) {
        $this->db->select('kelompok.*, dosen.nama AS nama_pembimbing, kelas.nama_kelas, prodi.nama_prodi, prodi.jenjang');
        $this->db->from('kelompok');
        $this->db->join('dosen', 'kelompok.dosen_pembimbing_id = dosen.id');
        $this->db->join('kelas', 'kelompok.kelas_id = kelas.id');
        $this->db->join('prodi', 'kelas.prodi_id = prodi.id');
        $this->db->where('kelompok.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // query get data plotting by plotting id
    public function get_plotting_by_kelompok_id($kelompok_id) {
        $this->db->select('
            mahasiswa.npm AS mahasiswa_npm,
            mahasiswa.nama AS mahasiswa_nama,
            kelas.nama_kelas,
            prodi.nama_prodi,
            prodi.jenjang
        ');
        $this->db->from('plotting');
        $this->db->join('mahasiswa', 'plotting.mahasiswa_id = mahasiswa.id');
        $this->db->join('kelas', 'mahasiswa.kelas_id = kelas.id');
        $this->db->join('prodi', 'kelas.prodi_id = prodi.id');
        $this->db->where('plotting.kelompok_id', $kelompok_id);
        return $this->db->get()->result_array();
    }

    public function insert_kelompok($data)
    {
        return $this->db->insert('kelompok', $data);
    }

    public function update_kelompok($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kelompok', $data);
    }
    // Akhir kelola kelompok


    // GET ALL DATA FROM TABLE KELAS
    public function get_all_kelas() {
        $this->db->select('kelas.*, prodi.nama_prodi, prodi.jenjang');
        $this->db->from('kelas');
        $this->db->join('prodi', 'prodi.id = kelas.prodi_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // GET ALL DATA FROM TABLE DOSEN
    public function get_all_dosen()
    {
        $this->db->select('dosen.*, user.username, role.nama_role');
        $this->db->from('dosen');
        $this->db->join('user', 'dosen.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'dosen');
        $query = $this->db->get();
        return $query->result_array();
    }
}