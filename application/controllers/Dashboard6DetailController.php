<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard6DetailController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
	}
	
	public function index()
	{
		$configs = getGeodemokonsosConfigs();

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
	
			$satker_id_by_parent = satker_id_by_parent($id_satker);
			$tableAlias = $config['tableAlias'];
			$sqlSelect = $config['sqlSelect'];
	
			$selectSql = "
				$sqlSelect  
				INNER JOIN ($satker_id_by_parent) as satker_tree on satker_tree.id_satker = $tableAlias.id_satker 
				WHERE $tableAlias.is_active = 1
				";
			$query = $this->db->query($selectSql);			
			$this->data['tableDatas'] = $query->result();
		} else {
			$this->data['title'] = $jenisdata;
			$this->data['columns'] = [];
			$this->data['tableDatas'] = [];
		}
		
		$this->load->view('dashboard/dashboard6Detail', $this->data);
	}    
}
