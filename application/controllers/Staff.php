<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('staff_model');
        $this->load->model('user_model');
        $this->load->model('jadwal_model');

         // Pengecekan apakah user sudah login
         if (!$this->session->userdata('is_logged_in')) {
            // Set pesan flashdata untuk ditampilkan di halaman login
            $this->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
            // Redirect ke halaman login
            redirect('auth');
        }

        // Pengecekan apakah user memiliki role 'staff'
        if ($this->session->userdata('nama_role') != 'staff') {
            // Redirect ke halaman lain jika bukan staff
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Dashboard | Staff';
        $data['active'] = 'dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_dashboard');
        $this->load->view('templates/footer');
	}

    // kelola role
    public function kelola_role()
    {
        $data['title'] = 'Kelola Role | Staff';
        $data['roles'] = $this->staff_model->get_all_role();
        $data['active'] = 'kelola_role';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_role');
        $this->load->view('templates/footer');
    }

    public function tambah_role()
    {
        // set_rules
        $this->form_validation->set_rules('nama_role', 'Nama_Role', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);

        // jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Role baru gagal ditambahkan!</div>');
            // kembalikan ke halaman kelola role
            $this->kelola_role();
        } else {
            $data = [
                'nama_role' => htmlspecialchars($this->input->post('nama_role'))
            ];

            $this->staff_model->insert_role($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Role baru berhasil ditambahkan!</div>');
            redirect('staff/kelola_role');
        }
    }

    public function ubah_role($id)
    {
        $data['title'] = 'Ubah Role | Staff';
        $data['roles'] = $this->staff_model->get_role_by_id($id);
        $data['active'] = 'kelola_role';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_role');
        $this->load->view('templates/footer');
    }

    public function update_role() {
        $id = $this->input->post('id');
        $newRoleData = [
            'nama_role' => htmlspecialchars($this->input->post('nama_role')),
            // Add other fields as necessary
        ];
    
        $update = $this->staff_model->update_role($id, $newRoleData);
    
        if ($update) {
            // If update is successful
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data role berhasil di ubah!</div>');
            redirect('staff/kelola_role'); // Adjust the redirect path as needed
        } else {
            // If update fails
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Gagal melakukan update role !</div>');
            redirect('staff/ubah_role/' . $id);
        }
    }
    

    public function hapus_role($id)
    {
        $this->staff_model->delete_role($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Role berhasil dihapus!</div>');
        redirect('staff/kelola_role');
    }
    // akhir kelola role

    // kelola pengguna
    public function kelola_pengguna() {
        $data['title'] = 'Kelola Pengguna | Staff';
        // ambil data pengguna
        $data['pengguna'] = $this->user_model->get_all_user();
        // ambil data role
        $data['roles'] = $this->staff_model->get_all_role();
        $data['active'] = 'kelola_pengguna';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_pengguna');
        $this->load->view('templates/footer');
    }

    public function tambah_pengguna() 
    {
        // set_rules
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Field {field} harus diisi.',
            'is_unique' => 'Username sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required' => 'Field {field} harus diisi.',
            'min_length' => 'Password harus memiliki panjang minimal 6 karakter.',
        ]);
        $this->form_validation->set_rules('role_id', 'Role_Id', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('is_active', 'Is_Active', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        // jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Pengguna baru gagal ditambahkan!</div>');
            // kembalikan ke halaman kelola user
            $this->kelola_pengguna();
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => htmlspecialchars(password_hash($this->input->post('password'), PASSWORD_DEFAULT)),
                'role_id' => htmlspecialchars($this->input->post('role_id')),
                'is_active' => htmlspecialchars($this->input->post('is_active')),
                'created_at' => time(),
                'updated_at' => time()
            ];

            $this->user_model->insert_user($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Pengguna baru berhasil ditambahkan!</div>');
            redirect('staff/kelola_pengguna');
        }
    }

    public function detail_pengguna($id)
    {
        $data['title'] = 'Detail Pengguna | Staff';
        $data['active'] = 'kelola_pengguna';
        $data['pengguna'] = $this->user_model->get_user_by_id($id);
        $data['roles'] = $this->staff_model->get_all_role();

        // Menggabungkan nama role ke data pengguna
        foreach ($data['roles'] as $role) {
            if ($role['id'] == $data['pengguna']['role_id']) {
                $data['pengguna']['nama_role'] = $role['nama_role'];
                break;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_pengguna', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_pengguna($id)
    {
        $data['title'] = 'Ubah Pengguna | Staff';
        $data['active'] = 'kelola_pengguna';
        $data['roles'] = $this->staff_model->get_all_role();
        $data['pengguna'] = $this->user_model->get_user_by_id($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_pengguna');
        $this->load->view('templates/footer');
    }

    public function update_pengguna()
    {
        $id = $this->input->post('id');
        $current_user = $this->user_model->get_user_by_id($id);

        // set_rules
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        // Only apply the is_unique rule if the new username is different from the current username
        $new_username = $this->input->post('username');
        if ($new_username != $current_user['username']) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
                'required' => 'Field {field} harus diisi.',
                'is_unique' => 'Username sudah terdaftar.'
            ]);
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => 'Field {field} harus diisi.',
            ]);
        }

        // Only add password validation rule if the password field is not empty
        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
                'required' => 'Field {field} harus diisi.',
                'min_length' => 'Password harus memiliki panjang minimal 6 karakter.',
            ]);
        }

        $this->form_validation->set_rules('role_id', 'Role_Id', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        $this->form_validation->set_rules('is_active', 'Is_Active', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_pengguna($id); // Kembali ke halaman ubah pengguna jika validasi gagal
        } else {
            $password = $this->input->post('password');
            if (!empty($password)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $password = $this->input->post('old_password'); // gunakan password lama jika tidak ada password baru yang ditambahkan
            }

            $newUserData = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => $password,
                'role_id' => htmlspecialchars($this->input->post('role_id')),
                'is_active' => htmlspecialchars($this->input->post('is_active')),
                'created_at' => $this->input->post('created_at'),
                'updated_at' => time()
            ];

            $update = $this->user_model->update_user($id, $newUserData);

            if ($update) {
                // If update is successful
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data pengguna berhasil di ubah!</div>');
                redirect('staff/kelola_pengguna'); // Adjust the redirect path as needed
            } else {
                // If update fails
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update pengguna!</div>');
                redirect('staff/ubah_pengguna/' . $id);
            }
        }
    }

    public function hapus_pengguna($id)
    {
        $this->user_model->delete_user($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pengguna berhasil dihapus!</div>');
        redirect('staff/kelola_pengguna');
    }
    // akhir kelola pengguna

    // kelola prodi
    public function kelola_prodi()
    {
        $data['title'] = 'Kelola prodi | Staff';
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['active'] = 'kelola_prodi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_prodi');
        $this->load->view('templates/footer');
    }

    public function tambah_prodi()
    {
        // set_rules
        $this->form_validation->set_rules('kode_prodi', 'Kode_prodi', 'required|trim|is_unique[prodi.kode_prodi]|exact_length[5]|is_numeric', [
            'required' => 'Field {field} harus diisi.',
            'is_unique' => 'Kode prodi sudah terdaftar.',
            'exact_length' => 'Field {field} harus berisi 5 digit karakter.', 
            'is_numeric' => 'Format isian harus berupa angka / numerik.'
        ]);
        $this->form_validation->set_rules('nama_prodi', 'Nama_prodi', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');

        // jalankan form validation, dan jika bernilai false, maka
        if ($this->form_validation->run() == FALSE) {
            // beri pesan kesalahan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Prodi baru gagal ditambahkan!</div>');
            // kembalikan ke halaman kelola role
            $this->kelola_prodi();
        } else {
            $data = [
                'kode_prodi' => htmlspecialchars($this->input->post('kode_prodi')),
                'nama_prodi' => htmlspecialchars($this->input->post('nama_prodi')),
                'jenjang' => htmlspecialchars($this->input->post('jenjang'))
            ];

            $this->staff_model->insert_prodi($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Prodi baru berhasil ditambahkan!</div>');
            redirect('staff/kelola_prodi');
        }
    }

    public function detail_prodi($id)
    {
        $data['title'] = 'Detail Prodi | Staff';
        $data['prodi'] = $this->staff_model->get_prodi_by_id($id);
        $data['active'] = 'kelola_prodi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_prodi', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_prodi($id)
    {
        $data['title'] = 'Ubah Prodi | Staff';
        $data['prodi'] = $this->staff_model->get_prodi_by_id($id);
        $data['active'] = 'kelola_prodi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_prodi');
        $this->load->view('templates/footer');
    }

    public function update_prodi() {
        $id = $this->input->post('id');
        $newProdiData = [
            'kode_prodi' => htmlspecialchars($this->input->post('kode_prodi')),
            'nama_prodi' => htmlspecialchars($this->input->post('nama_prodi')),
            'jenjang' => htmlspecialchars($this->input->post('jenjang')),
        ];
    
        $update = $this->staff_model->update_prodi($id, $newProdiData);
    
        if ($update) {
            // If update is successful
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data prodi berhasil di ubah!</div>');
            redirect('staff/kelola_prodi'); // Adjust the redirect path as needed
        } else {
            // If update fails
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Gagal melakukan update data prodi!</div>');
            redirect('staff/ubah_prodi/' . $id);
        }
    }
    // akhir kelola prodi

    // Kelola Project
    public function kelola_project() {
        $data['title'] = 'Kelola Project';
        // Ambil data project
        $data['projects'] = $this->staff_model->get_all_projects();
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_project', $data);
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

            $this->staff_model->insert_project($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Project baru berhasil ditambahkan!</div>');
            redirect('staff/kelola_project');
        }
    }

    public function detail_project($id)
    {
        $data['title'] = 'Detail Prodi | Staff';
        $data['projects'] = $this->staff_model->get_project_by_id($id);
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_project', $data);
        $this->load->view('templates/footer');
    }
    public function ubah_project($id)
    {
        $data['title'] = 'Ubah Mahasiswa | Staff';
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['projects'] = $this->staff_model->get_project_by_id($id);
        $data['active'] = 'kelola_project';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_project', $data);
        $this->load->view('templates/footer');
    }

    public function update_project()
    {
        $id = $this->input->post('id');
        $current_project = $this->staff_model->get_project_by_id($id);

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

            $update = $this->staff_model->update_project($id, $data);

            if ($update) {
                // If update is successful
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data project berhasil diubah!</div>');
                redirect('staff/kelola_project'); // Adjust the redirect path as needed
            } else {
                // If update fails
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal melakukan update project!</div>');
                redirect('staff/ubah_project/' . $id);
            }
        }
    }
    // Akhir kelola project

    // kelola mahasiswa
    public function kelola_mahasiswa()
    {
        $data['title'] = 'Kelola Mahasiswa | Staff';
        $data['mahasiswa'] = $this->staff_model->get_all_mahasiswa();
        // Ambil user id yang sudah dipilih
        $selectedUserIds = $this->staff_model->get_selected_user_mhs_ids();
        $data['prodi'] = $this->staff_model->get_all_prodi();
        // Kirim user id yang sudah dipilih ke fungsi get_all_user_match_by_role_as_mahasiswa
        $data['users'] = $this->staff_model->get_all_user_match_by_role_as_mahasiswa($selectedUserIds);
        $data['active'] = 'kelola_mahasiswa';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_mahasiswa() 
    {
        // set_rules
        $this->form_validation->set_rules('npm', 'Npm', 'required|trim|min_length[9]|is_unique[mahasiswa.npm]', [
            'required' => 'Field {field} harus diisi.',
            'min_length' => 'NPM harus terdiri dari 9 digit karakter.',
            'is_unique' => 'NPM sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('user_id', 'User_id', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        $this->form_validation->set_rules('prodi_id', 'Prodi_id', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">Data mahasiswa gagal ditambahkan!</div>');
            $this->kelola_mahasiswa();
        } else {
            $config['upload_path'] = './assets/images/upload';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024; // ukuran file yang di upload max 1MB
            $config['file_name'] = uniqid(); // generate nama file menjadi unik
    
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('gambar')) {
                // Cek kesalahan upload
                $error = $this->upload->display_errors('', '');
                if ($error == 'You did not select a file to upload.') {
                    $err_message = 'Silahkan upload file gambar terlebih dahulu.';
                } elseif (strpos($error, 'The filetype you are attempting to upload is not allowed') !== false) {
                    $err_message = 'File yang di upload harus berupa .png, .jpg, atau .jpeg.';
                } elseif (strpos($error, 'The file you are attempting to upload is larger than the permitted size') !== false) {
                    $err_message = 'File yang di upload tidak boleh lebih dari 1MB.';
                } else {
                    $err_message = $error;
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                $this->kelola_mahasiswa();
            } else {
                $uploadData = $this->upload->data();
                $data = [
                    'user_id' => $this->input->post('user_id'),
                    'npm' => htmlspecialchars($this->input->post('npm')),
                    'prodi_id' => htmlspecialchars($this->input->post('prodi_id')),
                    'semester' => htmlspecialchars($this->input->post('semester')),
                    'gambar' => $uploadData['file_name']
                ];
    
                $this->staff_model->insert_mahasiswa($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Data mahasiswa berhasil ditambahkan!</div>');
                redirect('staff/kelola_mahasiswa');
            }
        }
    }

    public function detail_mahasiswa($id)
    {
        $data['title'] = 'Detail Mahasiswa | Staff';
        $data['mahasiswa'] = $this->staff_model->get_mahasiswa_by_id($id);
        $data['active'] = 'kelola_mahasiswa';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_mahasiswa($id)
    {
        $data['title'] = 'Ubah Mahasiswa | Staff';
        $data['prodi'] = $this->staff_model->get_all_prodi();
        $data['mahasiswa'] = $this->staff_model->get_mahasiswa_by_id($id);
        $data['active'] = 'kelola_mahasiswa';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function update_mahasiswa()
    {
        $id = $this->input->post('id');
        $mahasiswa = $this->staff_model->get_mahasiswa_by_id($id);

        $this->form_validation->set_rules('npm', 'NPM', 'required|trim|exact_length[9]', [
            'required' => 'Field {field} harus diisi.',
            'exact_length' => 'Field {field} harus berisi 9 digit.'
        ]);
        $this->form_validation->set_rules('prodi_id', 'Prodi_Id', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim|is_numeric', [
            'required' => 'Field {field} harus diisi.',
            'is_numeric' => 'Field {field} hanya memperbolehkan input berupa angka.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_mahasiswa($id);
        } else {
            $config['upload_path'] = './assets/images/upload';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024; // ukuran file yang diupload max 1MB
            $config['file_name'] = uniqid(); // generate nama file menjadi unik

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'The filetype you are attempting to upload is not allowed') !== false) {
                    $err_message = 'File yang di upload harus berupa .png, .jpg, atau .jpeg.';
                } elseif (strpos($error, 'The file you are attempting to upload is larger than the permitted size') !== false) {
                    $err_message = 'File yang di upload tidak boleh lebih dari 1MB.';
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                    redirect('staff/ubah_mahasiswa/' . $id); // arahkan kembali ke halaman ubah_mahasiswa dengan pesan kesalahan
                } else {
                    $err_message = $error;
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                // Ambil nilai gambar dari input hidden gambarLama
                $gambar = $this->input->post('gambarLama');
            } else {
                $uploadData = $this->upload->data();
                $gambar = $uploadData['file_name'];
            }

            $data = [
                'npm' => htmlspecialchars($this->input->post('npm')),
                'prodi_id' => htmlspecialchars($this->input->post('prodi_id')),
                'semester' => htmlspecialchars($this->input->post('semester')),
                'gambar' => $gambar
            ];

            $this->staff_model->update_mahasiswa($id, $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Data mahasiswa berhasil diubah!</div>');
            redirect('staff/kelola_mahasiswa');
        }
    }
        // akhir kelola mahasiswa

        // kelola dosen
    public function kelola_dosen()
    {
        $data['title'] = 'Kelola Dosen | Staff';
        $data['dosen'] = $this->staff_model->get_all_dosen();
        // Ambil user id yang sudah dipilih
        $selectedUserIds = $this->staff_model->get_selected_user_dsn_ids();
        
        // Kirim user id yang sudah dipilih ke fungsi get_all_user_match_by_role_as_dosen
        $data['users'] = $this->staff_model->get_all_user_match_by_role_as_dosen($selectedUserIds);
        $data['active'] = 'kelola_dosen';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_kelola_dosen', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_dosen() 
    {
        // set_rules
        $this->form_validation->set_rules('nidn', 'Nidn', 'required|trim|min_length[10]|is_unique[dosen.nidn]', [
            'required' => 'Field {field} harus diisi.',
            'min_length' => 'NPM harus terdiri dari 9 digit karakter.',
            'is_unique' => 'NPM sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('user_id', 'User_id', 'required|trim', [
            'required' => 'Field {field} harus diisi.',
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">Data dosen gagal ditambahkan!</div>');
            $this->kelola_dosen();
        } else {
            $config['upload_path'] = './assets/images/upload';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024; // ukuran file yang di upload max 1MB
            $config['file_name'] = uniqid(); // generate nama file menjadi unik
    
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('gambar')) {
                // Cek kesalahan upload
                $error = $this->upload->display_errors('', '');
                if ($error == 'You did not select a file to upload.') {
                    $err_message = 'Silahkan upload file gambar terlebih dahulu.';
                } elseif (strpos($error, 'The filetype you are attempting to upload is not allowed') !== false) {
                    $err_message = 'File yang di upload harus berupa .png, .jpg, atau .jpeg.';
                } elseif (strpos($error, 'The file you are attempting to upload is larger than the permitted size') !== false) {
                    $err_message = 'File yang di upload tidak boleh lebih dari 1MB.';
                } else {
                    $err_message = $error;
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                $this->kelola_dosen();
            } else {
                $uploadData = $this->upload->data();
                $data = [
                    'nidn' => htmlspecialchars($this->input->post('nidn')),
                    'user_id' => $this->input->post('user_id'),
                    'gambar' => $uploadData['file_name']
                ];
    
                $this->staff_model->insert_dosen($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Data dosen berhasil ditambahkan!</div>');
                redirect('staff/kelola_dosen');
            }
        }
    }

    public function detail_dosen($id)
    {
        $data['title'] = 'Detail Dosen | Staff';
        $data['dosen'] = $this->staff_model->get_dosen_by_id($id);
        $data['active'] = 'kelola_dosen';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_dosen', $data);
        $this->load->view('templates/footer');
    }

    public function ubah_dosen($id)
    {
        $data['title'] = 'Ubah Dosen | Staff';
        $data['dosen'] = $this->staff_model->get_dosen_by_id($id);
        $data['active'] = 'kelola_dosen';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_ubah_dosen', $data);
        $this->load->view('templates/footer');
    }

    public function update_dosen()
    {
        $id = $this->input->post('id');
        $dosen = $this->staff_model->get_dosen_by_id($id);

        $this->form_validation->set_rules('nidn', 'Nidn', 'required|trim|exact_length[10]', [
            'required' => 'Field {field} harus diisi.',
            'exact_length' => 'Field {field} harus berisi 9 digit.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->ubah_dosen($id);
        } else {
            $config['upload_path'] = './assets/images/upload';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024; // ukuran file yang diupload max 1MB
            $config['file_name'] = uniqid(); // generate nama file menjadi unik

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'The filetype you are attempting to upload is not allowed') !== false) {
                    $err_message = 'File yang di upload harus berupa .png, .jpg, atau .jpeg.';
                } elseif (strpos($error, 'The file you are attempting to upload is larger than the permitted size') !== false) {
                    $err_message = 'File yang di upload tidak boleh lebih dari 1MB.';
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                    redirect('staff/ubah_dosen/' . $id); // arahkan kembali ke halaman ubah_dosen dengan pesan kesalahan
                } else {
                    $err_message = $error;
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" user="alert">'.$err_message.'</div>');
                // Ambil nilai gambar dari input hidden gambarLama
                $gambar = $this->input->post('gambarLama');
            } else {
                $uploadData = $this->upload->data();
                $gambar = $uploadData['file_name'];
            }

            $data = [
                'nidn' => htmlspecialchars($this->input->post('nidn')),
                'gambar' => $gambar
            ];

            $this->staff_model->update_dosen($id, $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" user="alert">Data dosen berhasil diubah!</div>');
            redirect('staff/kelola_dosen');
        }
    }
    // akhir kelola dosen

    // publish jadwal
    public function publish_jadwal() 
    {
        $data['title'] = 'publish Jadwal | Staff';
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal();
        $data['active'] = 'publish_jadwal';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_publish_jadwal', $data);
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

        redirect('staff/publish_jadwal');
    }

    public function detail_jadwal($id) {
        $data['title'] = 'Detail Jadwal | Staff';
        $data['jadwal'] = $this->jadwal_model->get_jadwal_by_id($id);
        $data['kegiatan'] = $this->jadwal_model->get_kegiatan_by_jadwal_id($id);  // Menambahkan data kegiatan
        $data['active'] = 'publish_jadwal';
    
        if (empty($data['jadwal'])) {
            show_404();
        }
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('staff/v_detail_jadwal', $data);
        $this->load->view('templates/footer');
    }
    
    // Akhir publish jadwal
}
