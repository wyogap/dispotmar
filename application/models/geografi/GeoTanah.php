<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoTanah extends CI_Model
{
    private $_table = "geo_struktur_tanah";

    public $id_struktur_tanah;

    public function get()
    {
		$sql = "SELECT DISTINCT
					tanah.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanah.nama AS jenis_tanah
				FROM
					geo_struktur_tanah AS tanah
					JOIN org_satker AS satker
					ON tanah.id_satker = satker.id_satker
					JOIN mst_jenis_tanah AS jenis_tanah
					ON tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah
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
					tanah.id_geografi = geografi.id_provinsi OR
					tanah.id_geografi = geografi.id_kabupaten OR
					tanah.id_geografi = geografi.id_kecamatan OR
					tanah.id_geografi = geografi.id_kelurahan
				WHERE
					tanah.is_active = 1 
				GROUP BY
					tanah.id_struktur_tanah
				ORDER BY
					tanah.id_struktur_tanah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('tanah.*,
		satker.nama_satker,
		geografi.*,
		jenis_tanah.nama AS jenis_tanah');
		$this->db->from('geo_struktur_tanah AS tanah');
		$this->db->join('org_satker AS satker','tanah.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanah AS jenis_tanah','tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','tanah.id_geografi = geografi.id_provinsi OR
			tanah.id_geografi = geografi.id_kabupaten OR
			tanah.id_geografi = geografi.id_kecamatan OR
			tanah.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('tanah.id_satker', $request['satker']);
			}
		}
		$this->db->where('tanah.is_active',1);
		$this->db->group_by('tanah.id_struktur_tanah');
		$this->db->order_by('tanah.id_struktur_tanah','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('tanah.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_tanah.nama AS jenis_tanah,
		user1.nama_pegawai,
		DATE_FORMAT(tanah.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_struktur_tanah AS tanah');
		$this->db->join('org_satker AS satker','tanah.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanah AS jenis_tanah','tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah');
		$this->db->join('org_geografi AS geografi','tanah.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','tanah.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('tanah.id_satker', $request['satker']);
			}
		}
		$this->db->where('tanah.is_active',1);
		$this->db->group_by('tanah.id_struktur_tanah');
		$this->db->order_by('tanah.id_struktur_tanah','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('tanah.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_tanah.nama AS jenis_tanah,
		user1.nama_pegawai,
		DATE_FORMAT(tanah.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_struktur_tanah AS tanah');
		$this->db->join('org_satker AS satker','tanah.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanah AS jenis_tanah','tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah');
		$this->db->join('org_geografi AS geografi','tanah.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','tanah.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('tanah.id_satker', $id);
		}
		$this->db->where('tanah.is_active',1);
		$this->db->group_by('tanah.id_struktur_tanah');
		$this->db->order_by('tanah.id_struktur_tanah','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					tanah.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanah.nama AS jenis_tanah
				FROM
					geo_struktur_tanah AS tanah
					JOIN org_satker AS satker
					ON tanah.id_satker = satker.id_satker
					JOIN mst_jenis_tanah AS jenis_tanah
					ON tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah
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
					tanah.id_geografi = geografi.id_provinsi OR
					tanah.id_geografi = geografi.id_kabupaten OR
					tanah.id_geografi = geografi.id_kecamatan OR
					tanah.id_geografi = geografi.id_kelurahan
				WHERE
					tanah.is_active = 1 AND
					tanah.id_struktur_tanah = $id
				GROUP BY
					tanah.id_struktur_tanah
				ORDER BY
					tanah.id_struktur_tanah DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					tanah.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanah.nama AS jenis_tanah
				FROM
					geo_struktur_tanah AS tanah
					JOIN org_satker AS satker
					ON tanah.id_satker = satker.id_satker
					JOIN mst_jenis_tanah AS jenis_tanah
					ON tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah
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
					tanah.id_geografi = geografi.id_provinsi OR
					tanah.id_geografi = geografi.id_kabupaten OR
					tanah.id_geografi = geografi.id_kecamatan OR
					tanah.id_geografi = geografi.id_kelurahan
				WHERE
					tanah.is_active = 1 AND
					tanah.id_satker = $id
				GROUP BY
					tanah.id_struktur_tanah
				ORDER BY
					tanah.id_struktur_tanah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					tanah.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_tanah.nama AS jenis_tanah
				FROM
					geo_struktur_tanah AS tanah
					JOIN org_satker AS satker
					ON tanah.id_satker = satker.id_satker
					JOIN mst_jenis_tanah AS jenis_tanah
					ON tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah
					LEFT JOIN org_geografi AS geografi ON tanah.id_geografi = geografi.id_geografi
				WHERE
					tanah.is_active = 1 AND
					tanah.id_satker = $id
				GROUP BY
					tanah.id_struktur_tanah
				ORDER BY
					tanah.id_struktur_tanah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_struktur_tanah" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_struktur_tanah" => $id]);
    }
}
