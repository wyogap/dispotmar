<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LabuhSungaiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPelabuhanSungai', 'pelabuhanSungai');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Pelabuhan Sungai';

		if (policy('GEO','read')) {
			$this->data['dataPelabuhanSungai'] = $this->pelabuhanSungai->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPelabuhanSungai'] = $this->pelabuhanSungai->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanSungai/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['pelabuhanSungai'] = $this->pelabuhanSungai->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('harbor', 'Nama Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('river', 'Nama Sungai', 'trim|required');
		$this->form_validation->set_rules('range', 'Jarak dari Laut', 'trim|numeric|required');
		$this->form_validation->set_rules('waves', 'Pasang Tinggi', 'trim|numeric|required');
		$this->form_validation->set_rules('recede', 'Surut Rendah', 'trim|numeric|required');
		$this->form_validation->set_rules('draft', 'Draft Maks', 'trim|numeric|required');
		$this->form_validation->set_rules('shipWidth', 'Lebar Kapal Maks', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'harbor' 		=> form_error('harbor'),
				'river'			=> form_error('river'),
				'range' 		=> form_error('range'),
				'waves'			=> form_error('waves'),
				'recede' 		=> form_error('recede'),
				'draft'			=> form_error('draft'),
				'shipWidth' 	=> form_error('shipWidth'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_pelabuhan'	=> $this->input->post('harbor'),
				'nama_sungai'	=> $this->input->post('river'),
				'jarak_dari_laut'	=> $this->input->post('range'),
				'pasang_tinggi'	=> $this->input->post('waves'),
				'surut_rendah'	=> $this->input->post('recede'),
				'draft_maks'	=> $this->input->post('draft'),
				'lebar_kapal_maks'	=> $this->input->post('shipWidth'),
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

			if ($this->pelabuhanSungai->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('harbor', 'Nama Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('river', 'Nama Sungai', 'trim|required');
		$this->form_validation->set_rules('range', 'Jarak dari Laut', 'trim|numeric|required');
		$this->form_validation->set_rules('waves', 'Pasang Tinggi', 'trim|numeric|required');
		$this->form_validation->set_rules('recede', 'Surut Rendah', 'trim|numeric|required');
		$this->form_validation->set_rules('draft', 'Draft Maks', 'trim|numeric|required');
		$this->form_validation->set_rules('shipWidth', 'Lebar Kapal Maks', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'harbor' 		=> form_error('harbor'),
				'river'			=> form_error('river'),
				'range' 		=> form_error('range'),
				'waves'			=> form_error('waves'),
				'recede' 		=> form_error('recede'),
				'draft'			=> form_error('draft'),
				'shipWidth' 	=> form_error('shipWidth'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_pelabuhan'	=> $this->input->post('harbor'),
				'nama_sungai'	=> $this->input->post('river'),
				'jarak_dari_laut'	=> $this->input->post('range'),
				'pasang_tinggi'	=> $this->input->post('waves'),
				'surut_rendah'	=> $this->input->post('recede'),
				'draft_maks'	=> $this->input->post('draft'),
				'lebar_kapal_maks'	=> $this->input->post('shipWidth'),
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

			if ($this->pelabuhanSungai->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pelabuhanSungai->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
