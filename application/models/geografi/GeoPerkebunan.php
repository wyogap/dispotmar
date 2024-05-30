<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Geoperkebunan extends CI_Model
{
    private $_table = "geo_perkebunan";

    public $id_perkebunan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					perkebunan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_perkebunan AS perkebunan
					JOIN org_satker AS satker
					ON perkebunan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON perkebunan.id_komoditas = komoditas.id_komoditas
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
					perkebunan.id_geografi = geografi.id_provinsi OR
					perkebunan.id_geografi = geografi.id_kabupaten OR
					perkebunan.id_geografi = geografi.id_kecamatan OR
					perkebunan.id_geografi = geografi.id_kelurahan
				WHERE
					perkebunan.is_active = 1 
				GROUP BY
					perkebunan.id_perkebunan
				ORDER BY
					perkebunan.id_perkebunan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('perkebunan.*,
		satker.nama_satker,
		geografi.*,
		komoditas.nama_komoditas');
		$this->db->from('geo_perkebunan AS perkebunan');
		$this->db->join('org_satker AS satker','perkebunan.id_satker = satker.id_satker');
		$this->db->join('mst_pangan_komoditas AS komoditas','perkebunan.id_komoditas = komoditas.id_komoditas');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','perkebunan.id_geografi = geografi.id_provinsi OR
			perkebunan.id_geografi = geografi.id_kabupaten OR
			perkebunan.id_geografi = geografi.id_kecamatan OR
			perkebunan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('perkebunan.id_satker', $request['satker']);
			}
		}
		$this->db->where('perkebunan.is_active',1);
		$this->db->group_by('perkebunan.id_perkebunan');
		$this->db->order_by('perkebunan.id_perkebunan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('perkebunan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(perkebunan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_perkebunan AS perkebunan');
		$this->db->join('org_satker AS satker','perkebunan.id_satker = satker.id_satker');
		$this->db->join('mst_pangan_komoditas AS komoditas','perkebunan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('org_geografi AS geografi','perkebunan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','perkebunan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('perkebunan.id_satker', $request['satker']);
			}
		}
		$this->db->where('perkebunan.is_active',1);
		$this->db->group_by('perkebunan.id_perkebunan');
		$this->db->order_by('perkebunan.id_perkebunan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('perkebunan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(perkebunan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_perkebunan AS perkebunan');
		$this->db->join('org_satker AS satker','perkebunan.id_satker = satker.id_satker');
		$this->db->join('mst_pangan_komoditas AS komoditas','perkebunan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('org_geografi AS geografi','perkebunan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','perkebunan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('perkebunan.id_satker', $id);
		}
		$this->db->where('perkebunan.is_active',1);
		$this->db->group_by('perkebunan.id_perkebunan');
		$this->db->order_by('perkebunan.id_perkebunan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					perkebunan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_perkebunan AS perkebunan
					JOIN org_satker AS satker
					ON perkebunan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON perkebunan.id_komoditas = komoditas.id_komoditas
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
					perkebunan.id_geografi = geografi.id_provinsi OR
					perkebunan.id_geografi = geografi.id_kabupaten OR
					perkebunan.id_geografi = geografi.id_kecamatan OR
					perkebunan.id_geografi = geografi.id_kelurahan
				WHERE
					perkebunan.is_active = 1 AND
					perkebunan.id_perkebunan = $id
				GROUP BY
					perkebunan.id_perkebunan
				ORDER BY
					perkebunan.id_perkebunan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					perkebunan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_perkebunan AS perkebunan
					JOIN org_satker AS satker
					ON perkebunan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON perkebunan.id_komoditas = komoditas.id_komoditas
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
					perkebunan.id_geografi = geografi.id_provinsi OR
					perkebunan.id_geografi = geografi.id_kabupaten OR
					perkebunan.id_geografi = geografi.id_kecamatan OR
					perkebunan.id_geografi = geografi.id_kelurahan
				WHERE
					perkebunan.is_active = 1 AND
					perkebunan.id_satker = $id
				GROUP BY
					perkebunan.id_perkebunan
				ORDER BY
					perkebunan.id_perkebunan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					perkebunan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					komoditas.nama_komoditas
				FROM
					geo_perkebunan AS perkebunan
					JOIN org_satker AS satker
					ON perkebunan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON perkebunan.id_komoditas = komoditas.id_komoditas
					LEFT JOIN org_geografi AS geografi ON perkebunan.id_geografi = geografi.id_geografi
				WHERE
					perkebunan.is_active = 1 AND
					perkebunan.id_satker = $id
				GROUP BY
					perkebunan.id_perkebunan
				ORDER BY
					perkebunan.id_perkebunan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_perkebunan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_perkebunan" => $id]);
    }
}
