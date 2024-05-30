<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StruktanahController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoTanah', 'tanah');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisTanah','jenis');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Struktur Tanah';

		if (policy('GEO','read')) {
			$this->data['dataTanah'] = $this->tanah->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataTanah'] = $this->tanah->getdataForDatatable();
		}

		$this->data['jenisTanah'] = $this->jenis->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sda/strukTanah/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['tanah'] = $this->tanah->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('type', 'Jenis Tanah', 'trim|required');
		$this->form_validation->set_rules('slope', 'Kemiringan', 'trim|required');
		$this->form_validation->set_rules('utilization', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'type' 			=> form_error('type'),
				'slope' 			=> form_error('slope'),
				'utilization' 			=> form_error('utilization'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_tanah'		=> $this->input->post('type'),
				'kemiringan'		=> $this->input->post('slope'),
				'pemanfaatan'=> $this->input->post('utilization'),
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

			if ($this->tanah->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('type', 'Jenis Tanah', 'trim|required');
		$this->form_validation->set_rules('slope', 'Kemiringan', 'trim|required');
		$this->form_validation->set_rules('utilization', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'type' 			=> form_error('type'),
				'slope' 			=> form_error('slope'),
				'utilization' 			=> form_error('utilization'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 	=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_jenis_tanah'		=> $this->input->post('type'),
				'kemiringan'		=> $this->input->post('slope'),
				'pemanfaatan'=> $this->input->post('utilization'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_locationedit'),
				'is_active'		=> TRUE,
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

			if ($this->tanah->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->tanah->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
