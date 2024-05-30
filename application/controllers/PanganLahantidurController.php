<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanganLahantidurController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('RekapLahanTidur', 'lahantidur');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
	}

	public function index()
	{
		$this->data['title'] = 'Rekap Lahan Tidur';

		if (policy('KETPANG','read')) {
			$this->data['lahantidur'] = $this->lahantidur->all(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('KETPANG','read_all')){
			$this->data['lahantidur'] = $this->lahantidur->all();
		}

		$data['isi'] = $this->load->view('pangan/lahantidur/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function create()
	{
		if (!policy('KETPANG','create')) show_404();

		$this->data['title'] = 'Form Lahan Tidur';

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('pangan/lahantidur/create', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function store(){
		if (!policy('KETPANG','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('totalArea', 'Luas Lahan', 'trim|required|numeric');
		$this->form_validation->set_rules('usedArea', 'Digarap', 'trim|required|numeric');
		$this->form_validation->set_rules('restArea', 'Lahan Tidur', 'trim|required|numeric');
		$this->form_validation->set_rules('location', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Catatan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker' => form_error('satker'),
				'totalArea' => form_error('totalArea'),
				'usedArea' => form_error('usedArea'),
				'restArea' => form_error('restArea'),
				'location' => form_error('location'),
				'latitude' => form_error('latitude'),
				'longitude' => form_error('longitude'),
				'provinsi' => form_error('provinsi'),
				'notes' => form_error('notes'),
				'flag_location' => form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'			=> $this->input->post('satker'),
				'luas_total'		=> $this->input->post('totalArea'),
				'digarap'			=> $this->input->post('usedArea'),
				'lahan_tidur'		=> $this->input->post('restArea'),
				'latitude'			=> $this->input->post('latitude'),
				'longitude'			=> $this->input->post('longitude'),
				'lokasi'			=> $this->input->post('location'),
				'keterangan'		=> $this->input->post('notes'),
				'flag_location'		=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
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

			if ($this->lahantidur->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function edit($id)
	{
		if (!policy('KETPANG','update')) show_404();

		$this->data['title'] = 'Edit Data Lahan Tidur';

		$this->data['lahantidur'] = $this->lahantidur->find(decrypt($id));
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('pangan/lahantidur/edit', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function update(){
		if (!policy('KETPANG','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('totalArea', 'Luas Lahan', 'trim|required|numeric');
		$this->form_validation->set_rules('usedArea', 'Digarap', 'trim|required|numeric');
		$this->form_validation->set_rules('restArea', 'Lahan Tidur', 'trim|required|numeric');
		$this->form_validation->set_rules('location', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Catatan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker' => form_error('satker'),
				'totalArea' => form_error('totalArea'),
				'usedArea' => form_error('usedArea'),
				'restArea' => form_error('restArea'),
				'location' => form_error('location'),
				'latitude' => form_error('latitude'),
				'longitude' => form_error('longitude'),
				'provinsi' => form_error('provinsi'),
				'notes' => form_error('notes'),
				'flag_locationedit' => form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'			=> $this->input->post('satker'),
				'luas_total'		=> $this->input->post('totalArea'),
				'digarap'			=> $this->input->post('usedArea'),
				'lahan_tidur'		=> $this->input->post('restArea'),
				'latitude'			=> $this->input->post('latitude'),
				'longitude'			=> $this->input->post('longitude'),
				'lokasi'			=> $this->input->post('location'),
				'keterangan'		=> $this->input->post('notes'),
				'flag_location'		=> $this->input->post('flag_locationedit'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
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

			if ($this->lahantidur->update($id, $data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('KETPANG','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->lahantidur->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }

}
