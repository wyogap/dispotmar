<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrganisasiMassaController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('kondsos/OrganisasiMasa', 'masa');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Kondsos - Organisasi Massa';

		if (policy('KONSOS','read')) {
			$this->data['dataMasa'] = $this->masa->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('KONSOS','read_all')){
			$this->data['dataMasa'] = $this->masa->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('kondsos/orgMassa/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('KONSOS','update')) show_404();

		$this->data['masa'] = $this->masa->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KONSOS','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Organisasi', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat Kantor Pusat', 'trim|required');
		$this->form_validation->set_rules('bidang', 'Bidang', 'trim|required');
		$this->form_validation->set_rules('tertua', 'Tertua', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'name'			=> form_error('name'),
				'address'		=> form_error('address'),
				'bidang' 			=> form_error('bidang'),
				'tertua' 		=> form_error('tertua'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_organisasi'		=> $this->input->post('name'),
				'alamat_kantor_pusat'		=> $this->input->post('address'),
				'bidang'	=> $this->input->post('bidang'),
				'tertua'		=> $this->input->post('tertua'),
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

			if ($this->masa->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('KONSOS','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Organisasi', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat Kantor Pusat', 'trim|required');
		$this->form_validation->set_rules('bidang', 'Bidang', 'trim|required');
		$this->form_validation->set_rules('tertua', 'Tertua', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'name'			=> form_error('name'),
				'address'		=> form_error('address'),
				'bidang' 			=> form_error('bidang'),
				'tertua' 		=> form_error('tertua'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_organisasi'		=> $this->input->post('name'),
				'alamat_kantor_pusat'		=> $this->input->post('address'),
				'bidang'	=> $this->input->post('bidang'),
				'tertua'		=> $this->input->post('tertua'),
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

			if ($this->masa->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('KONSOS','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->masa->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
