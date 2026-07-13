<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_role(['1', '2']);
        $this->load->model('M_room');
        $this->load->model('M_question');
        $this->load->model('M_report');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['active_menu'] = 'dashboard';
        $data['content'] = 'admin/v_dashboard';
        $this->load->view('layouts/v_layout_admin', $data);
    }

    // ===================== ROOMS =====================
    public function rooms()
    {
        $data['title'] = 'Kelola Ruangan';
        $data['active_menu'] = 'rooms';
        $data['content'] = 'admin/v_rooms';
        $this->load->view('layouts/v_layout_admin', $data);
    }

    public function print_qr($id)
    {
        $room = $this->M_room->get_by_id($id);
        if (!$room) {
            show_404();
            return;
        }

        $data['room'] = $room;
        $this->load->view('admin/v_print_qr', $data);
    }

    public function get_rooms()
    {
        $this->load->library('table');
        $columns = ['id', 'name', 'slug', 'floor', 'facility_type', 'is_active', 'sort_order'];

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));
        $order_col = $columns[$this->input->get('order[0][column]')];
        $order_dir = $this->input->get('order[0][dir]');
        $search = $this->input->get('search[value]');

        $total = $this->M_room->count_all();

        $filtered = $this->M_room->count_filtered($search);
        $rooms = $this->M_room->get_datatables($start, $length, $order_col, $order_dir, $search);

        $data = [];
        foreach ($rooms as $row) {
            $status_badge = $row->is_active === '1'
                ? '<span class="badge badge-success">Aktif</span>'
                : '<span class="badge badge-danger">Nonaktif</span>';

            $action = '<a href="' . base_url('admin/print_qr/' . $row->id) . '" target="_blank" class="btn btn-sm btn-info mr-1" title="Cetak QR"><i class="fa fa-qrcode"></i></a>';
            $action .= '<button class="btn btn-sm btn-primary btn-edit-room mr-1" data-id="' . $row->id . '" title="Edit"><i class="fa fa-edit"></i></button>';
            $action .= '<button class="btn btn-sm btn-danger btn-delete-room" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name) . '" title="Hapus"><i class="fa fa-trash"></i></button>';

            $data[] = [
                $row->id,
                $row->name,
                $row->slug,
                $row->floor,
                $row->facility_type,
                $status_badge,
                $row->sort_order,
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

    public function create_room()
    {
        $this->form_validation->set_rules('name', 'Nama Ruangan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('floor', 'Lantai', 'required|integer');
        $this->form_validation->set_rules('facility_type', 'Tipe Fasilitas', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('sort_order', 'Urutan', 'integer');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $name = $this->input->post('name', TRUE);
        $slug = url_title(strtolower($name), '-', TRUE);

        if (!$this->M_room->is_slug_unique($slug)) {
            echo json_encode(['status' => 'error', 'message' => 'Slug ruangan sudah digunakan.']);
            return;
        }

        $data = [
            'name' => $name,
            'slug' => $slug,
            'floor' => $this->input->post('floor', TRUE),
            'facility_type' => $this->input->post('facility_type', TRUE),
            'is_active' => $this->input->post('is_active') ? '1' : '0',
            'sort_order' => $this->input->post('sort_order', TRUE) ?: 0,
        ];

        $insert = $this->M_room->create($data);
        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert ? 'Ruangan berhasil ditambahkan.' : 'Gagal menambahkan ruangan.'
        ]);
    }

    public function update_room()
    {
        $id = $this->input->post('id', TRUE);
        $this->form_validation->set_rules('name', 'Nama Ruangan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('floor', 'Lantai', 'required|integer');
        $this->form_validation->set_rules('facility_type', 'Tipe Fasilitas', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('sort_order', 'Urutan', 'integer');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $name = $this->input->post('name', TRUE);
        $slug = url_title(strtolower($name), '-', TRUE);

        if (!$this->M_room->is_slug_unique($slug, $id)) {
            echo json_encode(['status' => 'error', 'message' => 'Slug ruangan sudah digunakan.']);
            return;
        }

        $data = [
            'name' => $name,
            'slug' => $slug,
            'floor' => $this->input->post('floor', TRUE),
            'facility_type' => $this->input->post('facility_type', TRUE),
            'is_active' => $this->input->post('is_active') ? '1' : '0',
            'sort_order' => $this->input->post('sort_order', TRUE) ?: 0,
        ];

        $update = $this->M_room->update($id, $data);
        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'message' => $update ? 'Ruangan berhasil diupdate.' : 'Gagal mengupdate ruangan.'
        ]);
    }

    public function delete_room()
    {
        $id = $this->input->post('id', TRUE);
        $delete = $this->M_room->delete($id);
        echo json_encode([
            'status' => $delete ? 'success' : 'error',
            'message' => $delete ? 'Ruangan berhasil dihapus.' : 'Gagal menghapus ruangan.'
        ]);
    }

    public function get_room_by_id()
    {
        $id = $this->input->get('id', TRUE);
        $room = $this->M_room->get_by_id($id);
        echo json_encode($room ? $room : null);
    }

    // ===================== QUESTIONS =====================
    public function questions()
    {
        $data['title'] = 'Kelola Pertanyaan Survei';
        $data['active_menu'] = 'questions';
        $data['rooms'] = $this->M_room->get_active_rooms();
        $data['content'] = 'admin/v_questions';
        $this->load->view('layouts/v_layout_admin', $data);
    }

    public function get_questions()
    {
        $room_id = $this->input->get('room_id');
        $columns = ['id', 'question_text', 'question_type', 'sort_order', 'is_active'];

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));
        $order_col_index = intval($this->input->get('order[0][column]'));
        $order_col = isset($columns[$order_col_index]) ? $columns[$order_col_index] : 'sort_order';
        $order_dir = $this->input->get('order[0][dir]');
        $search = $this->input->get('search[value]');

        $total = $this->M_question->count_all($room_id);
        $filtered = $this->M_question->count_filtered($room_id, $search);
        $questions = $this->M_question->get_datatables($room_id, $start, $length, $order_col, $order_dir, $search);

        $data = [];
        foreach ($questions as $row) {
            $type_label = $row->question_type === 'radio' ? 'Single Choice'
                : ($row->question_type === 'checkbox' ? 'Multiple Choice' : 'Text Bebas');

            $options_str = '-';
            if ($row->options) {
                $opts = json_decode($row->options, true);
                $options_str = implode(', ', $opts);
            }

            $status_badge = $row->is_active === '1'
                ? '<span class="badge badge-success">Aktif</span>'
                : '<span class="badge badge-danger">Nonaktif</span>';

            $action = '<button class="btn btn-sm btn-primary btn-edit-question" data-id="' . $row->id . '" title="Edit"><i class="fa fa-edit"></i></button> ';
            $action .= '<button class="btn btn-sm btn-danger btn-delete-question" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';

            $data[] = [
                $row->id,
                $row->question_text,
                $type_label,
                $options_str,
                $row->sort_order,
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

    public function create_question()
    {
        $this->form_validation->set_rules('room_id', 'Ruangan', 'required|integer');
        $this->form_validation->set_rules('question_text', 'Teks Pertanyaan', 'required|trim');
        $this->form_validation->set_rules('question_type', 'Tipe Pertanyaan', 'required|in_list[radio,checkbox,text]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $question_type = $this->input->post('question_type', TRUE);
        $options = null;

        if (in_array($question_type, ['radio', 'checkbox'])) {
            $options_raw = $this->input->post('options', TRUE);
            if (!empty($options_raw)) {
                $options_arr = array_map('trim', explode("\n", $options_raw));
                $options_arr = array_filter($options_arr);
                $options = json_encode(array_values($options_arr));
            }
        }

        $data = [
            'room_id' => $this->input->post('room_id', TRUE),
            'question_text' => $this->input->post('question_text', TRUE),
            'question_type' => $question_type,
            'options' => $options,
            'sort_order' => $this->input->post('sort_order', TRUE) ?: 0,
            'is_active' => $this->input->post('is_active') ? '1' : '0',
        ];

        $insert = $this->M_question->create($data);
        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert ? 'Pertanyaan berhasil ditambahkan.' : 'Gagal menambahkan pertanyaan.'
        ]);
    }

    public function update_question()
    {
        $id = $this->input->post('id', TRUE);
        $this->form_validation->set_rules('question_text', 'Teks Pertanyaan', 'required|trim');
        $this->form_validation->set_rules('question_type', 'Tipe Pertanyaan', 'required|in_list[radio,checkbox,text]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $question_type = $this->input->post('question_type', TRUE);
        $options = null;

        if (in_array($question_type, ['radio', 'checkbox'])) {
            $options_raw = $this->input->post('options', TRUE);
            if (!empty($options_raw)) {
                $options_arr = array_map('trim', explode("\n", $options_raw));
                $options_arr = array_filter($options_arr);
                $options = json_encode(array_values($options_arr));
            }
        }

        $data = [
            'question_text' => $this->input->post('question_text', TRUE),
            'question_type' => $question_type,
            'options' => $options,
            'sort_order' => $this->input->post('sort_order', TRUE) ?: 0,
            'is_active' => $this->input->post('is_active') ? '1' : '0',
        ];

        $update = $this->M_question->update($id, $data);
        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'message' => $update ? 'Pertanyaan berhasil diupdate.' : 'Gagal mengupdate pertanyaan.'
        ]);
    }

    public function delete_question()
    {
        $id = $this->input->post('id', TRUE);
        $delete = $this->M_question->delete($id);
        echo json_encode([
            'status' => $delete ? 'success' : 'error',
            'message' => $delete ? 'Pertanyaan berhasil dihapus.' : 'Gagal menghapus pertanyaan.'
        ]);
    }

    public function get_question_by_id()
    {
        $id = $this->input->get('id', TRUE);
        $question = $this->M_question->get_by_id($id);
        echo json_encode($question ? $question : null);
    }

    // ===================== REPORTS =====================
    public function reports()
    {
        $data['title'] = 'Laporan Survei';
        $data['active_menu'] = 'reports';
        $data['rooms'] = $this->M_room->get_active_rooms();
        $data['content'] = 'admin/v_reports';
        $this->load->view('layouts/v_layout_admin', $data);
    }

    public function get_report_data()
    {
        $room_id = $this->input->get('room_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $summary = $this->M_report->get_summary($room_id, $date_from, $date_to);
        $chart_data = $this->M_report->get_chart_data($room_id, $date_from, $date_to);
        $responses = $this->M_report->get_responses($room_id, $date_from, $date_to);

        echo json_encode([
            'summary' => $summary,
            'chart_data' => $chart_data,
            'responses' => $responses
        ]);
    }

    public function get_chart_data()
    {
        $room_id = $this->input->get('room_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        $chart_data = $this->M_report->get_chart_data($room_id, $date_from, $date_to);
        echo json_encode($chart_data);
    }

    public function export_excel()
    {
        $room_id = $this->input->get('room_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $this->M_report->export_excel($room_id, $date_from, $date_to);
    }
}
