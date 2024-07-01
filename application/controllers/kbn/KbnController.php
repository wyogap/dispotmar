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

		if (policy('KBN','read')) {
			$this->data['dataKbn'] = $this->kbn->getBySatker([$this->session->userdata('id_satker')]);
		}else if (policy('KBN','read_all')){
			$this->data['dataKbn'] = $this->kbn->get();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('kbn/kbn', $this->data, true);

        //echo($data['isi']); exit;

		$this->load->view('skin/layout', $data);
	}

    public function rekap()
	{
        $json['status'] = 1;
		if (policy('KBN','read')) {
			$json['data'] = $this->kbn->getBySatker([$this->session->userdata('id_satker')]);
		}else if (policy('KBN','read_all')){
			$json['data'] = $this->kbn->get();
		}

		echo json_encode($json);
    }

	public function show($id)
	{
		if (!policy('KBN','update')) print_json_error("not-authorized");

		$this->data['kbn'] = $this->kbn->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KBN','create')) print_json_error("not-authorized");

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('klaster', 'Klaster', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama KBN', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Tertua Desa', 'trim');
		$this->form_validation->set_rules('nama_ketua_pelaksana', 'Nama Ketua Pelaksana', 'trim|required');
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
				'tgl_peresmian' => $this->input->post('tgl_peresmian'),
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
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");
            }
		}
	}

	public function update(){
		if (!policy('KBN','update')) print_json_error("not-authorized");

        $this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('klaster', 'Klaster', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama KBN', 'trim|required');
		$this->form_validation->set_rules('nama_tertua_desa', 'Nama Tertua Desa', 'trim');
		$this->form_validation->set_rules('nama_ketua_pelaksana', 'Nama Ketua Pelaksana', 'trim|required');
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
				'tgl_peresmian'	=> $this->input->post('tgl_peresmian'),
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
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");
            }
		}
	}

	public function delete($id=null)
    {
		if (!policy('KBN','delete'))  print_json_error("not-authorized");

		if (!isset($id)) print_json_error("invalid-id");

		if ($this->kbn->delete($id)) {
			echo json_encode([['status' => 1]]);
		} else {
			print_json_error("failure");
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

        foreach ($activities as $actv) {
            if ($actv->id_activity_sosial) {
                $actv->id_activity_sosial = encrypt($actv->id_activity_sosial);
            }
        }

		echo json_encode($activities);
	}

	public function getKbnActivityBySatker($klaster, $idsatker)
	{
		$result = $this->kbn->getReportBySatker($klaster, $idsatker);
		
		echo json_encode($result);
	}

	public function getKbnActivityByPersonel($klaster, $iduser)
	{
		$result = $this->kbn->getReportByPersonel($klaster, $iduser);
		
		echo json_encode($result);
	}   

	public function getKbnActivityByKbn($klaster, $idkbn)
	{
		$result = $this->kbn->getReportByKbn($klaster, $idkbn);
		
		echo json_encode($result);
	}    
    
    public function profil($idkbn) {
        $this->data['kbn'] = null;
        if (policy('KBN','read') || policy('KBN','read_all')) {
			$this->data['kbn'] = $this->kbn->find($idkbn);
		}
        
        $this->data['title'] = 'Kampung Bahari Nusantara';
        if (!empty($this->data['kbn'])) {
            $this->data['title'] = $this->data['kbn']->nama ." - ". $this->data['title'];
        }
        		
        $data['isi'] = $this->load->view('kbn/profil', $this->data, true);
		$this->load->view('skin/layout', $data);

    }

	public function getSDA($sda, $idkbn)
	{
        $result = null;
        if ($sda == 'pantai') {
            $result = $this->kbn->getSDAPantai($idkbn);
        }
        else if ($sda == 'hutan') {
            $result = $this->kbn->getSDAHutan($idkbn);
        }
        else if ($sda == 'gunung') {
            $result = $this->kbn->getSDAGunung($idkbn);
        }
        else if ($sda == 'kerawanan') {
            $result = $this->kbn->getSDAKerawanan($idkbn);
        }
        else if ($sda == 'hujan') {
            $result = $this->kbn->getSDAHujan($idkbn);           
        }
        else if ($sda == 'tanah') {
            $result = $this->kbn->getSDATanah($idkbn);
        }
        else if ($sda == 'sumberair') {
            $result = $this->kbn->getSDASumberAir($idkbn);
        }
        else if ($sda == 'sungai') {
            $result = $this->kbn->getSDASungai($idkbn);
        }
        else if ($sda == 'pulauterluar') {
            $result = $this->kbn->getSDAPulauTerluar($idkbn);
        }
        else if ($sda == 'mangrove') {
            $result = $this->kbn->getSDAMangrove($idkbn);
        }

		echo json_encode($result);
	}    

	public function getSDAB($sdab, $idkbn)
	{
        $result = null;
        if ($sdab == 'perkebunan') {
            $result = $this->kbn->getSDABPerkebunan($idkbn);
        }
        else if ($sdab == 'pertanian') {
            $result = $this->kbn->getSDABPertanian($idkbn);
        }
        else if ($sdab == 'peternakan') {
            $result = $this->kbn->getSDABPeternakan($idkbn);
        }
        else if ($sdab == 'pertambangan') {
            $result = $this->kbn->getSDABPertambangan($idkbn);
        }
        else if ($sdab == 'budidayaikan') {
            $result = $this->kbn->getSDABBudidayaIkan($idkbn);
        }
        else if ($sdab == 'kerambajaring') {
            $result = $this->kbn->getSDABKerambaJaring($idkbn);
        }
        else if ($sdab == 'konservasi') {
            $result = $this->kbn->getSDABKonservasi($idkbn);
        }
        else if ($sdab == 'sumberlistrik') {
            $result = $this->kbn->getSDABSumberListrik($idkbn);
        }
        
		echo json_encode($result);
	}    
}
