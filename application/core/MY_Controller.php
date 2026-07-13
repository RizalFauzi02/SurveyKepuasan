<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function is_logged_in()
    {
        return $this->session->userdata('is_Loggin') === true;
    }

    protected function get_role()
    {
        return $this->session->userdata('is_role');
    }

    protected function require_login()
    {
        if (!$this->is_logged_in()) {
            redirect('auth');
        }
    }

    protected function require_role($allowed_roles)
    {
        $this->require_login();

        $role = $this->get_role();
        if (!in_array($role, (array) $allowed_roles)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            if ($this->is_logged_in()) {
                redirect('admin');
            } else {
                redirect('auth');
            }
        }
    }
}
