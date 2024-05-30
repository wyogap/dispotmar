<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('Role','role');
		$this->load->model('Modul','module');
	}

	public function index()
	{
		if (!policy('USERMAN','read_all')) show_404();

		$this->data['title'] = 'Master Role';
		$this->data['roles'] = $this->role->get();

		$data['isi'] = $this->load->view('user/role', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function store()
    {
		if (!policy('USERMAN','create')) show_404();

		$this->form_validation->set_rules('name','Role Name','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = ['name' => form_error('name')];
			echo json_encode([$status,$response]);
		}else{
			$data = [
				'nama_role'		=> $this->input->post('name'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date("Y-m-d H:i:s")
			];

			if ($this->role->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
    }

	public function update()
    {
		if (!policy('USERMAN','update')) show_404();

		$this->form_validation->set_rules('name','Role Name','trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('error', 'Data Anda tidak berhasil disimpan, Silahkan cek kembali data yang Anda masukkan.');;
			// redirect_back();
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = ['name' => form_error('name')];
			echo json_encode([$status,$response]);
		}else{
			$data = [
				'nama_role'		=> $this->input->post('name'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date("Y-m-d H:i:s")
			];

			$id = decrypt($this->input->post('id_role'));

			if ($this->role->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
			// if ($this->role->update($id,$data)) {
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
		if (!policy('USERMAN','delete')) show_404();

		if (!isset($id)) show_404();
		
		if ($this->role->roleCheck(decrypt($id))) {
			$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
			redirect_back();
		} else {
			if ($this->role->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
			}
		}
    }
}
