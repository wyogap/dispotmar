<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPeternakan extends CI_Model
{
    private $_table = "geo_peternakan";

    public $id_peternakan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					peternakan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_peternakan AS peternakan
					JOIN org_satker AS satker
					ON peternakan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON peternakan.id_komoditas = komoditas.id_komoditas
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
					peternakan.id_geografi = geografi.id_provinsi OR
					peternakan.id_geografi = geografi.id_kabupaten OR
					peternakan.id_geografi = geografi.id_kecamatan OR
					peternakan.id_geografi = geografi.id_kelurahan
				WHERE
					peternakan.is_active = 1 
				GROUP BY
					peternakan.id_peternakan
				ORDER BY
					peternakan.id_peternakan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('peternakan.*,
		satker.nama_satker,
		geografi.*,
		komoditas.nama_komoditas');
		$this->db->from('geo_peternakan AS peternakan');
		$this->db->join('org_satker AS satker','peternakan.id_satker = satker.id_satker');
		$this->db->join('mst_pangan_komoditas AS komoditas','peternakan.id_komoditas = komoditas.id_komoditas');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','peternakan.id_geografi = geografi.id_provinsi OR
			peternakan.id_geografi = geografi.id_kabupaten OR
			peternakan.id_geografi = geografi.id_kecamatan OR
			peternakan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('peternakan.id_satker', $request['satker']);
			}
		}
		$this->db->where('peternakan.is_active',1);
		$this->db->group_by('peternakan.id_peternakan');
		$this->db->order_by('peternakan.id_peternakan','DESC');
			
		return $this->db->get()->result();
	}

	public function getdataForDatatable($request = null)
    {
		$this->db->select('peternakan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama_hewan as nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(peternakan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_peternakan AS peternakan');
		$this->db->join('org_satker AS satker','peternakan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_hewan AS komoditas','peternakan.id_komoditas = komoditas.id_jenis_hewan');
		$this->db->join('org_geografi AS geografi','peternakan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','peternakan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('peternakan.id_satker', $request['satker']);
			}
		}
		$this->db->where('peternakan.is_active',1);
		$this->db->group_by('peternakan.id_peternakan');
		$this->db->order_by('peternakan.id_peternakan','DESC');
			
		return $this->db->get()->result();
	}

	public function getExport($id)
    {
		$this->db->select('peternakan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama_hewan as nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(peternakan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_peternakan AS peternakan');
		$this->db->join('org_satker AS satker','peternakan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_hewan AS komoditas','peternakan.id_komoditas = komoditas.id_jenis_hewan');
		$this->db->join('org_geografi AS geografi','peternakan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','peternakan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('peternakan.id_satker', $id);
		}
		$this->db->where('peternakan.is_active',1);
		$this->db->group_by('peternakan.id_peternakan');
		$this->db->order_by('peternakan.id_peternakan','DESC');
			
		return $this->db->get()->result();
	}
	
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					peternakan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_hewan as nama_komoditas
				FROM
					geo_peternakan AS peternakan
					JOIN org_satker AS satker
					ON peternakan.id_satker = satker.id_satker
					JOIN mst_jenis_hewan AS komoditas
					ON peternakan.id_komoditas = komoditas.id_jenis_hewan
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
					peternakan.id_geografi = geografi.id_provinsi OR
					peternakan.id_geografi = geografi.id_kabupaten OR
					peternakan.id_geografi = geografi.id_kecamatan OR
					peternakan.id_geografi = geografi.id_kelurahan
				WHERE
					peternakan.is_active = 1 AND
					peternakan.id_peternakan = $id
				GROUP BY
					peternakan.id_peternakan
				ORDER BY
					peternakan.id_peternakan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					peternakan.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_peternakan AS peternakan
					JOIN org_satker AS satker
					ON peternakan.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON peternakan.id_komoditas = komoditas.id_komoditas
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
					peternakan.id_geografi = geografi.id_provinsi OR
					peternakan.id_geografi = geografi.id_kabupaten OR
					peternakan.id_geografi = geografi.id_kecamatan OR
					peternakan.id_geografi = geografi.id_kelurahan
				WHERE
					peternakan.is_active = 1 AND
					peternakan.id_satker = $id
				GROUP BY
					peternakan.id_peternakan
				ORDER BY
					peternakan.id_peternakan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					peternakan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					komoditas.nama_hewan as nama_komoditas
				FROM
					geo_peternakan AS peternakan
					JOIN org_satker AS satker
					ON peternakan.id_satker = satker.id_satker
					JOIN mst_jenis_hewan AS komoditas
					ON peternakan.id_komoditas = komoditas.id_jenis_hewan
					LEFT JOIN org_geografi AS geografi ON peternakan.id_geografi = geografi.id_geografi
				WHERE
					peternakan.is_active = 1 AND
					peternakan.id_satker = $id
				GROUP BY
					peternakan.id_peternakan
				ORDER BY
					peternakan.id_peternakan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_peternakan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_peternakan" => $id]);
    }
}
