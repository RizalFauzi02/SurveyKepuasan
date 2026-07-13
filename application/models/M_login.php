<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_username($username)
    {
        return $this->db->where('username', $username)->get($this->table)->row();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id_user', $id)->get($this->table)->row();
    }

    public function is_username_unique($username, $exclude_id = 0)
    {
        $this->db->where('username', $username);
        if ($exclude_id > 0) {
            $this->db->where('id_user !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) === 0;
    }
}
