<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PantaiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPantai', 'pantai');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisPantai','jenisPantai');
	}

	public function index()
	{
		$this->data['title'] = 'Geografi - Data Pantai';

		if (policy('GEO','read')) {
			$this->data['dataPantai'] = $this->pantai->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPantai'] = $this->pantai->getdataForDatatable();
		}

		$this->data['jenisPantai'] = $this->jenisPantai->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		
		$data['isi'] = $this->load->view('geografi/sda/pantai/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['pantai'] = $this->pantai->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('type', 'Jenis Pantai', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Pantai', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('long', 'Panjang Pantai', 'trim|numeric|required');
		$this->form_validation->set_rules('material', 'Material Dasar Pantai', 'trim|required');
		$this->form_validation->set_rules('ciri', 'Ciri Khusus', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'type' 			=> form_error('type'),
				'name' 			=> form_error('name'),
				'satker'		=> form_error('satker'),
				'long' 			=> form_error('long'),
				'material' 		=> form_error('material'),
				'ciri' 			=> form_error('ciri'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' => form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_pantai'	=> $this->input->post('type'),
				'nama_pantai'	=> $this->input->post('name'),
				'panjang_pantai'=> $this->input->post('long'),
				'material_dasar_pantai'=> $this->input->post('material'),
				'ciri_khusus'	=> $this->input->post('ciri'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_location'),
				'is_active'		=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date('Y-m-d H:i:s')
			);

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			if ($this->pantai->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('type', 'Jenis Pantai', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Pantai', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('long', 'Panjang Pantai', 'trim|numeric|required');
		$this->form_validation->set_rules('material', 'Material Dasar Pantai', 'trim|required');
		$this->form_validation->set_rules('ciri', 'Ciri Khusus', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'type' 				=> form_error('type'),
				'name' 				=> form_error('name'),
				'satker'			=> form_error('satker'),
				'long' 				=> form_error('long'),
				'material' 			=> form_error('material'),
				'ciri' 				=> form_error('ciri'),
				'provinsi' 			=> form_error('provinsi'),
				'notes' 			=> form_error('notes'),
				'flag_locationedit' => form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'				=> $this->input->post('satker'),
				'id_jenis_pantai'		=> $this->input->post('type'),
				'nama_pantai'			=> $this->input->post('name'),
				'panjang_pantai'		=> $this->input->post('long'),
				'material_dasar_pantai'	=> $this->input->post('material'),
				'ciri_khusus'			=> $this->input->post('ciri'),
				'keterangan'			=> $this->input->post('notes'),
				'flag_location'		=> $this->input->post('flag_locationedit'),
				'updated_by'			=> $this->session->userdata('id_user'),
				'updated_date'			=> date('Y-m-d H:i:s')
			);

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			$id = decrypt($this->input->post('id'));

			if ($this->pantai->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pantai->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
