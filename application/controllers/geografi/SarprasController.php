<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SarprasController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoSarpras', 'sarpras');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('KelasPemerintah','pemerintah');
		$this->load->model('KelasBebanMuatan','bebanMuatan');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Sarana Prasarana';

		if (policy('GEO','read')) {
			$this->data['dataSarpras'] = $this->sarpras->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataSarpras'] = $this->sarpras->getdataForDatatable();
		}

		$this->data['kelasPemerintah'] = $this->pemerintah->get();
		$this->data['kelasBebanMuatan'] = $this->bebanMuatan->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/sarprasJalan/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['sarpras'] = $this->sarpras->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('klasifikasi_pemerintah', 'Klasifikasi Jalan Pemerintah', 'trim|required');
		$this->form_validation->set_rules('prosentase_pemerintah', 'Prosentase Jalan Pemerintah', 'trim|required|numeric');
		$this->form_validation->set_rules('klasifikasi_beban', 'Klasifikasi Jalan Beban Muatan', 'trim|required');
		$this->form_validation->set_rules('prosentase_beban', 'Prosentase Jalan Beban Muatan', 'trim|required|numeric');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'klasifikasi_pemerintah' 			=> form_error('klasifikasi_pemerintah'),
				'prosentase_pemerintah'			=> form_error('prosentase_pemerintah'),
				'klasifikasi_beban' 		=> form_error('klasifikasi_beban'),
				'prosentase_beban'		=> form_error('prosentase_beban'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_kelas_admpemerintah'	=> $this->input->post('klasifikasi_pemerintah'),
				'prosentase_pemerintah'		=> $this->input->post('prosentase_pemerintah'),
				'id_kelas_bebanmuatan'		=> $this->input->post('klasifikasi_beban'),
				'prosentase_beban_muatan'		=> $this->input->post('prosentase_beban'),
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

			if ($this->sarpras->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('klasifikasi_pemerintah', 'Klasifikasi Jalan Pemerintah', 'trim|required');
		$this->form_validation->set_rules('prosentase_pemerintah', 'Prosentase Jalan Pemerintah', 'trim|required|numeric');
		$this->form_validation->set_rules('klasifikasi_beban', 'Klasifikasi Jalan Beban Muatan', 'trim|required');
		$this->form_validation->set_rules('prosentase_beban', 'Prosentase Jalan Beban Muatan', 'trim|required|numeric');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'klasifikasi_pemerintah' 			=> form_error('klasifikasi_pemerintah'),
				'prosentase_pemerintah'			=> form_error('prosentase_pemerintah'),
				'klasifikasi_beban' 		=> form_error('klasifikasi_beban'),
				'prosentase_beban'		=> form_error('prosentase_beban'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'id_kelas_admpemerintah'	=> $this->input->post('klasifikasi_pemerintah'),
				'prosentase_pemerintah'		=> $this->input->post('prosentase_pemerintah'),
				'id_kelas_bebanmuatan'		=> $this->input->post('klasifikasi_beban'),
				'prosentase_beban_muatan'		=> $this->input->post('prosentase_beban'),
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

			if ($this->sarpras->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->sarpras->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
