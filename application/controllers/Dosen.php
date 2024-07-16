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

        // Pengecekan apakah user memiliki role 'koordinator'
        if ($this->session->userdata('nama_role') != 'dosen') {
            // Redirect ke halaman lain jika bukan koordinator
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

}