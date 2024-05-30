<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DesaBinaanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/Binaan', 'binaan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Demografi - Desa Binaan';

		if (policy('DEMO','read')) {
			$this->data['desaBinaan'] = $this->binaan->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['desaBinaan'] = $this->binaan->getdataForDatatable();
		}
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/desaBinaan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['binaan'] = $this->binaan->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'trim|required');
		$this->form_validation->set_rules('jumlah_penduduk', 'Jumlah Penduduk', 'trim|integer|required');
		$this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'trim|required');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Tertua Desa', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('kode_satker', 'kode satker', 'trim');
		$this->form_validation->set_rules('wilayah', 'wilayah', 'trim');
		$this->form_validation->set_rules('latitude', 'latitude', 'trim');
		$this->form_validation->set_rules('longitude', 'longitude', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');
		$this->form_validation->set_rules('idprov', 'idprov', 'trim');
		$this->form_validation->set_rules('idkab', 'idkab', 'trim');
		$this->form_validation->set_rules('idkec', 'idkec', 'trim');
		$this->form_validation->set_rules('idkel', 'idkel', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama_desa' 			=> form_error('nama_desa'),
				'jumlah_penduduk' 			=> form_error('jumlah_penduduk'),
				'tingkat_pendidikan' 		=> form_error('tingkat_pendidikan'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'nama_tertua_desa' 		=> form_error('nama_tertua_desa'),
				'notes' 		=> form_error('notes'),
				'kode_satker' 		=> form_error('kode_satker'),
				'wilayah' 		=> form_error('wilayah'),
				'latitude' 		=> form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
				'flag_location' 		=> form_error('flag_location'),
				'idprov' 		=> form_error('idprov'),
				'idkab' 		=> form_error('idkab'),
				'idkec' 		=> form_error('idkec'),
				'idkel' 		=> form_error('idkel')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_desa'	=> $this->input->post('nama_desa'),
				'jumlah_penduduk'	=> $this->input->post('jumlah_penduduk'),
				'tingkat_pendidikan'	=> $this->input->post('tingkat_pendidikan'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'nama_tertua_desa'	=> $this->input->post('nama_tertua_desa'),
				'keterangan'	=> $this->input->post('notes'),
				'kode_satker'	=> $this->input->post('kode_satker'),
				'wilayah'	=> $this->input->post('wilayah'),
				'latitude'	=> $this->input->post('latitude'),
				'longitude'	=> $this->input->post('longitude'),
				'flag_location'	=> $this->input->post('flag_location'),
				'id_prov'	=> $this->input->post('idprov'),
				'id_kab'	=> $this->input->post('idkab'),
				'id_kec'	=> $this->input->post('idkec'),
				'id_kel'	=> $this->input->post('idkel'),
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

			if ($this->binaan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'trim|required');
		$this->form_validation->set_rules('jumlah_penduduk', 'Jumlah Penduduk', 'trim|integer|required');
		$this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'trim|required');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Tertua Desa', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('kode_satkerEdit', 'kode satker', 'trim');
		$this->form_validation->set_rules('wilayahEdit', 'wilayah', 'trim');
		$this->form_validation->set_rules('latitudeEdit', 'latitude', 'trim');
		$this->form_validation->set_rules('longitudeEdit', 'longitude', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');
		$this->form_validation->set_rules('idprovedit', 'idprov', 'trim');
		$this->form_validation->set_rules('idkabedit', 'idkab', 'trim');
		$this->form_validation->set_rules('idkecedit', 'idkec', 'trim');
		$this->form_validation->set_rules('idkeledit', 'idkel', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'nama_desa' 			=> form_error('nama_desa'),
				'jumlah_penduduk' 			=> form_error('jumlah_penduduk'),
				'tingkat_pendidikan' 		=> form_error('tingkat_pendidikan'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'nama_tertua_desa' 		=> form_error('nama_tertua_desa'),
				'notes' 		=> form_error('notes'),
				'kode_satkerEdit' 		=> form_error('kode_satkerEdit'),
				'wilayahEdit' 		=> form_error('wilayahEdit'),
				'latitudeEdit' 		=> form_error('latitudeEdit'),
				'longitudeEdit' 		=> form_error('longitudeEdit'),
				'flag_locationedit' 		=> form_error('flag_locationedit'),
				'idprovedit' 		=> form_error('idprovedit'),
				'idkabedit' 		=> form_error('idkabedit'),
				'idkecedit' 		=> form_error('idkecedit'),
				'idkeledit' 		=> form_error('idkeledit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama_desa'	=> $this->input->post('nama_desa'),
				'jumlah_penduduk'	=> $this->input->post('jumlah_penduduk'),
				'tingkat_pendidikan'	=> $this->input->post('tingkat_pendidikan'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'nama_tertua_desa'	=> $this->input->post('nama_tertua_desa'),
				'keterangan'	=> $this->input->post('notes'),
				'kode_satker'	=> $this->input->post('kode_satkerEdit'),
				'wilayah'	=> $this->input->post('wilayahEdit'),
				'latitude'	=> $this->input->post('latitudeEdit'),
				'longitude'	=> $this->input->post('longitudeEdit'),
				'flag_location'	=> $this->input->post('flag_locationedit'),
				'id_prov'	=> $this->input->post('idprovedit'),
				'id_kab'	=> $this->input->post('idkabedit'),
				'id_kec'	=> $this->input->post('idkecedit'),
				'id_kel'	=> $this->input->post('idkeledit'),
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

			if ($this->binaan->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->binaan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
