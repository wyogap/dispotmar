<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoKonservasi extends CI_Model
{
    private $_table = "geo_konservasi_lingkungan";

    public $id_konservasi;

    public function get()
    {
		$sql = "SELECT DISTINCT
					konservasi.*,
					satker.nama_satker,
					geografi.*,
					jenis_konservasi.nama AS jenis_konservasi
				FROM
					geo_konservasi_lingkungan AS konservasi
					JOIN org_satker AS satker
					ON konservasi.id_satker = satker.id_satker
					JOIN mst_jenis_konservasi AS jenis_konservasi
					ON konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi
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
					konservasi.id_geografi = geografi.id_provinsi OR
					konservasi.id_geografi = geografi.id_kabupaten OR
					konservasi.id_geografi = geografi.id_kecamatan OR
					konservasi.id_geografi = geografi.id_kelurahan
				WHERE
					konservasi.is_active = 1 
				GROUP BY
					konservasi.id_konservasi
				ORDER BY
					konservasi.id_konservasi DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('konservasi.*,
		satker.nama_satker,
		geografi.*,
		jenis_konservasi.nama AS jenis_konservasi');
		$this->db->from('geo_konservasi_lingkungan AS konservasi');
		$this->db->join('org_satker AS satker','konservasi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_konservasi AS jenis_konservasi','konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','konservasi.id_geografi = geografi.id_provinsi OR
			konservasi.id_geografi = geografi.id_kabupaten OR
			konservasi.id_geografi = geografi.id_kecamatan OR
			konservasi.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('konservasi.id_satker', $request['satker']);
			}
		}
		$this->db->where('konservasi.is_active',1);
		$this->db->group_by('konservasi.id_konservasi');
		$this->db->order_by('konservasi.id_konservasi','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('konservasi.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_konservasi.nama AS jenis_konservasi,
		user1.nama_pegawai,
		DATE_FORMAT(konservasi.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_konservasi_lingkungan AS konservasi');
		$this->db->join('org_satker AS satker','konservasi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_konservasi AS jenis_konservasi','konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi');
		$this->db->join('org_geografi AS geografi','konservasi.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','konservasi.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('konservasi.id_satker', $request['satker']);
			}
		}
		$this->db->where('konservasi.is_active',1);
		$this->db->group_by('konservasi.id_konservasi');
		$this->db->order_by('konservasi.id_konservasi','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('konservasi.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_konservasi.nama AS jenis_konservasi,
		user1.nama_pegawai,
		DATE_FORMAT(konservasi.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_konservasi_lingkungan AS konservasi');
		$this->db->join('org_satker AS satker','konservasi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_konservasi AS jenis_konservasi','konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi');
		$this->db->join('org_geografi AS geografi','konservasi.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','konservasi.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('konservasi.id_satker', $id);
		}
		$this->db->where('konservasi.is_active',1);
		$this->db->group_by('konservasi.id_konservasi');
		$this->db->order_by('konservasi.id_konservasi','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					konservasi.*,
					satker.nama_satker,
					geografi.*,
					jenis_konservasi.nama AS jenis_konservasi
				FROM
					geo_konservasi_lingkungan AS konservasi
					JOIN org_satker AS satker
					ON konservasi.id_satker = satker.id_satker
					JOIN mst_jenis_konservasi AS jenis_konservasi
					ON konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi
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
					konservasi.id_geografi = geografi.id_provinsi OR
					konservasi.id_geografi = geografi.id_kabupaten OR
					konservasi.id_geografi = geografi.id_kecamatan OR
					konservasi.id_geografi = geografi.id_kelurahan
				WHERE
					konservasi.is_active = 1 AND
					konservasi.id_konservasi = $id
				GROUP BY
					konservasi.id_konservasi
				ORDER BY
					konservasi.id_konservasi DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					konservasi.*,
					satker.nama_satker,
					geografi.*,
					jenis_konservasi.nama AS jenis_konservasi
				FROM
					geo_konservasi_lingkungan AS konservasi
					JOIN org_satker AS satker
					ON konservasi.id_satker = satker.id_satker
					JOIN mst_jenis_konservasi AS jenis_konservasi
					ON konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi
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
					konservasi.id_geografi = geografi.id_provinsi OR
					konservasi.id_geografi = geografi.id_kabupaten OR
					konservasi.id_geografi = geografi.id_kecamatan OR
					konservasi.id_geografi = geografi.id_kelurahan
				WHERE
					konservasi.is_active = 1 AND
					konservasi.id_satker = $id
				GROUP BY
					konservasi.id_konservasi
				ORDER BY
					konservasi.id_konservasi DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					konservasi.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_konservasi.nama AS jenis_konservasi
				FROM
					geo_konservasi_lingkungan AS konservasi
					JOIN org_satker AS satker
					ON konservasi.id_satker = satker.id_satker
					JOIN mst_jenis_konservasi AS jenis_konservasi
					ON konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi
					LEFT JOIN org_geografi AS geografi ON konservasi.id_geografi = geografi.id_geografi
				WHERE
					konservasi.is_active = 1 AND
					konservasi.id_satker = $id
				GROUP BY
					konservasi.id_konservasi
				ORDER BY
					konservasi.id_konservasi DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_konservasi" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_konservasi" => $id]);
    }
}
