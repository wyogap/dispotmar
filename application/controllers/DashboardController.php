<?php

use function PHPSTORM_META\map;

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('RekapPangan', 'pangan');
		$this->load->model('RekapLahanTidur', 'lahanTidur');
		$this->load->model('ProgresPangan', 'progres');
		$this->load->model('KomoditasPangan', 'komoditas');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('SatuanKerja', 'satker23');
		$this->load->model('SatuanKerjaPersonel', 'personel');
		$this->load->model('Pelaporan', 'report');

		$this->load->model('geografi/GeoPantai', 'pantai');
	}
	
	public function komoditasByParentSatker()
	{
		$komoditas = $this->komoditas->getComodityResultByParentSatker($this->input->get());
		echo json_encode($komoditas);
	}

	public function home()
	{
        // ALTER TABLE staging_dispotmar.org_satker ADD nama_pimpinan varchar(100) NULL;
		$this->data['title'] = 'HOME';
		$satkers = $this->satker->treeWithGeo();
		$this->data['satkers_json'] = json_encode($satkers);

		$data['isi'] = $this->load->view('dashboard/home', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

    public function dashboard1()
	{
		$this->data['title'] = 'Sebaran Produksi Ketahanan Pangan';
		
		$this->data['komoditases'] = $this->komoditas->getNocluster(
			(object) ['column' => 'nama_komoditas', 'direction' => 'ASC']
		);
		
		$this->data['summaryLahan'] = $this->pangan->getSummaryLahanByParentSatker($this->input->get());
		$this->data['panganMapping'] = $this->pangan->mapping($this->input->get());
		$this->data['progress'] = $this->progres->get();
		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		// $satkers2 = $this->satker->byParent($this->input->get());
		// $satkers2 = $this->satker->allTree(true, $this->input->get());
		$satkerTreeWithGeos = $this->satker->treeWithGeo();
		
		$komoditasList = $this->komoditas->getComodityResultByParentSatker($this->input->get());
		$this->data['komoditasList'] = $komoditasList;
		$komoditasBySatkerList = $this->komoditas->getComodityResultByParentSatkerGroupBySatker($this->input->get());
		$komoditasBySatkerList2 = array_map(
			function ($data) {
				return $data -> id_satker; 
			}, 
			$komoditasBySatkerList
		);

		$satkerTreeWithGeoFiltered = [];
		foreach ($satkerTreeWithGeos as $value) {
			if ( in_array($value->id_satker, $komoditasBySatkerList2) ) {
				$satkerTreeWithGeoFiltered[] = $value;
			}
		}
		$this->data['satkers_json'] = json_encode($satkerTreeWithGeoFiltered);
		
		$data['isi'] = $this->load->view('dashboard/dashboard1', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard2()
	{
		$this->data['title'] = 'Monitoring Status Ketahanan Pangan';
		
		$this->data['lahantidur'] = $this->lahanTidur->get($this->input->get());
		//$this->data['pangan'] = $this->pangan->get($this->input->get());
		$this->data['summaryPangan'] = $this->pangan->getSummary($this->input->get());
		
		$this->data['progress'] = $this->progres->get();
		//$this->data['komoditas'] = $this->komoditas->get();
		$this->data['kotama'] = $this->satker->getLevel1();
		$this->data['satkers'] = $this->satker->GetLevel2and3($this->input->get());
		$this->data['komoditas'] = $this->komoditas->getComodityResultByParentSatkerGroupBySatkerNew($this->input->get());

		$this->data['selectedLanal'] = null;
		if($this->input->get() && $this->input->get()['satker'] ) {
			$selectedSatkerId = $this->input->get()['satker'];
			$selectedSatker = $this->satker->findByIdSatker($selectedSatkerId);
			if ($selectedSatker->id_level == 3) {
				$this->data['selectedLanal'] = $selectedSatker;
			}
		} else {
			$this->data['selectedLanal'] = null;
		}

		$data['isi'] = $this->load->view('dashboard/dashboard2', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard3()
	{
		$this->data['title'] = 'Monitoring Produksi Ketahanan Pangan';
		
		$this->data['rekapPangan'] = $this->pangan->get2($this->input->get());
		$this->data['progress'] = $this->progres->get();
		$this->data['komoditas'] = $this->komoditas->get();
		$this->data['kotama'] = $this->satker->getLevel1();
		$this->data['satkers'] = $this->satker->GetLevel2and3($this->input->get());
		$this->data['komoditasList'] =$this->komoditas->getComodityResult($this->input->get());

		$data['isi'] = $this->load->view('dashboard/dashboard3', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard4()
	{
		$this->data['title'] = 'Personel dan Lahan Tidur';

		$this->data['satkers'] = $this->satker->get();
		$this->data['satkers2'] = $this->satker->get($this->input->get());
		$this->data['personels'] = $this->personel->get($this->input->get());
		$this->data['personels2'] = $this->personel->all($this->input->get());
		$this->data['lahantidur'] = $this->lahanTidur->get($this->input->get());
		$this->data['lahantidur2'] = $this->lahanTidur->all($this->input->get());

		$data['isi'] = $this->load->view('dashboard/dashboard4', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard5()
	{
		$this->data['title'] = 'Pelaporan Babinpotmar';

		$this->data['satkers'] = $this->satker->get();
		$this->data['satkerRank'] = $this->satker->getRankSatker();
		$this->data['personelRank'] = $this->satker->getRankPersonel();
		$this->data['getRankCriminals'] = $this->report->getRankCriminals();
		
		$config['base_url'] = site_url().'dashboard5';

		if (policy('LAPHAR','read')) {
			$config['total_rows'] = count($this->report->get([
				'satker' => $this->session->userdata('id_satker'),
				'startDate' => null,
				'finishDate' => null
			]));
		}else if (policy('LAPHAR','read_all')){
			$config['total_rows'] = count($this->report->get());
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
		
		$data['isi'] = $this->load->view('dashboard/dashboard5', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard6()
	{
		if ( $this->input->get()['jenisdata'] && $this->input->get()['jenisdata'] != "" ) {
			$this->data['title'] = 'GEODEMOKONSOS';
			$this->data['jenisdata'] = getGeodemokonsosConfigName(decrypt($this->input->get()['jenisdata']));

			$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
			$this->data['kotamas'] = $this->satker->getLevel1();	
//			$this->data['satkers'] = $this->satker->get();

			$kotama = $this->input->get()['kotama'];
			$satker = $this->input->get()['satker'];
			$parent_satker = null;
			if($satker) {
				$parent_satker = $satker;
			} else if ($kotama) {
				$parent_satker = $kotama;
			}

			$this->data['summaryLahanTidur'] = $this->lahanTidur->summaryByParentSatker($kotama, $satker);
			$this->data['summarySatker'] = $this->satker->satkerCountByParent($parent_satker);


			$data['isi'] = $this->load->view('dashboard/dashboard6', $this->data, true);
			$this->load->view('skin/layout', $data);	
		} else {
			redirect('/dashboard6?kotama=&satker=&jenisdata=dVpwNUhIN3B3enRNR0gxcnlTVzdPQT09');
		}
	}

	public function dashboard6Detail()
	{
		$geo_pantai = [
			'title' => "Pantai",
			'tableName' => 'geo_pantai',
			'tableAlias' => 'pantai',
			'columns' => [
				"nama_satker" => "Satker", 
				"wilayah" => "Wilayah", 
				"nama_pantai" => "Nama Pantai", 
				"jenis_pantai" => "Jenis Pantai", 
				"panjang_pantai" => "Panjang Pantai (Km)", 
				"material_dasar_pantai" => "Material Dasar Pantai", 
				"ciri_khusus" => "Ciri Khusus", 
				"keterangan" => "Ket"
			],
			'sqlSelect' => "
				select 
					pantai.*, satker.nama_satker, geografi.nama as wilayah, geografi.*, jenis_pantai.nama AS jenis_pantai
				from 
					geo_pantai pantai
					inner join org_satker satker on satker.id_satker = pantai.id_satker
					inner join mst_jenis_pantai jenis_pantai on jenis_pantai.id_jenis_pantai = pantai.id_jenis_pantai 
					inner join org_geografi geografi on geografi.id_geografi = pantai.id_geografi
				"
		];

		$geo_hutan = [
			'title' => "Hutan",
			'tableName' => 'geo_hutan',
			'tableAlias' => 'hutan',
			'columns' => [
				"nama_satker" => "Satker",
				"wilayah" => "Wilayah", 
				"jenis_tanaman" => "Jenis Tanaman", 
				"luas_hutan" => "Luas Hutan (Ha)", 
				"status_hutan" => "Status Hutan",
				"keterangan" => "Ket"
			],
			'sqlSelect' => "
				select
					hutan.*, satker.nama_satker, geografi.nama as wilayah, 
					geografi.*, jenis_tanaman.nama AS jenis_tanaman, status_hutan.nama AS status_hutan
				from
					geo_hutan AS hutan
					inner join org_satker AS satker on hutan.id_satker = satker.id_satker
					inner join mst_jenis_tanaman_hutan AS jenis_tanaman on hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
					inner join mst_status_hutan AS status_hutan on hutan.id_status_hutan = status_hutan.id_status_hutan
					inner join org_geografi AS geografi on hutan.id_geografi = geografi.id_geografi
				"
		];
		
		$configs = [
			'geo_pantai' => $geo_pantai,
			'geo_hutan' => $geo_hutan
		];

		$id_satker = $this->input->get()['id_satker'];
		$jenisdata = $this->input->get()['jenisdata'];
		$jenisdata = decrypt($jenisdata);
		$this->data['id_satker'] = $id_satker;
		$this->data['jenisdata'] = $jenisdata;

		$query = $this->db->query("SELECT nama_satker from org_satker where id_satker=" . $id_satker);
		$this->data['nama_satker'] = $query->result()[0]->nama_satker;


		if ( array_key_exists($jenisdata, $configs)  ) {
			$config = $configs[$jenisdata];

			$this->data['title'] = $config['title'];
			$this->data['columns'] = $config['columns'];
	
	
			$selectSql = $config['sqlSelect'] . " WHERE " . $config['tableAlias'] . ".id_satker=" . $id_satker;
			$query = $this->db->query($selectSql);			
			$this->data['tableDatas'] = $query->result();
		} else {
			$this->data['title'] = 'N/A';
			$this->data['columns'] = [];
			$this->data['tableDatas'] = [];
		}
		
		$this->load->view('dashboard/dashboard6Detail', $this->data);
	}

	public function dashboard7()
	{
		$this->data['title'] = 'DESA BINAAN';
		
		$this->data['kotamas'] = $this->satker->getLevel1();
		$this->data['lantamal'] = $this->satker->getLevel2($this->input->get());
		$this->data['satkers'] = $this->satker->getLevel3($this->input->get());
		
		$data['isi'] = $this->load->view('dashboard/dashboard7Gal', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard8()
	{
		$this->data['title'] = 'PANTAI';

		$this->data['satkers'] = $this->satker->get();
		
		$data['isi'] = $this->load->view('dashboard/dashboard8bak', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function dashboard9()
	{
		$this->data['title'] = 'MANGROVE';

		$this->data['kotamas'] = $this->satker->getLevel1();	
		$this->data['satkers'] = $this->satker->getLevel2And3($this->input->get());
		// $this->data['satkers'] = $this->satker->get();

		$this->data['satkers2'] = $this->satker->get($this->input->get());

		// $this->data['satkers'] = $this->satker->get();
		
		$data['isi'] = $this->load->view('dashboard/dashboard9bak', $this->data, true);
		$this->load->view('skin/layout', $data);
	}
    
}
