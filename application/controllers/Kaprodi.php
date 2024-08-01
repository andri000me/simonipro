<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kaprodi extends CI_Controller {

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

        // Pengecekan apakah user memiliki role 'kaprodi'
        if ($this->session->userdata('nama_role') != 'kaprodi') {
            // Redirect ke halaman lain jika bukan kaprodi
            redirect('auth');
        }

        // hubungkan dengan models
        $this->load->model('jadwal_model');
        $this->load->model('kaprodi_model');

    }

	public function index()
	{
        $data['events'] = $this->jadwal_model->get_all_events();

        // count data from tables
        $data['count_mhs'] = $this->kaprodi_model->count_all_mahasiswa();
        $data['count_dsn'] = $this->kaprodi_model->count_all_dosen();
        $data['count_rekomendasi'] = $this->kaprodi_model->count_mahasiswa_rekomendasi();
        $data['count_siap_sidang'] = $this->kaprodi_model->count_draft_sidang_approved();
        $data['count_belum_terpenuhi'] = $this->kaprodi_model->count_mahasiswa_belum_terpenuhi();

        // Calculate percentages
        $total_mahasiswa = $data['count_mhs'];
        $data['percent_siap_sidang'] = ($total_mahasiswa > 0) ? ($data['count_siap_sidang'] / $total_mahasiswa) * 100 : 0;
        $data['percent_rekomendasi'] = ($total_mahasiswa > 0) ? ($data['count_rekomendasi'] / $total_mahasiswa) * 100 : 0;
        $data['percent_belum_terpenuhi'] = ($total_mahasiswa > 0) ? ($data['count_belum_terpenuhi'] / $total_mahasiswa) * 100 : 0;

		$data['title'] = 'Dashboard | Kaprodi';
        $data['active'] = 'dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('kaprodi/v_dashboard');
        $this->load->view('templates/footer', $data);
	}

}
