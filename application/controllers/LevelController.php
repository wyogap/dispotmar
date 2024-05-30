<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LevelController extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			in_access(); 
			$this->load->model('Level', 'level');
	}

	public function index()
	{
		if (!policy('ORG','read_all')) show_404();

		$this->data['title'] = 'Data Level';
		$this->data['levels'] = $this->level->get();
		$this->data['level1'] = $this->level->getLevel(1);
		$this->data['level2'] = $this->level->getLevel(2);
		$this->data['level3'] = $this->level->getLevel(3);
		$this->data['level4'] = $this->level->getLevel(4);

		$data['isi'] = $this->load->view('organisasi/level/index', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('ORG','update')) show_404();

		$this->data['level'] = $this->level->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('ORG','create')) show_404();

		$this->form_validation->set_rules('name', 'Organization Name', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		$this->form_validation->set_rules('parent', 'Parent Level', 'trim');

		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('error', 'Data Anda tidak berhasil disimpan, Silahkan cek kembali data yang Anda masukkan.');;
			// redirect_back();
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' => form_error('name'),
				'level' => form_error('level'),
				'parent' => form_error('parent'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'jenis_organisasi'	=> $this->input->post('name'),
				'level'				=> $this->input->post('level'),
				'id_level_parent'	=> $this->input->post('parent'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date('Y-m-d H:i:s')
			);

			if ($this->level->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
			
			// if ($this->level->create($data)) {
			// 	$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			// 	redirect_back();
			// } else {
			// 	$this->session->set_flashdata('error', 'Data anda tidak berhasil disimpan');
			// 	redirect_back();
			// }
		}
	}

	public function update(){
		if (!policy('ORG','update')) show_404();

		$this->form_validation->set_rules('id', 'ID Level', 'trim|required');
		$this->form_validation->set_rules('name', 'Organization Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('level', 'Level', 'trim');
		$this->form_validation->set_rules('parent', 'Parent', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('error', 'Data Anda tidak berhasil disimpan, Silahkan cek kembali data yang Anda masukkan.');;
			// redirect_back();
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' => form_error('name'),
				'level' => form_error('level'),
				'parent' => form_error('parent'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'jenis_organisasi'	=> $this->input->post('name'),
				'level'				=> $this->input->post('level'),
				'id_level_parent'	=> $this->input->post('parent'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
			);
			$id = decrypt($this->input->post('id'));

			if ($this->level->update($id, $data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
			// if ($this->level->update($id, $data)) {
			// 	$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			// 	redirect_back();
			// } else {
			// 	$this->session->set_flashdata('error', 'Data anda tidak berhasil disimpan');
			// 	redirect_back();
			// }
		}
	}

	public function delete($id=null)
    {
		if (!policy('ORG','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->level->checkLevel(decrypt($id))) {
			$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
			redirect_back();
		} else {
			if ($this->level->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
			}
		}
        
    }
}
