<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanganRekapController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('RekapPangan', 'pangan');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('KomoditasPangan', 'comodity');
	}

	public function index()
	{
		$this->data['title'] = 'Rekap Pangan';

		$this->data['satkers'] = $this->satker->get();

		if (policy('KETPANG','read')) {

			$this->data['rekap'] = $this->pangan->listnew(
				[
				'satker' => $this->session->userdata('id_satker')
				]);
			
		}
		else if (policy('KETPANG','read_all'))
		{
			if ($this->input->get()) {
				$this->data['rekap'] = $this->pangan->listnew($this->input->get());
			}else{
				$this->data['rekap'] = $this->pangan->listnew();
			}
			
		}

		$data['isi'] = $this->load->view('pangan/rekap/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function create()
	{
		if (!policy('KETPANG','create')) show_404();

		$this->data['title'] = 'Form Rekap Pangan';

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$this->db->where('is_active',1);
        $this->db->order_by('nama_cluster');
		$this->data['clusters'] = $this->db->get('mst_cluster')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_satuan');
		$this->data['units'] = $this->db->get('mst_satuan')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_statuslahan');
		$this->data['areaStatus'] = $this->db->get('mst_pangan_statuslahan')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_progres');
		$this->data['progress'] = $this->db->get('mst_pangan_progres')->result();

		$data['isi'] = $this->load->view('pangan/rekap/create', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('KETPANG','update')) show_404();

		$this->data['title'] = 'Detail Laporan Pangan';
		$this->data['pangan'] = $this->pangan->find(decrypt($id));
		$this->data['histories'] = $this->pangan->getHistory(decrypt($id));

		$data['isi'] = $this->load->view('pangan/rekap/show', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function store(){
		if (!policy('KETPANG','create')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('cluster', 'Cluster', 'trim|required');
		$this->form_validation->set_rules('comodity', 'Comodity', 'trim|required');
		$this->form_validation->set_rules('area', 'Luas Lahan', 'trim|numeric|required');
		$this->form_validation->set_rules('result', 'Estimasi Hasil', 'trim|numeric|required');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('jmlbibit', 'Jumlah Bibit/Bakalan', 'trim|numeric');
		$this->form_validation->set_rules('unit2', 'Unit2', 'trim');
		$this->form_validation->set_rules('tmt', 'TMT Pelaksanaan', 'trim|required');
		$this->form_validation->set_rules('estimate', 'Estimasi Panen', 'trim|required');
		$this->form_validation->set_rules('areaStatus', 'Status Lahan', 'trim|required');
		$this->form_validation->set_rules('progress', 'Progress', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Catatan', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker' => form_error('satker'),
				'cluster' => form_error('cluster'),
				'comodity' => form_error('comodity'),
				'area' => form_error('area'),
				'result' => form_error('result'),
				'unit' => form_error('unit'),
				'jmlbibit' => form_error('jmlbibit'),
				'unit2' => form_error('unit2'),
				'tmt' => form_error('tmt'),
				'estimate' => form_error('estimate'),
				'areaStatus' => form_error('areaStatus'),
				'progress' => form_error('progress'),
				'latitude' => form_error('latitude'),
				'longitude' => form_error('longitude'),
				'provinsi' => form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'			=> $this->input->post('satker'),
				'id_komoditas'		=> $this->input->post('comodity'),
				'luas_lahan'		=> $this->input->post('area'),
				'estimasi_hasil'	=> $this->input->post('result'),
				'id_satuan'			=> $this->input->post('unit'),
				'jmlbibit'			=> $this->input->post('jmlbibit'),
				'id_satuan2'		=> $this->input->post('unit2'),
				'tmt'				=> $this->input->post('tmt'),
				'estimasi_panen'	=> $this->input->post('estimate'),
				'id_pangan_status'	=> $this->input->post('areaStatus'),
				'id_progres'		=> $this->input->post('progress'),
				'latitude'			=> $this->input->post('latitude'),
				'longitude'			=> $this->input->post('longitude'),
				'keterangan'		=> $this->input->post('notes'),
				'flag_location'		=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date('Y-m-d H:i:s'),
				'gambar'			=> $this->pangan->do_upload()
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

			if ($this->pangan->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function edit($id)
	{
		if (!policy('KETPANG','update')) show_404();

		$this->data['title'] = 'Edit Rekap Pangan';

		$this->data['pangan'] = $this->pangan->find(decrypt($id));

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$this->db->where('is_active',1);
        $this->db->order_by('nama_cluster');
		$this->data['clusters'] = $this->db->get('mst_cluster')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_satuan');
		$this->data['units'] = $this->db->get('mst_satuan')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_statuslahan');
		$this->data['areaStatus'] = $this->db->get('mst_pangan_statuslahan')->result();

		$this->db->where('is_active',1);
        $this->db->order_by('nama_progres');
		$this->data['progress'] = $this->db->get('mst_pangan_progres')->result();

		$data['isi'] = $this->load->view('pangan/rekap/edit', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function update(){
		if (!policy('KETPANG','update')) show_404();

		$this->form_validation->set_rules('satker', 'Satuan Kerja', 'trim|required');
		$this->form_validation->set_rules('cluster', 'Cluster', 'trim|required');
		$this->form_validation->set_rules('comodity', 'Comodity', 'trim|required');
		$this->form_validation->set_rules('area', 'Luas Lahan', 'trim|numeric|required');
		$this->form_validation->set_rules('result', 'Estimasi Hasil', 'trim|numeric|required');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		$this->form_validation->set_rules('jmlbibit', 'Jumlah Bibit/Bakalan', 'trim|numeric');
		$this->form_validation->set_rules('unit2', 'Unit2', 'trim');
		$this->form_validation->set_rules('tmt', 'TMT Pelaksanaan', 'trim|required');
		$this->form_validation->set_rules('estimate', 'Estimasi Panen', 'trim|required');
		$this->form_validation->set_rules('areaStatus', 'Status Lahan', 'trim|required');
		$this->form_validation->set_rules('progress', 'Progress', 'trim|required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('notes', 'Catatan', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker' => form_error('satker'),
				'cluster' => form_error('cluster'),
				'comodity' => form_error('comodity'),
				'area' => form_error('area'),
				'result' => form_error('result'),
				'unit' => form_error('unit'),
				'jmlbibit' => form_error('jmlbibit'),
				'unit2' => form_error('unit2'),
				'tmt' => form_error('tmt'),
				'estimate' => form_error('estimate'),
				'areaStatus' => form_error('areaStatus'),
				'progress' => form_error('progress'),
				'latitude' => form_error('latitude'),
				'longitude' => form_error('longitude'),
				'provinsi' => form_error('provinsi'),
				'notes' 		=> form_error('notes'),
				'flag_locationedit' 		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{

			if($this->input->post('gambar') == "undefined")
			{
				$data = array(
					'id_satker'			=> $this->input->post('satker'),
					'id_komoditas'		=> $this->input->post('comodity'),
					'luas_lahan'		=> $this->input->post('area'),
					'estimasi_hasil'	=> $this->input->post('result'),
					'id_satuan'			=> $this->input->post('unit'),
					'jmlbibit'			=> $this->input->post('jmlbibit'),
					'id_satuan2'		=> $this->input->post('unit2'),
					'tmt'				=> $this->input->post('tmt'),
					'estimasi_panen'	=> $this->input->post('estimate'),
					'id_pangan_status'	=> $this->input->post('areaStatus'),
					'id_progres'		=> $this->input->post('progress'),
					'latitude'			=> $this->input->post('latitude'),
					'longitude'			=> $this->input->post('longitude'),
					'keterangan'		=> $this->input->post('notes'),
					'flag_location'		=> $this->input->post('flag_locationedit'),
					'updated_by'		=> $this->session->userdata('id_user'),
					'updated_date'		=> date('Y-m-d H:i:s'),
					//'gambar'			=> $this->pangan->do_upload()
				);
			}
			else if($this->input->post('gambar') != "undefined")
			{
				$data = array(
					'id_satker'			=> $this->input->post('satker'),
					'id_komoditas'		=> $this->input->post('comodity'),
					'luas_lahan'		=> $this->input->post('area'),
					'estimasi_hasil'	=> $this->input->post('result'),
					'id_satuan'			=> $this->input->post('unit'),
					'jmlbibit'			=> $this->input->post('jmlbibit'),
					'id_satuan2'		=> $this->input->post('unit2'),
					'tmt'				=> $this->input->post('tmt'),
					'estimasi_panen'	=> $this->input->post('estimate'),
					'id_pangan_status'	=> $this->input->post('areaStatus'),
					'id_progres'		=> $this->input->post('progress'),
					'latitude'			=> $this->input->post('latitude'),
					'longitude'			=> $this->input->post('longitude'),
					'keterangan'		=> $this->input->post('notes'),
					'flag_location'		=> $this->input->post('flag_locationedit'),
					'updated_by'		=> $this->session->userdata('id_user'),
					'updated_date'		=> date('Y-m-d H:i:s'),
					'gambar'			=> $this->pangan->do_upload()
				);
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

			$id = decrypt($this->input->post('id'));

			if ($this->pangan->update($id,$data)) {
				$this->pangan->createHistory($id);
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}
	
	public function delete($id=null)
    {
		if (!policy('KETPANG','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pangan->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
        
    }
}
