<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends CI_Controller
{
	public function index()
	{
		$this->load->view('v_survey');
	}

	public function toilet()
	{
		$this->load->view('v_survey_toilet');
	}

	public function admin()
	{
		$this->load->view('v_survey_admin');
	}

	public function nsranap()
	{
		$this->load->view('v_survey_nsranap');
	}

	public function kamarranap()
	{
		$this->load->view('v_survey_kamarranap');
	}

	public function save()
	{
		$data = [
			'nama_lokasi' => $this->input->post('nama_lokasi'),
			'lantai' => $this->input->post('lantai'),
			'tipe_fasilitas' => $this->input->post('tipe_fasilitas'),
			'survey_kepuasan' => $this->input->post('survey_kepuasan'),
			'survey_memuaskan' => $this->input->post('survey_memuaskan'),
		];

		// 🔥 DEBUG
		// log_message('error', print_r($data, true));

		$insert = $this->db->insert('tb_survey', $data);

		echo json_encode([
			'status' => $insert ? 'success' : 'error',
			'data' => $data
		]);
	}
}
