<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarVaksinController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('Geografi','geo');
		$this->load->model('vaksin/daftarvaksin', 'vaksin');
	}

	public function index()
	{
		$this->data['title'] = 'Tracer Vaksin - Daftar Vaksin';
		$this->data['dataDaftarVaksin'] = $this->vaksin->getdataForDatatable();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		
		$data['isi'] = $this->load->view('vaksin/daftar_vaksin/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['daftarvaksin'] = $this->vaksin->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('VAKSIN','create')) show_404();

		$this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|required|max_length[20]');
		$this->form_validation->set_rules('namaktp', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('nohp', 'No Handphone', 'trim|numeric|required|max_length[13]');
		$this->form_validation->set_rules('pernahvaksin', 'Pernah Vaksin', 'trim|required');
		$this->form_validation->set_rules('dosis', 'Dosis', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nik' 			=> form_error('nik'),
				'namaktp' 		=> form_error('namaktp'),
				'nohp'			=> form_error('nohp'),
				'pernahvaksin' 	=> form_error('pernahvaksin'),
				'dosis' 		=> form_error('dosis'),
				'email' 		=> form_error('email'),
				'flag_location' => form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'NIK'				=> $this->input->post('nik'),
				'NamaKTP'			=> $this->input->post('namaktp'),
				'nohp'				=> $this->input->post('nohp'),
				'pernahvaksin'		=> $this->input->post('pernahvaksin'),
				'dosiske'			=> $this->input->post('dosis'),
				'email' 			=> $this->input->post('email'),
				'provinsidomisili' 	=> $this->input->post('provinsi'),
				'kabkotadomisili' 	=> $this->input->post('kabupaten'),
				'kecdomisili' 		=> $this->input->post('kecamatan'),
				'kelurahandomisili' => $this->input->post('kelurahan'),
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

			if ($this->vaksin->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('VAKSIN','update')) show_404();

		$this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|required|max_length[20]');
		$this->form_validation->set_rules('namaktp', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('nohp', 'No Handphone', 'trim|numeric|required|max_length[13]');
		$this->form_validation->set_rules('pernahvaksin', 'Pernah Vaksin', 'trim|required');
		$this->form_validation->set_rules('dosis', 'Dosis', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('flag_locationEdit', 'flag_location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nik'				=> form_error('nik'),
				'namaktp'			=> form_error('namaktp'),
				'nohp'				=> form_error('nohp'),
				'pernahvaksin'		=> form_error('pernahvaksin'),
				'dosis'				=> form_error('dosis'),
				'email' 			=> form_error('email'),
				'flag_locationEdit' => form_error('flag_locationEdit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nik'				=> $this->input->post('nik'),
				'namaktp'			=> $this->input->post('namaktp'),
				'nohp'				=> $this->input->post('nohp'),
				'pernahvaksin'		=> $this->input->post('pernahvaksin'),
				'dosiske'			=> $this->input->post('dosis'),
				'email'				=> $this->input->post('email'),
				'provinsidomisili' 	=> $this->input->post('provinsi'),
				'kabkotadomisili' 	=> $this->input->post('kabupaten'),
				'kecdomisili' 		=> $this->input->post('kecamatan'),
				'kelurahandomisili' => $this->input->post('kelurahan'),
				'flag_location'		=> $this->input->post('flag_locationEdit'),
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

			if ($this->vaksin->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('VAKSIN','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->vaksin->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
