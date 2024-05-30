<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndustriIkanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoIndustriIkan', 'ikan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisIkan','jenis');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi -  Industri Perikanan';

		if (policy('GEO','read')) {
			$this->data['dataIkan'] = $this->ikan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataIkan'] = $this->ikan->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['jenisIkan'] = $this->jenis->get();

		$data['isi'] = $this->load->view('geografi/injasMaritim/industriIkan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['ikan'] = $this->ikan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('gtKapal', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('jumlah_kapal', 'Jumlah Kapal', 'trim|required|integer');
		// $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('data_pemilik', 'Data Pemilik', 'trim|required');
		$this->form_validation->set_rules('hasil_produksi', 'Hasil Produksi', 'trim|numeric|required');
		$this->form_validation->set_rules('pemanfaatan', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('omzet', 'Omzet', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');
		$this->form_validation->set_rules('type', 'Jenis Ikan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama' 			=> form_error('nama'),
				'gtKapal'			=> form_error('gtKapal'),
				'jumlah_kapal' 		=> form_error('jumlah_kapal'),
				// 'fasilitas'		=> form_error('fasilitas'),
				'alamat'		=> form_error('alamat'),
				'pemilik'			=> form_error('pemilik'),
				'data_pemilik' 		=> form_error('data_pemilik'),
				'hasil_produksi'		=> form_error('hasil_produksi'),
				'pemanfaatan'		=> form_error('pemanfaatan'),
				'omzet'		=> form_error('omzet'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location'),
				'type' 			=> form_error('type')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('nama'),
				'gt_kapal'		=> $this->input->post('gtKapal'),
				'jumlah_kapal'		=> $this->input->post('jumlah_kapal'),
				// 'fasilitas'		=> $this->input->post('fasilitas'),
				'alamat'		=> $this->input->post('alamat'),
				'pemilik'		=> $this->input->post('pemilik'),
				'data_pemilik'		=> $this->input->post('data_pemilik'),
				'hasil_produksi'		=> $this->input->post('hasil_produksi'),
				'pemanfaatan'		=> $this->input->post('pemanfaatan'),
				'omzet'		=> $this->input->post('omzet'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_location'),
				'id_jenis_ikan'	=> $this->input->post('type'),
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

			if ($this->ikan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('gtKapal', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('jumlah_kapal', 'Jumlah Kapal', 'trim|required|integer');
		// $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		$this->form_validation->set_rules('data_pemilik', 'Data Pemilik', 'trim|required');
		$this->form_validation->set_rules('hasil_produksi', 'Hasil Produksi', 'trim|numeric|required');
		$this->form_validation->set_rules('pemanfaatan', 'Pemanfaatan', 'trim|required');
		$this->form_validation->set_rules('omzet', 'Omzet', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');
		$this->form_validation->set_rules('type', 'Jenis Ikan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama' 			=> form_error('nama'),
				'gtKapal'			=> form_error('gtKapal'),
				'jumlah_kapal' 		=> form_error('jumlah_kapal'),
				// 'fasilitas'		=> form_error('fasilitas'),
				'alamat'		=> form_error('alamat'),
				'pemilik'			=> form_error('pemilik'),
				'data_pemilik' 		=> form_error('data_pemilik'),
				'hasil_produksi'		=> form_error('hasil_produksi'),
				'pemanfaatan'		=> form_error('pemanfaatan'),
				'omzet'		=> form_error('omzet'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit'),
				'type' 			=> form_error('type')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('nama'),
				'gt_kapal'		=> $this->input->post('gtKapal'),
				'jumlah_kapal'		=> $this->input->post('jumlah_kapal'),
				// 'fasilitas'		=> $this->input->post('fasilitas'),
				'alamat'		=> $this->input->post('alamat'),
				'pemilik'		=> $this->input->post('pemilik'),
				'data_pemilik'		=> $this->input->post('data_pemilik'),
				'hasil_produksi'		=> $this->input->post('hasil_produksi'),
				'pemanfaatan'		=> $this->input->post('pemanfaatan'),
				'omzet'		=> $this->input->post('omzet'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_locationedit'),
				'id_jenis_ikan'	=> $this->input->post('type'),
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

			if ($this->ikan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->ikan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
