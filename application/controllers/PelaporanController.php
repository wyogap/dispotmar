<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelaporanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja','satker');
		$this->load->model('Pelaporan','report');
		$this->load->model('Geografi','geo');
	}

	public function index()
	{
		$this->data['title'] = 'Data Pelaporan';
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);
		$this->data['categories'] = $this->report->categories();
		$this->data['getsummarydatatahun'] = $this->report->getsummarydatatahun();

		if (policy('LAPHAR','read')) {

			$this->data['reports'] = $this->report->get(
				[
				'satker' => $this->session->userdata('id_satker'),
				'startDate' => $this->input->get('startDate'),
				'finishDate' => $this->input->get('finishDate')
				]);
		}
		else if (policy('LAPHAR','read_all'))
		{
			if ($this->input->get()) {
				$this->data['reports'] = $this->report->get($this->input->get());
			}else{
				$this->data['reports'] = $this->report->get();
			}
			
		}

		$data['isi'] = $this->load->view('pelaporan/index', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('LAPHAR','update')) show_404();

		$this->data['report'] = $this->report->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function detail($id)
	{
		if (!policy('LAPHAR','update')) show_404();

		$this->data['title'] = 'Detail Laporan';

		$this->data['report'] = $this->report->find(decrypt($id));

		$data['isi'] = $this->load->view('pelaporan/detail', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function read($id_activity,$id_notification)
	{
		if (!policy('LAPHAR','update')) show_404();
		$this->load->helper('url');

		$this->db->update('notifications', ['is_read' => TRUE], ["id_notification" => decrypt($id_notification)]);
		redirect('/data_pelaporan/'.$id_activity.'/show', 'refresh'); 
	}

	public function create()
	{
		if (!policy('LAPHAR','create')) show_404();

		$this->data['title'] = 'Form Laporan';
		$this->data['satkers'] = $this->satker->get();
		$this->data['categories'] = $this->report->categories();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		// $this->load->library('googlemaps');
		// $config['onplace'] = 'placeMarker_map({ map: map, position:event.latLng });$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
		// $this->googlemaps->initialize($config);
		// $this->data['map'] = $this->googlemaps->create_map();

		$data['isi'] = $this->load->view('pelaporan/create', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function store(){
		if (!policy('LAPHAR','create')) show_404();

		$this->form_validation->set_rules('type', 'Jenis Aktivitas', 'trim|required');
		$this->form_validation->set_rules('satker', 'Satker', 'trim|required');
		$this->form_validation->set_rules('who', 'Nama', 'trim|required');
		$this->form_validation->set_rules('what', 'Apa', 'trim|required');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('where', 'Dimana', 'trim|required');
		$this->form_validation->set_rules('why', 'Mengapa', 'trim|required');
		$this->form_validation->set_rules('how', 'Bagaimana', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'type'  	=> form_error('type'),
				'who' 		=> form_error('who'),
				'satker'	=> form_error('satker'),
				'what' 		=> form_error('what'),
				'date' 		=> form_error('date'),
				'where' 	=> form_error('where'),
				'why' 		=> form_error('why'),
				'how' 		=> form_error('how'),
				'provinsi' 	=> form_error('provinsi'),
				'flag_location' 	=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'			=> $this->input->post('satker'),
				'id_activity_jenis'	=> $this->input->post('type'),
				'who'				=> $this->input->post('who'),
				'what'				=> $this->input->post('what'),
				'where'				=> $this->input->post('where'),
				'when'				=> $this->input->post('date'),
				'why'				=> $this->input->post('why'),
				'how'				=> $this->input->post('how'),
				'gambar'			=> $this->report->do_upload(),
				'catatan_penting'	=> $this->input->post('notes'),
				'latitude'			=> $this->input->post('latitude'),
				'longitude'			=> $this->input->post('longitude'),
				'flag_location'			=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date('Y-m-d H:i:s')
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

			$this->db->select('mst_user.*');
			$this->db->from('mst_user');
			$this->db->where('mst_user.notifable',1);
			$users = $this->db->get()->result();

			if ($this->report->create($data)) {
				$pelaporan = $this->db->get_where('rekap_activity_sosial', [
					"what" => $this->input->post('what'),
					"where" => $this->input->post('where')
					])->row();

				foreach ($users as $user) {
					$this->db->insert('notifications', [
						'id_activity_sosial' => $pelaporan->id_activity_sosial,
						'id_user' => $user->id_user,
						'id_pelapor' => $this->session->userdata('id_user'),
						'messages' => 'Telah menambahkan laporan baru'
					]);
				}

				notification('Telah menambahkan laporan baru');

				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
			
			// if ($this->report->create($data)) {
			// 	notification('Telah menambahkan laporan baru');

			// 	$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			// 	redirect_back();
			// } else {
			// 	$this->session->set_flashdata('error', 'Data anda tidak berhasil disimpan');
			// 	redirect_back();
			// }
		}
	}

	public function delete($id=null)
    {
		if (!policy('LAPHAR','delete')) show_404();

		if (!isset($id)) show_404();
		
		if ($this->report->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
	}
	
	public function update()
    {
		if (!policy('LAPHAR','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('what', 'what', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('who', 'who', 'trim|required');
		$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
		$this->form_validation->set_rules('where', 'where', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('why', 'Mengapa', 'trim|required');
		$this->form_validation->set_rules('how', 'Bagaimana', 'trim|required');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');
		
		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'what' 		=> form_error('what'),
				'satker' 	=> form_error('satker'),
				'provinsi' 		=> form_error('provinsi'),
				'who' 		=> form_error('who'),
				'latitude' 		=> form_error('latitude'),
				'longitude' 		=> form_error('longitude'),
				'type' 		=> form_error('type'),
				'where' 		=> form_error('where'),
				'why' 		=> form_error('why'),
				'how' 		=> form_error('how'),
				'catatan_penting'	=> $this->input->post('notes'),
				'date' 		=> form_error('date'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
		
		if($this->input->post('gambar') == "undefined")
		{
			$data = [
				'what'	=> $this->input->post('what'),
				'id_satker'		=> $this->input->post('satker'),
				'who'		=> $this->input->post('who'),
				'latitude'		=> $this->input->post('latitude'),
				'longitude'		=> $this->input->post('longitude'),
				'id_activity_jenis'		=> $this->input->post('type'),
				'where'		=> $this->input->post('where'),
				'why'				=> $this->input->post('why'),
				'how'				=> $this->input->post('how'),
				'catatan_penting'	=> $this->input->post('notes'),
				//'gambar'			=> $this->report->do_upload(),
				'when'				=> $this->input->post('date'),
				'flag_location'				=> $this->input->post('flag_locationedit'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
			];
		}else if($this->input->post('gambar') != "undefined")
		{
			$data = [
				'what'	=> $this->input->post('what'),
				'id_satker'		=> $this->input->post('satker'),
				'who'		=> $this->input->post('who'),
				'latitude'		=> $this->input->post('latitude'),
				'longitude'		=> $this->input->post('longitude'),
				'id_activity_jenis'		=> $this->input->post('type'),
				'where'		=> $this->input->post('where'),
				'why'				=> $this->input->post('why'),
				'how'				=> $this->input->post('how'),
				'catatan_penting'	=> $this->input->post('notes'),
				'gambar'			=> $this->report->do_upload(),
				'when'				=> $this->input->post('date'),
				'flag_location'				=> $this->input->post('flag_locationedit'),
				'updated_by'		=> $this->session->userdata('id_user'),
				'updated_date'		=> date('Y-m-d H:i:s')
			];
		}
			

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			$id = decrypt($this->input->post('id_activity_sosial'));

			if ($this->report->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	// public function detail()
	// {
	// 		$this->data['title'] = 'Detail Pelaporan';
	// 		$data['isi'] = $this->load->view('pelaporan/detail', $this->data, true);
	// 		$this->load->view('skin/layout', $data);
	// }
}
