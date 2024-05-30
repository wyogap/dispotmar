<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPulau extends CI_Model
{
    private $_table = "geo_pulau_terluar";

    public $id_pulau_terluar;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pulau.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pulau_terluar AS pulau
					JOIN org_satker AS satker
					ON pulau.id_satker = satker.id_satker
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
					pulau.id_geografi = geografi.id_provinsi OR
					pulau.id_geografi = geografi.id_kabupaten OR
					pulau.id_geografi = geografi.id_kecamatan OR
					pulau.id_geografi = geografi.id_kelurahan
				WHERE
					pulau.is_active = 1 
				GROUP BY
					pulau.id_pulau_terluar
				ORDER BY
					pulau.id_pulau_terluar DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pulau.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('geo_pulau_terluar AS pulau');
		$this->db->join('org_satker AS satker','pulau.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pulau.id_geografi = geografi.id_provinsi OR
			pulau.id_geografi = geografi.id_kabupaten OR
			pulau.id_geografi = geografi.id_kecamatan OR
			pulau.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pulau.id_satker', $request['satker']);
			}
		}
		$this->db->where('pulau.is_active',1);
		$this->db->group_by('pulau.id_pulau_terluar');
		$this->db->order_by('pulau.id_pulau_terluar','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('pulau.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pulau.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pulau_terluar AS pulau');
		$this->db->join('org_satker AS satker','pulau.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pulau.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pulau.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pulau.id_satker', $request['satker']);
			}
		}
		$this->db->where('pulau.is_active',1);
		$this->db->group_by('pulau.id_pulau_terluar');
		$this->db->order_by('pulau.id_pulau_terluar','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('pulau.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pulau.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pulau_terluar AS pulau');
		$this->db->join('org_satker AS satker','pulau.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pulau.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pulau.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pulau.id_satker', $id);
		}
		$this->db->where('pulau.is_active',1);
		$this->db->group_by('pulau.id_pulau_terluar');
		$this->db->order_by('pulau.id_pulau_terluar','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pulau.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pulau_terluar AS pulau
					JOIN org_satker AS satker
					ON pulau.id_satker = satker.id_satker
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
					pulau.id_geografi = geografi.id_provinsi OR
					pulau.id_geografi = geografi.id_kabupaten OR
					pulau.id_geografi = geografi.id_kecamatan OR
					pulau.id_geografi = geografi.id_kelurahan
				WHERE
					pulau.is_active = 1 AND
					pulau.id_pulau_terluar = $id
				GROUP BY
					pulau.id_pulau_terluar
				ORDER BY
					pulau.id_pulau_terluar DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pulau.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pulau_terluar AS pulau
					JOIN org_satker AS satker
					ON pulau.id_satker = satker.id_satker
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
					pulau.id_geografi = geografi.id_provinsi OR
					pulau.id_geografi = geografi.id_kabupaten OR
					pulau.id_geografi = geografi.id_kecamatan OR
					pulau.id_geografi = geografi.id_kelurahan
				WHERE
					pulau.is_active = 1 AND
					pulau.id_satker = $id
				GROUP BY
					pulau.id_pulau_terluar
				ORDER BY
					pulau.id_pulau_terluar DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pulau.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					geo_pulau_terluar AS pulau
					JOIN org_satker AS satker
					ON pulau.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON pulau.id_geografi = geografi.id_geografi
				WHERE
					pulau.is_active = 1 AND
					pulau.id_satker = $id
				GROUP BY
					pulau.id_pulau_terluar
				ORDER BY
					pulau.id_pulau_terluar DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pulau_terluar" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pulau_terluar" => $id]);
    }
}
