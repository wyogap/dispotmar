<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RumahSakitController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/RumahSakit', 'rumahsakit');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisRumahSakit','jenis');
		$this->load->model('KelasRumahSakit','kelas');
		//$this->load->model('PenyelenggaraRumahSakit','penyelenggara');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Rumah Sakit';

		if (policy('DEMO','read')) {
			$this->data['dataRumahsakit'] = $this->rumahsakit->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataRumahsakit'] = $this->rumahsakit->getdataForDatatable();
		}

		$this->data['jenis_rumahsakit'] = $this->jenis->get();
		$this->data['kelas_rumahsakit'] = $this->kelas->get();
		//$this->data['penyelenggara_rumahsakit'] = $this->penyelenggara->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/rumahSakit/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['rumahsakit'] = $this->rumahsakit->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_rumahsakit', 'Nama Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('jenis_rumahsakit', 'Jenis Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('kelas_rumahsakit', 'Kelas Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('penyelenggara_rumahsakit', 'Penyelenggara Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('alamat_rumahsakit', 'Alamat Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama_rumahsakit' 		=> form_error('nama_rumahsakit'),
				'jenis_rumahsakit' 	=> form_error('jenis_rumahsakit'),
				'kelas_rumahsakit' 	=> form_error('kelas_rumahsakit'),
				'penyelenggara_rumahsakit' 	=> form_error('penyelenggara_rumahsakit'),
				'alamat_rumahsakit' 	=> form_error('alamat_rumahsakit'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_rumahsakit'	=> $this->input->post('nama_rumahsakit'),
				'id_jenis_rumahsakit'	=> $this->input->post('jenis_rumahsakit'),
				'id_kelas_rumahsakit'	=> $this->input->post('kelas_rumahsakit'),
				'id_penyelenggara_rumahsakit'	=> $this->input->post('penyelenggara_rumahsakit'),
				'alamat_rumahsakit'	=> $this->input->post('alamat_rumahsakit'),
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

			if ($this->rumahsakit->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_rumahsakit', 'Nama Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('jenis_rumahsakit', 'Jenis Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('kelas_rumahsakit', 'Kelas Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('penyelenggara_rumahsakit', 'Penyelenggara Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('alamat_rumahsakit', 'Alamat Rumah Sakit', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama_rumahsakit' 		=> form_error('nama_rumahsakit'),
				'jenis_rumahsakit' 	=> form_error('jenis_rumahsakit'),
				'kelas_rumahsakit' 	=> form_error('kelas_rumahsakit'),
				'penyelenggara_rumahsakit' 	=> form_error('penyelenggara_rumahsakit'),
				'alamat_rumahsakit' 	=> form_error('alamat_rumahsakit'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_rumahsakit'	=> $this->input->post('nama_rumahsakit'),
				'id_jenis_rumahsakit'	=> $this->input->post('jenis_rumahsakit'),
				'id_kelas_rumahsakit'	=> $this->input->post('kelas_rumahsakit'),
				'id_penyelenggara_rumahsakit'	=> $this->input->post('penyelenggara_rumahsakit'),
				'alamat_rumahsakit'	=> $this->input->post('alamat_rumahsakit'),
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

			if ($this->rumahsakit->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->rumahsakit->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
