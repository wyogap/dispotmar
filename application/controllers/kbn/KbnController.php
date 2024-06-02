<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KbnController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('kbn/Kbn', 'kbn');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Rekap - Kampung Bahari Nusantara';

		if (policy('DEMO','read')) {
			$this->data['dataKbn'] = $this->kbn->getBySatker([$this->session->userdata('id_satker')]);
		}else if (policy('DEMO','read_all')){
			$this->data['dataKbn'] = $this->kbn->get();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('kbn/kbn', $this->data, true);

        //echo($data['isi']); exit;

		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('KBN','update')) show_404();

		$this->data['kbn'] = $this->bahari->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KBN','create')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('klaster', 'Klaster', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama KBN', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('nama_ketua_pelaksana', 'Nama Tertua Desa', 'trim|required');
		$this->form_validation->set_rules('id_geografi', 'Desa/Kelurahan', 'trim|integer|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			    => form_error('id_satker'),
				'klaster' 			    => form_error('klaster'),
				'nama' 		            => form_error('nama'),
				'nama_tertua_desa' 	    => form_error('nama_tertua_desa'),
				'nama_ketua_pelaksana' 	=> form_error('nama_ketua_pelaksana'),
				'id_geografi' 		    => form_error('id_geografi'),
				'latitude' 	            => form_error('latitude'),
				'longitude' 		    => form_error('longitude'),
				'deskripsi' 		    => form_error('deskripsi')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('id_satker'),
				'klaster'	    => $this->input->post('klaster'),
				'nama'	        => $this->input->post('nama'),
				'nama_tertua_desa'	    => $this->input->post('nama_tertua_desa'),
				'nama_ketua_pelaksana'	=> $this->input->post('nama_ketua_pelaksana'),
				'id_geografi'	=> $this->input->post('id_geografi'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'deskripsi'		=> $this->input->post('deskripsi'),
				'tgl_mulai'	    => $this->input->post('tgl_mulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
				'gambar_sampul'	=> $this->input->post('gambar_sampul'),
                'is_active'     => 1,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => $this->session->userdata('id_user'),
			);

			if ($this->kbn->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('KBN','update')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('klaster', 'Klaster', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama KBN', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('nama_ketua_pelaksana', 'Nama Tertua Desa', 'trim|required');
		$this->form_validation->set_rules('id_geografi', 'Desa/Kelurahan', 'trim|integer|required');
		$this->form_validation->set_rules('latitude', 'Lintang', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Bujur', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'id_satker'			    => form_error('id_satker'),
				'klaster' 			    => form_error('klaster'),
				'nama' 		            => form_error('nama'),
				'nama_tertua_desa' 	    => form_error('nama_tertua_desa'),
				'nama_ketua_pelaksana' 	=> form_error('nama_ketua_pelaksana'),
				'id_geografi' 		    => form_error('id_geografi'),
				'latitude' 	            => form_error('latitude'),
				'longitude' 		    => form_error('longitude'),
				'deskripsi' 		    => form_error('deskripsi')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('id_satker'),
				'klaster'	    => $this->input->post('klaster'),
				'nama'	        => $this->input->post('nama'),
				'nama_tertua_desa'	    => $this->input->post('nama_tertua_desa'),
				'nama_ketua_pelaksana'	=> $this->input->post('nama_ketua_pelaksana'),
				'id_geografi'	=> $this->input->post('id_geografi'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'deskripsi'		=> $this->input->post('deskripsi'),
				'tgl_mulai'	    => $this->input->post('tgl_mulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
				'gambar_sampul'	=> $this->input->post('gambar_sampul'),
                'updated_date'  => date('Y-m-d H:i:s'),
                'updated_by'    => $this->session->userdata('id_user'),
			);

			$id = $this->input->post('id');

			if ($this->kbn->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('KBN','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->kbn->delete($id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
