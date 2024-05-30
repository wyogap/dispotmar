<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PertambanganController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPertambangan', 'pertambangan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisBahanTambang','bahanTambang');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Pertambangan';

		if (policy('GEO','read')) {
			$this->data['dataPertambangan'] = $this->pertambangan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPertambangan'] = $this->pertambangan->getdataForDatatable();
		}

		$this->data['jenisBahanTambang'] = $this->bahanTambang->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sdab/pertambangan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['pertambangan'] = $this->pertambangan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('type', 'Jenis Bahan Tambang', 'trim|required');
		$this->form_validation->set_rules('technique', 'Teknik Penambangan', 'trim|required');
		$this->form_validation->set_rules('use', 'Penggunaan', 'trim|required');
		$this->form_validation->set_rules('owner', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('employees', 'Jumalh Tenaga Kerja', 'trim|required|integer');
		$this->form_validation->set_rules('area', 'Luas Tambang', 'trim|numeric|required');
		$this->form_validation->set_rules('tonase', 'Tonase Hasil', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'type' 			=> form_error('type'),
				'technique' 	=> form_error('technique'),
				'use'			=> form_error('use'),
				'owner'			=> form_error('owner'),
				'employees'		=> form_error('employees'),
				'area'			=> form_error('area'),
				'tonase'		=> form_error('tonase'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_bahantambang'	=> $this->input->post('type'),
				'teknik_penambangan'	=> $this->input->post('technique'),
				'penggunaan'	=> $this->input->post('use'),
				'pemilik'		=> $this->input->post('owner'),
				'jumlah_tenaga_kerja'	=> $this->input->post('employees'),
				'luas_tambang'	=> $this->input->post('area'),
				'tonase_hasil'	=> $this->input->post('tonase'),
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

			if ($this->pertambangan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('type', 'Jenis Bahan Tambang', 'trim|required');
		$this->form_validation->set_rules('technique', 'Teknik Penambangan', 'trim|required');
		$this->form_validation->set_rules('use', 'Penggunaan', 'trim|required');
		$this->form_validation->set_rules('owner', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('employees', 'Jumalh Tenaga Kerja', 'trim|required|integer');
		$this->form_validation->set_rules('area', 'Luas Tambang', 'trim|numeric|required');
		$this->form_validation->set_rules('tonase', 'Tonase Hasil', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'type' 			=> form_error('type'),
				'technique' 	=> form_error('technique'),
				'use'			=> form_error('use'),
				'owner'			=> form_error('owner'),
				'employees'		=> form_error('employees'),
				'area'			=> form_error('area'),
				'tonase'		=> form_error('tonase'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_bahantambang'	=> $this->input->post('type'),
				'teknik_penambangan'	=> $this->input->post('technique'),
				'penggunaan'	=> $this->input->post('use'),
				'pemilik'		=> $this->input->post('owner'),
				'jumlah_tenaga_kerja'	=> $this->input->post('employees'),
				'luas_tambang'	=> $this->input->post('area'),
				'tonase_hasil'	=> $this->input->post('tonase'),
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

			if ($this->pertambangan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pertambangan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
