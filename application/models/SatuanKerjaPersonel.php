<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SatuanKerjaPersonel extends CI_Model
{
    private $_table = "org_personel";

    public $id_personel;

	public function summaryByParentSatker($kotama = null, $satker = null)
    {
		$this->db->select('
			COUNT( DISTINCT personel.id_satker ) as count_satker,
			SUM(personel.jumlah_personel) AS sum_jumlah_personel,
			SUM(personel.perwira) AS sum_perwira,
			SUM(personel.bintara) AS sum_bintara,
			SUM(personel.tamtama) AS sum_tamtama			
		');
		$this->db->from("$this->_table AS personel");
		$this->db->where('personel.is_active',1);
		
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

		$query = $this->db->get();

		return $query->row();
	}

	public function summaryByParentSatkerGroupBySatker($kotama = null, $satker = null)
    {
		// $satker_tree_table = satker_tree_table();
		$satker_tree_table = satker_tree_geo_table();

		$this->db->select('
			satker_detail.id_satker as id_satker, satker_detail.nama_satker, 
			satker_detail.latitude, satker_detail.longitude,
			satker_detail.id_kotama, satker_detail.level,
			satker_detail.id_geografi, satker_detail.nama_pimpinan, satker_detail.geo_nama, satker_detail.geo_path,

			SUM(personel.jumlah_personel) AS sum_jumlah_personel,
			SUM(personel.perwira) AS sum_perwira,
			SUM(personel.bintara) AS sum_bintara,
			SUM(personel.tamtama) AS sum_tamtama			
		');
		$this->db->from("$this->_table AS personel");
		$this->db->where('personel.is_active',1);
		$this->db->join(
			" ($satker_tree_table) as satker_detail ",
			'satker_detail.id_satker = personel.id_satker',
			'inner'
		);
		
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
		
		$this->db->group_by('satker_detail.id_satker');

		$query = $this->db->get();

		$queryResults =  $query->result();		
		foreach ( $queryResults as $row ) {
			$row->id_satker_encrypted = encrypt($row->id_satker);
		}
		return $queryResults;

		//return $query->result();
	}

    public function all($request = null)
    {
		$this->db->select('personel.*,
				SUM(personel.jumlah_personel) AS totalPersonel,
				SUM(personel.perwira) AS totalPerwira,
				SUM(personel.bintara) AS totalBintara,
				SUM(personel.tamtama) AS totalTamtama,
				satker.nama_satker,
				satker.latitude,
				satker.longitude,
				level.jenis_organisasi AS level,
				GEOGRAFI.PROVINSI, 
				GEOGRAFI.KABUPATEN, 
				GEOGRAFI.KECAMATAN, 
				GEOGRAFI.KELURAHAN');
        $this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
        $this->db->join('org_level AS level','satker.id_level = level.id_level');
		$this->db->join('
			(SELECT DISTINCT
			PROV.id_geografi AS id_provinsi,
			KAB.id_geografi AS id_kabupaten,
			KEC.id_geografi AS id_kecamatan,
			KEL.id_geografi AS id_kelurahan,
			PROV.nama AS PROVINSI, 
			KAB.nama AS KABUPATEN, 
			KEC.nama AS KECAMATAN, 
			KEL.nama AS KELURAHAN
		FROM
			org_geografi AS PROV
			INNER JOIN
			org_geografi AS KAB
			ON 
				KAB.id_geografi_parent = PROV.id_geografi
			INNER JOIN
			org_geografi AS KEC
			ON 
				KEC.id_geografi_parent = KAB.id_geografi
			INNER JOIN
			org_geografi AS KEL
			ON 
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','satker.id_geografi = GEOGRAFI.id_provinsi OR
				satker.id_geografi = GEOGRAFI.id_kabupaten OR
				satker.id_geografi = GEOGRAFI.id_kecamatan OR
				satker.id_geografi = GEOGRAFI.id_kelurahan','left');
		$this->db->where('personel.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('personel.id_satker', $request['satker']);
			}
		}
		$this->db->order_by('personel.id_personel', 'DESC');
        return $this->db->get("$this->_table AS personel")->result();
    }

    public function get($request = null)
    {
		$this->db->select('personel.*,
		        SUM(personel.jumlah_personel) AS totalPersonel,
				SUM(personel.perwira) AS totalPerwira,
				SUM(personel.bintara) AS totalBintara,
				SUM(personel.tamtama) AS totalTamtama,
				satker.nama_satker,
				level.jenis_organisasi AS level');
        $this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
        $this->db->join('org_level AS level','satker.id_level = level.id_level');
		$this->db->where('personel.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('personel.id_satker', $request['satker']);
			}
		}
		$this->db->order_by('personel.id_personel', 'DESC');
        return $this->db->get("$this->_table AS personel")->result();
	}
	
	public function getData_formSatker($request = null)
    {
		$this->db->select('personel.*,
				satker.nama_satker,
				level.jenis_organisasi AS level,
				user1.nama_pegawai,
				DATE_FORMAT(personel.updated_date, "%d/%m/%Y") as LastUpdated');
        $this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
        $this->db->join('org_level AS level','satker.id_level = level.id_level');
		$this->db->join('mst_user AS user1','personel.updated_by = user1.id_user','left');
		$this->db->where('personel.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('personel.id_satker', $request['satker']);
			}
		}
		$this->db->order_by('personel.id_personel', 'DESC');
        return $this->db->get("$this->_table AS personel")->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('personel.*,
				satker.nama_satker,
				level.jenis_organisasi AS level,
				user1.nama_pegawai,
				DATE_FORMAT(personel.updated_date, "%d/%m/%Y") as LastUpdated');
        $this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
        $this->db->join('org_level AS level','satker.id_level = level.id_level');
		$this->db->join('mst_user AS user1','personel.updated_by = user1.id_user','left');
		$this->db->where('personel.is_active',1);
		if ($id != 0) {
			$this->db->where('personel.id_satker', $id);
		}
		$this->db->order_by('personel.id_personel', 'DESC');
        return $this->db->get("$this->_table AS personel")->result();
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_personel" => $id,"is_active" => 1])->row();
    }
	
    public function create($data)
    {		
		return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, array("id_personel" => $id));
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_personel" => $id]);
    }
}
