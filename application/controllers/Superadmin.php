<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_role(['1']);
        $this->load->model('M_user');
    }

    public function index()
    {
        $data['title'] = 'Kelola User';
        $data['active_menu'] = 'users';
        $data['content'] = 'superadmin/v_users';
        $this->load->view('layouts/v_layout_admin', $data);
    }

    public function get_users()
    {
        $columns = ['id_user', 'username', 'unit', 'is_role', 'is_active'];

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));
        $order_col = $columns[$this->input->get('order[0][column]')];
        $order_dir = $this->input->get('order[0][dir]');
        $search = $this->input->get('search[value]');

        $total = $this->M_user->count_all();
        $filtered = $this->M_user->count_filtered($search);
        $users = $this->M_user->get_datatables($start, $length, $order_col, $order_dir, $search);

        $data = [];
        foreach ($users as $row) {
            $role_label = $row->is_role === '1' ? 'Superadmin' : 'Admin';
            $role_badge = $row->is_role === '1'
                ? '<span class="badge badge-primary">' . $role_label . '</span>'
                : '<span class="badge badge-info">' . $role_label . '</span>';

            $status_badge = $row->is_active === '1'
                ? '<span class="badge badge-success">Aktif</span>'
                : '<span class="badge badge-danger">Nonaktif</span>';

            $action = '<button class="btn btn-sm btn-primary btn-edit-user" data-id="' . $row->id_user . '" title="Edit"><i class="fa fa-edit"></i></button> ';
            $action .= '<button class="btn btn-sm btn-danger btn-delete-user" data-id="' . $row->id_user . '" data-username="' . htmlspecialchars($row->username) . '" title="Hapus"><i class="fa fa-trash"></i></button>';

            $data[] = [
                $row->id_user,
                $row->username,
                $row->unit,
                $role_badge,
                $status_badge,
                $action
            ];
        }

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data
        ]);
    }

    public function create_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('is_role', 'Role', 'required|in_list[1,2]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $username = $this->input->post('username', TRUE);
        if (!$this->M_user->is_username_unique($username)) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
            return;
        }

        $data = [
            'username' => $username,
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
            'unit' => $this->input->post('unit', TRUE),
            'is_role' => $this->input->post('is_role', TRUE),
            'is_active' => $this->input->post('is_active') ? '1' : '0',
        ];

        $insert = $this->M_user->create($data);
        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert ? 'User berhasil ditambahkan.' : 'Gagal menambahkan user.'
        ]);
    }

    public function update_user()
    {
        $id = $this->input->post('id', TRUE);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('is_role', 'Role', 'required|in_list[1,2]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $username = $this->input->post('username', TRUE);
        if (!$this->M_user->is_username_unique($username, $id)) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
            return;
        }

        $data = [
            'username' => $username,
            'unit' => $this->input->post('unit', TRUE),
            'is_role' => $this->input->post('is_role', TRUE),
            'is_active' => $this->input->post('is_active') ? '1' : '0',
        ];

        // Update password only if provided
        $password = $this->input->post('password', TRUE);
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $update = $this->M_user->update($id, $data);
        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'message' => $update ? 'User berhasil diupdate.' : 'Gagal mengupdate user.'
        ]);
    }

    public function delete_user()
    {
        $id = $this->input->post('id', TRUE);
        $user = $this->M_user->get_by_id($id);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan.']);
            return;
        }

        // Prevent deleting own account
        if ($user->id_user == $this->session->userdata('id_user')) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak bisa menghapus akun sendiri.']);
            return;
        }

        $delete = $this->M_user->delete($id);
        echo json_encode([
            'status' => $delete ? 'success' : 'error',
            'message' => $delete ? 'User berhasil dihapus.' : 'Gagal menghapus user.'
        ]);
    }

    public function get_user_by_id()
    {
        $id = $this->input->get('id', TRUE);
        $user = $this->M_user->get_by_id($id);
        if ($user) {
            $user->password = ''; // Don't send password hash to frontend
        }
        echo json_encode($user ? $user : null);
    }
}
