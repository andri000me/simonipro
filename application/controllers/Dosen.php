<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	// construct method
    public function __construct() {
        parent::__construct();

        // set local timezone
        date_default_timezone_set('Asia/jakarta');

        // Pengecekan apakah user sudah login
        if (!$this->session->userdata('is_logged_in')) {
            // Set pesan flashdata untuk ditampilkan di halaman login
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            // Redirect ke halaman login
            redirect('auth');
        }

        // Pengecekan apakah user memiliki role 'Dosen'
        if ($this->session->userdata('nama_role') != 'dosen') {
            // Redirect ke halaman lain jika bukan Dosen
            redirect('auth');
        }
        
        $this->load->model('jadwal_model');
        $this->load->model('dosen_model');
    }

	public function index()
	{
		$data['title'] = 'Dashboard | Dosen';
        $data['active'] = 'dashboard';
        // Memuat model dan mengambil data jadwal
        $data['events'] = $this->jadwal_model->get_all_events();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/v_dashboard', $data);
        $this->load->view('templates/footer');
	}

    public function kelola_absensi()
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Kelola Absensi | Dosen';
        $data['active'] = 'kelola_absensi';

        // Ambil data absensi bimbingan yang relevan untuk dosen
        $data['absensi_bimbingan'] = $this->dosen_model->get_all_absensi_bimbingan_by_dosen($username);

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/absensi/v_kelola_absensi', $data);
        $this->load->view('templates/footer');
    }

    public function detail_absensi($id)
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Detail Absensi | Dosen';
        $data['active'] = 'kelola_absensi';

        // Ambil data kelompok yang sesuai dengan dosen saat ini
        $data['kelompok'] = $this->dosen_model->get_all_kelompok_match_current_dsn($username);

        // Ambil semua data absensi bimbingan yang relevan
        $data['absensi_bimbingan'] = $this->dosen_model->get_all_absensi_bimbingan_by_id($id);

        // Periksa format data
        if (is_array($data['absensi_bimbingan']) && !isset($data['absensi_bimbingan'][0])) {
            $data['absensi_bimbingan'] = [$data['absensi_bimbingan']];
        }

        // Menghitung jumlah status 'hadir'
        $mahasiswa_id = $data['absensi_bimbingan'][0]['mahasiswa_id'];
        $data['mahasiswa_id'] = $mahasiswa_id; // Set mahasiswa_id
        $data['jumlahHadir'] = $this->dosen_model->count_hadir_by_mahasiswa_id($mahasiswa_id);

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/absensi/v_detail_absensi', $data);
        $this->load->view('templates/footer');
    }

    public function update_absensi()
    {
        $this->form_validation->set_rules('tgl_bimbingan', 'Tanggal Bimbingan', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Bimbingan', 'required');
        $this->form_validation->set_rules('topik', 'Topik', 'required');
        $this->form_validation->set_rules('is_confirmed', 'Status Konfirmasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data absensi gagal diupdate. Cek kembali inputan anda.</div>');
            redirect('dosen/kelola_absensi');
        } else {
            $id = $this->input->post('id');
            $tgl_bimbingan = $this->input->post('tgl_bimbingan');
            $waktu = $this->input->post('waktu');
            $topik = $this->input->post('topik');
            $is_confirmed = $this->input->post('is_confirmed');
            $catatan_penolakan = $this->input->post('catatan_penolakan');

            // Set is_submitted menjadi 0 (false) jika is_confirmed adalah 'rejected'
            $is_submitted = $is_confirmed === 'rejected' ? 0 : 1;

             // Tambahkan kondisi untuk status
            $status = $is_confirmed === 'confirmed' ? 'hadir' : null;

            $data = [
                'tgl_bimbingan' => $tgl_bimbingan,
                'waktu' => $waktu,
                'topik' => $topik,
                'status' => $status,
                'is_confirmed' => $is_confirmed,
                'is_submitted' => $is_submitted,  // Tambahkan is_submitted
                'catatan_penolakan' => $is_confirmed === 'rejected' ? $catatan_penolakan : null,
                'updated_at' => time()
            ];

            $update = $this->dosen_model->update_absensi($id, $data);

            if ($update) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data absensi berhasil diupdate.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data absensi gagal diupdate.</div>');
            }
            redirect('dosen/kelola_absensi');
        }
    }

    public function rekomendasi_absensi($mahasiswa_id)
    {
        // Ambil data absensi mahasiswa terkait
        $absensi_bimbingan = $this->dosen_model->get_absensi_by_mahasiswa($mahasiswa_id);

        // Hitung jumlah status 'hadir'
        $jumlahHadir = 0;
        foreach ($absensi_bimbingan as $absen) {
            if ($absen['status'] === 'hadir') {
                $jumlahHadir++;
            }
        }

        // Lakukan update status absensi jika jumlah 'hadir' >= 8
        if ($jumlahHadir >= 8) {
            $update_data = ['status' => 'rekomendasi'];
            $this->dosen_model->update_status_absensi($mahasiswa_id, $update_data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status absensi berhasil direkomendasikan.</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Jumlah absensi hadir belum mencapai 8.</div>');
        }

        redirect('dosen/kelola_absensi');
    }

    // Kelola penilaian
    public function kelola_penilaian()
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Kelola Penilaian | Dosen';
        $data['active'] = 'kelola_penilaian';

        // Ambil data penilaian yang relevan untuk dosen
        $data['penilaian'] = $this->dosen_model->get_all_penilaian_by_dosen($username);

        // Ambil data mahasiswa yang terkait plotting tertentu
        $data['mahasiswa'] = $this->dosen_model->get_all_mahasiswa_by_plotting($username);

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/penilaian/v_kelola_penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_penilaian() {
        // Atur aturan validasi untuk form
        $this->form_validation->set_rules('plotting_id', 'Plotting', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('nilai_pembimbing', 'Nilai Pembimbing', 'required|numeric|trim', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);
        $this->form_validation->set_rules('nilai_penguji_1', 'Nilai Penguji 1', 'required|numeric|trim', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);
        $this->form_validation->set_rules('nilai_penguji_2', 'Nilai Penguji 2', 'required|numeric|trim', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);
    
        // Cek apakah validasi berhasil
        if ($this->form_validation->run() == FALSE) {
            // Beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Penilaian baru gagal ditambahkan!</div>');
            // Kembalikan ke halaman kelola penilaian
            $this->kelola_penilaian();
        } else {
            // Ambil data dari form
            $plotting_id = htmlspecialchars($this->input->post('plotting_id'));
            $nilai_pembimbing = (float) htmlspecialchars($this->input->post('nilai_pembimbing'));
            $nilai_penguji_1 = (float) htmlspecialchars($this->input->post('nilai_penguji_1'));
            $nilai_penguji_2 = (float) htmlspecialchars($this->input->post('nilai_penguji_2'));
    
            // Hitung rata-rata nilai dengan bobot masing-masing
            $rata_rata_nilai = ($nilai_pembimbing * 0.4) + ($nilai_penguji_1 * 0.3) + ($nilai_penguji_2 * 0.3);
    
            // Tentukan grade berdasarkan rata-rata nilai
            $grade = $this->get_grade($rata_rata_nilai);
    
            // Tentukan status kelulusan berdasarkan nilai
            $status_kelulusan = $this->get_status_kelulusan($nilai_pembimbing, $nilai_penguji_1, $nilai_penguji_2);
    
            // Siapkan data untuk disimpan
            $data = [
                'plotting_id' => $plotting_id,
                'nilai_pembimbing' => $nilai_pembimbing,
                'nilai_penguji_1' => $nilai_penguji_1,
                'nilai_penguji_2' => $nilai_penguji_2,
                'grade' => $grade,
                'status_kelulusan' => $status_kelulusan,
                'created_at' => time(),
                'updated_at' => time()
            ];
    
            // Panggil model untuk menyimpan data
            $this->dosen_model->insert_penilaian($data);
    
            // Set pesan sukses dan arahkan ke halaman kelola penilaian
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Penilaian berhasil ditambahkan!</div>');
            redirect('dosen/kelola_penilaian'); // Sesuaikan dengan method yang menampilkan data penilaian
        }
    }

    public function detail_penilaian($id)
    {
        $data['title'] = 'Detail Penilaian | Dosen';
        $data['penilaian'] = $this->dosen_model->get_penilaian_by_id($id);
        $data['active'] = 'kelola_penilaian';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/penilaian/v_detail_penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_penilaian($id)
    {
        $data['title'] = 'Ubah Penilaian | Dosen';
        $data['penilaian'] = $this->dosen_model->get_penilaian_by_id($id);
        $data['active'] = 'kelola_penilaian';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('dosen/penilaian/v_ubah_penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function update_penilaian()
    {
        $id = $this->input->post('id');

        // Set validation rules
        $this->form_validation->set_rules('nilai_pembimbing', 'Nilai Pembimbing', 'required|numeric', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);
        $this->form_validation->set_rules('nilai_penguji_1', 'Nilai Penguji 1', 'required|numeric', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);
        $this->form_validation->set_rules('nilai_penguji_2', 'Nilai Penguji 2', 'required|numeric', [
            'required' => 'Field {field} harus diisi.',
            'numeric' => 'Field {field} harus berupa angka.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_penilaian($id); // Kembali ke halaman ubah penilaian jika validasi gagal
        } else {
            // Ambil nilai input
            $nilai_pembimbing = (float) htmlspecialchars($this->input->post('nilai_pembimbing'));
            $nilai_penguji_1 = (float) htmlspecialchars($this->input->post('nilai_penguji_1'));
            $nilai_penguji_2 = (float) htmlspecialchars($this->input->post('nilai_penguji_2'));

            // Hitung rata-rata nilai dan tentukan grade serta status kelulusan
            $rata_rata_nilai = ($nilai_pembimbing * 0.4) + ($nilai_penguji_1 * 0.3) + ($nilai_penguji_2 * 0.3);
            $grade = $this->get_grade($rata_rata_nilai);
            $status_kelulusan = $this->get_status_kelulusan($nilai_pembimbing, $nilai_penguji_1, $nilai_penguji_2);

            $data = [
                'nilai_pembimbing' => $nilai_pembimbing,
                'nilai_penguji_1' => $nilai_penguji_1,
                'nilai_penguji_2' => $nilai_penguji_2,
                'grade' => $grade,
                'status_kelulusan' => $status_kelulusan,
                'updated_at' => time(),
            ];

            $update = $this->dosen_model->update_penilaian($id, $data);

            if ($update) {
                // Jika update berhasil
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data penilaian berhasil diubah!</div>');
                redirect('dosen/kelola_penilaian'); // Sesuaikan dengan path redirect
            } else {
                // Jika update gagal
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update penilaian!</div>');
                redirect('dosen/ubah_penilaian/' . $id);
            }
        }
    }

    // Method untuk menentukan grade
    private function get_grade($rata_rata_nilai) {
        if ($rata_rata_nilai >= 85) {
            return 'A';
        } elseif ($rata_rata_nilai >= 80) {
            return 'AB';
        } elseif ($rata_rata_nilai >= 70) {
            return 'B';
        } elseif ($rata_rata_nilai >= 60) {
            return 'BC';
        } elseif ($rata_rata_nilai >= 50) {
            return 'C';
        } elseif ($rata_rata_nilai >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }

    // Method untuk menentukan status kelulusan
    private function get_status_kelulusan($nilai_pembimbing, $nilai_penguji_1, $nilai_penguji_2) {
        $minimal_kelulusan = 60;
        $nilai_ideal = 80;

        // Hitung jumlah nilai yang kurang dari minimal kelulusan
        $jumlah_nilai_bawah = 0;
        $jumlah_nilai_ideal = 0;

        // Cek setiap nilai dan hitung kategori
        foreach ([$nilai_pembimbing, $nilai_penguji_1, $nilai_penguji_2] as $nilai) {
            if ($nilai < $minimal_kelulusan) {
                $jumlah_nilai_bawah++;
            } elseif ($nilai >= $nilai_ideal) {
                $jumlah_nilai_ideal++;
            }
        }

        // Tentukan status kelulusan berdasarkan kriteria
        if ($jumlah_nilai_bawah >= 2) {
            return 'Tidak Lulus';
        } elseif ($jumlah_nilai_bawah == 1) {
            return 'Sidang Ulang';
        } elseif ($jumlah_nilai_ideal == 3) {
            return 'Lulus Tanpa Perbaikan';
        } else {
            return 'Lulus Dengan Perbaikan';
        }
    }
    // Akhir kelola penilaian
}