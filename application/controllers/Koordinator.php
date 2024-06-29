<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koordinator extends CI_Controller {
    // construct method
    public function __construct() {
        parent::__construct();
        $this->load->model('jadwal_model');

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

}
