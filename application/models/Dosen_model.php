<?php 
class Dosen_model extends CI_Model { 
    public function get_all_absensi_bimbingan_by_dosen($username)
    {
        // Ambil data user berdasarkan dosen
        $this->db->select('user.id as user_id, dosen.id as dosen_pembimbing_id');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.user_id = user.id');
        $this->db->where('user.username', $username);
        $user = $this->db->get()->row();

        if ($user) {
            // Ambil data absensi bimbingan berdasarkan dosen_pembimbing_id dengan join ke tabel kelompok dan dosen
            $this->db->select('absensi_bimbingan.*, kelompok.dosen_pembimbing_id, dosen.nama as nama_dosen, mahasiswa.nama AS nama_mahasiswa, mahasiswa.npm AS mahasiswa_npm');
            $this->db->from('absensi_bimbingan');
            $this->db->join('kelompok', 'kelompok.id = absensi_bimbingan.kelompok_id');
            $this->db->join('dosen', 'dosen.id = kelompok.dosen_pembimbing_id');
            $this->db->join('mahasiswa', 'mahasiswa.id = mahasiswa_id');
            $this->db->where('kelompok.dosen_pembimbing_id', $user->dosen_pembimbing_id);
            $this->db->where('absensi_bimbingan.is_submitted', 1); // Hanya ambil data yang disubmit
            $this->db->order_by('absensi_bimbingan.tgl_bimbingan', 'DESC'); // Urutkan berdasarkan tanggal bimbingan terbaru
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_all_absensi_bimbingan_by_id($absensi_id)
    {
        $this->db->select('absensi_bimbingan.*, mahasiswa.id AS mahasiswa_id, mahasiswa.npm as mahasiswa_npm, mahasiswa.nama as mahasiswa_nama');
        $this->db->from('absensi_bimbingan');
        $this->db->join('plotting', 'absensi_bimbingan.mahasiswa_id = plotting.mahasiswa_id', 'left');
        $this->db->join('mahasiswa', 'plotting.mahasiswa_id = mahasiswa.id', 'left');
        $this->db->where('absensi_bimbingan.id', $absensi_id);
        $query = $this->db->get();

        return $query->row_array();  // Mengembalikan data sebagai array tunggal
    }

    public function get_all_kelompok_match_current_dsn($username)
    {
        // Ambil data dosen berdasarkan username
        $this->db->select('dosen.id as dosen_id, dosen.nama as nama_dosen, dosen.nidn, kelompok.id as kelompok_id, kelompok.kode_kelompok, kelompok.dosen_pembimbing_id, kelompok.kelas_id, kelompok.semester, kelompok.tahun_ajaran');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.user_id = user.id');
        $this->db->join('kelompok', 'kelompok.dosen_pembimbing_id = dosen.id');  // Perbaiki join dengan kelompok untuk mendapatkan kelompok berdasarkan dosen_pembimbing_id
        $this->db->where('user.username', $username);
        $this->db->limit(1);  // Hanya ambil satu data
        $dosen = $this->db->get()->row();

        if ($dosen) {
            // Ambil data kelompok dan dosen pembimbing berdasarkan kelompok_id
            $this->db->select('kelompok.*, kelas.nama_kelas, prodi.nama_prodi, prodi.jenjang, dosen_pembimbing.nama as nama_dosen_pembimbing');
            $this->db->from('kelompok');
            $this->db->join('kelas', 'kelas.id = kelompok.kelas_id');
            $this->db->join('dosen as dosen_pembimbing', 'dosen_pembimbing.id = kelompok.dosen_pembimbing_id');  // Join dengan tabel dosen untuk mendapatkan nama dosen pembimbing
            $this->db->join('prodi', 'prodi.id = kelas.prodi_id');  // Join dengan prodi untuk mendapatkan nama_prodi dari prodi_id kelas
            $this->db->where('kelompok.id', $dosen->kelompok_id);
            $kelompok = $this->db->get()->row_array();

            // Tambahkan data dosen ke dalam array $kelompok
            $kelompok['dosen_id'] = $dosen->dosen_id;
            $kelompok['nama_dosen'] = $dosen->nama_dosen;
            $kelompok['nidn'] = $dosen->nidn;

            return $kelompok;  // Mengembalikan data sebagai array tunggal
        } else {
            return array();
        }
    }

    public function count_hadir_by_mahasiswa_id($mahasiswa_id)
    {
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        $this->db->where('status', 'hadir');
        $this->db->from('absensi_bimbingan');
        return $this->db->count_all_results();
    }

    public function get_absensi_by_mahasiswa($mahasiswa_id)
    {
        $this->db->select('*');
        $this->db->from('absensi_bimbingan');
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_absensi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('absensi_bimbingan', $data);
    }

    public function update_status_absensi($mahasiswa_id, $update_data)
    {
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        $this->db->where('status !=', 'rekomendasi'); // Tambahkan kondisi ini
        $this->db->update('absensi_bimbingan', $update_data);
    }
}