<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RekapDesaBinaan extends CI_Model
{
    private $_table = "rekap_desabinaan";

    public $id_desaBinaan;

    public function get()
    {
		$this->db->select('desabinaan.*,satker.nama_satker');
		$this->db->from("$this->_table AS desabinaan");
       	 $this->db->join('org_satker as satker','desabinaan.kode_satker = satker.kode_satker');
        	$this->db->where('desabinaan.is_active',1);
		$this->db->order_by('desabinaan.id', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select(' desabinaan.*, satker.nama_satker, geografi.nama as nama_geografi ');
		$this->db->from("$this->_table AS desabinaan");
		$this->db->join('org_satker as satker','desabinaan.kode_satker = satker.kode_satker');
		$this->db->join('org_geografi as geografi','geografi.id_geografi = satker.id_geografi', 'left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('desabinaan.kode_satker', $request['satker']);
			}
		}
        $this->db->where('desabinaan.is_active',1);
		$this->db->order_by('desabinaan.id', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }
    
    public function find($id)
    {
		
		$sql = "SELECT DISTINCT
			desabinaan.*,
			geografi.*
		FROM
			rekap_desabinaan AS desabinaan
			LEFT JOIN (SELECT DISTINCT
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
							KEL.id_geografi_parent = KEC.id_geografi) AS geografi
		ON
		desabinaan.id_geografi = geografi.id_provinsi OR
		desabinaan.id_geografi = geografi.id_kabupaten OR
		desabinaan.id_geografi = geografi.id_kecamatan OR
			desabinaan.id_geografi = geografi.id_kelurahan
		WHERE
		desabinaan.is_active = 1 AND
		desabinaan.id = $id
		GROUP BY
		desabinaan.id";
			$query = $this->db->query($sql);
			
			return $query->row();
	}

	public function create($data)
	{		
		return $this->db->insert($this->_table, $data);
	}

	public function update($id,$data)
	{
		return $this->db->update($this->_table, $data, ["id" => $id]);
	}

    	public function delete($id)
    	{
        	return $this->db->update($this->_table,['is_active' => FALSE], ["id" => $id]);
	}
	
	public function getDataSummary($kotama, $lantamal, $lanal)
    	{
		$this->db->select('
			count(desabinaan.nama_desa) as jumlah_penduduk,
			count(distinct desabinaan.id_geografi) as wilayah,
			count(distinct desabinaan.id_satker) as satker
			');
		$this->db->from('rekap_desabinaan as desabinaan');

		$id_satker = null;
		if ( $lanal ) {
				$id_satker = $lanal;
		} else if ($lantamal) {
				$id_satker = $lantamal;
		} else if ($kotama) {
				$id_satker = $kotama;
		} 

		if ( $id_satker ) {
			$this->db->join("
			(
				WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker) AS
					(
						SELECT id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker
						FROM org_satker
						WHERE id_parent_satker = $id_satker
						UNION ALL
						SELECT c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker
						FROM 
							org_satker_path AS cp 
							JOIN org_satker AS c ON cp.id_satker = c.id_parent_satker
					)
					SELECT id_satker FROM org_satker_path
					union all
					select $id_satker 
				) AS satker_tree",
				'satker_tree.id_satker = desabinaan.id_satker',
				'inner'
			);
		}

		$this->db->where('desabinaan.is_active',1);
			
		return $this->db->get()->row();
	}

	public function byLantamalAndLanal($lantamal, $lanal) {
		$satker_tree_table = satker_tree_table();

		//$this->db->select(' desabinaan.*, satker.nama_satker, satker.id_kotama, satker.level, satker.nama_pimpinan, geografi.nama as nama_geografi ');
		$this->db->select(' desabinaan.*, satker.nama_satker, satker.id_kotama, satker.level, satker.nama_pimpinan, prov.nama as provinsi, kab.nama as kabupaten, kec.nama as kecamatan, kel.nama as kelurahan');
		$this->db->from("$this->_table AS desabinaan");

		$this->db->join(
			"($satker_tree_table) as satker",
			'desabinaan.id_satker = satker.id_satker',
			"inner"
		);
		//$this->db->join('org_geografi as geografi','geografi.id_geografi = desabinaan.id_geografi', 'left');
		$this->db->join('org_geografi AS prov','desabinaan.id_prov = prov.id_geografi', 'left');
		$this->db->join('org_geografi AS kab','desabinaan.id_kab = kab.id_geografi', 'left');
		$this->db->join('org_geografi AS kec','desabinaan.id_kec = kec.id_geografi', 'left');
		$this->db->join('org_geografi AS kel','desabinaan.id_kel = kel.id_geografi', 'left');
		if ($lantamal && $lanal) {
			$this->db->where_in('desabinaan.id_satker', array($lantamal, $lanal));
		} else if ( $lantamal ) {
			$this->db->join(
				"( 
					select id_satker from org_satker where id_parent_satker=$lantamal 
					union all select $lantamal as id_satker
				) as satker_tree",
				'desabinaan.id_satker = satker_tree.id_satker'
			);
		} else if ( $lanal ) {
			$this->db->where('desabinaan.id_satker', $lanal);
		}
        $this->db->where('desabinaan.is_active',1);
		$this->db->order_by('desabinaan.id', 'asc');
		$query = $this->db->get();

		$queryResults =  $query->result();		
		foreach ( $queryResults as $row ) {
			$row->id_satker_encrypted = encrypt($row->id_satker);
		}
		return $queryResults;
    }
    
}
