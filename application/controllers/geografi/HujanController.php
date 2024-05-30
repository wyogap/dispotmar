<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HujanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoHujan', 'hujan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
	}

	public function index()
	{
		$this->data['title'] = 'Geografi - Curah Hujan';

		if (policy('GEO','read')) {
			$this->data['dataHujan'] = $this->hujan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataHujan'] = $this->hujan->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sda/curahHujan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['hujan'] = $this->hujan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('min', 'Suhu Minimum', 'trim|numeric|required');
		$this->form_validation->set_rules('max', 'Suhu Maximum', 'trim|numeric|required');
		$this->form_validation->set_rules('humidity', 'Kelembapan Udara', 'trim|numeric|required');
		$this->form_validation->set_rules('rainy', 'Musim Hujan', 'trim|required');
		$this->form_validation->set_rules('rainfall', 'Curah Hujan', 'trim|required');
		// $this->form_validation->set_rules('category', 'Kategori Curah Hujan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'min' 			=> form_error('min'),
				'max' 			=> form_error('max'),
				'humidity' 			=> form_error('humidity'),
				'rainy' 		=> form_error('rainy'),
				'rainfall' 			=> form_error('rainfall'),
				// 'category' 			=> form_error('category'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'suhu_min'		=> $this->input->post('min'),
				'suhu_max'		=> $this->input->post('max'),
				'kelembaban_udara'=> $this->input->post('humidity'),
				'musim_hujan'	=> $this->input->post('rainy'),
				'curah_hujan'	=> $this->input->post('rainfall'),
				// 'kategori_curah_hujan'	=> $this->input->post('category'),
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

			if ($this->hujan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('min', 'Suhu Minimum', 'trim|numeric|required');
		$this->form_validation->set_rules('max', 'Suhu Maximum', 'trim|numeric|required');
		$this->form_validation->set_rules('humidity', 'Kelembapan Udara', 'trim|numeric|required');
		$this->form_validation->set_rules('rainy', 'Musim Hujan', 'trim|required');
		$this->form_validation->set_rules('rainfall', 'Curah Hujan', 'trim|required');
		// $this->form_validation->set_rules('category', 'Kategori Curah Hujan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'min' 			=> form_error('min'),
				'max' 			=> form_error('max'),
				'humidity' 			=> form_error('humidity'),
				'rainy' 		=> form_error('rainy'),
				'rainfall' 			=> form_error('rainfall'),
				// 'category' 			=> form_error('category'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'suhu_min'		=> $this->input->post('min'),
				'suhu_max'		=> $this->input->post('max'),
				'kelembaban_udara'=> $this->input->post('humidity'),
				'musim_hujan'	=> $this->input->post('rainy'),
				'curah_hujan'	=> $this->input->post('rainfall'),
				// 'kategori_curah_hujan'	=> $this->input->post('category'),
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

			if ($this->hujan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->hujan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
