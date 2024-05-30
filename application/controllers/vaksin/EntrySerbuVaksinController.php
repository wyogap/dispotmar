<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntrySerbuVaksinController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('Geografi','geo');
		$this->load->model('vaksin/entry_serbuvaksin', 'entryvaksin');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('User', 'user');
	}

	public function index()
	{
		$this->data['title'] = 'Tracer Vaksin - Entry Serbu Vaksin';
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['users'] = $this->user->get();
		$this->data['dataEntrySerbuVaksin'] = $this->entryvaksin->getdataForDatatable();
		$data['isi'] = $this->load->view('vaksin/entry_serbuvaksin/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('VAKSIN','update')) show_404();

		$this->data['vaksin'] = $this->entryvaksin->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store(){
		if (!policy('VAKSIN','create')) show_404();

		$this->form_validation->set_rules('namalokasi', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('alamatlokasi', 'Alamat Lokasi', 'trim|required');
		$this->form_validation->set_rules('satkerpelaksana', 'Satker', 'trim');
		//$this->form_validation->set_rules('satkerpelaksana', 'Satker', 'trim|required');
		$this->form_validation->set_rules('kotama', 'Kotama', 'trim|required');
		$this->form_validation->set_rules('jenisvaksin', 'Jenis Vaksin', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Capaian', 'trim|required');
		$this->form_validation->set_rules('dosiske', 'Dosis', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('reportedby', 'Reported By', 'trim|required');
		$this->form_validation->set_rules('vaksinator', 'Vaksinator', 'trim|required');
		$this->form_validation->set_rules('jumlahvaksinator', 'Jumlah Vaksinator', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'namalokasi' 			=> form_error('namalokasi'),
				'alamatlokasi' 			=> form_error('alamatlokasi'),
				'satkerpelaksana'	=> form_error('satkerpelaksana'),
				'kotama' 		=> form_error('kotama'),
				'jenisvaksin' 		=> form_error('jenisvaksin'),
				'jumlah' 	=> form_error('jumlah'),
				'dosiske' 		=> form_error('dosiske'),
				'tanggal' 		=> form_error('tanggal'),
				'reportedby' 		=> form_error('reportedby'),
				'vaksinator' 	=> form_error('vaksinator'),
				'jumlahvaksinator' => form_error('jumlahvaksinator')
			];
			echo json_encode([$status,$response]);
		}else{
			if($this->input->post('lampirandok') == "undefined")
			{
				$data = array(
					'namalokasi'		=> $this->input->post('namalokasi'),
					'alamatlokasi'		=> $this->input->post('alamatlokasi'),
					'satkerpelaksana'			=> $this->input->post('satkerpelaksana'),
					'kotama'	=> $this->input->post('kotama'),
					'jenisvaksin'			=> $this->input->post('jenisvaksin'),
					'jumlah'			=> $this->input->post('jumlah'),
					'dosiske'			=> $this->input->post('dosiske'),
					'tanggal'			=> $this->input->post('tanggal'),
					'reportedby'		=> $this->input->post('reportedby'),
					'vaksinator' 	=> $this->input->post('vaksinator'),
					'jumlahvaksinator' 			=> $this->input->post('jumlahvaksinator'),
					//'lampirandok'			=> $this->entryvaksin->do_upload(),
					'is_active'			=> TRUE,
					'created_by'		=> $this->session->userdata('id_user'),
					'created_date'		=> date("Y-m-d H:i:s")
				);
			}
			else
			{
				$data = array(
					'namalokasi'		=> $this->input->post('namalokasi'),
					'alamatlokasi'		=> $this->input->post('alamatlokasi'),
					'satkerpelaksana'			=> $this->input->post('satkerpelaksana'),
					'kotama'	=> $this->input->post('kotama'),
					'jenisvaksin'			=> $this->input->post('jenisvaksin'),
					'jumlah'			=> $this->input->post('jumlah'),
					'dosiske'			=> $this->input->post('dosiske'),
					'tanggal'			=> $this->input->post('tanggal'),
					'reportedby'		=> $this->input->post('reportedby'),
					'vaksinator' 	=> $this->input->post('vaksinator'),
					'jumlahvaksinator' 			=> $this->input->post('jumlahvaksinator'),
					'lampirandok'			=> $this->entryvaksin->do_upload(),
					'is_active'			=> TRUE,
					'created_by'		=> $this->session->userdata('id_user'),
					'created_date'		=> date("Y-m-d H:i:s")
				);
			}
			

			if ($this->entryvaksin->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('VAKSIN','update')) show_404();

		$this->form_validation->set_rules('namalokasiEdit', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('alamatlokasiEdit', 'Alamat Lokasi', 'trim|required');
		$this->form_validation->set_rules('satkerpelaksanaEdit', 'Satker', 'trim');
		//$this->form_validation->set_rules('satkerpelaksanaEdit', 'Satker', 'trim|required');
		$this->form_validation->set_rules('kotamaEdit', 'Kotama', 'trim|required');
		$this->form_validation->set_rules('jenisvaksinEdit', 'Jenis Vaksin', 'trim|required');
		$this->form_validation->set_rules('jumlahEdit', 'Jumlah Capaian', 'trim|required');
		$this->form_validation->set_rules('dosiskeEdit', 'Dosis', 'trim|required');
		$this->form_validation->set_rules('tanggalEdit', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('reportedbyEdit', 'Reported By', 'trim|required');
		$this->form_validation->set_rules('vaksinatorEdit', 'Vaksinator', 'trim|required');
		$this->form_validation->set_rules('jumlahvaksinatorEdit', 'Jumlah Vaksinator', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'namalokasiEdit' 			=> form_error('namalokasiEdit'),
				'alamatlokasiEdit' 			=> form_error('alamatlokasiEdit'),
				'satkerpelaksanaEdit'	=> form_error('satkerpelaksanaEdit'),
				'kotamaEdit' 		=> form_error('kotamaEdit'),
				'jenisvaksinEdit' 		=> form_error('jenisvaksinEdit'),
				'jumlahEdit' 	=> form_error('jumlahEdit'),
				'dosiskeEdit' 		=> form_error('dosiskeEdit'),
				'tanggalEdit' 		=> form_error('tanggalEdit'),
				'reportedbyEdit' 		=> form_error('reportedbyEdit'),
				'vaksinatorEdit' 	=> form_error('vaksinatorEdit'),
				'jumlahvaksinatorEdit' => form_error('jumlahvaksinatorEdit')
			];
			echo json_encode([$status,$response]);
		}else{
			if($this->input->post('lampirandok') == "undefined")
			{
				$data = array(
					'namalokasi'		=> $this->input->post('namalokasiEdit'),
					'alamatlokasi'		=> $this->input->post('alamatlokasiEdit'),
					'satkerpelaksana'			=> $this->input->post('satkerpelaksanaEdit'),
					'kotama'	=> $this->input->post('kotamaEdit'),
					'jenisvaksin'			=> $this->input->post('jenisvaksinEdit'),
					'jumlah'			=> $this->input->post('jumlahEdit'),
					'dosiske'			=> $this->input->post('dosiskeEdit'),
					'tanggal'			=> $this->input->post('tanggalEdit'),
					'reportedby'		=> $this->input->post('reportedbyEdit'),
					'vaksinator' 	=> $this->input->post('vaksinatorEdit'),
					'jumlahvaksinator' 			=> $this->input->post('jumlahvaksinatorEdit'),
					//'lampirandok'			=> $this->entryvaksin->do_upload(),
					'updated_by'		=> $this->session->userdata('id_user'),
					'updated_date'		=> date('Y-m-d H:i:s')
				);
			}
			else if($this->input->post('lampirandok') != "undefined")
			{
				$data = array(
					'namalokasi'		=> $this->input->post('namalokasiEdit'),
					'alamatlokasi'		=> $this->input->post('alamatlokasiEdit'),
					'satkerpelaksana'			=> $this->input->post('satkerpelaksanaEdit'),
					'kotama'	=> $this->input->post('kotamaEdit'),
					'jenisvaksin'			=> $this->input->post('jenisvaksinEdit'),
					'jumlah'			=> $this->input->post('jumlahEdit'),
					'dosiske'			=> $this->input->post('dosiskeEdit'),
					'tanggal'			=> $this->input->post('tanggalEdit'),
					'reportedby'		=> $this->input->post('reportedbyEdit'),
					'vaksinator' 	=> $this->input->post('vaksinatorEdit'),
					'jumlahvaksinator' 			=> $this->input->post('jumlahvaksinatorEdit'),
					'lampirandok'			=> $this->entryvaksin->do_upload(),
					'updated_by'		=> $this->session->userdata('id_user'),
					'updated_date'		=> date('Y-m-d H:i:s')
				);
			}
		
			$id = decrypt($this->input->post('idvaksin'));

			if ($this->entryvaksin->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}
	
	public function delete($id=null)
    {
		if (!policy('VAKSIN','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->entryvaksin->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
    }
}
