<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class OrganisasiPolitik extends CI_Model
{
    private $_table = "konsos_organisasi_politik";

    public $id_organisasi_politik;

    public function get()
    {
		$sql = "SELECT DISTINCT
					politik.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai,
					organisasi.nama AS organisasi
				FROM
					konsos_organisasi_politik AS politik
					JOIN org_satker AS satker
					ON politik.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON politik.id_partai = partai.id_partai
					JOIN mst_nama_organisasi AS organisasi
					ON politik.id_nama_organisasi = organisasi.id_nama_organisasi
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
					politik.id_geografi = geografi.id_provinsi OR
					politik.id_geografi = geografi.id_kabupaten OR
					politik.id_geografi = geografi.id_kecamatan OR
					politik.id_geografi = geografi.id_kelurahan
				WHERE
					politik.is_active = 1 
				GROUP BY
					politik.id_organisasi_politik
				ORDER BY
					politik.id_organisasi_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('politik.*,
		satker.nama_satker,
		geografi.*,
		partai.nama AS partai,
		organisasi.nama AS organisasi');
		$this->db->from('konsos_organisasi_politik AS politik');
		$this->db->join('org_satker AS satker','politik.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','politik.id_partai = partai.id_partai');
		$this->db->join('mst_nama_organisasi AS organisasi','politik.id_nama_organisasi = organisasi.id_nama_organisasi');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','politik.id_geografi = geografi.id_provinsi OR
			politik.id_geografi = geografi.id_kabupaten OR
			politik.id_geografi = geografi.id_kecamatan OR
			politik.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('politik.id_satker', $request['satker']);
			}
		}
		$this->db->where('politik.is_active',1);
		$this->db->group_by('politik.id_organisasi_politik');
		$this->db->order_by('politik.id_organisasi_politik','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('politik.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		partai.nama AS partai,
		user1.nama_pegawai,
		DATE_FORMAT(politik.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_organisasi_politik AS politik');
		$this->db->join('org_satker AS satker','politik.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','politik.id_partai = partai.id_partai');
		// $this->db->join('mst_nama_organisasi AS organisasi','politik.id_nama_organisasi = organisasi.id_nama_organisasi');
		$this->db->join('org_geografi AS geografi','politik.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','politik.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('politik.id_satker', $request['satker']);
			}
		}
		$this->db->where('politik.is_active',1);
		$this->db->group_by('politik.id_organisasi_politik');
		$this->db->order_by('politik.id_organisasi_politik','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('politik.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		partai.nama AS partai,
		user1.nama_pegawai,
		DATE_FORMAT(politik.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_organisasi_politik AS politik');
		$this->db->join('org_satker AS satker','politik.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','politik.id_partai = partai.id_partai');
		// $this->db->join('mst_nama_organisasi AS organisasi','politik.id_nama_organisasi = organisasi.id_nama_organisasi');
		$this->db->join('org_geografi AS geografi','politik.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','politik.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('politik.id_satker', $id);
		}
		$this->db->where('politik.is_active',1);
		$this->db->group_by('politik.id_organisasi_politik');
		$this->db->order_by('politik.id_organisasi_politik','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					politik.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai
				FROM
					konsos_organisasi_politik AS politik
					JOIN org_satker AS satker
					ON politik.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON politik.id_partai = partai.id_partai
				
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
					politik.id_geografi = geografi.id_provinsi OR
					politik.id_geografi = geografi.id_kabupaten OR
					politik.id_geografi = geografi.id_kecamatan OR
					politik.id_geografi = geografi.id_kelurahan
				WHERE
					politik.is_active = 1 AND
					politik.id_organisasi_politik = $id
				GROUP BY
					politik.id_organisasi_politik
				ORDER BY
					politik.id_organisasi_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					politik.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai,
					organisasi.nama AS organisasi
				FROM
					konsos_organisasi_politik AS politik
					JOIN org_satker AS satker
					ON politik.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON politik.id_partai = partai.id_partai
					JOIN mst_nama_organisasi AS organisasi
					ON politik.id_nama_organisasi = organisasi.id_nama_organisasi
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
					politik.id_geografi = geografi.id_provinsi OR
					politik.id_geografi = geografi.id_kabupaten OR
					politik.id_geografi = geografi.id_kecamatan OR
					politik.id_geografi = geografi.id_kelurahan
				WHERE
					politik.is_active = 1 AND
					politik.id_satker = $id
				GROUP BY
					politik.id_organisasi_politik
				ORDER BY
					politik.id_organisasi_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					politik.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					partai.nama AS partai,
					organisasi.nama AS organisasi
				FROM
					konsos_organisasi_politik AS politik
					JOIN org_satker AS satker
					ON politik.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON politik.id_partai = partai.id_partai
					JOIN mst_nama_organisasi AS organisasi
					ON politik.id_nama_organisasi = organisasi.id_nama_organisasi
					LEFT JOIN org_geografi AS geografi ON politik.id_geografi = geografi.id_geografi
				WHERE
					politik.is_active = 1 AND
					politik.id_satker = $id
				GROUP BY
					politik.id_organisasi_politik
				ORDER BY
					politik.id_organisasi_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_organisasi_politik" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_organisasi_politik" => $id]);
    }
}
