<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LabuhIkanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPelabuhanIkan', 'pelabuhanIkan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('KelasPelabuhan','kelas');
		$this->load->model('Wpp','wpp');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Pelabuhan Perikanan';

		if (policy('GEO','read')) {
			$this->data['dataPelabuhanIkan'] = $this->pelabuhanIkan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPelabuhanIkan'] = $this->pelabuhanIkan->getdataForDatatable();
		}

		$this->data['kelasPelabuhan'] = $this->kelas->get();
		$this->data['wpps'] = $this->wpp->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanIkan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['pelabuhanIkan'] = $this->pelabuhanIkan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('harbor', 'Nama Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('class', 'Kelas Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('wpp', 'WPP', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('manager', 'Pengelola', 'trim|required');
		$this->form_validation->set_rules('facility', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'harbor' 		=> form_error('harbor'),
				'class'			=> form_error('class'),
				'wpp' 			=> form_error('wpp'),
				'status'		=> form_error('status'),
				'manager' 		=> form_error('manager'),
				'facility'		=> form_error('facility'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_pelabuhan'=> $this->input->post('harbor'),
				'id_kelas_pelabuhanikan'	=> $this->input->post('class'),
				'id_wpp'			=> $this->input->post('wpp'),
				'status'		=> $this->input->post('status'),
				'pengelola'		=> $this->input->post('manager'),
				'fasilitas'		=> $this->input->post('facility'),
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

			if ($this->pelabuhanIkan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('harbor', 'Nama Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('class', 'Kelas Pelabuhan', 'trim|required');
		$this->form_validation->set_rules('wpp', 'WPP', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('manager', 'Pengelola', 'trim|required');
		$this->form_validation->set_rules('facility', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'harbor' 		=> form_error('harbor'),
				'class'			=> form_error('class'),
				'wpp' 			=> form_error('wpp'),
				'status'		=> form_error('status'),
				'manager' 		=> form_error('manager'),
				'facility'		=> form_error('facility'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_pelabuhan'=> $this->input->post('harbor'),
				'id_kelas_pelabuhanikan'	=> $this->input->post('class'),
				'id_wpp'			=> $this->input->post('wpp'),
				'status'		=> $this->input->post('status'),
				'pengelola'		=> $this->input->post('manager'),
				'fasilitas'		=> $this->input->post('facility'),
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

			if ($this->pelabuhanIkan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pelabuhanIkan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
