<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login | Simonipro';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/v_login');
            $this->load->view('templates/footer');
        } else {
            $this->login_validasi();
        }
    }

    private function login_validasi() {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $user = $this->User_model->get_user_by_username($username);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'nama' => $user['nama'],
                        'username' => $user['username'],
                        // 'role_id' => $user['role_id'],
                        'nama_role' => $user['nama_role'],
                        'is_logged_in' => true
                    ];

                    $this->session->set_userdata($data);

                    // Redirect ke halaman dashboard sesuai role
                    switch ($user['nama_role']) {
						case 'staff':
							redirect('staff/');
							break;
                        case 'koordinator':
                            redirect('koordinator/');
                            break;
                        case 'dosen':
                            redirect('dosen/');
                            break;
                        case 'mahasiswa':
                            redirect('mahasiswa/');
                            break;
                        case 'kaprodi':
                            redirect('kaprodi/');
                            break;
                        default:
                            redirect('auth');
                            break;
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password yang Anda masukkan salah.');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Username sudah tidak aktif.');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username tidak terdaftar.');
            redirect('auth');
        }
    }

    public function register() {
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

        // set rules
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Field {field} harus diisi.'
        ]);
        $this->form_validation->set_rules('no_telp', 'No_Telp', 'required|trim|is_numeric', [
            'required' => 'Field {field} harus diisi.',
            'is_numeric' => 'Format nomor telepon harus berupa angka/numeric.',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Field {field} harus diisi.',
            'is_unique' => 'Username sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Field {field} harus diisi.',
            'min_length' => 'Password harus memiliki panjang minimal 6 karakter.',
            'matches' => 'Konfirmasi password tidak cocok.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Daftar | Simonipro';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/v_register');
            $this->load->view('templates/footer');
        } else {
            // $nama = htmlspecialchars($this->input->post('nama'));
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars(password_hash($this->input->post('password1'), PASSWORD_DEFAULT));
            $role_id = htmlspecialchars($this->input->post('role_id'));
            $nama = htmlspecialchars($this->input->post('nama'));
            $no_telp = htmlspecialchars($this->input->post('no_telp'));

            $data = [
                // 'nama' => $nama,
                'username' => $username,
                'password' => $password,
                'role_id' => $role_id,
                'nama' => $nama,
                'no_telp' => $no_telp,
                'is_active' => 1,
                'created_at' => time(),
                'updated_at' => time()
            ];

            $this->User_model->insert_user($data);

            $this->session->set_flashdata('pesan', 'Selamat, akun Anda telah berhasil dibuat, silahkan Login.');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        // $this->session->set_flashdata('pesan', 'Berhasil logout.');
        redirect(base_url() . 'auth?alert=logout');
    }
}
