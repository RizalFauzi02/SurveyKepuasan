<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_survey');
        $this->load->model('M_room');
    }

    public function index()
    {
        $rooms = $this->M_room->get_active_rooms();
        if (empty($rooms)) {
            show_404();
            return;
        }
        redirect('survey/form/' . $rooms[0]->slug);
    }

    public function form($slug = '')
    {
        $room = $this->M_survey->get_room_by_slug($slug);
        if (!$room) {
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ruangan tidak ditemukan.'
                ]);
                return;
            }
            show_404();
            return;
        }

        $questions = $this->M_survey->get_questions_by_room($room->id);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'status' => 'success',
                'room' => $room,
                'questions' => $questions
            ]);
            return;
        }

        $data['room'] = $room;
        $data['questions'] = $questions;
        $data['rooms'] = $this->M_room->get_active_rooms();
        $this->load->view('survey/v_survey_form', $data);
    }

    public function rooms()
    {
        $data['rooms'] = $this->M_room->get_active_rooms();
        $this->load->view('survey/v_rooms_list', $data);
    }

    public function submit()
    {
        $this->form_validation->set_rules('room_id', 'Ruangan', 'required|integer');
        $this->form_validation->set_rules('satisfaction_score', 'Rating Kepuasan', 'required|integer|in_list[1,2,3,4,5]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $room_id = $this->input->post('room_id', TRUE);
        $room = $this->M_room->get_by_id($room_id);

        if (!$room) {
            echo json_encode(['status' => 'error', 'message' => 'Ruangan tidak ditemukan.']);
            return;
        }

        $response_data = [
            'room_id' => $room_id,
            'respondent_name' => $this->input->post('respondent_name', TRUE) ?: null,
            'satisfaction_score' => $this->input->post('satisfaction_score', TRUE),
            'feedback' => $this->input->post('feedback', TRUE),
        ];

        // Collect question answers
        $answers = [];
        $questions = $this->M_survey->get_questions_by_room($room_id);

        foreach ($questions as $q) {
            $answer_text = null;
            $post_key = 'question_' . $q->id;

            if ($q->question_type === 'checkbox') {
                $posted = $this->input->post($post_key);
                if (is_array($posted)) {
                    $answer_text = json_encode($posted);
                }
            } else {
                $answer_text = $this->input->post($post_key, TRUE);
            }

            if ($answer_text !== null && $answer_text !== '') {
                $answers[] = [
                    'question_id' => $q->id,
                    'answer_text' => $answer_text,
                ];
            }
        }

        $success = $this->M_survey->submit_survey($response_data, $answers);

        echo json_encode([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Terima kasih atas partisipasi Anda!' : 'Gagal menyimpan data. Silahkan coba lagi.'
        ]);
    }
}
