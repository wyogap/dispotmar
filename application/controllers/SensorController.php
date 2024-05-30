<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SensorController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('RekapSensor', 'sensor');
	}

	public function index()
	{
		$this->data['title'] = 'Rekap Sensor';
		
		$data['isi'] = $this->load->view('jobsensor/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function store(){

		$this->form_validation->set_rules('id', 'id sensor', 'trim');
		$this->form_validation->set_rules('code', 'code', 'trim');
		$this->form_validation->set_rules('category', 'category', 'trim');
		$this->form_validation->set_rules('group_th', 'group_th', 'trim');
		$this->form_validation->set_rules('group_label', 'group_label', 'trim');
		$this->form_validation->set_rules('node_id', 'node_id', 'trim');
		$this->form_validation->set_rules('node_label', 'node_label', 'trim');
		$this->form_validation->set_rules('timestamp', 'timestamp', 'trim');
		$this->form_validation->set_rules('unit', 'unit', 'trim');
		$this->form_validation->set_rules('value', 'value', 'trim');

		// if ($this->form_validation->run() == FALSE) {
		// 	$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
		// 	$response = [
		// 		'id' => form_error('id'),
		// 		'code' => form_error('code'),
		// 		'category' => form_error('category'),
		// 		'group_th' => form_error('group_th'),
		// 		'group_label' => form_error('group_label'),
		// 		'node_id' => form_error('node_id'),
		// 		'node_label' => form_error('node_label'),
		// 		'timestamp' => form_error('timestamp'),
		// 		'unit' => form_error('unit'),
		// 		'value' => form_error('value')
		// 	];
		// 	echo json_encode([$status,$response]);
		// }else{
			$data = array(
				'id_sensor'			=> $this->input->post('id'),
				'code'				=> $this->input->post('code'),
				'category'			=> $this->input->post('category'),
				'group_th'			=> $this->input->post('group_th'),
				'group_label'		=> $this->input->post('group_label'),
				'node_id'			=> $this->input->post('node_id'),
				'node_label'		=> $this->input->post('node_label'),
				'timestamp'			=> $this->input->post('timestamp'),
				'unit'				=> $this->input->post('unit'),
				'value'				=> $this->input->post('value'),
				'is_active'			=> TRUE,
				'created_date'		=> date('Y-m-d H:i:s')
			);

			if ($this->sensor->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		//}
	}
}
