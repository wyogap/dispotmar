<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShipHandlerController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoShipHandler', 'ship');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Ship Chandler';

		if (policy('GEO','read')) {
			$this->data['dataShip'] = $this->ship->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataShip'] = $this->ship->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/injasMaritim/shipHandler/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['ship'] = $this->ship->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('company', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('ship', 'Nama Kapal', 'trim|required');
		$this->form_validation->set_rules('shipGt', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('facilities', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('owner', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('ownerData', 'Data Pemilik', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'company' 			=> form_error('company'),
				'ship'			=> form_error('ship'),
				'shipGt' 		=> form_error('shipGt'),
				'facilities'		=> form_error('facilities'),
				'address'		=> form_error('address'),
				'owner'		=> form_error('owner'),
				'ownerData'		=> form_error('ownerData'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('company'),
				'nama_kapal'		=> $this->input->post('ship'),
				'gt_kapal'		=> $this->input->post('shipGt'),
				'fasilitas'		=> $this->input->post('facilities'),
				'alamat'		=> $this->input->post('address'),
				'pemilik'		=> $this->input->post('owner'),
				'data_pemilik'		=> $this->input->post('ownerData'),
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

			if ($this->ship->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('company', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('ship', 'Nama Kapal', 'trim|required');
		$this->form_validation->set_rules('shipGt', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('facilities', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('owner', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('ownerData', 'Data Pemilik', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'company' 			=> form_error('company'),
				'ship'			=> form_error('ship'),
				'shipGt' 		=> form_error('shipGt'),
				'facilities'		=> form_error('facilities'),
				'address'		=> form_error('address'),
				'owner'		=> form_error('owner'),
				'ownerData'		=> form_error('ownerData'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('company'),
				'nama_kapal'		=> $this->input->post('ship'),
				'gt_kapal'		=> $this->input->post('shipGt'),
				'fasilitas'		=> $this->input->post('facilities'),
				'alamat'		=> $this->input->post('address'),
				'pemilik'		=> $this->input->post('owner'),
				'data_pemilik'		=> $this->input->post('ownerData'),
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

			if ($this->ship->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->ship->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
