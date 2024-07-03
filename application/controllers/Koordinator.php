<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koordinator extends CI_Controller {
    // construct method
    public function __construct() {
        parent::__construct();
        $this->load->model('jadwal_model');
        $this->load->model('koordinator_model');

        // Pengecekan apakah user sudah login
        if (!$this->session->userdata('is_logged_in')) {
            // Set pesan flashdata untuk ditampilkan di halaman login
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            // Redirect ke halaman login
            redirect('auth');
        }

        // Pengecekan apakah user memiliki role 'koordinator'
        if ($this->session->userdata('nama_role') != 'koordinator') {
            // Redirect ke halaman lain jika bukan koordinator
            redirect('auth');
        }

    }

	public function index()
	{
        $data['title'] = 'Dashboard | Koordinator';
        $data['active'] = 'dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_dashboard');
        $this->load->view('templates/footer');
	}

    // Kelola jadwal
    public function kelola_jadwal() {
        $data['title'] = 'Kelola Jadwal | Koordinator';
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal();
        $data['active'] = 'kelola_jadwal';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_kelola_jadwal', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_jadwal() {
        $this->form_validation->set_rules('nama_jadwal', 'Nama_Jadwal', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->kelola_jadwal();
        } else {
            $data = [
                'nama_jadwal' => htmlspecialchars($this->input->post('nama_jadwal')),
                'status' => 'draft',
                'created_at' => time(),
                'updated_at' => time()
            ];

            $this->jadwal_model->insert_jadwal($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jadwal baru berhasil ditambahkan!</div>');
            redirect('koordinator/kelola_jadwal');
        }
    }

    public function detail_jadwal($id)
    {
        $data['title'] = 'Detail Jadwal | Koordinator';
        $data['jadwal'] = $this->jadwal_model->get_jadwal_by_id($id);
        $data['active'] = 'kelola_jadwal';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_detail_jadwal', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_jadwal($id)
    {
        $data['title'] = 'Detail Jadwal | Koordinator';
        $data['jadwal'] = $this->jadwal_model->get_jadwal_by_id($id);
        $data['active'] = 'kelola_jadwal';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_ubah_jadwal', $data);
        $this->load->view('templates/footer');
    }

    public function update_jadwal()
    {
        $id = $this->input->post('id');

        // set_rules
        $this->form_validation->set_rules('nama_jadwal', 'Nama_Jadwal', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_jadwal($id); // Kembali ke halaman ubah jadwal jika validasi gagal
        } else {
            $data = [
                'nama_jadwal' => htmlspecialchars($this->input->post('nama_jadwal')),
                'created_at' => $this->input->post('created_at'),
                'updated_at' => time(),
                'status' => 'draft'
            ];

            $update = $this->jadwal_model->update_jadwal($id, $data);

            if ($update) {
                // If update is successful
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data jadwal berhasil di ubah!</div>');
                redirect('koordinator/kelola_jadwal'); // Adjust the redirect path as needed
            } else {
                // If update fails
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update jadwal!</div>');
                redirect('koordinator/ubah_jadwal/' . $id);
            }
        }
    }
    // akhir kelola jadwal

    // Kelola Kegiatan
    public function kelola_kegiatan() {
        $data['title'] = 'Kelola Kegiatan | Koordinator';
        $data['kegiatan'] = $this->jadwal_model->get_all_kegiatan();
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal();
        $data['active'] = 'kelola_kegiatan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_kelola_kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_kegiatan() 
    {
        // set_rules
        $this->form_validation->set_rules('jadwal_id', 'Jadwal_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_awal', 'tgl_awal', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tgl_Selesai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_Kegiatan', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        // jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Kegiatan baru gagal ditambahkan!</div>');
            // kembalikan ke halaman kelola kegiatan
            $this->kelola_kegiatan();
        } else {
            $data = [
                'jadwal_id' => htmlspecialchars($this->input->post('jadwal_id')),
                'tgl_awal' => htmlspecialchars($this->input->post('tgl_awal')),
                'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai')),
                'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
            ];

            $this->jadwal_model->insert_kegiatan($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Kegiatan baru berhasil ditambahkan!</div>');
            redirect('koordinator/kelola_kegiatan');
        }
    }

    public function ubah_kegiatan($id)
    {
        $data['title'] = 'Detail Kegiatan | Koordinator';
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal();
        $data['kegiatan'] = $this->jadwal_model->get_kegiatan_by_id($id);
        $data['active'] = 'kelola_kegiatan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_ubah_kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function update_kegiatan()
    {
        $id = $this->input->post('id');

        // set_rules
        $this->form_validation->set_rules('jadwal_id', 'Jadwal_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_kegiatan', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_awal', 'Tgl_Awal', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tgl_Selesai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_kegiatan($id); // Kembali ke halaman ubah kegiatan jika validasi gagal
        } else {
            $data = [
                'jadwal_id' => htmlspecialchars($this->input->post('jadwal_id')),
                'tgl_awal' => htmlspecialchars($this->input->post('tgl_awal')),
                'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai')),
                'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
            ];

            $update = $this->jadwal_model->update_kegiatan($id, $data);

            if ($update) {
                // If update is successful
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data kegiatan berhasil di ubah!</div>');
                redirect('koordinator/kelola_kegiatan'); // Adjust the redirect path as needed
            } else {
                // If update fails
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update kegiatan!</div>');
                redirect('koordinator/ubah_kegiatan/' . $id);
            }
        }
    }

    public function hapus_kegiatan($id)
    {
        $this->jadwal_model->delete_kegiatan($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kegiatan berhasil dihapus!</div>');
        redirect('koordinator/kelola_kegiatan');
    }
    // Akhir kelola kegiatan

    // Kelola Plotting
    public function kelola_plotting() {
        $data['title'] = 'Kelola Plotting | Koordinator';
        $data['plotting'] = $this->koordinator_model->get_all_plotting_pembimbing();
        $data['active'] = 'kelola_plotting';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/v_kelola_plotting', $data);
        $this->load->view('templates/footer');
    }
    // Akhir kelola plotting
}
