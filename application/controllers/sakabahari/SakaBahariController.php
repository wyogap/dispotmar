<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SakaBahariController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('sakabahari/SakaBahari', 'bahari');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Rekap - Saka Bahari';

		if (policy('DEMO','read')) {
			$this->data['dataBahari'] = $this->bahari->get($this->session->userdata('id_satker'));
		}else if (policy('DEMO','read_all')){
			$this->data['dataBahari'] = $this->bahari->get();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('sakabahari/sakabahari', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('DEMO','update')) show_404();

		$this->data['bahari'] = $this->bahari->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('DEMO','create')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Saka Bahari', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
		$this->form_validation->set_rules('foto_ketua', 'Foto Ketua', 'trim');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('foto_pembina', 'Foto Pembina', 'trim');
		$this->form_validation->set_rules('sekolah_terlibat', 'Sekolah Terlibat', 'trim');
		$this->form_validation->set_rules('no_gugus_depan', 'Nomer Gugus Depan', 'trim');
		$this->form_validation->set_rules('id_geografi', 'Desa/Kelurahan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			=> form_error('id_satker'),
				'nama' 			    => form_error('nama'),
				'deskripsi' 		=> form_error('deskripsi'),
				'nama_ketua' 	    => form_error('nama_ketua'),
				'foto_ketua' 		=> form_error('foto_ketua'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'foto_pembina' 	    => form_error('foto_pembina'),
				'sekolah_terlibat' 	=> form_error('sekolah_terlibat'),
				'no_gugus_depan' 	=> form_error('no_gugus_depan'),
				'id_geografi' 		=> form_error('id_geografi'),
				'alamat' 		    => form_error('alamat'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama'	        => $this->input->post('nama'),
				'deskripsi'	    => $this->input->post('deskripsi'),
				'nama_ketua'	=> $this->input->post('nama_ketua'),
				'foto_ketua'	=> $this->input->post('foto_ketua'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'foto_pembina'	=> $this->input->post('foto_pembina'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
				'id_geografi'	=> $this->input->post('id_geografi'),
				'alamat'	    => $this->input->post('alamat'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'gambar_sampul'	=> $this->input->post('gambar_sampul'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
			);

			if ($this->bahari->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('DEMO','update')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Saka Bahari', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
		$this->form_validation->set_rules('foto_ketua', 'Foto Ketua', 'trim');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('foto_pembina', 'Foto Pembina', 'trim');
		$this->form_validation->set_rules('sekolah_terlibat', 'Sekolah Terlibat', 'trim');
		$this->form_validation->set_rules('no_gugus_depan', 'Nomer Gugus Depan', 'trim');
		$this->form_validation->set_rules('id_geografi', 'Desa/Kelurahan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			=> form_error('id_satker'),
				'nama' 			    => form_error('nama'),
				'deskripsi' 		=> form_error('deskripsi'),
				'nama_ketua' 	    => form_error('nama_ketua'),
				'foto_ketua' 		=> form_error('foto_ketua'),
				'nama_pembina' 		=> form_error('nama_pembina'),
				'foto_pembina' 	    => form_error('foto_pembina'),
				'sekolah_terlibat' 	=> form_error('sekolah_terlibat'),
				'no_gugus_depan' 	=> form_error('no_gugus_depan'),
				'id_geografi' 		=> form_error('id_geografi'),
				'alamat' 		    => form_error('alamat'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),
				'nama'	        => $this->input->post('nama'),
				'deskripsi'	    => $this->input->post('deskripsi'),
				'nama_ketua'	=> $this->input->post('nama_ketua'),
				'foto_ketua'	=> $this->input->post('foto_ketua'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'foto_pembina'	=> $this->input->post('foto_pembina'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
				'id_geografi'	=> $this->input->post('id_geografi'),
				'alamat'	    => $this->input->post('alamat'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'gambar_sampul'	=> $this->input->post('gambar_sampul'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);

			$id = $this->input->post('id');

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

		if ($this->bahari->delete($id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
