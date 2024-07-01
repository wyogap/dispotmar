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
		$this->load->model('mst/JenisAgama','agama');
		$this->load->model('mst/JenisSuku','suku');
		$this->load->model('mst/Pendidikan','pendidikan');
		$this->load->model('mst/Jurusan','jurusan');
		$this->load->model('mst/StatusNikah','statusnikah');
    }

    public function index()
	{
		$this->data['title'] = 'Rekap - Komponen Cadangan';

		// if (policy('KOMCAD','read')) {
		// 	$this->data['dataKomcad'] = $this->komcad->getBySatker($this->session->userdata('id_satker'));
		// }else if (policy('KOMCAD','read_all')){
		// 	$this->data['dataKomcad'] = $this->komcad->get();
		// }

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['agama'] = $this->agama->get();
		$this->data['suku_bangsa'] = $this->suku->get();
		$this->data['pendidikan'] = $this->pendidikan->get();
		$this->data['jurusan'] = $this->jurusan->get();
		$this->data['statusnikah'] = $this->statusnikah->get();

		$data['isi'] = $this->load->view('komcad/komcad', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function rekap()
	{
        $json['status'] = 1;
		if (policy('KOMCAD','read')) {
			$json['data'] = $this->komcad->getBySatker($this->session->userdata('id_satker'));
		}else if (policy('KOMCAD','read_all')){
			$json['data'] = $this->komcad->get();
		}

		echo json_encode($json);
    }

	public function show($id)
	{
		if (!policy('KOMCAD','update')) print_json_error("not-authorized");

		$this->data['komcad'] = $this->komcad->find($id);
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('KOMCAD','create')) print_json_error("not-authorized");

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Komcad', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('golongan_pangkat', 'Golongan Pangkat', 'trim|required');
		$this->form_validation->set_rules('nomor_induk_komcad', 'Nomor Induk Komcad', 'trim|required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required');
		$this->form_validation->set_rules('tmt_penetapan', 'Tanggal Penetapan', 'trim|required');
		$this->form_validation->set_rules('nomor_telp', 'Nomor Telp', 'trim|required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('id_agama', 'Agama', 'trim');
		$this->form_validation->set_rules('id_suku_bangsa', 'Suku Bangsa', 'trim');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim');
		$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'trim');
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
				'jenis_kelamin' 	=> form_error('jenis_kelamin'),
				'pangkat' 		    => form_error('pangkat'),
				'golongan_pangkat' 		=> form_error('golongan_pangkat'),
				'nomor_induk_komcad' 	=> form_error('nomor_induk_komcad'),
				'pendidikan_terakhir' 	=> form_error('pendidikan_terakhir'),
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
				'id_satker'		=> $this->input->post('id_satker'),
				'nama'	        => $this->input->post('nama'),
				'tempat_lahir'	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'pangkat'	    => $this->input->post('pangkat'),
				'golongan_pangkat'	    => $this->input->post('golongan_pangkat'),
				'nomor_induk_komcad'	=> $this->input->post('nomor_induk_komcad'),
				'pendidikan_terakhir'	=> $this->input->post('pendidikan_terakhir'),
				'jurusan_pendidikan'	=> $this->input->post('jurusan_pendidikan'),
				'tmt_penetapan'	=> $this->input->post('tmt_penetapan'),
				'nomor_telp'	=> $this->input->post('nomor_telp'),
				'email'	        => $this->input->post('email'),
				'id_status_nikah'	    => $this->input->post('id_status_nikah'),
				'id_agama'	    => $this->input->post('id_agama'),
				'id_suku_bangsa'	=> $this->input->post('id_suku_bangsa'),
				'id_kelurahan'	=> $this->input->post('id_kelurahan'),
				'id_kecamatan'	=> $this->input->post('id_kecamatan'),
				'id_kabupaten'	=> $this->input->post('id_kabupaten'),
				'id_provinsi'	=> $this->input->post('id_provinsi'),
				'alamat_ktp'	=> $this->input->post('alamat_ktp'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
                'is_active'     => 1,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => $this->session->userdata('id_user'),
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto'])) {
                $gambar = $this->komcad->do_upload('foto');
                if (!empty($gambar)) {
                    $data['foto'] = $gambar;
                }
            }

			if ($this->komcad->create($data)) {
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");
            }
		}
	}

	public function update(){
		if (!policy('KOMCAD','update')) print_json_error("not-authorized");

		$this->form_validation->set_rules('id_satker', 'Satuan Kerja', 'trim|integer|required');
		$this->form_validation->set_rules('nama', 'Nama Komcad', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
		$this->form_validation->set_rules('golongan_pangkat', 'Golongan Pangkat', 'trim|required');
		$this->form_validation->set_rules('nomor_induk_komcad', 'Nomor Induk Komcad', 'trim|required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required');
		$this->form_validation->set_rules('tmt_penetapan', 'Tanggal Penetapan', 'trim|required');
		$this->form_validation->set_rules('nomor_telp', 'Nomor Telp', 'trim|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('id_agama', 'Agama', 'trim');
		$this->form_validation->set_rules('id_suku_bangsa', 'Suku Bangsa', 'trim');
		$this->form_validation->set_rules('id_kelurahan', 'Desa/Kelurahan', 'trim');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim');
		$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'trim');
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
				'jenis_kelamin' 	=> form_error('jenis_kelamin'),
				'pangkat' 		    => form_error('pangkat'),
				'golongan_pangkat' 		=> form_error('golongan_pangkat'),
				'nomor_induk_komcad' 	=> form_error('nomor_induk_komcad'),
				'pendidikan_terakhir' 	=> form_error('pendidikan_terakhir'),
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
				'id_satker'		=> $this->input->post('id_satker'),
				'nama'	        => $this->input->post('nama'),
				'tempat_lahir'	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'pangkat'	    => $this->input->post('pangkat'),
				'golongan_pangkat'	    => $this->input->post('golongan_pangkat'),
				'nomor_induk_komcad'	=> $this->input->post('nomor_induk_komcad'),
				'pendidikan_terakhir'	=> $this->input->post('pendidikan_terakhir'),
				'jurusan_pendidikan'	=> $this->input->post('jurusan_pendidikan'),
				'tmt_penetapan'	=> $this->input->post('tmt_penetapan'),
				'nomor_telp'	=> $this->input->post('nomor_telp'),
				'email'	        => $this->input->post('email'),
				'id_status_nikah'	    => $this->input->post('id_status_nikah'),
				'id_agama'	    => $this->input->post('id_agama'),
				'id_suku_bangsa'	=> $this->input->post('id_suku_bangsa'),
				'id_kelurahan'	=> $this->input->post('id_kelurahan'),
				'id_kecamatan'	=> $this->input->post('id_kecamatan'),
				'id_kabupaten'	=> $this->input->post('id_kabupaten'),
				'id_provinsi'	=> $this->input->post('id_provinsi'),
				'alamat_ktp'	=> $this->input->post('alamat_ktp'),
				'latitude'	    => $this->input->post('latitude'),
				'longitude'	    => $this->input->post('longitude'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);

            //insert gambar-sampul kalau perlu
            if (!empty($_FILES['foto'])) {
                $gambar = $this->komcad->do_upload('foto');
                if (!empty($gambar)) {
                    $data['foto'] = $gambar;
                }
            }

            $id = $this->input->post('id_komcad');

			if ($this->komcad->update($id,$data)) {
				echo json_encode([['status' => 1]]);
			} else {
                print_json_error("failure");
            }
		}
	}

	public function delete($id=null)
    {
		if (!policy('KOMCAD','delete')) print_json_error("not-authorized");

		if (!isset($id)) print_json_error("invalid-id");

		if ($this->komcad->delete($id)) {
			echo json_encode([['status' => 1]]);
		} else {
			print_json_error("failure");
		}
    }

    public function dashboard() {
		$this->data['title'] = 'Peta Sebaran Komponen Cadangan';
        $kotamas = $this->satker->getKotama();
        $satkers = $this->satker->getSatkerBukanKotama();
        $this->data['kotamas'] = $kotamas;
        $this->data['satkers'] = $satkers;
        $komcad = $this->komcad->get();
        $this->data['komcad'] = $komcad;

		$data['isi'] = $this->load->view('komcad/dashboard', $this->data, true);
		$this->load->view('skin/layout', $data);
    }

    public function pelaporan() {
        $this->data['title'] = 'Pelaporan Komcad';

		$this->data['satkers'] = $this->satker->get();
		$this->data['satkerRank'] = $this->komcad->getRankSatker();
		$this->data['personelRank'] = $this->komcad->getRankPersonel();
		$this->data['getRankCriminals'] = $this->komcad->getRankCriminals();
		
		$config['base_url'] = site_url().'komcad/pelaporan';

		if (policy('KOMCAD','read')) {
			$config['total_rows'] = $this->komcad->getReportCount($this->session->userdata('id_satker'), null, null);
		}else if (policy('KOMCAD','read_all')){
			$config['total_rows'] = $this->komcad->getReportCount();
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
		
		$data['isi'] = $this->load->view('komcad/pelaporan', $this->data, true);
		$this->load->view('skin/layout', $data);
    }

    public function getKomcadActivity($offset)
	{
        $offset = intval($offset);
		if ($offset == 0) {
			$offset = 1;
		}
		
		if (policy('KOMCAD','read')) {
			$activities = $this->komcad->getReport($this->session->userdata('id_satker'),10,$offset);
		}else if (policy('KOMCAD','read_all')){
			// $activities = $this->report->getDataPagination(null,10,$offset);
			$activities = $this->komcad->getReport(null,10,$offset);
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

	public function getKomcadActivityBySatker($idsatker)
	{
		$result = $this->komcad->getReportBySatker($idsatker);
		
		echo json_encode($result);
	}

	public function getKomcadActivityByPersonel($iduser)
	{
		$result = $this->komcad->getReportByPersonel($iduser);
		
		echo json_encode($result);
	}   

}
