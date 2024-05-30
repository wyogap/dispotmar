<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('Modul','module');
		$this->load->model('Role','role');
    }

    public function index($id)
	{
		if (!policy('USERMAN','read_all')) show_404();

		$this->data['title'] = 'User - Permission';

		$this->data['modules'] = $this->module->get(decrypt($id));
		$this->data['role'] = $this->role->find(decrypt($id));

		$data['isi'] = $this->load->view('user/permission', $this->data, true);
		$this->load->view('skin/layout', $data);
	}
	
	public function store($id)
	{
		if (!policy('USERMAN','create')) show_404();

		$modules = $this->module->generate();

		foreach ($modules as $modul) {
			$data = [
				'id_role' => decrypt($id),
				'id_modul' => $modul->id_modul,
				'create' => FALSE,
				'read' => FALSE,
				'read_all' => FALSE,
				'update' => FALSE,
				'delete' => FALSE
			];
			$this->db->insert("mst_permission", $data);
		}

		$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
		redirect_back();
	}
	
	public function update($id)
	{
		if (!policy('USERMAN','update')) show_404();

		$permissions = $this->db->get_where("mst_permission", ["id_role" => decrypt($id)])->result();

		foreach ($permissions as $key => $permission) {
			$data = [
				'create' => $this->input->post("create[$permission->id_permission]"),
				'read' => $this->input->post("read[$permission->id_permission]"),
				'read_all' => $this->input->post("read_all[$permission->id_permission]"),
				'update' => $this->input->post("update[$permission->id_permission]"),
				'delete' => $this->input->post("delete[$permission->id_permission]"),
			];

			$response = $this->db->update("mst_permission", $data, ["id_permission" => $permission->id_permission]);
		}

		if ($response) {
			$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Data gagal disimpan');
			redirect_back();
		}
	}
}
