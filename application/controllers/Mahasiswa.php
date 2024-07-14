<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

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

        // Pengecekan apakah user memiliki role 'koordinator'
        if ($this->session->userdata('nama_role') != 'mahasiswa') {
            // Redirect ke halaman lain jika bukan koordinator
            redirect('auth');
        }

        $this->load->model('jadwal_model');
        $this->load->model('mahasiswa_model');
    }

	public function index()
	{
		$data['title'] = 'Dashboard | Mahasiswa';
        $data['active'] = 'dashboard';
        // Memuat model dan mengambil data jadwal
        $data['events'] = $this->jadwal_model->get_all_events();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/v_dashboard', $data);
        $this->load->view('templates/footer');
	}

    // Kelola Absensi Bimbingan
    public function kelola_absensi()
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Kelola Absensi | Mahasiswa';
        $data['active'] = 'kelola_absensi';

        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);

        // Ambil semua data absensi bimbingan yang relevan
        $data['absensi_bimbingan'] = $this->mahasiswa_model->get_all_absensi_bimbingan_by_user($username);

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/absensi/v_kelola_absensi', $data);
        $this->load->view('templates/footer');
    }

    public function detail_absensi()
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Detail Absensi | Mahasiswa';
        $data['active'] = 'kelola_absensi';

        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);

        // Ambil semua data absensi bimbingan yang relevan
        $data['absensi_bimbingan'] = $this->mahasiswa_model->get_all_absensi_bimbingan_by_user($username);

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/absensi/v_detail_absensi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_absensi()
    {
        // Set form validation rules
        $this->form_validation->set_rules('tgl_bimbingan', 'Tanggal Bimbingan', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('topik', 'Topik', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        // Jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // Beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data absensi gagal ditambahkan!</div>');
            // Kembalikan ke halaman sebelumnya
            redirect('mahasiswa/kelola_absensi');
        } else {
            $data = [
                'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id')),
                'mahasiswa_id' => htmlspecialchars($this->input->post('mahasiswa_id')),
                'tgl_bimbingan' => htmlspecialchars($this->input->post('tgl_bimbingan')),
                'topik' => htmlspecialchars($this->input->post('topik')),
                'created_at' => time(),
                'updated_at' => time(),
            ];

            $this->mahasiswa_model->insert_absensi($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data absensi berhasil ditambahkan!</div>');
            redirect('mahasiswa/kelola_absensi');
        }
    }
    // Akhir kelola Absensi Bimbingan

}
