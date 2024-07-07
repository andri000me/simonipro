<?php
class Staff_model extends CI_Model {

    // Role
     // ambil semua data yang ada di tabel role
     public function get_all_role()
     {
         $query = $this->db->get('role');
         return $query->result_array();
     }
 
     // ambil data role yang ada di tabel role berdasarkan id
     public function get_role_by_id($id)
     {
         $query = $this->db->get_where('role', array('id' => $id));
         return $query->row_array();
     }
 
     // insert data role
     public function insert_role($data)
     {
         return $this->db->insert('role', $data);
     }
 
     // Update data role
     public function update_role($id, $data)
     {
         $this->db->where('id', $id);
         return $this->db->update('role', $data);
     }
 
     // Hapus data role
     public function delete_role($id)
     {
         $this->db->where('id', $id);
         return $this->db->delete('role');
     }
    //  End Role

    // Prodi
     // ambil semua data yang ada di tabel Prodi
     public function get_all_prodi()
     {
         $query = $this->db->get('prodi');
         return $query->result_array();
     }
    //  tangkap data prodi berdasar id
     public function get_prodi_by_id($id)
     {
        $this->db->where('id', $id);
        $query = $this->db->get('prodi');
        return $query->row_array();
     }
    //  input data ke tabel prodi
     public function insert_prodi($data)
     {
         return $this->db->insert('prodi', $data);
     }
     // Update data prodi
     public function update_prodi($id, $data)
     {
         $this->db->where('id', $id);
         return $this->db->update('prodi', $data);
     }
    //  End Prodi

    // Kelola Project
    public function get_all_projects()
    {
        $this->db->select('project.*, prodi.nama_prodi');
        $this->db->from('project');
        $this->db->join('prodi', 'project.prodi_id = prodi.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    // get a project by ID
    public function get_project_by_id($id)
    {
        $this->db->select('project.*, prodi.nama_prodi');
        $this->db->from('project');
        $this->db->join('prodi', 'project.prodi_id = prodi.id');
        $this->db->where('project.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Function to insert a new project
    public function insert_project($data)
    {
        return $this->db->insert('project', $data);
    }

    // function to update project data
    public function update_project($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('project', $data);
    }
    // Akhir kelola project

    // Mahasiswa
    public function get_all_mahasiswa()
    {
        $this->db->select('mahasiswa.*, role.nama_role, prodi.nama_prodi');
        $this->db->from('mahasiswa');
        $this->db->join('user', 'mahasiswa.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->join('prodi', 'mahasiswa.prodi_id = prodi.id'); // Pastikan penggabungan menggunakan kolom yang benar
        $this->db->where('role.nama_role', 'mahasiswa');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_user_match_by_role_as_mahasiswa($selectedUserIds = array())
    {
        $this->db->select('user.id, user.username, user.nama');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'mahasiswa');

        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('user.id', $selectedUserIds);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_selected_user_mhs_ids()
    {
        $this->db->select('user_id');
        $this->db->from('mahasiswa');
        $query = $this->db->get();
        return array_column($query->result_array(), 'user_id');
    }

    public function insert_mahasiswa($data)
    {
        return $this->db->insert('mahasiswa', $data);
    }
    public function update_mahasiswa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mahasiswa', $data);
    }

    public function get_mahasiswa_by_id($id)
    {
        $this->db->select('mahasiswa.*, user.username, role.nama_role, prodi.nama_prodi');
        $this->db->from('mahasiswa');
        $this->db->join('user', 'mahasiswa.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->join('prodi', 'mahasiswa.prodi_id = prodi.id'); // Join dengan tabel prodi menggunakan kolom prodi_id
        $this->db->where('mahasiswa.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // akhir model mahasiswa

    // Dosen
    public function get_all_dosen()
    {
        $this->db->select('dosen.*, user.username, role.nama_role');
        $this->db->from('dosen');
        $this->db->join('user', 'dosen.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'dosen');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_selected_user_dsn_ids()
    {
        $this->db->select('user_id');
        $this->db->from('dosen');
        $query = $this->db->get();
        return array_column($query->result_array(), 'user_id');
    }
    public function get_all_user_match_by_role_as_dosen($selectedUserIds = array())
    {
        $this->db->select('user.id, user.username, user.nama');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'dosen');

        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('user.id', $selectedUserIds);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_dosen($data)
    {
        return $this->db->insert('dosen', $data);
    }

    public function update_dosen($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('dosen', $data);
    }
    
    public function get_dosen_by_id($id)
    {
        $this->db->select('dosen.*, user.username, role.nama_role');
        $this->db->from('dosen');
        $this->db->join('user', 'dosen.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('dosen.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // akhir kelola dosen

    // Kelola koordinator
    public function get_all_koordinator()
    {
        $this->db->select('koordinator.*, user.username, role.nama_role');
        $this->db->from('koordinator');
        $this->db->join('user', 'koordinator.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'koordinator');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_selected_user_koor_ids()
    {
        $this->db->select('user_id');
        $this->db->from('koordinator');
        $query = $this->db->get();
        return array_column($query->result_array(), 'user_id');
    }

    public function get_all_user_match_by_role_as_koordinator($selectedUserIds = array())
    {
        $this->db->select('user.id, user.username, user.nama');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('role.nama_role', 'koordinator');

        if (!empty($selectedUserIds)) {
            $this->db->where_not_in('user.id', $selectedUserIds);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_koordinator_by_id($id)
    {
        $this->db->select('koordinator.*, user.username, role.nama_role');
        $this->db->from('koordinator');
        $this->db->join('user', 'koordinator.user_id = user.id');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('koordinator.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_koordinator($data)
    {
        return $this->db->insert('koordinator', $data);
    }

    public function update_koordinator($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('koordinator', $data);
    }
    // Akhir kelola koordinator
}
