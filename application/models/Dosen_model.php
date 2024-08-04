<?php 
class Dosen_model extends CI_Model { 

    // Count data from tables
    // Hitung mahasiswa berdasarkan dosen pembimbing
    public function count_mahasiswa_by_dosen($username) {
        // Dapatkan ID dosen berdasarkan username
        $dosen_id = $this->get_dosen_id_by_username($username);

        // Lakukan query untuk menghitung mahasiswa
        $this->db->select('COUNT(DISTINCT plotting.mahasiswa_id) as total_mahasiswa');
        $this->db->from('plotting');
        $this->db->join('kelompok', 'plotting.kelompok_id = kelompok.id');
        $this->db->join('mahasiswa', 'plotting.mahasiswa_id = mahasiswa.id');
        $this->db->where('kelompok.dosen_pembimbing_id', $dosen_id);
        $result = $this->db->get()->row();

        // Kembalikan hasilnya
        return $result ? $result->total_mahasiswa : 0;
    }

    // Hitung absensi bimbingan berdasarkan dosen
    public function count_absensi_bimbingan_by_dosen($username) {
        $this->db->select('user.id as user_id, dosen.id as dosen_pembimbing_id');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.user_id = user.id');
        $this->db->where('user.username', $username);
        $user = $this->db->get()->row();

        if ($user) {
            $this->db->select('COUNT(absensi_bimbingan.id) as total_confirmed_absensi');
            $this->db->from('absensi_bimbingan');
            $this->db->join('kelompok', 'kelompok.id = absensi_bimbingan.kelompok_id');
            $this->db->join('dosen', 'dosen.id = kelompok.dosen_pembimbing_id');
            $this->db->where('kelompok.dosen_pembimbing_id', $user->dosen_pembimbing_id);
            $this->db->where('absensi_bimbingan.is_confirmed', 'confirmed');
            $result = $this->db->get()->row();

            return $result ? $result->total_confirmed_absensi : 0;
        } else {
            return 0;
        }
    }

    // Hitung mahasiswa yang telah direkomendasikan oleh dosen
    public function count_mahasiswa_rekomendasi_by_dosen($username) {
        $this->db->select('user.id as user_id, dosen.id as dosen_pembimbing_id');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.user_id = user.id');
        $this->db->where('user.username', $username);
        $user = $this->db->get()->row();

        if ($user) {
            $this->db->select('COUNT(DISTINCT absensi_bimbingan.mahasiswa_id) as total_rekomendasi_mahasiswa');
            $this->db->from('absensi_bimbingan');
            $this->db->join('kelompok', 'kelompok.id = absensi_bimbingan.kelompok_id');
            $this->db->join('dosen', 'dosen.id = kelompok.dosen_pembimbing_id');
            $this->db->where('kelompok.dosen_pembimbing_id', $user->dosen_pembimbing_id);
            $this->db->where('absensi_bimbingan.is_confirmed', 'confirmed');
            $this->db->where('absensi_bimbingan.status', 'rekomendasi');
            $result = $this->db->get()->row();

            return $result ? $result->total_rekomendasi_mahasiswa : 0;
        } else {
            return 0;
        }
    }

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
            $this->db->join('mahasiswa', 'mahasiswa.id = absensi_bimbingan.mahasiswa_id');
            $this->db->where('kelompok.dosen_pembimbing_id', $user->dosen_pembimbing_id);
            $this->db->where('absensi_bimbingan.is_submitted', 1); // Hanya ambil data yang disubmit

            // Urutkan berdasarkan status, tanggal bimbingan, dan waktu
            $this->db->order_by("FIELD(absensi_bimbingan.is_confirmed, 'pending', 'confirmed', 'rejected')"); // Urutkan status dengan "pending" lebih dulu
            $this->db->order_by('absensi_bimbingan.tgl_bimbingan', 'DESC'); // Urutkan berdasarkan tanggal bimbingan terbaru
            $this->db->order_by('absensi_bimbingan.waktu', 'DESC'); // Urutkan berdasarkan waktu terbaru

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

