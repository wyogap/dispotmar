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

		// if (policy('SAKA','read')) {
		// 	$this->data['dataBahari'] = $this->bahari->get($this->session->userdata('id_satker'));
		// }else if (policy('SAKA','read_all')){
		// 	$this->data['dataBahari'] = $this->bahari->get();
		// }

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('sakabahari/sakabahari', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

    public function rekap() {
        $json['status'] = 1;
		if (policy('SAKA','read')) {
			$json['data'] = $this->bahari->get($this->session->userdata('id_satker'));
		}else if (policy('SAKA','read_all')){
			$json['data'] = $this->bahari->get();
		}

		echo json_encode($json);
    }

	public function show($id)
	{
		if (!policy('SAKA','update')) print_json_error("not-authorized");

		$this->data['bahari'] = $this->bahari->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('SAKA','create')) print_json_error("not-authorized");

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Saka Bahari', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
		$this->form_validation->set_rules('foto_ketua', 'Foto Ketua', 'trim');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('foto_pembina', 'Foto Pembina', 'trim');
		$this->form_validation->set_rules('sekolah_terlibat', 'Sekolah Terlibat', 'trim');
		$this->form_validation->set_rules('no_gugus_depan', 'Nomer Gugus Depan', 'trim');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|required');
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
				'id_geografi' 		=> form_error('id_kelurahan'),
				'alamat' 		    => form_error('alamat'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('id_satker'),
				'nama'	        => $this->input->post('nama'),
				'deskripsi'	    => $this->input->post('deskripsi'),
				'nama_ketua'	=> $this->input->post('nama_ketua'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
				'id_geografi'	=> $this->input->post('id_kelurahan'),
				'alamat'	    => $this->input->post('alamat'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto_ketua'])) {
                $gambar = $this->bahari->do_upload('foto_ketua');
                if (!empty($gambar)) {
                    $data['foto_ketua'] = $gambar;
                }
            }

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto_pembina'])) {
                $gambar = $this->bahari->do_upload('foto_pembina');
                if (!empty($gambar)) {
                    $data['foto_pembina'] = $gambar;
                }
            }

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['gambar_sampul'])) {
                $gambar = $this->bahari->do_upload('gambar_sampul');
                if (!empty($gambar)) {
                    $data['gambar_sampul'] = $gambar;
                }
            }

			if ($this->bahari->create($data)) {
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");;
            }
		}
	}

	public function update(){
		if (!policy('SAKA','update')) print_json_error("not-authorized");

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Saka Bahari', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
		$this->form_validation->set_rules('foto_ketua', 'Foto Ketua', 'trim');
		$this->form_validation->set_rules('nama_pembina', 'Nama Pembina', 'trim|required');
		$this->form_validation->set_rules('foto_pembina', 'Foto Pembina', 'trim');
		$this->form_validation->set_rules('sekolah_terlibat', 'Sekolah Terlibat', 'trim');
		$this->form_validation->set_rules('no_gugus_depan', 'Nomer Gugus Depan', 'trim');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim|required');
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
				'nama_pembina' 		=> form_error('nama_pembina'),
				'id_geografi' 		=> form_error('id_kelurahan'),
				'alamat' 		    => form_error('alamat'),
				'latitude' 		    => form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('id_satker'),
				'nama'	        => $this->input->post('nama'),
				'deskripsi'	    => $this->input->post('deskripsi'),
				'nama_ketua'	=> $this->input->post('nama_ketua'),
				'nama_pembina'	=> $this->input->post('nama_pembina'),
				'sekolah_terlibat'	=> $this->input->post('sekolah_terlibat'),
				'no_gugus_depan'	=> $this->input->post('no_gugus_depan'),
				'id_geografi'	=> $this->input->post('id_kelurahan'),
				'alamat'	    => $this->input->post('alamat'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto_ketua'])) {
                $gambar = $this->bahari->do_upload('foto_ketua');
                if (!empty($gambar)) {
                    $data['foto_ketua'] = $gambar;
                }
            }

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto_pembina'])) {
                $gambar = $this->bahari->do_upload('foto_pembina');
                if (!empty($gambar)) {
                    $data['foto_pembina'] = $gambar;
                }
            }

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['gambar_sampul'])) {
                $gambar = $this->bahari->do_upload('gambar_sampul');
                if (!empty($gambar)) {
                    $data['gambar_sampul'] = $gambar;
                }
            }

			$id = $this->input->post('id_sakabahari');

			if ($this->bahari->update($id,$data)) {
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");;
            }
		}
	}

	public function delete($id=null)
    {
		if (!policy('SAKA','delete')) print_json_error("not-authorized");

		if (!isset($id))  print_json_error("invalid-id");

		if ($this->bahari->delete($id)) {
			echo json_encode([['status' => 1]]);
		} else {
			print_json_error("failure");;
		}
    }

    public function dashboard() {
		$this->data['title'] = 'Peta Sebaran Saka Bahari';
        $kotamas = $this->satker->getKotama();
        $satkers = $this->satker->getSatkerBukanKotama();
        $this->data['kotamas'] = $kotamas;
        $this->data['satkers'] = $satkers;
        $saka = $this->bahari->get();
        $this->data['saka'] = $saka;

		$data['isi'] = $this->load->view('sakabahari/dashboard', $this->data, true);
		$this->load->view('skin/layout', $data);
    }

    public function pelaporan() {
        $this->data['title'] = 'Pelaporan Saka Bahari';

		$this->data['satkers'] = $this->satker->get();
		$this->data['satkerRank'] = $this->bahari->getRankSatker();
		$this->data['personelRank'] = $this->bahari->getRankPersonel();
		$this->data['getRankCriminals'] = $this->bahari->getRankCriminals();
		
		$config['base_url'] = site_url().'sakabahari/pelaporan';

		if (policy('SAKA','read')) {
			$config['total_rows'] = $this->bahari->getReportCount($this->session->userdata('id_satker'), null, null);
		}else if (policy('SAKA','read_all')){
			$config['total_rows'] = $this->bahari->getReportCount();
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
		
		$data['isi'] = $this->load->view('sakabahari/pelaporan', $this->data, true);
		$this->load->view('skin/layout', $data);
    }  

    public function getSakaActivity($offset)
	{
        $offset = intval($offset);
		if ($offset == 0) {
			$offset = 1;
		}
		
		if (policy('SAKA','read')) {
			$activities = $this->bahari->getReport($this->session->userdata('id_satker'),10,$offset);
		}else if (policy('SAKA','read_all')){
			// $activities = $this->report->getDataPagination(null,10,$offset);
			$activities = $this->bahari->getReport(null,10,$offset);
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

	public function getSakaActivityBySatker($idsatker)
	{
		$result = $this->bahari->getReportBySatker($idsatker);
		
		echo json_encode($result);
	}

	public function getSakaActivityByPersonel($iduser)
	{
		$result = $this->bahari->getReportByPersonel($iduser);
		
		echo json_encode($result);
	}   

	public function getSakaActivityBySaka($idsaka)
	{
		$result = $this->bahari->getReportBySaka($idsaka);
		
		echo json_encode($result);
	}    

    public function profil($idsaka) {
        $this->data['bahari'] = null;
        if (policy('SAKA','read') || policy('SAKA','read_all')) {
			$this->data['bahari'] = $this->bahari->find($idsaka);
		}
        
        $this->data['title'] = 'Saka Bahari';
        if (!empty($this->data['bahari'])) {
            $this->data['title'] = $this->data['bahari']->nama ." - ". $this->data['title'];
        }
        
        $this->data['anggota'] = $this->bahari->daftaranggota($idsaka);

		$data['isi'] = $this->load->view('sakabahari/profil', $this->data, true);
		$this->load->view('skin/layout', $data);

    }

    public function daftaranggota($idsaka) {
        $json['status'] = 1;
        $json['data'] = $this->bahari->daftaranggota($idsaka);

        //print_json_output($json['data']);
		echo json_encode($json);
    }

    public function show_anggota($id)
	{
		if (!policy('SAKA','read') && !policy('SAKA','read_all')) print_json_error("not-authorized");

		$this->data['anggota'] = $this->bahari->find_anggota($id);
		echo json_encode($this->data);
	}

	public function store_anggota(){
		if (!policy('SAKA','update')) print_json_error("not-authorized");

		$this->form_validation->set_rules('nama', 'Nama Anggota', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nama' 			    => form_error('nama'),
				'tgl_lahir' 		=> form_error('tgl_lahir'),
				'jenis_kelamin' 	=> form_error('jenis_kelamin'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nama'	        => $this->input->post('nama'),
				'tgl_lahir'	    => $this->input->post('tgl_lahir'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'no_hp'	        => $this->input->post('no_hp'),
				'email'	        => $this->input->post('email'),
				'alamat'	    => $this->input->post('alamat'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
			);

            $data['id_sakabahari'] = $this->input->post('id_sakabahari');

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto'])) {
                $gambar = $this->bahari->do_upload('foto');
                if (!empty($gambar)) {
                    $data['foto'] = $gambar;
                }
            }

			if ($this->bahari->create_anggota($data)) {
				echo json_encode([['status' => 1]]);
			}
            else {
                print_json_error("failure");
            }
		}
	}

	public function update_anggota(){
		if (!policy('SAKA','update')) print_json_error("not-authorized");

		$this->form_validation->set_rules('nama', 'Nama Anggota', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'nama' 			    => form_error('nama'),
				'tgl_lahir' 		=> form_error('tgl_lahir'),
				'jenis_kelamin' 	=> form_error('jenis_kelamin'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nama'	        => $this->input->post('nama'),
				'tgl_lahir'	    => $this->input->post('tgl_lahir'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'no_hp'	        => $this->input->post('no_hp'),
				'email'	        => $this->input->post('email'),
				'alamat'	    => $this->input->post('alamat'),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto'])) {
                $gambar = $this->bahari->do_upload('foto');
                if (!empty($gambar)) {
                    $data['foto'] = $gambar;
                }
            }

			$id = $this->input->post('id_anggota');

			if ($this->bahari->update_anggota($id,$data)) {
				echo json_encode([['status' => 1]]);
			}
            else {
                print_json_error("failure");
            }
		}
	}

	public function delete_anggota($id=null)
    {
		if (!policy('SAKA','update')) print_json_error("not-authorized");

		if (!isset($id)) print_json_error("invalid-id");

		if ($this->bahari->delete_anggota($id)) {
			echo json_encode([['status' => 1]]);;
		} else {
			print_json_error("failure");;
		}
    }
}
