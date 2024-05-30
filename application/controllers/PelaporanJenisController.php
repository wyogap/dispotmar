<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelaporanJenisController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('PelaporanJenis', 'type');
	}

	public function index()
	{
		if (!policy('LAPHAR','read_all')) show_404();

		$this->data['title'] = 'Jenis Pelaporan';

		$this->data['types'] = $this->type->get();

		$data['isi'] = $this->load->view('pelaporan/jenis_laporan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('LAPHAR','update')) show_404();

		$this->data['type'] = $this->type->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store()
    {
		if (!policy('LAPHAR','create')) show_404();

		$this->form_validation->set_rules('name','Type Name','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = ['name' => form_error('name')];
			echo json_encode([$status,$response]);
		}else{
			$data = [
				'nama_jenis'		=> $this->input->post('name'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date("Y-m-d H:i:s")
			];

			if ($this->type->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}
	
	public function update()
    {
		if (!policy('LAPHAR','update')) show_404();

		$this->form_validation->set_rules('name','Role Name','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = ['name' => form_error('name')];
			echo json_encode([$status,$response]);
		}else{
			$data = [
				'nama_jenis'		=> $this->input->post('name'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date("Y-m-d H:i:s")
			];

			$id = decrypt($this->input->post('id'));

			if ($this->type->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
    }

	public function delete($id=null)
    {
		if (!policy('LAPHAR','delete')) show_404();

		if (!isset($id)) show_404();
		
		// if ($this->type->roleCheck(decrypt($id))) {
		// 	$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
		// 	redirect_back();
		// } else {
		// 	if ($this->type->delete(decrypt($id))) {
		// 		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		// 		redirect_back();
		// 	} else {
		// 		$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
		// 		redirect_back();
		// 	}
		// }

		if ($this->type->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
