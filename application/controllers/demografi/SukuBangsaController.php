<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SukuBangsaController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/SukuBangsa', 'suku');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('Bahasa','bahasa');
		$this->load->model('JenisSuku','jenisSuku');
    }

    public function index()
	{
		$this->data['title'] = 'Demografi - Suku Bangsa';

		if (policy('DEMO','read')) {
			$this->data['dataSuku'] = $this->suku->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataSuku'] = $this->suku->getdataForDatatable();
		}
		
		$this->data['jenis_suku'] = $this->jenisSuku->get();
		$this->data['bahasa_adat'] = $this->bahasa->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/sukuBangsa/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['suku'] = $this->suku->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('suku', 'Jenis suku', 'trim|required');
		$this->form_validation->set_rules('prosentase', 'Prosentase', 'trim|numeric|required');
		$this->form_validation->set_rules('ciri_khas', 'Ciri Khas', 'trim|required');
		$this->form_validation->set_rules('bahasa_adat', 'Bahasa Adat', 'trim|required');
		$this->form_validation->set_rules('tertua_adat', 'Tertua Adat', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'suku' 			=> form_error('suku'),
				'prosentase' 			=> form_error('prosentase'),
				'ciri_khas' 		=> form_error('ciri_khas'),
				'bahasa_adat' 		=> form_error('bahasa_adat'),
				'tertua_adat' 		=> form_error('tertua_adat'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_suku'	=> $this->input->post('suku'),
				'prosentase'	=> $this->input->post('prosentase'),
				'ciri_khas'	=> $this->input->post('ciri_khas'),
				'id_bahasa_adat'	=> $this->input->post('bahasa_adat'),
				'tertua_adat'	=> $this->input->post('tertua_adat'),
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

			if ($this->suku->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('suku', 'Jenis suku', 'trim|required');
		$this->form_validation->set_rules('prosentase', 'Prosentase', 'trim|numeric|required');
		$this->form_validation->set_rules('ciri_khas', 'Ciri Khas', 'trim|required');
		$this->form_validation->set_rules('bahasa_adat', 'Bahasa Adat', 'trim|required');
		$this->form_validation->set_rules('tertua_adat', 'Tertua Adat', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'suku' 			=> form_error('suku'),
				'prosentase' 			=> form_error('prosentase'),
				'ciri_khas' 		=> form_error('ciri_khas'),
				'bahasa_adat' 		=> form_error('bahasa_adat'),
				'tertua_adat' 		=> form_error('tertua_adat'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_suku'	=> $this->input->post('suku'),
				'prosentase'	=> $this->input->post('prosentase'),
				'ciri_khas'	=> $this->input->post('ciri_khas'),
				'id_bahasa_adat'	=> $this->input->post('bahasa_adat'),
				'tertua_adat'	=> $this->input->post('tertua_adat'),
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

			if ($this->suku->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->suku->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
