<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KerawananController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoKerawanan', 'kerawanan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Data Kerawanan';

		if (policy('GEO','read')) {
			$this->data['dataKerawanan'] = $this->kerawanan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataKerawanan'] = $this->kerawanan->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sda/kerawanan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['kerawanan'] = $this->kerawanan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('tektonik', 'Gempa Tektonik', 'trim');
		$this->form_validation->set_rules('vulkanik', 'Gempa Vulkanik', 'trim');
		$this->form_validation->set_rules('banjir', 'Banjir', 'trim');
		$this->form_validation->set_rules('gunung', 'Gunung Meletus', 'trim');
		$this->form_validation->set_rules('tsunami', 'Tsunami', 'trim');
		$this->form_validation->set_rules('kebakaran', 'Kebakaran', 'trim');
		$this->form_validation->set_rules('angin', 'Angin', 'trim');
		$this->form_validation->set_rules('longsor', 'Longsor', 'trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'tektonik' 			=> form_error('tektonik'),
				'vulkanik'			=> form_error('vulkanik'),
				'banjir' 		=> form_error('banjir'),
				'gunung'		=> form_error('gunung'),
				'tsunami'		=> form_error('tsunami'),
				'kebakaran'		=> form_error('kebakaran'),
				'angin'		=> form_error('angin'),
				'longsor'		=> form_error('longsor'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'gempa_tektonik'	=> $this->input->post('tektonik'),
				'gempa_vulkanik'		=> $this->input->post('vulkanik'),
				'banjir'		=> $this->input->post('banjir'),
				'gunung_meletus'		=> $this->input->post('gunung'),
				'tsunami'		=> $this->input->post('tsunami'),
				'kebakaran'		=> $this->input->post('kebakaran'),
				'kebakaran'		=> $this->input->post('kebakaran'),
				'angin'		=> $this->input->post('angin'),
				'longsor'		=> $this->input->post('longsor'),
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

			if ($this->kerawanan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('tektonik', 'Gempa Tektonik', 'trim');
		$this->form_validation->set_rules('vulkanik', 'Gempa Vulkanik', 'trim');
		$this->form_validation->set_rules('banjir', 'Banjir', 'trim');
		$this->form_validation->set_rules('gunung', 'Gunung Meletus', 'trim');
		$this->form_validation->set_rules('tsunami', 'Tsunami', 'trim');
		$this->form_validation->set_rules('kebakaran', 'Kebakaran', 'trim');
		$this->form_validation->set_rules('angin', 'Angin', 'trim');
		$this->form_validation->set_rules('longsor', 'Longsor', 'trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'tektonik' 			=> form_error('tektonik'),
				'vulkanik'			=> form_error('vulkanik'),
				'banjir' 		=> form_error('banjir'),
				'gunung'		=> form_error('gunung'),
				'tsunami'		=> form_error('tsunami'),
				'kebakaran'		=> form_error('kebakaran'),
				'angin'		=> form_error('angin'),
				'longsor'		=> form_error('longsor'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'gempa_tektonik'	=> $this->input->post('tektonik'),
				'gempa_vulkanik'		=> $this->input->post('vulkanik'),
				'banjir'		=> $this->input->post('banjir'),
				'gunung_meletus'		=> $this->input->post('gunung'),
				'tsunami'		=> $this->input->post('tsunami'),
				'kebakaran'		=> $this->input->post('kebakaran'),
				'kebakaran'		=> $this->input->post('kebakaran'),
				'angin'		=> $this->input->post('angin'),
				'longsor'		=> $this->input->post('longsor'),
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

			if ($this->kerawanan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->kerawanan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
