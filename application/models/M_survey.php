<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_survey extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_room_by_slug($slug)
    {
        return $this->db->where('slug', $slug)
            ->where('is_active', '1')
            ->get('rooms')
            ->row();
    }

    public function get_questions_by_room($room_id)
    {
        return $this->db->where('room_id', $room_id)
            ->where('is_active', '1')
            ->order_by('sort_order', 'ASC')
            ->get('survey_questions')
            ->result();
    }

    public function submit_survey($response_data, $answers)
    {
        $this->db->trans_start();

        // Insert response
        $this->db->insert('survey_responses', $response_data);
        $response_id = $this->db->insert_id();

        // Insert answers
        if (!empty($answers)) {
            foreach ($answers as $answer) {
                $answer['response_id'] = $response_id;
                $this->db->insert('response_answers', $answer);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
