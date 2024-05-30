<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SungaiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoSungai', 'sungai');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('PemanfaatanSungai','pemanfaatan');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Sungai';

		if (policy('GEO','read')) {
			$this->data['dataSungai'] = $this->sungai->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataSungai'] = $this->sungai->getdataForDatatable();
		}

		$this->data['pemanfaatan'] = $this->pemanfaatan->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sda/sungai/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['sungai'] = $this->sungai->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Sungai', 'trim|required');
		$this->form_validation->set_rules('width', 'Lebar Sungai', 'trim|numeric|required');
		$this->form_validation->set_rules('long', 'Panjang Sungai', 'trim|numeric|required');
		$this->form_validation->set_rules('sources', 'Sumber Sungai', 'trim|required');
		$this->form_validation->set_rules('child', 'Anak Sungai', 'trim|required');
		$this->form_validation->set_rules('utilization', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'name' 			=> form_error('name'),
				'width' 		=> form_error('width'),
				'long' 			=> form_error('long'),
				'sources' 		=> form_error('sources'),
				'child' 		=> form_error('child'),
				'utilization' 	=> form_error('utilization'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_sungai'	=> $this->input->post('name'),
				'lebar'			=> $this->input->post('width'),
				'panjang'		=> $this->input->post('long'),
				'sumber_sungai'	=> $this->input->post('sources'),
				'anak_sungai'	=> $this->input->post('child'),
				'id_pemanfaatan_sungai'	=> $this->input->post('utilization'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_location'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
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

			if ($this->sungai->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Sungai', 'trim|required');
		$this->form_validation->set_rules('width', 'Lebar Sungai', 'trim|numeric|required');
		$this->form_validation->set_rules('long', 'Panjang Sungai', 'trim|numeric|required');
		$this->form_validation->set_rules('sources', 'Sumber Sungai', 'trim|required');
		$this->form_validation->set_rules('child', 'Anak Sungai', 'trim|required');
		$this->form_validation->set_rules('utilization', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'name' 			=> form_error('name'),
				'width' 		=> form_error('width'),
				'long' 			=> form_error('long'),
				'sources' 		=> form_error('sources'),
				'child' 		=> form_error('child'),
				'utilization' 	=> form_error('utilization'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_sungai'	=> $this->input->post('name'),
				'lebar'			=> $this->input->post('width'),
				'panjang'		=> $this->input->post('long'),
				'sumber_sungai'	=> $this->input->post('sources'),
				'anak_sungai'	=> $this->input->post('child'),
				'id_pemanfaatan_sungai'	=> $this->input->post('utilization'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_locationedit'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
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

			if ($this->sungai->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->sungai->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
