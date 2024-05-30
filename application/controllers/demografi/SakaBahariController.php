<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SakaBahariController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/SakaBahari', 'bahari');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisSaka','saka');
    }

    public function index()
	{
		$this->data['title'] = 'Demografi - Saka Bahari';

		if (policy('DEMO','read')) {
			$this->data['dataBahari'] = $this->bahari->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataBahari'] = $this->bahari->getdataForDatatable();
		}

		$this->data['jenis_saka'] = $this->saka->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/sakaBahari/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['bahari'] = $this->bahari->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jumlah_saka', 'Nama Desa', 'trim|integer|required');
		$this->form_validation->set_rules('sekolah_terlibat', 'Jumlah Penduduk', 'trim|required');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('no_gugus_depan', 'Nama Tertua Desa', 'trim|numeric|required');
		$this->form_validation->set_rules('jenis_saka', 'Jenis Saka', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'			=> form_error('satker'),
				'provinsi' 			=> form_error('provinsi'),
				'jumlah_saka' 		=> form_error('jumlah_saka'),
				'sekolah_terlibat' 	=> form_error('sekolah_terlibat'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'jenis_saka' 		=> form_error('jenis_saka'),
				'no_gugus_depan' 	=> form_error('no_gugus_depan'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jumlah_saka'	=> $this->input->post('jumlah_saka'),
				'id_jenis_saka'	=> $this->input->post('jenis_saka'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
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

			if ($this->bahari->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jumlah_saka', 'Nama Desa', 'trim|integer|required');
		$this->form_validation->set_rules('sekolah_terlibat', 'Jumlah Penduduk', 'trim|required');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('no_gugus_depan', 'Nama Tertua Desa', 'trim|numeric|required');
		$this->form_validation->set_rules('jenis_saka', 'Jenis Saka', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'			=> form_error('satker'),
				'provinsi' 			=> form_error('provinsi'),
				'jumlah_saka' 		=> form_error('jumlah_saka'),
				'sekolah_terlibat' 	=> form_error('sekolah_terlibat'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'jenis_saka' 		=> form_error('jenis_saka'),
				'no_gugus_depan' 	=> form_error('no_gugus_depan'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jumlah_saka'	=> $this->input->post('jumlah_saka'),
				'id_jenis_saka'	=> $this->input->post('jenis_saka'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
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

			if ($this->bahari->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->bahari->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
