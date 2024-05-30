<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SatuanKerjaPersonelController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerjaPersonel','personel');
	}

	public function index()
	{
		if (!policy('ORG','read_all')) show_404();

		$this->data['title'] = 'Data Personel';

		$this->data['personels'] = $this->personel->getData_formSatker();

		$data['isi'] = $this->load->view('organisasi/personel/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('ORG','update')) show_404();

		$this->data['personel'] = $this->personel->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function update(){
		if (!policy('ORG','update')) show_404();

		$this->form_validation->set_rules('id', 'ID Personel', 'trim|required');
		$this->form_validation->set_rules('perwira', 'Perwira', 'trim|required|numeric');
		$this->form_validation->set_rules('bintara', 'Bintara', 'trim|required|numeric');
		$this->form_validation->set_rules('tamtama', 'Tamtama', 'trim|required|numeric');
		$this->form_validation->set_rules('jumlah', 'Jumlah Personel', 'trim|required|numeric');
		$this->form_validation->set_rules('struktur', 'Struktur', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'perwira' => form_error('perwira'),
				'bintara' => form_error('bintara'),
				'tamtama' => form_error('tamtama'),
				'struktur' => form_error('struktur'),
				'jumlah' => form_error('jumlah'),
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'perwira'	=> $this->input->post('perwira'),
				'bintara'	=> $this->input->post('bintara'),
				'tamtama'	=> $this->input->post('tamtama'),
				'struktur'	=> $this->input->post('struktur'),
				'jumlah_personel'	=> $this->input->post('jumlah'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);
			$id = decrypt($this->input->post('id'));

			if ($this->personel->update($id, $data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}
}
