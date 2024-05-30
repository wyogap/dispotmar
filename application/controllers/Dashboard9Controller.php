<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard9Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('RekapMangrove', 'rekapMangrove');
	}

	public function index()
	{
		$this->data['title'] = 'MANGROVE';

		$this->data['kotamas'] = $this->satker->getByLevelAndParent(1);	
		$this->data['lantamals'] = $this->satker->getByLevelAndParent(2, $this->input->get());	
		$this->data['lanals'] = $this->satker->getByLevelAndParent(3, $this->input->get());	

		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');
		$this->data['dataSummary'] = $this->rekapMangrove->getDataSummary($kotama, $lantamal, $lanal);
				
		$data['isi'] = $this->load->view('dashboard/dashboard9', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function chart($level)
	{
		$satker_subquery = satker_tree_table();
		
		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');

		$param = [
			'level' => $level,
			'kotama' => $kotama,
			'lantamal' => $lantamal,
			'lanal' => $lanal
		];
		// var_dump($param);

		$areas = [];

		if ( $level == 1 ) {
			// tidak ada
		} else if ( $level == 2 ){
			if ( $lanal ) {
				$this->db->select('sum(rekap_mangrove.jumlah) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('rekap_mangrove');		
				$this->db->join("($satker_subquery) AS satker_tree",'(rekap_mangrove.id_satker = satker_tree.id_lantamal) or (rekap_mangrove.id_satker = satker_tree.id_lanal)');
				$this->db->where('rekap_mangrove.is_active',1);

				$this->db->where('satker_tree.id_lanal',$lanal);

				$this->db->group_by('satker_tree.id_lantamal');
				$areas = $this->db->get()->result();
			} else {
				$this->db->select('sum(rekap_mangrove.jumlah) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('rekap_mangrove');		
				$this->db->join("($satker_subquery) AS satker_tree",'(rekap_mangrove.id_satker = satker_tree.id_lantamal and satker_tree.level=2) or (rekap_mangrove.id_satker = satker_tree.id_lanal and satker_tree.level=3)');
				$this->db->where('rekap_mangrove.is_active',1);
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
			$this->db->select('sum(rekap_mangrove.jumlah) AS total, satker.nama_satker, satker.id_satker');
			$this->db->from('rekap_mangrove');
			$this->db->join('org_satker AS satker','rekap_mangrove.id_satker = satker.id_satker');			
			$this->db->where('rekap_mangrove.is_active',1);

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
				'rekap_mangrove.id_satker = lanal.id_satker'
				);
			} else {
				$this->db->where('satker.id_level',$level);
			}

			$this->db->group_by('rekap_mangrove.id_satker');
			$areas = $this->db->get()->result();

		} else {
			// tidak ada
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

		$this->data['id_satker'] = $id_satker;

		$query = $this->db->query("SELECT nama_satker from org_satker where id_satker=" . $id_satker);
		$this->data['nama_satker'] = $query->result()[0]->nama_satker;

		$this->data['title'] = 'Mangrove';
		$this->data['columns'] = [
			'nama_satker' => 'Satker', 
			'nama_geografi' => 'Wilayah', 
			'jumlah' => 'Jumlah', 
			'tgl_tanam' => 'Tanggal Tanam', 
			'tgl_lapor' => 'Tanggal Lapor',
			'latitude' => 'Latitude', 
			'longitude' => 'Longitude', 
			'keterangan' => 'Ket'
		];
		
		$tableDatas = $this->rekapMangrove->byLantamalAndLanal($lantamal, $lanal);
		$this->data['tableDatas'] = $tableDatas;

		$markers = [];
		foreach ($tableDatas as $tableData) {
			if ($tableData->latitude && $tableData->longitude){
				$markers[] = $tableData;
			}
		}

		$this->data['markers_json'] = json_encode($markers);

		if ($is_partial) {
			$partialData['map-part'] = $this->load->view('dashboard/dashboard9DetailMap', $this->data, true);
			$partialData['table-title-part'] = $this->load->view('dashboard/dashboard9DetailTableTitle', $this->data, true);
			$partialData['table-part'] = $this->load->view('dashboard/dashboard9DetailTable', $this->data, true);
			echo json_encode($partialData);
		} else {
			$this->load->view('dashboard/dashboard9Detail', $this->data);
		}
	}
    
}
