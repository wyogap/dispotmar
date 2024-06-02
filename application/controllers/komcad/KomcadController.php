<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KomcadController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('komcad/Komcad', 'komcad');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Rekap - Komponen Cadangan';

		if (policy('DEMO','read')) {
			$this->data['dataKomcad'] = $this->komcad->getBySatker($this->session->userdata('id_satker'));
		}else if (policy('DEMO','read_all')){
			$this->data['dataKomcad'] = $this->komcad->get();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('komcad/komcad', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['komcad'] = $this->komcad->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Komcad', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('nomor_induk_komcat', 'Nomor Induk Komcad', 'trim|required');
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
		$this->form_validation->set_rules('tmt_penetapan', 'Tanggal Penetapan', 'trim|required');
		$this->form_validation->set_rules('nomor_telp', 'Nomor Telp', 'trim|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('id_agama', 'Agama', 'trim|integer');
		$this->form_validation->set_rules('id_suku_bangsa', 'Suku Bangsa', 'trim|integer');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|integer');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|integer');
		$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|integer');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'trim|integer');
		$this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim|numeric');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim|numeric');
		$this->form_validation->set_rules('foto', 'Foto', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			=> form_error('id_satker'),
				'nama' 			    => form_error('nama'),
				'tempat_lahir' 		=> form_error('tempat_lahir'),
				'tanggal_lahir' 	=> form_error('tanggal_lahir'),
				'pangkat' 		    => form_error('pangkat'),
				'nomor_induk_komcad' 	=> form_error('nomor_induk_komcat'),
				'pendidikan' 	    => form_error('pendidikan'),
				'tmt_penetapan' 	=> form_error('tmt_penetapan'),
				'nomor_telp' 		=> form_error('nomor_telp'),
				'email' 		    => form_error('email'),
				'id_agama' 		    => form_error('id_agama'),
				'id_suku_bangsa' 	=> form_error('id_suku_bangsa'),
				'id_kelurahan' 		=> form_error('id_kelurahan'),
				'id_kecamatan' 		=> form_error('id_kecamatan'),
				'id_kabupaten' 		=> form_error('id_kabupaten'),
				'id_provinsi' 		=> form_error('id_provinsi'),
				'alamat_ktp' 		=> form_error('alamat_ktp'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
				'foto' 		        => form_error('foto'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama'	        => $this->input->post('nama'),
				'tempat_lahir'	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'pangkat'	    => $this->input->post('pangkat'),
				'nomor_induk_komcad'	=> $this->input->post('nomor_induk_komcad'),
				'pendidikan'	=> $this->input->post('pendidikan'),
				'tmt_penetapan'	=> $this->input->post('tmt_penetapan'),
				'nomor_telp'	=> $this->input->post('nomor_telp'),
				'email'	        => $this->session->userdata('email'),
				'id_agama'	    => $this->input->post('id_agama'),
				'id_suku_bangsa'	=> $this->input->post('id_suku_bangsa'),
				'id_kelurahan'	=> $this->input->post('id_kelurahan'),
				'id_kecamatan'	=> $this->input->post('id_kecamatan'),
				'id_kabupaten'	=> $this->input->post('id_kabupaten'),
				'id_provinsi'	=> $this->input->post('id_provinsi'),
				'alamat_ktp'	=> $this->input->post('alamat_ktp'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'foto'	        => $this->input->post('foto'),
                'is_active'     => 1,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => $this->session->userdata('id_user'),
			);

			if ($this->komcad->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Komcad', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('nomor_induk_komcat', 'Nomor Induk Komcad', 'trim|required');
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
		$this->form_validation->set_rules('tmt_penetapan', 'Tanggal Penetapan', 'trim|required');
		$this->form_validation->set_rules('nomor_telp', 'Nomor Telp', 'trim|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('id_agama', 'Agama', 'trim|integer');
		$this->form_validation->set_rules('id_suku_bangsa', 'Suku Bangsa', 'trim|integer');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|integer');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|integer');
		$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|integer');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'trim|integer');
		$this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim|numeric');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim|numeric');
		$this->form_validation->set_rules('foto', 'Foto', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			=> form_error('id_satker'),
				'nama' 			    => form_error('nama'),
				'tempat_lahir' 		=> form_error('tempat_lahir'),
				'tanggal_lahir' 	=> form_error('tanggal_lahir'),
				'pangkat' 		    => form_error('pangkat'),
				'nomor_induk_komcad' 	=> form_error('nomor_induk_komcat'),
				'pendidikan' 	    => form_error('pendidikan'),
				'tmt_penetapan' 	=> form_error('tmt_penetapan'),
				'nomor_telp' 		=> form_error('nomor_telp'),
				'email' 		    => form_error('email'),
				'id_agama' 		    => form_error('id_agama'),
				'id_suku_bangsa' 	=> form_error('id_suku_bangsa'),
				'id_kelurahan' 		=> form_error('id_kelurahan'),
				'id_kecamatan' 		=> form_error('id_kecamatan'),
				'id_kabupaten' 		=> form_error('id_kabupaten'),
				'id_provinsi' 		=> form_error('id_provinsi'),
				'alamat_ktp' 		=> form_error('alamat_ktp'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
				'foto' 		        => form_error('foto'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama'	        => $this->input->post('nama'),
				'tempat_lahir'	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'pangkat'	    => $this->input->post('pangkat'),
				'nomor_induk_komcad'	=> $this->input->post('nomor_induk_komcad'),
				'pendidikan'	=> $this->input->post('pendidikan'),
				'tmt_penetapan'	=> $this->input->post('tmt_penetapan'),
				'nomor_telp'	=> $this->input->post('nomor_telp'),
				'email'	        => $this->session->userdata('email'),
				'id_agama'	    => $this->input->post('id_agama'),
				'id_suku_bangsa'	=> $this->input->post('id_suku_bangsa'),
				'id_kelurahan'	=> $this->input->post('id_kelurahan'),
				'id_kecamatan'	=> $this->input->post('id_kecamatan'),
				'id_kabupaten'	=> $this->input->post('id_kabupaten'),
				'id_provinsi'	=> $this->input->post('id_provinsi'),
				'alamat_ktp'	=> $this->input->post('alamat_ktp'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'foto'	        => $this->input->post('foto'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);

			$id = $this->input->post('id');

			if ($this->komcad->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('DEMO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->komcad->delete($id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
