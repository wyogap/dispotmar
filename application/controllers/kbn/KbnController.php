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

		$this->data['kbn'] = $this->kbn->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KBN','create')) show_404();

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('klaster', 'Klaster', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama KBN', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('nama_ketua_pelaksana', 'Nama Tertua Desa', 'trim|required');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|integer|required');
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
				'id_kelurahan' 		    => form_error('id_kelurahan'),
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
				'id_geografi'	=> $this->input->post('id_kelurahan'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'deskripsi'		=> $this->input->post('deskripsi'),
				'tgl_mulai'	    => $this->input->post('tgl_mulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
                'is_active'     => 1,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => $this->session->userdata('id_user'),
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['gambar_sampul'])) {
                $gambar = $this->kbn->do_upload('gambar_sampul');
                if (!empty($gambar)) {
                    $data['gambar_sampul'] = $gambar;
                }
            }

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
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|integer|required');
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
				'id_kelurahan' 		    => form_error('id_kelurahan'),
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
				'id_geografi'	=> $this->input->post('id_kelurahan'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'deskripsi'		=> $this->input->post('deskripsi'),
				'tgl_mulai'	    => $this->input->post('tgl_mulai'),
				'tgl_selesai'	=> $this->input->post('tgl_selesai'),
                'updated_date'  => date('Y-m-d H:i:s'),
                'updated_by'    => $this->session->userdata('id_user'),
			);

            //update gambar-sampul kalau perlu
            if (!empty($_FILES['gambar_sampul'])) {
                $gambar = $this->kbn->do_upload('gambar_sampul');
                if (!empty($gambar)) {
                    $data['gambar_sampul'] = $gambar;
                }
            }

			$id = $this->input->post('id_kbn');

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

    public function dashboard() {
		$this->data['title'] = 'Peta Sebaran Kampung Bahari Nusantara';
		// $satkers = $this->satker->treeWithGeo();
		// $this->data['satkers_json'] = json_encode($satkers, JSON_INVALID_UTF8_IGNORE);
        $kotamas = $this->satker->getKotama();
        $satkers = $this->satker->getSatkerBukanKotama();
        $this->data['kotamas'] = $kotamas;
        $this->data['satkers'] = $satkers;
        $kbn = $this->kbn->get();
        $this->data['kbn'] = $kbn;

		$data['isi'] = $this->load->view('kbn/dashboard', $this->data, true);
		$this->load->view('skin/layout', $data);
    }

    public function pelaporan($klaster) {
        $this->data['title'] = 'Kampung Bahari Nusantara - Klaster ' .strtoupper($klaster);

		$this->data['klaster'] = $klaster;
		$this->data['satkers'] = $this->satker->get();
		$this->data['satkerRank'] = $this->kbn->getRankSatker($klaster);
		$this->data['personelRank'] = $this->kbn->getRankPersonel($klaster);
		
		$config['base_url'] = site_url().'kbn/'. $klaster;

		if (policy('KBN','read')) {
			$config['total_rows'] = $this->kbn->getReportCount($klaster, $this->session->userdata('id_satker'), null, null);
		}else if (policy('KBN','read_all')){
			$config['total_rows'] = $this->kbn->getReportCount($klaster);
		}
		
		$config['per_page'] = 10;
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		
		$data['isi'] = $this->load->view('kbn/pelaporan', $this->data, true);
		$this->load->view('skin/layout', $data);
    }

    public function getKbnActivity($klaster, $offset)
	{
        $offset = intval($offset);
		if ($klaster == $offset || $offset == 0) {
			$offset = 1;
		}
		
		if (policy('KBN','read')) {
			$activities = $this->kbn->getReport($klaster, $this->session->userdata('id_satker'),10,$offset);
		}else if (policy('KBN','read_all')){
			// $activities = $this->report->getDataPagination(null,10,$offset);
			$activities = $this->kbn->getReport($klaster, null,10,$offset);
		}
		
        if ($activities == null) {
            $activities = array();
        }

		echo json_encode($activities);
	}

	public function getKbnActivityBySatker($idsatker)
	{
		$result = $this->kbn->getReportBySatker($klaster, $idsatker);
		
		echo json_encode($result);
	}

	public function getKbnActivityByPersonel($iduser)
	{
		$result = $this->kbn->getReportByPersonel($klaster, $iduser);
		
		echo json_encode($result);
	}   

	public function getKbnActivityByKbn($idkbn)
	{
		$result = $this->kbn->getReportByKbn($klaster, $idkbn);
		
		echo json_encode($result);
	}    
    
}
