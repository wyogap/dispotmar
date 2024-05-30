<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoBudidayaIkan extends CI_Model
{
    private $_table = "geo_budidaya_ikan";

    public $id_budidaya_ikan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_budidaya_ikan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 
				GROUP BY
					ikan.id_budidaya_ikan
				ORDER BY
					ikan.id_budidaya_ikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan');
		$this->db->from('geo_budidaya_ikan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','ikan.id_geografi = geografi.id_provinsi OR
			ikan.id_geografi = geografi.id_kabupaten OR
			ikan.id_geografi = geografi.id_kecamatan OR
			ikan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_budidaya_ikan');
		$this->db->order_by('ikan.id_budidaya_ikan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan,
		user1.nama_pegawai,
		DATE_FORMAT(ikan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_budidaya_ikan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
		$this->db->join('org_geografi AS geografi','ikan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ikan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_budidaya_ikan');
		$this->db->order_by('ikan.id_budidaya_ikan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan,
		user1.nama_pegawai,
		DATE_FORMAT(ikan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_budidaya_ikan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
		$this->db->join('org_geografi AS geografi','ikan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ikan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('ikan.id_satker', $id);
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_budidaya_ikan');
		$this->db->order_by('ikan.id_budidaya_ikan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_budidaya_ikan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 AND
					ikan.id_budidaya_ikan = $id
				GROUP BY
					ikan.id_budidaya_ikan
				ORDER BY
					ikan.id_budidaya_ikan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_budidaya_ikan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 AND
					ikan.id_satker = $id
				GROUP BY
					ikan.id_budidaya_ikan
				ORDER BY
					ikan.id_budidaya_ikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_budidaya_ikan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan
					LEFT JOIN org_geografi AS geografi ON ikan.id_geografi = geografi.id_geografi
				WHERE
					ikan.is_active = 1 AND
					ikan.id_satker = $id
				GROUP BY
					ikan.id_budidaya_ikan
				ORDER BY
					ikan.id_budidaya_ikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_budidaya_ikan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_budidaya_ikan" => $id]);
    }
}
