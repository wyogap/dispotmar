<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JumlahPendudukController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('demografi/JumlahPenduduk', 'penduduk');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Demografi - Jumlah Penduduk';

		if (policy('DEMO','read')) {
			$this->data['dataPenduduk'] = $this->penduduk->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataPenduduk'] = $this->penduduk->getdataForDatatable();
		}
		
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('demografi/jumlahPenduduk/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['penduduk'] = $this->penduduk->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jumlah_penduduk', 'Jumlah Penduduk', 'trim|integer|required');
		$this->form_validation->set_rules('jumlah_pria', 'Jumlah Pria', 'trim|integer|required');
		$this->form_validation->set_rules('jumlah_wanita', 'Jumlah Wanita', 'trim|integer|required');
		$this->form_validation->set_rules('age0018', 'Usia 0-18 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age1839', 'Usia 18-40 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age4045', 'Usia 40-45 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age55high', 'Usia >55 Th', 'trim|integer|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|integer|required');
		$this->form_validation->set_rules('angka_kelahiran', 'Angka Kelahiran', 'trim|integer|required');
		$this->form_validation->set_rules('angka_kematian', 'Angka Kematian', 'trim|integer|required');
		$this->form_validation->set_rules('SMP', 'SMP', 'trim|integer|required');
		$this->form_validation->set_rules('SMA', 'SMA', 'trim|integer|required');
		$this->form_validation->set_rules('S1', 'S1', 'trim|integer|required');
		$this->form_validation->set_rules('S2', 'S2', 'trim|integer|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'jumlah_penduduk' 	=> form_error('jumlah_penduduk'),
				'jumlah_pria' 	=> form_error('jumlah_pria'),
				'jumlah_wanita' => form_error('jumlah_wanita'),
				'age0018' 		=> form_error('age0018'),
				'age1839'		=> form_error('age1839'),
				'age4045' 		=> form_error('age4045'),
				'age55high' 	=> form_error('age55high'),
				'tahun' 		=> form_error('tahun'),
				'angka_kelahiran'	=> form_error('angka_kelahiran'),
				'angka_kematian'=> form_error('angka_kematian'),
				'SMP' 			=> form_error('SMP'),
				'SMA'			=> form_error('SMA'),
				'S1' 			=> form_error('S1'),
				'S2' 			=> form_error('S2'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jumlah_penduduk'	=> $this->input->post('jumlah_penduduk'),
				'jumlah_pria'	=> $this->input->post('jumlah_pria'),
				'jumlah_wanita'	=> $this->input->post('jumlah_wanita'),
				'age0018'		=> $this->input->post('age0018'),
				'age1839'		=> $this->input->post('age1839'),
				'age4045'		=> $this->input->post('age4045'),
				'age55high'		=> $this->input->post('age55high'),
				'tahun'			=> $this->input->post('tahun'),
				'angka_kelahiran'	=> $this->input->post('angka_kelahiran'),
				'angka_kematian'	=> $this->input->post('angka_kematian'),
				'SMP'			=> $this->input->post('SMP'),
				'SMA'			=> $this->input->post('SMA'),
				'S1'			=> $this->input->post('S1'),
				'S2'			=> $this->input->post('S2'),
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

			if ($this->penduduk->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jumlah_penduduk', 'Jumlah Penduduk', 'trim|integer|required');
		$this->form_validation->set_rules('jumlah_pria', 'Jumlah Pria', 'trim|integer|required');
		$this->form_validation->set_rules('jumlah_wanita', 'Jumlah Wanita', 'trim|integer|required');
		$this->form_validation->set_rules('age0018', 'Usia 0-18 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age1839', 'Usia 18-40 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age4045', 'Usia 40-45 Th', 'trim|integer|required');
		$this->form_validation->set_rules('age55high', 'Usia >55 Th', 'trim|integer|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|integer|required');
		$this->form_validation->set_rules('angka_kelahiran', 'Angka Kelahiran', 'trim|integer|required');
		$this->form_validation->set_rules('angka_kematian', 'Angka Kematian', 'trim|integer|required');
		$this->form_validation->set_rules('SMP', 'SMP', 'trim|integer|required');
		$this->form_validation->set_rules('SMA', 'SMA', 'trim|integer|required');
		$this->form_validation->set_rules('S1', 'S1', 'trim|integer|required');
		$this->form_validation->set_rules('S2', 'S2', 'trim|integer|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'jumlah_penduduk' 	=> form_error('jumlah_penduduk'),
				'jumlah_pria' 	=> form_error('jumlah_pria'),
				'jumlah_wanita' => form_error('jumlah_wanita'),
				'age0018' 		=> form_error('age0018'),
				'age1839'		=> form_error('age1839'),
				'age4045' 		=> form_error('age4045'),
				'age55high' 	=> form_error('age55high'),
				'tahun' 		=> form_error('tahun'),
				'angka_kelahiran'	=> form_error('angka_kelahiran'),
				'angka_kematian'=> form_error('angka_kematian'),
				'SMP' 			=> form_error('SMP'),
				'SMA'			=> form_error('SMA'),
				'S1' 			=> form_error('S1'),
				'S2' 			=> form_error('S2'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jumlah_penduduk'	=> $this->input->post('jumlah_penduduk'),
				'jumlah_pria'	=> $this->input->post('jumlah_pria'),
				'jumlah_wanita'	=> $this->input->post('jumlah_wanita'),
				'age0018'		=> $this->input->post('age0018'),
				'age1839'		=> $this->input->post('age1839'),
				'age4045'		=> $this->input->post('age4045'),
				'age55high'		=> $this->input->post('age55high'),
				'tahun'			=> $this->input->post('tahun'),
				'angka_kelahiran'	=> $this->input->post('angka_kelahiran'),
				'angka_kematian'	=> $this->input->post('angka_kematian'),
				'SMP'			=> $this->input->post('SMP'),
				'SMA'			=> $this->input->post('SMA'),
				'S1'			=> $this->input->post('S1'),
				'S2'			=> $this->input->post('S2'),
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

			if ($this->penduduk->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->penduduk->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
