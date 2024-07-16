<?php 
class Mahasiswa_model extends CI_Model {    
    // public function get_all_absensi_bimbingan() {
    //     $query = $this->db->get('absensi_bimbingan');
    //      return $query->result_array();
    // }

    // Kelola Absensi
    public function get_all_kelompok_match_current_mhs($username)
    {
        // Ambil data mahasiswa berdasarkan username
        $this->db->select('mahasiswa.id as mahasiswa_id, mahasiswa.nama as nama_mahasiswa, mahasiswa.npm, kelompok.id as kelompok_id, kelompok.kode_kelompok, kelompok.dosen_pembimbing_id, kelompok.kelas_id, kelompok.semester, kelompok.tahun_ajaran');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'mahasiswa.user_id = user.id');
        $this->db->join('plotting', 'plotting.mahasiswa_id = mahasiswa.id');
        $this->db->join('kelompok', 'kelompok.id = plotting.kelompok_id');
        $this->db->where('user.username', $username);
        $this->db->limit(1);  // Hanya ambil satu data
        $mahasiswa = $this->db->get()->row();

        if ($mahasiswa) {
            // Ambil data kelompok dan dosen pembimbing berdasarkan kelompok_id
            $this->db->select('kelompok.*, kelas.nama_kelas, prodi.nama_prodi, prodi.jenjang, dosen.nama as nama_dosen_pembimbing');
            $this->db->from('kelompok');
            $this->db->join('kelas', 'kelas.id = kelompok.kelas_id');
            $this->db->join('mahasiswa', 'mahasiswa.kelas_id = kelompok.kelas_id');  // Join dengan mahasiswa untuk mengambil prodi_id
            $this->db->join('prodi', 'prodi.id = mahasiswa.prodi_id');  // Ambil nama_prodi dari prodi_id mahasiswa
            $this->db->join('dosen', 'dosen.id = kelompok.dosen_pembimbing_id');  // Join dengan tabel dosen untuk mendapatkan nama dosen pembimbing
            $this->db->where('kelompok.id', $mahasiswa->kelompok_id);
            $kelompok = $this->db->get()->row_array();

            // Tambahkan data mahasiswa ke dalam array $kelompok
            $kelompok['mahasiswa_id'] = $mahasiswa->mahasiswa_id;
            $kelompok['nama_mahasiswa'] = $mahasiswa->nama_mahasiswa;
            $kelompok['npm'] = $mahasiswa->npm;

            return $kelompok;  // Mengembalikan data sebagai array tunggal
        } else {
            return array();
        }
    }

    public function get_all_absensi_bimbingan_by_user($username)
    {
        // Ambil data user berdasarkan username
        $this->db->select('user.id as user_id, mahasiswa.id as mahasiswa_id');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'mahasiswa.user_id = user.id');
        $this->db->where('user.username', $username);
        $user = $this->db->get()->row();

        if ($user) {
            // Ambil data absensi bimbingan berdasarkan mahasiswa_id
            $this->db->select('*');
            $this->db->from('absensi_bimbingan');
            $this->db->where('mahasiswa_id', $user->mahasiswa_id);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_all_absensi_bimbingan_by_id($absensi_id)
    {
        $this->db->select('*');
        $this->db->from('absensi_bimbingan');
        $this->db->where('id', $absensi_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_mahasiswa_by_username($username)
    {
        $this->db->select('mahasiswa.*, user.username, role.nama_role, prodi.nama_prodi, prodi.jenjang, kelas.nama_kelas');
        $this->db->from('mahasiswa');
        $this->db->join('user', 'mahasiswa.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->join('prodi', 'mahasiswa.prodi_id = prodi.id'); // Join dengan tabel prodi menggunakan kolom prodi_id
        $this->db->join('kelas', 'mahasiswa.kelas_id = kelas.id');
        $this->db->where('mahasiswa.npm', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_last_absensi_status($username)
    {
        // Ambil data user berdasarkan username
        $this->db->select('user.id as user_id, mahasiswa.id as mahasiswa_id');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'mahasiswa.user_id = user.id');
        $this->db->where('user.username', $username);
        $user = $this->db->get()->row();

        if ($user) {
            // Ambil status terakhir absensi bimbingan berdasarkan mahasiswa_id
            $this->db->select('status');
            $this->db->from('absensi_bimbingan');
            $this->db->where('mahasiswa_id', $user->mahasiswa_id);
            $this->db->order_by('tgl_bimbingan', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        } else {
            return array();
        }
    }


    public function insert_absensi($data)
    {
        $this->db->insert('absensi_bimbingan', $data);
    }

    public function update_absensi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('absensi_bimbingan', $data);
    }

    // Akhir kelola Absensi

}