<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard8Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('geografi/GeoPantai', 'geoPantai');
		$this->load->model('JenisPantai', 'jenisPantai');
	}

	public function index()
	{
		$this->data['title'] = 'PANTAI';

		$this->data['kotamas'] = $this->satker->getByLevelAndParent(1);	
		$this->data['lantamals'] = $this->satker->getByLevelAndParent(2, $this->input->get());	
		$this->data['lanals'] = $this->satker->getByLevelAndParent(3, $this->input->get());	
		$this->data['jenisPantaiList'] = $this->jenisPantai->get();

		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');
		$jenisPantai = $this->input->get('jenisPantai');
		$this->data['dataSummary'] = $this->geoPantai->getDataSummary($kotama, $lantamal, $lanal, $jenisPantai);
		
		$dataSummaryGroupByJenisPantai = $this->geoPantai->getDataSummaryGroupByJenisPantai($kotama, $lantamal, $lanal, $jenisPantai);

		$dataSummaryByJenis = [];
		foreach ($dataSummaryGroupByJenisPantai as $item) {
			$dataSummaryByJenis['id'.$item->id_jenis_pantai] = $item->jumlah_pantai;
		}

		$this->data['dataSummaryByJenis'] = [
			"DATAR" => array_key_exists ('id8', $dataSummaryByJenis) ? $dataSummaryByJenis['id8'] : 0,
			"CURAM" => array_key_exists ('id7', $dataSummaryByJenis) ? $dataSummaryByJenis['id7'] : 0,
			"LANDAI" => array_key_exists ('id11', $dataSummaryByJenis) ? $dataSummaryByJenis['id11'] : 0,
			"WISATA" => array_key_exists ('id14', $dataSummaryByJenis) ? $dataSummaryByJenis['id14'] : 0,
			"PASIR_PUTIH" => array_key_exists ('id4', $dataSummaryByJenis) ? $dataSummaryByJenis['id4'] : 0
		];

		$data['isi'] = $this->load->view('dashboard/dashboard8', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function chart($level)
	{
		$satker_subquery = satker_tree_table();

		$kotama = $this->input->get('kotama');
		$lantamal = $this->input->get('lantamal');
		$lanal = $this->input->get('lanal');
		$jenisPantai = $this->input->get('jenisPantai');

		$param = [
			'level' => $level,
			'kotama' => $kotama,
			'lantamal' => $lantamal,
			'lanal' => $lanal,
			'jenisPantai' => $jenisPantai
		];
		// var_dump($param);

		$areas = [];

		if ( $level == 1 ) {
			// tidak ada
		} else if ( $level == 2 ){
			if ( $lanal ) {
				$this->db->select('COUNT(geo_pantai.id_pantai) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('geo_pantai');		
				$this->db->join("($satker_subquery) AS satker_tree",'(geo_pantai.id_satker = satker_tree.id_lantamal) or (geo_pantai.id_satker = satker_tree.id_lanal)');
				$this->db->where('geo_pantai.is_active',1);

				$this->db->where('satker_tree.id_lanal',$lanal);
				if ($jenisPantai){
					$this->db->where('geo_pantai.id_jenis_pantai',$jenisPantai);
				}

				$this->db->group_by('satker_tree.id_lantamal');
				$areas = $this->db->get()->result();
			} else {

				$this->db->select('COUNT(geo_pantai.id_pantai) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from('geo_pantai');		
				$this->db->join("($satker_subquery) AS satker_tree",'(geo_pantai.id_satker = satker_tree.id_lantamal and satker_tree.level=2) or (geo_pantai.id_satker = satker_tree.id_lanal and satker_tree.level=3)');
				$this->db->where('geo_pantai.is_active',1);
				if ($lantamal ) {
					$this->db->where('satker_tree.id_lantamal',$lantamal);
				} else if ($kotama) {
					$this->db->where('satker_tree.id_kotama',$kotama);
				} else {
				}

				if ($jenisPantai){
					$this->db->where('geo_pantai.id_jenis_pantai',$jenisPantai);
				}

				$this->db->group_by('satker_tree.id_lantamal');
				$areas = $this->db->get()->result();
			}
		} else if( $level == 3 ) {

			$this->db->select('COUNT(geo_pantai.id_pantai) AS total, satker.nama_satker, satker.id_satker');
			$this->db->from('geo_pantai');
			$this->db->join('org_satker AS satker','geo_pantai.id_satker = satker.id_satker');			
			$this->db->where('geo_pantai.is_active',1);

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
				'geo_pantai.id_satker = lanal.id_satker'
				);
			} else {
				$this->db->where('satker.id_level',$level);
			}

			if ($jenisPantai){
				$this->db->where('geo_pantai.id_jenis_pantai',$jenisPantai);
			}


			$this->db->group_by('geo_pantai.id_satker');
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
		$id_jenis_pantai = $this->input->get('id_jenis_pantai');
		$is_partial = $this->input->get()['is_partial'];
		$id_satker = $lanal ? $lanal : $lantamal;

		$query = $this->db->query("SELECT nama_satker from org_satker where id_satker=" . $id_satker);
		$this->data['nama_satker'] = $query->result()[0]->nama_satker;

		$this->data['title'] = 'Pantai';
		$this->data['columns'] = [
			"nama_satker" => "Satker", 
			"wilayah" => "Wilayah", 
			"nama_pantai" => "Nama Pantai", 
			"jenis_pantai" => "Jenis Pantai", 
			"panjang_pantai" => "Panjang Pantai (Km)", 
			"material_dasar_pantai" => "Material Dasar Pantai", 
			"ciri_khusus" => "Ciri Khusus", 
			"keterangan" => "Ket"
		];
		
		$tableDatas = $this->geoPantai->byLantamalAndLanal($lantamal, $lanal);
		$this->data['tableDatas'] = $tableDatas;
		
		if ($is_partial) {
			$partialData['table-title-part'] = $this->load->view('dashboard/dashboard8DetailTitle', $this->data, true);
			$partialData['table-part'] = $this->load->view('dashboard/dashboard8DetailTable', $this->data, true);
			echo json_encode($partialData);
		} else {
			$this->load->view('dashboard/dashboard8Detail', $this->data);
		}
	}
    
}
