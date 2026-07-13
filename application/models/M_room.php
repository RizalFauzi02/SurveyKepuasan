<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_room extends CI_Model
{
    private $table = 'rooms';

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
            $this->db->like('name', $search);
            $this->db->or_like('facility_type', $search);
            $this->db->or_like('slug', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    public function get_datatables($start, $length, $order_col, $order_dir, $search)
    {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('facility_type', $search);
            $this->db->or_like('slug', $search);
            $this->db->group_end();
        }
        $this->db->order_by($order_col, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('is_active', '1')->get($this->table)->row();
    }

    public function get_active_rooms()
    {
        return $this->db->where('is_active', '1')
            ->order_by('sort_order', 'ASC')
            ->get($this->table)->result();
    }

    public function get_all_sorted()
    {
        return $this->db->order_by('sort_order', 'ASC')->get($this->table)->result();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function is_slug_unique($slug, $exclude_id = 0)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id > 0) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) === 0;
    }
}
