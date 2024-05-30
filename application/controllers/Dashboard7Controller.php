<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard7Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('RekapDesaBinaan', 'RekapDesaBinaan');
	}

	public function index()
	{
		$this->data['title'] = 'DESA BINAAN';

		$this->data['kotama'] = $this->satker->getByLevelAndParent(1);	
		$this->data['lantamal'] = $this->satker->getByLevelAndParent(2, $this->input->get());	
		$this->data['satker'] = $this->satker->getByLevelAndParent(3, $this->input->get());	

		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');
		$this->data['dataSummary'] = $this->RekapDesaBinaan->getDataSummary($kotama, $lantamal, $lanal);
				
		$data['isi'] = $this->load->view('dashboard/dashboard7', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function chart($level)
	{	
		$satker_subquery = satker_tree_table();


		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');

		$areas = [];

		if ( $level == 1 ) {
			// tidak ada
		} else if ( $level == 2 ){
			if ( $lanal ) {
				$this->db->select('count(rekap_desabinaan.nama_desa) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('rekap_desabinaan');		
				$this->db->join("($satker_subquery) AS satker_tree",'(rekap_desabinaan.id_satker = satker_tree.id_lantamal) or (rekap_desabinaan.id_satker = satker_tree.id_lanal)');
				$this->db->where('rekap_desabinaan.is_active',1);

				$this->db->where('satker_tree.id_lanal',$lanal);

				$this->db->group_by('satker_tree.id_lantamal');
				$areas = $this->db->get()->result();
			} else {
				$this->db->select('count(rekap_desabinaan.nama_desa) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('rekap_desabinaan');		
				$this->db->join("($satker_subquery) AS satker_tree",'(rekap_desabinaan.id_satker = satker_tree.id_lantamal and satker_tree.level=2) or (rekap_desabinaan.id_satker = satker_tree.id_lanal and satker_tree.level=3)');
				$this->db->where('rekap_desabinaan.is_active',1);
				if ($lantamal ) {
					$this->db->where('satker_tree.id_lantamal',$lantamal);
				} else if ($kotama) {
					$this->db->where('satker_tree.id_kotama',$kotama);
				} else {
				}
				$this->db->group_by('satker_tree.id_lantamal');
				$areas = $this->db->get()->result();
			}
		} else if( $level == 3 ) {
			$this->db->select('count(rekap_desabinaan.nama_desa) AS total, satker.nama_satker, satker.id_satker');
			$this->db->from('rekap_desabinaan');
			$this->db->join('org_satker AS satker','rekap_desabinaan.id_satker = satker.id_satker');			
			$this->db->where('rekap_desabinaan.is_active',1);

			if ( $lanal ) {
				$this->db->where('satker.id_satker', $lanal);
			} else if ($lantamal ) {
				$this->db->where('satker.id_parent_satker', $lantamal);
			} else if ($kotama) {
				$this->db->join("
					(select 
						lanal.* 
					from 
						org_satker as lanal
						inner join org_satker as lantamal on lanal.id_parent_satker = lantamal.id_satker
					where lantamal.id_parent_satker=$kotama) as lanal
				",
				'rekap_desabinaan.id_satker = lanal.id_satker'
				);
			} else {
				$this->db->where('satker.id_level',$level);
			}

			$this->db->group_by('rekap_desabinaan.id_satker');
			$areas = $this->db->get()->result();

		}

		$areas = orderChartData($level, $areas);

		$total = []; $label = []; $id_satkers = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_satker;
			$id_satkers[] = $area->id_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label,
			'id_satkers' => $id_satkers
		];

		echo json_encode($result);
	}

	public function detail() {
		$lantamal = $this->input->get()['lantamal'];
		$lanal = $this->input->get()['lanal'];
		$is_partial = $this->input->get()['is_partial'];
		$id_satker = $lanal ? $lanal : $lantamal;

		$query = $this->db->query("SELECT nama_satker from org_satker where id_satker=" . $id_satker);
		$this->data['nama_satker'] = $query->result()[0]->nama_satker;

		$this->data['title'] = 'Desa Binaan';
		$this->data['columns'] = [
			'nama_satker' => 'Satker', 
			'provinsi' => 'Provinsi', 
			'kabupaten' => 'Kabupaten', 
			'kecamatan' => 'Kecamatan', 
			'kelurahan' => 'Kelurahan', 
			'nama_desa' => 'Nama Desa', 
			'jumlah_penduduk' => 'Jumlah Penduduk (Orang)', 
			'tingkat_pendidikan' => 'Tingkat Pendidikan', 
			'nama_pembina' => 'Nama Pembina', 
			'nama_tertua_desa' => 'Nama Tertua Desa',
			'latitude' => 'Latitude', 
			'longitude' => 'Longitude', 
			'keterangan' => 'Ket'
		];
		
		$tableDatas = $this->RekapDesaBinaan->byLantamalAndLanal($lantamal, $lanal);
		$this->data['tableDatas'] = $tableDatas;

		$markers = [];
		foreach ($tableDatas as $tableData) {
			if ($tableData->latitude && $tableData->longitude){
				$markers[] = $tableData;
			}
		}

		$this->data['markers_json'] = json_encode($markers);

		if ($is_partial) {
			$partialData['map-part'] = $this->load->view('dashboard/dashboard7DetailMap', $this->data, true);
			$partialData['table-title-part'] = $this->load->view('dashboard/dashboard7DetailTableTitle', $this->data, true);
			$partialData['table-part'] = $this->load->view('dashboard/dashboard7DetailTable', $this->data, true);
			echo json_encode($partialData);
		} else {
			$this->load->view('dashboard/dashboard7Detail', $this->data);
		}
		
	}
    
}
