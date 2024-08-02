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
        $username = $this->session->userdata('username');
        // Ambil data mahasiswa_id dari username
        $mahasiswa_id = $this->mahasiswa_model->get_mahasiswa_id_by_username($username);

        $data['jml_absensi'] = $this->mahasiswa_model->count_absensi_bimbingan($mahasiswa_id);

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
    
        // Ambil data draft sidang yang sesuai dengan mahasiswa saat ini
        $data['draft'] = $this->mahasiswa_model->get_all_draft_match_current_mhs($username);
        
        // periksa apakah mahasiswa sudah melakukan submit draft
        $data['is_submitted'] = $this->mahasiswa_model->cek_submitted($mahasiswa_id);

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

        $upload_path = './assets/docs/drafts';

        // Konfigurasi upload file
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 5120; // Ukuran file yang di upload max 5MB
        $config['file_name'] = uniqid(); // Generate nama file menjadi unik

        $this->load->library('upload', $config);

        // Cek apakah ada file yang diupload
        if (!$this->upload->do_upload('file_laporan')) {
            // Jika ada kesalahan upload file laporan
            $error = $this->upload->display_errors('', '');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload file laporan: ' . $error . '</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        } else {
            // Berhasil upload file laporan
            $uploadData = $this->upload->data();
            $file_laporan = $uploadData['file_name'];
        }

        if (!$this->upload->do_upload('file_dpl')) {
            // Jika ada kesalahan upload file dpl
            $error = $this->upload->display_errors('', '');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload file dokumen perangkat lunak: ' . $error . '</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        } else {
            // Berhasil upload file dpl
            $uploadData = $this->upload->data();
            $file_dpl = $uploadData['file_name'];
        }

        $data = [
            'mahasiswa_id' => $this->input->post('mahasiswa_id'),
            'kelompok_id' => $this->input->post('kelompok_id'),
            'judul' => htmlspecialchars($this->input->post('judul')),
            'file_laporan' => $file_laporan,
            'file_dpl' => $file_dpl,
            'is_submitted' => ($this->input->post('action') == 'submit') ? 1 : 0,
            'status' => 'pending',
            'submitted_at' => ($this->input->post('action') == 'submit') ? time() : NULL
        ];

        $this->mahasiswa_model->insert_draft($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Draft berhasil diupload!</div>');
        redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
    }

    public function do_update_uploaded_draft($id)
    {
        // Set rules for form validation
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi form gagal
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal memperbarui draft, periksa kembali form input!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        }

        // Ambil data draft yang ada berdasarkan ID
        $current_draft = $this->mahasiswa_model->get_draft_by_id($id);
        if (!$current_draft) {
            // Jika draft tidak ditemukan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Draft tidak ditemukan!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return; // Hentikan eksekusi lebih lanjut
        }

        $upload_path = './assets/docs/drafts';

        // Konfigurasi upload file
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 5120; // Ukuran file yang di upload max 5MB
        $config['file_name'] = uniqid(); // Generate nama file menjadi unik

        $this->load->library('upload', $config);

        // Cek dan update file laporan jika diupload
        $file_laporan = $current_draft['file_laporan'];
        if (!empty($_FILES['file_laporan']['name'])) {
            if (!$this->upload->do_upload('file_laporan')) {
                // Jika ada kesalahan upload file laporan
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload file laporan: ' . $error . '</div>');
                redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
                return; // Hentikan eksekusi lebih lanjut
            } else {
                // Berhasil upload file laporan
                $uploadData = $this->upload->data();
                $file_laporan = $uploadData['file_name'];

                // Hapus file lama jika ada
                $old_file_laporan_path = $upload_path . '/' . $current_draft['file_laporan'];
                if (file_exists($old_file_laporan_path)) {
                    unlink($old_file_laporan_path);
                }
            }
        }

        // Cek dan update file dpl jika diupload
        $file_dpl = $current_draft['file_dpl'];
        if (!empty($_FILES['file_dpl']['name'])) {
            if (!$this->upload->do_upload('file_dpl')) {
                // Jika ada kesalahan upload file dpl
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload file dokumen perangkat lunak: ' . $error . '</div>');
                redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
                return; // Hentikan eksekusi lebih lanjut
            } else {
                // Berhasil upload file dpl
                $uploadData = $this->upload->data();
                $file_dpl = $uploadData['file_name'];

                // Hapus file lama jika ada
                $old_file_dpl_path = $upload_path . '/' . $current_draft['file_dpl'];
                if (file_exists($old_file_dpl_path)) {
                    unlink($old_file_dpl_path);
                }
            }
        }

        // Update data draft
        $data = [
            'judul' => htmlspecialchars($this->input->post('judul')),
            'file_laporan' => $file_laporan,
            'file_dpl' => $file_dpl,
            'is_submitted' => ($this->input->post('action') == 'submit') ? 1 : 0,
            'status' => 'pending',
            'submitted_at' => ($this->input->post('action') == 'submit') ? time() : NULL
        ];

        $this->mahasiswa_model->update_draft($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Draft berhasil diperbarui!</div>');
        redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
    }       

    public function do_download_file_laporan($id)
    {
        // Ambil data draft berdasarkan ID
        $draft = $this->mahasiswa_model->get_draft_by_id($id);

        // Periksa apakah draft ditemukan
        if (!$draft) {
            // Jika draft tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Draft tidak ditemukan!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return;
        }

        // Tentukan path file yang akan di-download
        $file_path = './assets/docs/drafts/' . $draft['file_laporan'];

        // Periksa apakah file ada di path yang ditentukan
        if (file_exists($file_path)) {
            // Set header untuk file download
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">File tidak ditemukan!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
        }
    }

    public function do_download_file_dpl($id)
    {
        // Ambil data draft berdasarkan ID
        $draft = $this->mahasiswa_model->get_draft_by_id($id);

        // Periksa apakah draft ditemukan
        if (!$draft) {
            // Jika draft tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Draft tidak ditemukan!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
            return;
        }

        // Tentukan path file yang akan di-download
        $file_path = './assets/docs/drafts/' . $draft['file_dpl'];

        // Periksa apakah file ada di path yang ditentukan
        if (file_exists($file_path)) {
            // Set header untuk file download
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">File tidak ditemukan!</div>');
            redirect('mahasiswa/upload_draft'); // Sesuaikan dengan route yang tepat
        }
    }

    // akhir upload draft

    // Informasi jadwal sidang
    public function jadwal_sidang() {
        // data jadwal sidang dicari berdasarkan mahasiswa saat ini/yang sedang login saat ini
        $username = $this->session->userdata('username');
        $data['jadwal_sidang'] = $this->mahasiswa_model->get_jadwal_sidang($username);
        $data['title'] = 'Informasi Sidang | Mahasiswa';
        $data['active'] = 'jadwal_sidang';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/sidang/v_jadwal_sidang');
        $this->load->view('templates/footer');
    }

    public function detail_jadwal_sidang($id) {
        $data['title'] = 'Detail Jadwal Sidang | Mahasiswa';
        $data['jadwal_sidang'] = $this->jadwal_model->get_jadwal_sidang_by_id($id);

        $data['active'] = 'jadwal_sidang';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('mahasiswa/sidang/v_detail_jadwal_sidang', $data);
        $this->load->view('templates/footer');
    }
    // Akhir informasi jadwal sidang

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
