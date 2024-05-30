<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard4Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('SatuanKerjaPersonel', 'personel');
		$this->load->model('RekapLahanTidur', 'lahanTidur');
	}

	public function index()
	{
		$this->data['title'] = 'Personel dan Lahan Tidur';
		$input_get = $this->input->get();

		if ($input_get){
			$kotama = $input_get['kotama']; 
			$satker = $input_get['satker'];	
		} else {
			$kotama = null; 
			$satker = null;	
		}

		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		$this->data['summaryLahanTidur'] = $this->lahanTidur->summaryByParentSatker($kotama, $satker);
		$this->data['summaryPersonel'] = $this->personel->summaryByParentSatker($kotama, $satker);

		$lahanTidur = $this->lahanTidur->byParentSatker($kotama, $satker);
		$this->data['lahanTidurMarkersJson'] = json_encode($lahanTidur);

		$personelMarkers = $this->personel->summaryByParentSatkerGroupBySatker($kotama, $satker);
		$this->data['personelMarkersJson'] = json_encode($personelMarkers);

		$data['isi'] = $this->load->view('dashboard/dashboard4', $this->data, true);
		$this->load->view('skin/layout', $data);
	}
	
	public function getPersonelByKotama()
	{
		$sql = "
			select 
				satker.top_id_satker, satker.top_nama_satker, sum(personel.jumlah_personel) as sum_jumlah_personel
			from 
				org_personel AS personel
				inner join 
				(
					WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker, top_nama_satker) AS
					(
					SELECT 
						id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker, nama_satker as top_nama_satker
					FROM 
						org_satker
					WHERE 
						id_parent_satker is null or id_parent_satker = 0
					UNION ALL
					SELECT 
						c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker, cp.top_nama_satker
					FROM 
						org_satker_path AS cp 
						JOIN org_satker AS c ON cp.id_satker = c.id_parent_satker
					)
					SELECT id_satker, nama_satker, id_level, path, top_id_satker, top_nama_satker FROM org_satker_path	
				) as satker on satker.id_satker = personel.id_satker
			group by satker.top_id_satker
			order by sum(personel.jumlah_personel) desc		
		";
		$query = $this->db->query($sql);
		
		$summaryPersonels =  $query->result();
		$total = []; $label = [];
		foreach ($summaryPersonels as $summaryPersonel) {
			$total[] = $summaryPersonel->sum_jumlah_personel;
			$label[] = $summaryPersonel->top_nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPersonelByStrata()
	{
		$sql = "
		select 
			sum(personel.perwira) as sum_perwira, sum(personel.bintara) as sum_bintara, sum(personel.tamtama) as sum_tamtama
		from 
			org_personel AS personel
		";

		$input_get = $this->input->get();

		if ($input_get){
			$kotama = $input_get['kotama']; 
			$satker = $input_get['satker'];	
		} else {
			$kotama = null; 
			$satker = null;	
		}

		$parent_satker = '';
		if($satker) {
			$parent_satker = $satker;
		} else if ($kotama) {
			$parent_satker = $kotama;
		}
		if ( $parent_satker ) {
			$satker_id_by_parent = satker_id_by_parent($parent_satker);

			$sql = $sql . "
				inner join ( $satker_id_by_parent ) as satker_tree on satker_tree.id_satker = personel.id_satker
			";
		}

		$query = $this->db->query($sql);
		
		$summaryPersonel =  $query->row();

		$total = [$summaryPersonel->sum_perwira, $summaryPersonel->sum_bintara,$summaryPersonel->sum_tamtama];
		$label = ["Perwira","Bintara","Tamtama"];

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPersonelBySatker()
	{
		$this->db->select('
			satker.nama_satker,
			sum(personel.jumlah_personel) as sum_jumlah_personel 			
			');
		$this->db->from('org_personel AS personel');
		$this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');

		$input_get = $this->input->get();

		if ($input_get){
			$kotama = $input_get['kotama']; 
			$satker = $input_get['satker'];	
		} else {
			$kotama = null; 
			$satker = null;	
		}
		$parent_satker = '';
		if($satker) {
			$parent_satker = $satker;
		} else if ($kotama) {
			$parent_satker = $kotama;
		}
		if ( $parent_satker ) {
			$satker_id_by_parent = satker_id_by_parent($parent_satker);

			$this->db->join("
			(
				$satker_id_by_parent
			) AS satker_tree",
			'satker_tree.id_satker = personel.id_satker',
			'inner'
			);
		}


		$this->db->group_by('personel.id_satker');
		$personels = $this->db->get()->result();

		usort(
			$personels, 
			function($a, $b) {
				return $b->sum_jumlah_personel - $a->sum_jumlah_personel;
			}
		);	

		$total = []; $label = [];
		foreach ($personels as $personel) {
			$total[] = $personel->sum_jumlah_personel;
			$label[] = $personel->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

}