    // Kelola penilaian
    // Method untuk mengambil data mahasiswa berdasarkan plotting
    public function get_all_mahasiswa_by_plotting($username) {
        // Ambil ID dosen dari username di tabel user
        $this->db->select('dosen.id');
        $this->db->from('user');
        $this->db->join('dosen', 'user.id = dosen.user_id'); // Join tabel user dengan tabel dosen
        $this->db->where('user.username', $username);
        $dosen = $this->db->get()->row();

        if (!$dosen) {
            return []; // Jika dosen tidak ditemukan, kembalikan array kosong
        }

        $dosen_id = $dosen->id;

        // Ambil mahasiswa yang sudah dinilai
        $mahasiswa_sudah_dinilai = $this->get_mahasiswa_sudah_dinilai($dosen_id);

        // Query untuk mengambil data mahasiswa dan informasi dosen penguji
        $this->db->select('
            mahasiswa.id AS mahasiswa_id, 
            mahasiswa.npm AS mahasiswa_npm, 
            mahasiswa.nama AS mahasiswa_nama, 
            plotting.id AS plotting_id,
            dosen_penguji_1.nama AS dosen_penguji_1_nama,
            dosen_penguji_1.nidn AS dosen_penguji_1_nidn,
            dosen_penguji_2.nama AS dosen_penguji_2_nama,
            dosen_penguji_2.nidn AS dosen_penguji_2_nidn
        ');
        $this->db->from('plotting');
        $this->db->join('mahasiswa', 'plotting.mahasiswa_id = mahasiswa.id');
        $this->db->join('dosen AS dosen_penguji_1', 'plotting.dosen_penguji_1_id = dosen_penguji_1.id', 'left');
        $this->db->join('dosen AS dosen_penguji_2', 'plotting.dosen_penguji_2_id = dosen_penguji_2.id', 'left');
        $this->db->where('plotting.dosen_penguji_2_id', $dosen_id);

        if (!empty($mahasiswa_sudah_dinilai)) {
            $this->db->where_not_in('mahasiswa.id', $mahasiswa_sudah_dinilai); // Mengecualikan mahasiswa yang sudah dinilai
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_penilaian_by_dosen($username) {
        // Ambil ID dosen dari username di tabel user
        $this->db->select('dosen.id');
        $this->db->from('user');
        $this->db->join('dosen', 'user.id = dosen.user_id'); // Join tabel user dengan tabel dosen
        $this->db->where('user.username', $username);
        $dosen = $this->db->get()->row();
    
        if (!$dosen) {
            return [];
        }
    
        $dosen_id = $dosen->id;
    
        // Query untuk mengambil data penilaian yang relevan untuk dosen
        $this->db->select('
                penilaian.id as id,
                mahasiswa.nama as mahasiswa_nama,
                mahasiswa.npm as mahasiswa_npm,
                penilaian.nilai_pembimbing,
                penilaian.nilai_penguji_1,
                penilaian.nilai_penguji_2,
                penilaian.grade,
                penilaian.status_kelulusan
            ')
            ->from('penilaian')
            ->join('plotting', 'penilaian.plotting_id = plotting.id')
            ->join('mahasiswa', 'plotting.mahasiswa_id = mahasiswa.id')
            ->where('plotting.dosen_penguji_1_id', $dosen_id)
            ->or_where('plotting.dosen_penguji_2_id', $dosen_id);
    
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_penilaian_by_id($id)
    {
        $this->db->select('
                penilaian.id,
                penilaian.nilai_pembimbing,
                penilaian.nilai_penguji_1,
                penilaian.nilai_penguji_2,
                penilaian.grade,
                penilaian.status_kelulusan
            ')
            ->from('penilaian')
            ->where('penilaian.id', $id);

        return $this->db->get()->row_array();
    }   
    
    // Method untuk mendapatkan mahasiswa yang sudah memiliki penilaian
    public function get_mahasiswa_sudah_dinilai($dosen_id) {
        // Ambil ID mahasiswa dari tabel penilaian melalui tabel plotting
        $this->db->select('plotting.mahasiswa_id');
        $this->db->from('penilaian');
        $this->db->join('plotting', 'penilaian.plotting_id = plotting.id');
        $this->db->where('plotting.dosen_penguji_2_id', $dosen_id); // Memastikan dosen adalah dosen penguji 2
        $this->db->or_where('plotting.dosen_penguji_1_id', $dosen_id); // Tambahkan juga untuk dosen penguji 1 jika perlu
        $this->db->distinct(); // Untuk menghindari duplikasi hasil
        $query = $this->db->get();
        return array_column($query->result_array(), 'mahasiswa_id');
    }

    public function get_dosen_id_by_username($username) {
        $this->db->select('dosen.id');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.user_id = user.id');
        $this->db->where('user.username', $username);
        $result = $this->db->get()->row();

        return $result ? $result->id : NULL;
    }
    

    // insert penilaian
    public function insert_penilaian($data) {
        $this->db->insert('penilaian', $data);
    }

    public function update_penilaian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('penilaian', $data);
    }
    // Akhir kelola penilaian
}