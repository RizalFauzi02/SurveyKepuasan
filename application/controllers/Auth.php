<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }

    public function index()
    {
        if ($this->is_logged_in()) {
            $this->redirect_by_role();
        }
        $this->load->view('auth/v_login');
    }

    public function login()
    {
        if ($this->is_logged_in()) {
            redirect('auth');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Username dan password harus diisi.');
            redirect('auth');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->M_login->get_by_username($username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            redirect('auth');
            return;
        }

        if ($user->is_active !== '1') {
            $this->session->set_flashdata('error', 'Akun belum aktif. Silahkan hubungi administrator!');
            redirect('auth');
            return;
        }

        if (!password_verify($password, $user->password)) {
            $this->session->set_flashdata('error', 'Password salah!');
            redirect('auth');
            return;
        }

        // Set session
        $session_data = [
            'id_user'   => $user->id_user,
            'username'  => $user->username,
            'is_role'   => $user->is_role,
            'is_active' => $user->is_active,
            'is_Loggin' => true,
        ];
        $this->session->set_userdata($session_data);

        $this->redirect_by_role();
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    private function redirect_by_role()
    {
        $role = $this->session->userdata('is_role');
        switch ($role) {
            case '1':
                redirect('superadmin');
                break;
            case '2':
                redirect('admin');
                break;
            default:
                redirect('auth');
                break;
        }
    }
}
