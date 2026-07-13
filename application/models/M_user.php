<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function count_filtered($search)
    {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('username', $search);
            $this->db->or_like('unit', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    public function get_datatables($start, $length, $order_col, $order_dir, $search)
    {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('username', $search);
            $this->db->or_like('unit', $search);
            $this->db->group_end();
        }
        $this->db->order_by($order_col, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id_user', $id)->get($this->table)->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_user', $id)->delete($this->table);
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
