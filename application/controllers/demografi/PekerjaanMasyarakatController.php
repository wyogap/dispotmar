<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PekerjaanMasyarakatController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/PekerjaanMasyarakat', 'pekerjaan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('Pekerjaan','mayoritas');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Pekerjaan Masyarakat';

		if (policy('DEMO','read')) {
			$this->data['dataPekerjaan'] = $this->pekerjaan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataPekerjaan'] = $this->pekerjaan->getdataForDatatable();
		}

		$this->data['mayoritasPekerjaan'] = $this->mayoritas->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/pekerjaanMasyarakat/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['pekerjaan'] = $this->pekerjaan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('mayoritas1', 'Mayoritas 1', 'trim|required');
		$this->form_validation->set_rules('mayoritas2', 'Mayoritas 2', 'trim|required');
		$this->form_validation->set_rules('mayoritas3', 'Mayoritas 3', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'mayoritas1' 	=> form_error('mayoritas1'),
				'mayoritas2' 	=> form_error('mayoritas2'),
				'mayoritas3' 	=> form_error('mayoritas3'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'mayoritas1'	=> $this->input->post('mayoritas1'),
				'mayoritas2'	=> $this->input->post('mayoritas2'),
				'mayoritas3'	=> $this->input->post('mayoritas3'),
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

			if ($this->pekerjaan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('mayoritas1', 'Mayoritas 1', 'trim|required');
		$this->form_validation->set_rules('mayoritas2', 'Mayoritas 2', 'trim|required');
		$this->form_validation->set_rules('mayoritas3', 'Mayoritas 3', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'mayoritas1' 	=> form_error('mayoritas1'),
				'mayoritas2' 	=> form_error('mayoritas2'),
				'mayoritas3' 	=> form_error('mayoritas3'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'mayoritas1'	=> $this->input->post('mayoritas1'),
				'mayoritas2'	=> $this->input->post('mayoritas2'),
				'mayoritas3'	=> $this->input->post('mayoritas3'),
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

			if ($this->pekerjaan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pekerjaan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
