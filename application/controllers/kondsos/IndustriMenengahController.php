<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndustriMenengahController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('kondsos/IndustriMenengah', 'industri');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Kondsos - Industri Menengah';

		if (policy('KONSOS','read')) {
			$this->data['dataIndustri'] = $this->industri->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('KONSOS','read_all')){
			$this->data['dataIndustri'] = $this->industri->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('kondsos/indMenengah/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('KONSOS','update')) show_404();

		$this->data['industri'] = $this->industri->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KONSOS','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Industri', 'trim|required');
		$this->form_validation->set_rules('sumber', 'Sumber Bahan Baku', 'trim|required');
		$this->form_validation->set_rules('penjualan', 'Penjualan', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Tenaga Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi'			=> form_error('provinsi'),
				'jenis'			=> form_error('jenis'),
				'sumber'			=> form_error('sumber'),
				'penjualan'			=> form_error('penjualan'),
				'jumlah'			=> form_error('jumlah'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jenis_industri'		=> $this->input->post('jenis'),
				'sumber_bahan_baku'		=> $this->input->post('sumber'),
				'penjualan'		=> $this->input->post('penjualan'),
				'jumlah_tenaga_kerja'		=> $this->input->post('jumlah'),
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

			if ($this->industri->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('KONSOS','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Industri', 'trim|required');
		$this->form_validation->set_rules('sumber', 'Sumber Bahan Baku', 'trim|required');
		$this->form_validation->set_rules('penjualan', 'Penjualan', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Tenaga Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi'			=> form_error('provinsi'),
				'jenis'			=> form_error('jenis'),
				'sumber'			=> form_error('sumber'),
				'penjualan'			=> form_error('penjualan'),
				'jumlah'			=> form_error('jumlah'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'jenis_industri'		=> $this->input->post('jenis'),
				'sumber_bahan_baku'		=> $this->input->post('sumber'),
				'penjualan'		=> $this->input->post('penjualan'),
				'jumlah_tenaga_kerja'		=> $this->input->post('jumlah'),
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

			if ($this->industri->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('KONSOS','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->industri->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
