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

        // Hitung jumlah kehadiran
        $jumlahHadir = 0;
        $statusTerakhir = '';

        foreach ($data['absensi_bimbingan'] as $absen) {
            if ($absen['status'] === 'hadir') {
                $jumlahHadir++;
            }
            $statusTerakhir = $absen['status'];
        }

        $data['jumlahHadir'] = $jumlahHadir;

        // Ambil status terakhir absensi bimbingan
        $statusTerakhirData = $this->mahasiswa_model->get_last_absensi_status($username);
        $data['statusTerakhir'] = isset($statusTerakhirData['status']) ? $statusTerakhirData['status'] : '';

        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/absensi/v_kelola_absensi', $data);
        $this->load->view('templates/footer');
    }


    public function detail_absensi($id)
    {
        // Ambil username dari session
        $username = $this->session->userdata('username');

        // Set data untuk halaman
        $data['title'] = 'Detail Absensi | Mahasiswa';
        $data['active'] = 'kelola_absensi';

        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);

        // Ambil semua data absensi bimbingan yang relevan
        $data['absensi_bimbingan'] = $this->mahasiswa_model->get_all_absensi_bimbingan_by_id($id);

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
        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim', [
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
                'waktu' => htmlspecialchars($this->input->post('waktu')),
                'topik' => htmlspecialchars($this->input->post('topik')),
                'created_at' => time(),
                'updated_at' => time(),
            ];

            $this->mahasiswa_model->insert_absensi($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data absensi berhasil ditambahkan!</div>');
            redirect('mahasiswa/kelola_absensi');
        }
    }

    public function update_absensi()
    {
        $this->form_validation->set_rules('tgl_bimbingan', 'Tanggal Bimbingan', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required');
        $this->form_validation->set_rules('topik', 'Topik', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data absensi gagal diupdate. Cek kembali inputan anda.</div>');
            redirect('mahasiswa/kelola_absensi');
        } else {
            $id = $this->input->post('id');
            $data = [
                'tgl_bimbingan' => $this->input->post('tgl_bimbingan'),
                'waktu' => $this->input->post('waktu'),
                'topik' => $this->input->post('topik'),
                'is_confirmed' => 'pending',
                'updated_at' => time()
            ];

            $update = $this->mahasiswa_model->update_absensi($id, $data);

            if ($update) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data absensi berhasil diupdate.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data absensi gagal diupdate.</div>');
            }
            redirect('mahasiswa/kelola_absensi');
        }
    }

    public function submit_absensi($id)
    {
        $data = [
            'is_submitted' => 1, // Set is_submitted to true (1)
            'updated_at' => time()
        ];

        $update = $this->mahasiswa_model->update_absensi($id, $data);

        if ($update) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Absensi berhasil disubmit.</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Absensi gagal disubmit.</div>');
        }

        redirect('mahasiswa/kelola_absensi');
    }
    // Akhir kelola Absensi Bimbingan

    // print absensi kehadiran
    public function print_pdf()
    {
        // Ambil data mahasiswa
        $username = $this->session->userdata('username');
        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);
        // Ambil data absensi yang sesuai dengan mahasiswa saat ini
        $data['absensi_bimbingan'] = $this->mahasiswa_model->get_all_absensi_bimbingan_by_user($username);

        $html = $this->load->view('mahasiswa/absensi/v_print_pdf', $data, true);

        $this->pdf->load_html($html);
        $this->pdf->render();

        // Save PDF file to a temporary location
        $output = $this->pdf->output();
        file_put_contents('./assets/docs/pdf/absensi_mahasiswa.pdf', $output);

        // Optional: Download PDF instead of saving
        $this->pdf->stream("absensi_mahasiswa.pdf");
    }

}
