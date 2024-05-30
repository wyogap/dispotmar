<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoListrik extends CI_Model
{
    private $_table = "geo_listrik";

    public $id_listrik;

    public function get()
    {
		$sql = "SELECT DISTINCT
					listrik.*,
					satker.nama_satker,
					geografi.*,
					sumber_listrik.nama AS sumber_listrik
				FROM
					geo_listrik AS listrik
					JOIN org_satker AS satker
					ON listrik.id_satker = satker.id_satker
					JOIN mst_sumber_listrik AS sumber_listrik
					ON listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik
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
					listrik.id_geografi = geografi.id_provinsi OR
					listrik.id_geografi = geografi.id_kabupaten OR
					listrik.id_geografi = geografi.id_kecamatan OR
					listrik.id_geografi = geografi.id_kelurahan
				WHERE
					listrik.is_active = 1 
				GROUP BY
					listrik.id_listrik
				ORDER BY
					listrik.id_listrik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('listrik.*,
		satker.nama_satker,
		geografi.*,
		sumber_listrik.nama AS sumber_listrik');
		$this->db->from('geo_listrik AS listrik');
		$this->db->join('org_satker AS satker','listrik.id_satker = satker.id_satker');
		$this->db->join('mst_sumber_listrik AS sumber_listrik','listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik');
		$this->db->join('(SELECT DISTINCT
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','listrik.id_geografi = geografi.id_provinsi OR
			listrik.id_geografi = geografi.id_kabupaten OR
			listrik.id_geografi = geografi.id_kecamatan OR
			listrik.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('listrik.id_satker', $request['satker']);
			}
		}
		$this->db->where('listrik.is_active',1);
		$this->db->group_by('listrik.id_listrik');
		$this->db->order_by('listrik.id_listrik','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('listrik.*,
		satker.nama_satker,
		geografi.nama as  wilayah,
		geografi.*,
		sumber_listrik.nama AS sumber_listrik,
		user1.nama_pegawai,
		DATE_FORMAT(listrik.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_listrik AS listrik');
		$this->db->join('org_satker AS satker','listrik.id_satker = satker.id_satker');
		$this->db->join('mst_sumber_listrik AS sumber_listrik','listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik');
		$this->db->join('org_geografi AS geografi','listrik.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','listrik.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('listrik.id_satker', $request['satker']);
			}
		}
		$this->db->where('listrik.is_active',1);
		$this->db->group_by('listrik.id_listrik');
		$this->db->order_by('listrik.id_listrik','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('listrik.*,
		satker.nama_satker,
		geografi.nama as  wilayah,
		geografi.*,
		sumber_listrik.nama AS sumber_listrik,
		user1.nama_pegawai,
		DATE_FORMAT(listrik.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_listrik AS listrik');
		$this->db->join('org_satker AS satker','listrik.id_satker = satker.id_satker');
		$this->db->join('mst_sumber_listrik AS sumber_listrik','listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik');
		$this->db->join('org_geografi AS geografi','listrik.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','listrik.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('listrik.id_satker', $id);
		}
		$this->db->where('listrik.is_active',1);
		$this->db->group_by('listrik.id_listrik');
		$this->db->order_by('listrik.id_listrik','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					listrik.*,
					satker.nama_satker,
					geografi.*,
					sumber_listrik.nama AS sumber_listrik
				FROM
					geo_listrik AS listrik
					JOIN org_satker AS satker
					ON listrik.id_satker = satker.id_satker
					JOIN mst_sumber_listrik AS sumber_listrik
					ON listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik
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
					listrik.id_geografi = geografi.id_provinsi OR
					listrik.id_geografi = geografi.id_kabupaten OR
					listrik.id_geografi = geografi.id_kecamatan OR
					listrik.id_geografi = geografi.id_kelurahan
				WHERE
					listrik.is_active = 1 AND
					listrik.id_listrik = $id
				GROUP BY
					listrik.id_listrik
				ORDER BY
					listrik.id_listrik DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					listrik.*,
					satker.nama_satker,
					geografi.*,
					sumber_listrik.nama AS sumber_listrik
				FROM
					geo_listrik AS listrik
					JOIN org_satker AS satker
					ON listrik.id_satker = satker.id_satker
					JOIN mst_sumber_listrik AS sumber_listrik
					ON listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik
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
					listrik.id_geografi = geografi.id_provinsi OR
					listrik.id_geografi = geografi.id_kabupaten OR
					listrik.id_geografi = geografi.id_kecamatan OR
					listrik.id_geografi = geografi.id_kelurahan
				WHERE
					listrik.is_active = 1 AND
					listrik.id_satker = $id
				GROUP BY
					listrik.id_listrik
				ORDER BY
					listrik.id_listrik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					listrik.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					sumber_listrik.nama AS sumber_listrik
				FROM
					geo_listrik AS listrik
					JOIN org_satker AS satker
					ON listrik.id_satker = satker.id_satker
					JOIN mst_sumber_listrik AS sumber_listrik
					ON listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik
					LEFT JOIN org_geografi AS geografi ON listrik.id_geografi = geografi.id_geografi
				WHERE
					listrik.is_active = 1 AND
					listrik.id_satker = $id
				GROUP BY
					listrik.id_listrik
				ORDER BY
					listrik.id_listrik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_listrik" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_listrik" => $id]);
    }
}
