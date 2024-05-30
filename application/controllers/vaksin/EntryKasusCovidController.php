<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntryKasusCovidController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('Geografi','geo');
		$this->load->model('vaksin/kasuscovid', 'covid');
		$this->load->model('vaksin/kontakerat', 'kontakerat');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('User', 'user');
	}

	public function index()
	{
		$this->data['title'] = 'Tracer Vaksin - Entry Kasus Covid';
		$this->data['dataEntryKasusCovid'] = $this->covid->getdataForDatatable();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$data['isi'] = $this->load->view('vaksin/entry_kasus_covid/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function create()
	{
		$this->data['title'] = 'Entry Kasus Covid';
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['users'] = $this->user->get();
		$data['isi'] = $this->load->view('vaksin/entry_kasus_covid/create', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function view($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['title'] = 'View Kasus Covid';
		$this->data['kasuscovid'] = $this->covid->find(decrypt($id));
		$data['isi'] = $this->load->view('vaksin/entry_kasus_covid/view', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function edit($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['title'] = 'Edit Kasus Covid';
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['users'] = $this->user->get();
		$this->data['kasuscovid'] = $this->covid->find(decrypt($id));
		$data['isi'] = $this->load->view('vaksin/entry_kasus_covid/edit', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function getdata($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['kasuscovid'] = $this->covid->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('VAKSIN','create')) show_404();

		$this->form_validation->set_rules('tanggallapor', 'Tanggal Lapor', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('namaktp', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('umur', 'Usia', 'trim|required');
		$this->form_validation->set_rules('telphp', 'No Telp / WA', 'trim|required');
		$this->form_validation->set_rules('alamatktp', 'Alamat KTP', 'trim|required');
		$this->form_validation->set_rules('alamatdomisili', 'Alamat Domisili', 'trim|required');
		$this->form_validation->set_rules('provinsidomisili', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('kabkotadomisili', 'KAB / Kota', 'trim|required');
		$this->form_validation->set_rules('kecdomisili', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('kelurahandomisili', 'Kelurahan', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('gejala', 'Gejala', 'trim|required');
		$this->form_validation->set_rules('deskripsigejala', 'Deskripsi Gejala', 'trim|required');
		$this->form_validation->set_rules('lokasikarantina', 'Lokasi Karantina', 'trim');
		$this->form_validation->set_rules('faskes', 'Faskes', 'trim');
		$this->form_validation->set_rules('kotama', 'Kotama', 'trim|required');
		$this->form_validation->set_rules('satkerpelapor', 'Satker Pelapor', 'trim');
		//$this->form_validation->set_rules('satkerpelapor', 'Satker Pelapor', 'trim|required');
		$this->form_validation->set_rules('reportedby', 'Reported By', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'tanggallapor' 			=> form_error('tanggallapor'),
				'nik' 			=> form_error('nik'),
				'namaktp'	=> form_error('namaktp'),
				'umur' 		=> form_error('umur'),
				'telphp' 		=> form_error('telphp'),
				'alamatktp' 	=> form_error('alamatktp'),
				'alamatdomisili' 		=> form_error('alamatdomisili'),
				'provinsidomisili' 		=> form_error('provinsidomisili'),
				'kabkotadomisili' 		=> form_error('kabkotadomisili'),
				'kecdomisili' 	=> form_error('kecdomisili'),
				'kelurahandomisili' => form_error('kelurahandomisili'),
				'status' 		=> form_error('status'),
				'gejala' 		=> form_error('gejala'),
				'deskripsigejala' 		=> form_error('deskripsigejala'),
				'lokasikarantina' 			=> form_error('lokasikarantina'),
				'faskes'	=> form_error('faskes'),
				'kotama' 		=> form_error('kotama'),
				'satkerpelapor' 		=> form_error('satkerpelapor'),
				'reportedby' 	=> form_error('reportedby'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'tanggallapor'		=> $this->input->post('tanggallapor'),
				'nik'		=> $this->input->post('nik'),
				'namaktp'			=> $this->input->post('namaktp'),
				'umur'	=> $this->input->post('umur'),
				'telphp'			=> $this->input->post('telphp'),
				'alamatktp'			=> $this->input->post('alamatktp'),
				'alamatdomisili'			=> $this->input->post('alamatdomisili'),
				'provinsidomisili'			=> $this->input->post('provinsidomisili'),
				'kabkotadomisili'		=> $this->input->post('kabkotadomisili'),
				'kecdomisili' 	=> $this->input->post('kecdomisili'),
				'kelurahandomisili' 			=> $this->input->post('kelurahandomisili'),
				'status' 	=> $this->input->post('status'),
				'gejala'		=> $this->input->post('gejala'),
				'deskripsigejala'		=> $this->input->post('deskripsigejala'),
				'lokasikarantina'			=> $this->input->post('lokasikarantina'),
				'faskes'	=> $this->input->post('faskes'),
				'kotama'			=> $this->input->post('kotama'),
				'satkerpelapor'			=> $this->input->post('satkerpelapor'),
				'reportedby'			=> $this->input->post('reportedby'),
				'flag_location'			=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date("Y-m-d H:i:s")
			);

			if ($this->input->post('kelurahandomisili')) {
				$data['id_geografi'] = $this->input->post('kelurahandomisili');
			}else if ($this->input->post('kecdomisili')) {
				$data['id_geografi'] = $this->input->post('kecdomisili');
			}else if ($this->input->post('kabkotadomisili')) {
				$data['id_geografi'] = $this->input->post('kabkotadomisili');
			}else if ($this->input->post('provinsidomisili')) {
				$data['id_geografi'] = $this->input->post('provinsidomisili');
			}

			if ($this->covid->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('VAKSIN','update')) show_404();

		$this->form_validation->set_rules('tanggallapor', 'Tanggal Lapor', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('namaktp', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('umur', 'Usia', 'trim|required');
		$this->form_validation->set_rules('telphp', 'No Telp / WA', 'trim|required');
		$this->form_validation->set_rules('alamatktp', 'Alamat KTP', 'trim|required');
		$this->form_validation->set_rules('alamatdomisili', 'Alamat Domisili', 'trim|required');
		$this->form_validation->set_rules('provinsidomisili', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('kabkotadomisili', 'KAB / Kota', 'trim|required');
		$this->form_validation->set_rules('kecdomisili', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('kelurahandomisili', 'Kelurahan', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('gejala', 'Gejala', 'trim|required');
		$this->form_validation->set_rules('deskripsigejala', 'Deskripsi Gejala', 'trim|required');
		$this->form_validation->set_rules('lokasikarantina', 'Lokasi Karantina', 'trim');
		$this->form_validation->set_rules('faskes', 'Faskes', 'trim');
		$this->form_validation->set_rules('kotama', 'Kotama', 'trim|required');
		$this->form_validation->set_rules('satkerpelapor', 'Satker Pelapor', 'trim');
		//$this->form_validation->set_rules('satkerpelapor', 'Satker Pelapor', 'trim|required');
		$this->form_validation->set_rules('reportedby', 'Reported By', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'tanggallapor' 			=> form_error('tanggallapor'),
				'nik' 			=> form_error('nik'),
				'namaktp'	=> form_error('namaktp'),
				'umur' 		=> form_error('umur'),
				'telphp' 		=> form_error('telphp'),
				'alamatktp' 	=> form_error('alamatktp'),
				'alamatdomisili' 		=> form_error('alamatdomisili'),
				'provinsidomisili' 		=> form_error('provinsidomisili'),
				'kabkotadomisili' 		=> form_error('kabkotadomisili'),
				'kecdomisili' 	=> form_error('kecdomisili'),
				'kelurahandomisili' => form_error('kelurahandomisili'),
				'status' 		=> form_error('status'),
				'gejala' 		=> form_error('gejala'),
				'deskripsigejala' 		=> form_error('deskripsigejala'),
				'lokasikarantina' 			=> form_error('lokasikarantina'),
				'faskes'	=> form_error('faskes'),
				'kotama' 		=> form_error('kotama'),
				'satkerpelapor' 		=> form_error('satkerpelapor'),
				'reportedby' 	=> form_error('reportedby'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'tanggallapor'		=> $this->input->post('tanggallapor'),
				'nik'		=> $this->input->post('nik'),
				'namaktp'			=> $this->input->post('namaktp'),
				'umur'	=> $this->input->post('umur'),
				'telphp'			=> $this->input->post('telphp'),
				'alamatktp'			=> $this->input->post('alamatktp'),
				'alamatdomisili'			=> $this->input->post('alamatdomisili'),
				'provinsidomisili'			=> $this->input->post('provinsidomisili'),
				'kabkotadomisili'		=> $this->input->post('kabkotadomisili'),
				'kecdomisili' 	=> $this->input->post('kecdomisili'),
				'kelurahandomisili' 			=> $this->input->post('kelurahandomisili'),
				'status' 	=> $this->input->post('status'),
				'gejala'		=> $this->input->post('gejala'),
				'deskripsigejala'		=> $this->input->post('deskripsigejala'),
				'lokasikarantina'			=> $this->input->post('lokasikarantina'),
				'faskes'	=> $this->input->post('faskes'),
				'kotama'			=> $this->input->post('kotama'),
				'satkerpelapor'			=> $this->input->post('satkerpelapor'),
				'reportedby'			=> $this->input->post('reportedby'),
				'flag_location'			=> $this->input->post('flag_location'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
			);

			if ($this->input->post('kelurahandomisili')) {
				$data['id_geografi'] = $this->input->post('kelurahandomisili');
			}else if ($this->input->post('kecdomisili')) {
				$data['id_geografi'] = $this->input->post('kecdomisili');
			}else if ($this->input->post('kabkotadomisili')) {
				$data['id_geografi'] = $this->input->post('kabkotadomisili');
			}else if ($this->input->post('provinsidomisili')) {
				$data['id_geografi'] = $this->input->post('provinsidomisili');
			}

			$id = decrypt($this->input->post('id'));

			if ($this->covid->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('VAKSIN','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->covid->roleCheck(decrypt($id))) {
			$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
			redirect_back();
		} else {
			if ($this->covid->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
			}
		}
    }

	//kontak erat

	//show detail
	public function showdetail($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['title'] = 'Detail Kontak Erat';
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['dataKontakErat'] = $this->kontakerat->getdataForDatatable(decrypt($id));
		$this->data['kasuscovid'] = $this->covid->find(decrypt($id));
		$data['isi'] = $this->load->view('vaksin/entry_kasus_covid/detail_kontakerat', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function edit_kontakerat($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['Editkontakerat'] = $this->kontakerat->find(decrypt($id));
		echo json_encode($this->data);
	}

	//create
	public function store_kontakerat(){
		if (!policy('VAKSIN','create')) show_404();

		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('namaktp', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('umur', 'Usia', 'trim|required');
		$this->form_validation->set_rules('idkasus', 'Id Parent', 'trim');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('alamatdomisili', 'Alamat Domisili', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('kabupaten', 'KAB / Kota', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('nohp', 'nohp', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nik' 			=> form_error('nik'),
				'namaktp'	=> form_error('namaktp'),
				'umur' 		=> form_error('umur'),
				'idkasus' 		=> form_error('idkasus'),
				'pekerjaan' 	=> form_error('pekerjaan'),
				'alamatdomisili' 		=> form_error('alamatdomisili'),
				'provinsi' 		=> form_error('provinsi'),
				'kabupaten' 		=> form_error('kabupaten'),
				'kecamatan' 	=> form_error('kecamatan'),
				'nohp' 		=> form_error('nohp'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nik'		=> $this->input->post('nik'),
				'namaktp'			=> $this->input->post('namaktp'),
				'umur'	=> $this->input->post('umur'),
				'idkasus'			=> $this->input->post('idkasus'),
				'pekerjaan'			=> $this->input->post('pekerjaan'),
				'alamatdomisili'			=> $this->input->post('alamatdomisili'),
				'provinsidomisili'			=> $this->input->post('provinsi'),
				'kabkotadomisili'		=> $this->input->post('kabupaten'),
				'kecdomisili' 	=> $this->input->post('kecamatan'),
				'nohp' 	=> $this->input->post('nohp'),
				'flag_location'			=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date("Y-m-d H:i:s")
			);

			if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			if ($this->kontakerat->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	//update
	public function update_kontakerat(){
		if (!policy('VAKSIN','update')) show_404();

		$this->form_validation->set_rules('nikEdit', 'NIK', 'trim|required');
		$this->form_validation->set_rules('namaktpEdit', 'Nama KTP', 'trim|required');
		$this->form_validation->set_rules('umurEdit', 'Usia', 'trim|required');
		$this->form_validation->set_rules('pekerjaanEdit', 'Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('alamatdomisiliEdit', 'Alamat Domisili', 'trim|required');
		$this->form_validation->set_rules('provinsiEdit', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('kabupatenEdit', 'KAB / Kota', 'trim|required');
		$this->form_validation->set_rules('kecamatanEdit', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('nohpEdit', 'nohp', 'trim|required');
		$this->form_validation->set_rules('flag_locationEdit', 'flag location', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nikEdit' 			=> form_error('nikEdit'),
				'namaktpEdit'	=> form_error('namaktpEdit'),
				'umurEdit' 		=> form_error('umurEdit'),
				'pekerjaanEdit' 	=> form_error('pekerjaanEdit'),
				'alamatdomisiliEdit' 		=> form_error('alamatdomisiliEdit'),
				'provinsiEdit' 		=> form_error('provinsiEdit'),
				'kabupatenEdit' 		=> form_error('kabupatenEdit'),
				'kecamatanEdit' 	=> form_error('kecamatanEdit'),
				'nohpEdit' 		=> form_error('nohpEdit'),
				'flag_locationEdit' 		=> form_error('flag_locationEdit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nik'		=> $this->input->post('nikEdit'),
				'namaktp'			=> $this->input->post('namaktpEdit'),
				'umur'	=> $this->input->post('umurEdit'),
				'pekerjaan'			=> $this->input->post('pekerjaanEdit'),
				'alamatdomisili'			=> $this->input->post('alamatdomisiliEdit'),
				'provinsidomisili'			=> $this->input->post('provinsiEdit'),
				'kabkotadomisili'		=> $this->input->post('kabupatenEdit'),
				'kecdomisili' 	=> $this->input->post('kecamatanEdit'),
				'nohp' 	=> $this->input->post('nohpEdit'),
				'flag_location'			=> $this->input->post('flag_locationEdit'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date("Y-m-d H:i:s")
			);

			if ($this->input->post('kecamatanEdit')) {
				$data['id_geografi'] = $this->input->post('kecamatanEdit');
			}else if ($this->input->post('kabupatenEdit')) {
				$data['id_geografi'] = $this->input->post('kabupatenEdit');
			}else if ($this->input->post('provinsiEdit')) {
				$data['id_geografi'] = $this->input->post('provinsiEdit');
			}

			
			$id = decrypt($this->input->post('id'));

			if ($this->kontakerat->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function deletekontakerat($id=null)
    {
		if (!policy('VAKSIN','delete')) show_404();

		if (!isset($id)) show_404();

			if ($this->kontakerat->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
			}
    }

}