<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanganKomoditasController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access(); 
		$this->load->model('KomoditasPangan', 'comodity');
	}

	public function index()
	{
		if (!policy('KETPANG','read_all')) show_404();

		$this->data['title'] = 'Master Komoditas';
		$this->data['komoditas'] = $this->comodity->get();
		$this->data['units'] = $this->db->get('mst_satuan')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('id_cluster', 'DESC');
		$this->data['clusters'] = $this->db->get('mst_cluster')->result();

		$data['isi'] = $this->load->view('pangan/komoditas/index', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('KETPANG','update')) show_404();

		$this->data['comodity'] = $this->comodity->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KETPANG','create')) show_404();

		$this->form_validation->set_rules('name', 'Comodity Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('cluster', 'Cluster', 'trim|required');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' => form_error('name'),
				'cluster' => form_error('cluster'),
				'unit' => form_error('unit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nama_komoditas'	=> $this->input->post('name'),
				'id_cluster'		=> $this->input->post('cluster'),
				'id_satuan'			=> $this->input->post('unit'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date('Y-m-d H:i:s')
			);

			if ($this->comodity->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('KETPANG','update')) show_404();

		$this->form_validation->set_rules('name', 'Comodity Name', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('cluster', 'Cluster', 'trim|required');
		$this->form_validation->set_rules('unitEdit', 'Unit', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' => form_error('name'),
				'cluster' => form_error('cluster'),
				'unitEdit' => form_error('unitEdit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nama_komoditas'	=> $this->input->post('name'),
				'id_cluster'		=> $this->input->post('cluster'),
				'id_satuan'			=> $this->input->post('unitEdit'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
			);
			$id = decrypt($this->input->post('id'));

			if ($this->comodity->update($id, $data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('KETPANG','delete')) show_404();

		if (!isset($id)) show_404();

		// if ($this->comodity->checkKomoditas(decrypt($id))) {
		// 	$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
		// 	redirect_back();
		// } else {
			if ($this->comodity->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
		// }
		}
    }

}
