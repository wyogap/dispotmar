<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EkspedisiLautController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoEkspedisiLaut', 'ekspedisi');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['ekspedisi'] = $this->ekspedisi->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('jenis_muatan', 'Jenis Muatan', 'trim|required');
		$this->form_validation->set_rules('frekuensi_pelayaran', 'Frekuensi ekspedisi', 'trim|numeric|required');
		$this->form_validation->set_rules('jumlah_kapal', 'Jumlah Kapal', 'trim|required|integer');
		$this->form_validation->set_rules('gt_kapal', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location1', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'nama_perusahaan' 			=> form_error('nama_perusahaan'),
				'jenis_muatan'			=> form_error('jenis_muatan'),
				'frekuensi_pelayaran'		=> form_error('frekuensi_pelayaran'),
				'jumlah_kapal'		=> form_error('jumlah_kapal'),
				'gt_kapal' 		=> form_error('gt_kapal'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location1' 		=> form_error('flag_location1')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('nama_perusahaan'),
				'id_jenis_muatan'		=> $this->input->post('jenis_muatan'),
				'frekuensi_pelayaran'		=> $this->input->post('frekuensi_pelayaran'),
				'jumlah_kapal'		=> $this->input->post('jumlah_kapal'),
				'gt_kapal'		=> $this->input->post('gt_kapal'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_location1'),
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

			if ($this->ekspedisi->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('jenis_muatan', 'Jenis Muatan', 'trim|required');
		$this->form_validation->set_rules('frekuensi_pelayaran', 'Frekuensi ekspedisi', 'trim|numeric|required');
		$this->form_validation->set_rules('jumlah_kapal', 'Jumlah Kapal', 'trim|required|integer');
		$this->form_validation->set_rules('gt_kapal', 'GT Kapal', 'trim|numeric|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit1', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'nama_perusahaan' 			=> form_error('nama_perusahaan'),
				'jenis_muatan'			=> form_error('jenis_muatan'),
				'frekuensi_pelayaran'		=> form_error('frekuensi_pelayaran'),
				'jumlah_kapal'		=> form_error('jumlah_kapal'),
				'gt_kapal' 		=> form_error('gt_kapal'),
				'provinsi' 		=> form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit1' 		=> form_error('flag_locationedit1')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_perusahaan'	=> $this->input->post('nama_perusahaan'),
				'id_jenis_muatan'		=> $this->input->post('jenis_muatan'),
				'frekuensi_pelayaran'		=> $this->input->post('frekuensi_pelayaran'),
				'jumlah_kapal'		=> $this->input->post('jumlah_kapal'),
				'gt_kapal'		=> $this->input->post('gt_kapal'),
				'keterangan'	=> $this->input->post('notes'),
				'flag_location'	=> $this->input->post('flag_locationedit1'),
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

			if ($this->ekspedisi->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->ekspedisi->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
