<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_question extends CI_Model
{
    private $table = 'survey_questions';

    public function __construct()
    {
        parent::__construct();
    }

    public function count_all($room_id = 0)
    {
        if ($room_id > 0) {
            $this->db->where('room_id', $room_id);
        }
        return $this->db->count_all_results($this->table);
    }

    public function count_filtered($room_id, $search)
    {
        if ($room_id > 0) {
            $this->db->where('room_id', $room_id);
        }
        if (!empty($search)) {
            $this->db->like('question_text', $search);
        }
        return $this->db->count_all_results($this->table);
    }

    public function get_datatables($room_id, $start, $length, $order_col, $order_dir, $search)
    {
        if ($room_id > 0) {
            $this->db->where('room_id', $room_id);
        }
        if (!empty($search)) {
            $this->db->like('question_text', $search);
        }
        $this->db->order_by($order_col, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_active_by_room($room_id)
    {
        return $this->db->where('room_id', $room_id)
            ->where('is_active', '1')
            ->order_by('sort_order', 'ASC')
            ->get($this->table)->result();
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
}
