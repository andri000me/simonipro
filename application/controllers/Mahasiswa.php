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

    // upload draft
    public function upload_draft() {
        // Ambil username dari session
        $username = $this->session->userdata('username');
    
        // Ambil data mahasiswa_id dari username
        $mahasiswa_id = $this->mahasiswa_model->get_mahasiswa_id_by_username($username);
    
        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);
    
        // Periksa apakah mahasiswa sudah mengupload draft
        $data['has_uploaded_draft'] = $this->mahasiswa_model->has_uploaded_draft($mahasiswa_id);
    
        // Ambil status terakhir absensi bimbingan
        $statusTerakhirData = $this->mahasiswa_model->get_last_absensi_status($username);
        $statusTerakhir = isset($statusTerakhirData['status']) ? $statusTerakhirData['status'] : '';
    
        // Set data untuk halaman
        $data['title'] = 'Upload Draft | Mahasiswa';
        $data['active'] = 'upload_draft';
        $data['isRekomendasi'] = $statusTerakhir === 'rekomendasi';
    
        // Render halaman
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/draft/v_upload_draft', $data);
        $this->load->view('templates/footer');
    }
     

    public function do_upload_draft()
    {
        // Set rules for form validation
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi form gagal
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload draft, periksa kembali form input!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        }

        // Konfigurasi upload file
        $config['upload_path'] = './assets/docs/drafts';
        $config['allowed_types'] = 'zip|rar';
        $config['max_size'] = 20480; // Ukuran file yang di upload max 20MB
        $config['file_name'] = uniqid(); // Generate nama file menjadi unik

        $this->load->library('upload', $config);

        // Cek apakah ada file yang diupload
        if (!$this->upload->do_upload('file_path')) {
            // Jika ada kesalahan upload file
            $error = $this->upload->display_errors('', '');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">'.$error.'</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        } else {
            // Berhasil upload file
            $uploadData = $this->upload->data();
            $file_path = $uploadData['file_name'];
        }

        $data = [
            'mahasiswa_id' => $this->input->post('mahasiswa_id'),
            'kelompok_id' => $this->input->post('kelompok_id'),
            'judul' => htmlspecialchars($this->input->post('judul')),
            'file_path' => $file_path,
            'status' => 'pending',
            'submitted_at' => time()
        ];

        $this->mahasiswa_model->insert_draft($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Draft berhasil diupload!</div>');
        redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
    }

    // akhir upload draft

    // print absensi kehadiran
    public function print_absensi()
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
    public function print_rekomendasi()
    {
        // Ambil data mahasiswa
        $username = $this->session->userdata('username');
        // Ambil data kelompok yang sesuai dengan mahasiswa saat ini
        $data['kelompok'] = $this->mahasiswa_model->get_all_kelompok_match_current_mhs($username);
        // Ambil data absensi bimbingan terakhir dengan status 'rekomendasi'
        $data['absensi_bimbingan'] = $this->mahasiswa_model->get_last_absensi_status($username);

        $html = $this->load->view('pdfGenerator/v_print_rekomendasi', $data, true);

        $this->pdf->load_html($html);
        $this->pdf->render();

        // Save PDF file to a temporary location
        $output = $this->pdf->output();
        file_put_contents('./assets/docs/pdf/rekomendasi.pdf', $output);

        // Optional: Download PDF instead of saving
        $this->pdf->stream("rekomendasi.pdf");
    }
    // Akhir kelola Absensi Bimbingan

    // print kalender proyek 2
    public function print_kalender()
    {
        // Mengambil jadwal_id yang statusnya 'published'
        $jadwal_published = $this->jadwal_model->get_published_jadwal();

        $jadwal_id = $jadwal_published['id'];

        $data['jadwal'] = $this->jadwal_model->get_jadwal_by_id($jadwal_id);
        $data['kegiatan'] = $this->jadwal_model->get_kegiatan_by_jadwal_id($jadwal_id);  // Menambahkan data kegiatan

        $html = $this->load->view('pdfGenerator/v_print_kalender_pdf', $data, true);

        $this->pdf->load_html($html);
        $this->pdf->render();

        // Save PDF file to a temporary location
        $output = $this->pdf->output();
        file_put_contents('./assets/docs/pdf/kalender.pdf', $output);

        // Optional: Download PDF instead of saving
        $this->pdf->stream("kalender.pdf");
    }
}
