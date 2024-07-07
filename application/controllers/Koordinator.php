<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koordinator extends CI_Controller {
    // construct method
    public function __construct() {
        parent::__construct();
        $this->load->model('staff_model');
        $this->load->model('jadwal_model');
        $this->load->model('koordinator_model');

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

    // Kelola Project
    public function kelola_project() {
        $data['title'] = 'Kelola Project';
        // Ambil data project
        $data['projects'] = $this->koordinator_model->get_all_projects();
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/project/v_kelola_project', $data);
        $this->load->view('templates/footer');
    }

    // Tambah Project
    public function tambah_project() 
    {
        // Set form validation rules
        $this->form_validation->set_rules('nama_project', 'Nama Project', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|max_length[255]', [
            'required' => 'Field {field} harus diisi.',
            'max_length' => 'Melebihi batas karakter yang diperbolehkan.'
        ]);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal_Mulai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal_Selesai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('prodi_id', 'Prodi_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        // Jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // Beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Project baru gagal ditambahkan!</div>');
            // Kembalikan ke halaman kelola project
            $this->kelola_project();
        } else {
            $data = [
                'nama_project' => htmlspecialchars($this->input->post('nama_project')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
                'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai')),
                'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai')),
                'prodi_id' => htmlspecialchars($this->input->post('prodi_id'))
            ];

            $this->koordinator_model->insert_project($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Project baru berhasil ditambahkan!</div>');
            redirect('koordinator/kelola_project');
        }
    }

    public function detail_project($id)
    {
        $data['title'] = 'Detail Prodi | Staff';
        $data['projects'] = $this->koordinator_model->get_project_by_id($id);
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/project/v_detail_project', $data);
        $this->load->view('templates/footer');
    }
    public function ubah_project($id)
    {
        $data['title'] = 'Ubah Mahasiswa | Staff';
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['projects'] = $this->koordinator_model->get_project_by_id($id);
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/project/v_ubah_project', $data);
        $this->load->view('templates/footer');
    }

    public function update_project()
    {
        $id = $this->input->post('id');
        $current_project = $this->koordinator_model->get_project_by_id($id);

        // Set validation rules
        $this->form_validation->set_rules('nama_project', 'Nama_Project', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal_Mulai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal_Selesai', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('prodi_id', 'Prodi_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_project($id); // Kembali ke halaman ubah project jika validasi gagal
        } else {
            $data = [
                'nama_project' => htmlspecialchars($this->input->post('nama_project')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
                'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai')),
                'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai')),
                'prodi_id' => htmlspecialchars($this->input->post('prodi_id')),
            ];

            $update = $this->koordinator_model->update_project($id, $data);

            if ($update) {
                // If update is successful
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data project berhasil diubah!</div>');
                redirect('koordinator/kelola_project'); // Adjust the redirect path as needed
            } else {
                // If update fails
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update project!</div>');
                redirect('koordinator/ubah_project/' . $id);
            }
        }
    }
    // Akhir kelola project

    // Kelola jadwal
    public function kelola_jadwal() {
        $data['title'] = 'Kelola Jadwal | Koordinator';
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal();
        $data['active'] = 'kelola_jadwal';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/jadwal/v_kelola_jadwal', $data);
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
        $data['kegiatan'] = $this->jadwal_model->get_kegiatan_by_jadwal_id($id);  // Menambahkan data kegiatan

        $data['active'] = 'kelola_jadwal';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/jadwal/v_detail_jadwal', $data);
        $this->load->view('templates/footer');
    }

    public function do_publish_jadwal($id) {
        $data = array(
            'status' => 'published',
            'updated_at' => time()
        );

        $result = $this->jadwal_model->update_jadwal($id, $data);

        if ($result) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jadwal berhasil dipublikasikan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mempublikasikan jadwal!</div>');
        }

        redirect('koordinator/kelola_jadwal');
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
        $this->load->view('koordinator/kegiatan/v_kelola_kegiatan', $data);
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
        $this->load->view('koordinator/kegiatan/v_ubah_kegiatan', $data);
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
        $data['plotting'] = $this->koordinator_model->getAllPlotting();
        // data from other tables
        $data['koordinator'] = $this->staff_model->get_all_koordinator();
        $data['dosen'] = $this->staff_model->get_all_dosen();
        $data['projects'] = $this->koordinator_model->get_all_projects();
        $data['jenis_plotting'] = $this->koordinator_model->get_all_jenis_plotting();
        // Ambil user id mahasiswa yang sudah dipilih
        $selectedUserIds = $this->koordinator_model->get_selected_user_mhs_ids();
        // Kirim user id yang sudah dipilih ke fungsi get_all_user_match_by_role_as_mahasiswa
        $data['mahasiswa'] = $this->koordinator_model->get_all_user_match_by_role_as_mahasiswa($selectedUserIds);

        $data['title'] = 'Kelola Plotting | Koordinator';
        $data['active'] = 'kelola_plotting';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/plotting/v_kelola_plotting', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_plotting() 
{
    // Set rules for common fields
    $this->form_validation->set_rules('koordinator_id', 'Koordinator_ID', 'required|trim', [
        'required' => 'Field {field} harus diisi.',
    ]);
    $this->form_validation->set_rules('dosen_pembimbing_id', 'Dosen_Pembimbing_ID', 'required|trim', [
        'required' => 'Field {field} harus diisi.',
    ]);
    $this->form_validation->set_rules('mahasiswa_id', 'Mahasiswa_ID', 'required|trim', [
        'required' => 'Field {field} harus diisi.',
    ]);
    $this->form_validation->set_rules('project_id', 'Project_ID', 'required|trim', [
        'required' => 'Field {field} harus diisi.',
    ]);
    $this->form_validation->set_rules('jenis_plotting_id', 'Jenis_Plotting_ID', 'required|trim', [
        'required' => 'Field {field} harus diisi.',
    ]);

    // Get jenis_plotting_id value
    $jenis_plotting_id = $this->input->post('jenis_plotting_id');

    // If jenis_plotting_id is 'Penguji', set additional rules
    if ($jenis_plotting_id == '2') { // Replace '2' with the actual ID for 'Penguji'
        $this->form_validation->set_rules('dosen_penguji_1_id', 'Dosen_Penguji_1_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('dosen_penguji_2_id', 'Dosen_Penguji_2_ID', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
    }

    // Run form validation, if false, return with error message
    if ($this->form_validation->run() == FALSE) {
        // Set error message
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data plotting baru gagal ditambahkan!</div>');
        // Redirect back to kelola plotting page
        $this->kelola_plotting();
    } else {
        // Prepare data to be inserted
        $data = [
            'koordinator_id' => htmlspecialchars($this->input->post('koordinator_id')),
            'dosen_pembimbing_id' => htmlspecialchars($this->input->post('dosen_pembimbing_id')),
            'mahasiswa_id' => htmlspecialchars($this->input->post('mahasiswa_id')),
            'project_id' => htmlspecialchars($this->input->post('project_id')),
            'jenis_plotting_id' => htmlspecialchars($this->input->post('jenis_plotting_id')),
            'created_at' => time(),
            'updated_at' => time()
        ];

        // If jenis_plotting_id is 'Penguji', add dosen_penguji_1_id and dosen_penguji_2_id to the data
        if ($jenis_plotting_id == '2') { // Replace '2' with the actual ID for 'Penguji'
            $data['dosen_penguji_1_id'] = htmlspecialchars($this->input->post('dosen_penguji_1_id'));
            $data['dosen_penguji_2_id'] = htmlspecialchars($this->input->post('dosen_penguji_2_id'));
        }

        // Insert data into database
        $this->koordinator_model->insert_plotting($data);
        // Set success message
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data plotting baru berhasil ditambahkan!</div>');
        // Redirect to kelola plotting page
        redirect('koordinator/kelola_plotting');
    }
}


    public function detail_plotting($id)
    {
        $data['title'] = 'Detail Plotting | Koordinator';
        $data['plotting'] = $this->koordinator_model->getPlottingById($id);
        $data['active'] = 'kelola_plotting';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/plotting/v_detail_plotting', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_plotting($id) {
        $data['title'] = 'Ubah Plotting | Koordinator';
        $data['plotting'] = $this->koordinator_model->getPlottingById($id);
        $data['dosen'] = $this->staff_model->get_all_dosen();
        $data['jenis_plotting'] = $this->koordinator_model->get_all_jenis_plotting();
        $data['active'] = 'kelola_plotting';
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('koordinator/plotting/v_ubah_plotting', $data);
        $this->load->view('templates/footer');
    }

    public function update_plotting() {
        // Set rules for form validation
        $this->form_validation->set_rules('jenis_plotting_id', 'Jenis Plotting', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        $this->form_validation->set_rules('dosen_pembimbing_id', 'Dosen Pembimbing', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
    
        // Fetch form data
        $jenis_plotting_id = $this->input->post('jenis_plotting_id');
        $dosen_pembimbing_id = $this->input->post('dosen_pembimbing_id');
        $dosen_penguji_1_id = $this->input->post('dosen_penguji_1_id');
        $dosen_penguji_2_id = $this->input->post('dosen_penguji_2_id');
    
        // Debug form data
        // var_dump($jenis_plotting_id);
        // var_dump($dosen_pembimbing_id);
        // var_dump($dosen_penguji_1_id);
        // var_dump($dosen_penguji_2_id);
        // var_dump($this->form_validation->run());
        // die;
    
        // Check if `jenis_plotting_id` is 2 to add rules for penguji
        if ($jenis_plotting_id == '2') {
            $this->form_validation->set_rules('dosen_penguji_1_id', 'Dosen Penguji 1', 'required|trim', [
                'required' => 'Field {field} harus diisi.'
            ]);
            $this->form_validation->set_rules('dosen_penguji_2_id', 'Dosen Penguji 2', 'required|trim', [
                'required' => 'Field {field} harus diisi.'
            ]);
        }
    
        // Check if the form validation is successful
        if ($this->form_validation->run() == FALSE) {
            // Debug form validation
            var_dump($this->form_validation->error_array());
            die;
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data plotting gagal diubah.</div>');
            redirect('koordinator/ubah_plotting/' . $this->input->post('id'));
        } else {
            // Prepare data for update
            $data = [
                'jenis_plotting_id' => $jenis_plotting_id,
                'dosen_pembimbing_id' => $dosen_pembimbing_id,
                'updated_at' => time()
            ];
    
            if ($jenis_plotting_id == 2) {
                $data['dosen_penguji_1_id'] = $dosen_penguji_1_id;
                $data['dosen_penguji_2_id'] = $dosen_penguji_2_id;
            } else {
                $data['dosen_penguji_1_id'] = null;
                $data['dosen_penguji_2_id'] = null;
            }
    
            $result = $this->koordinator_model->updatePlotting($this->input->post('id'), $data);
    
            if ($result) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data plotting berhasil diubah.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data plotting gagal diubah.</div>');
            }
    
            redirect('koordinator/kelola_plotting');
        }
    }
    
    // Akhir kelola plotting
}
