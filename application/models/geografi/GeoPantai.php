<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPantai extends CI_Model
{
    private $_table = "geo_pantai";

    public $id_pantai;

	public function getDataSummary($kotama, $lantamal, $lanal, $jenisPantai)
    {
		$this->db->select('
			count(pantai.id_pantai) as jumlah_pantai,
			count(distinct pantai.id_geografi) as wilayah,
			count(distinct pantai.id_satker) as satker
		');
		$this->db->from('geo_pantai AS pantai');

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
			'satker_tree.id_satker = pantai.id_satker',
			'inner'
			);
		}

		if ( $jenisPantai ) {
			$this->db->where('pantai.id_jenis_pantai',$jenisPantai);
		}
		$this->db->where('pantai.is_active',1);

		return $this->db->get()->row();
	}

	public function getDataSummaryGroupByJenisPantai($kotama, $lantamal, $lanal, $jenisPantai)
    {
		$this->db->select('pantai.id_jenis_pantai, jenis_pantai.nama as nama_jenis_pantai,count(pantai.id_pantai) as jumlah_pantai,
		count(distinct pantai.id_geografi) as wilayah,
		count(distinct pantai.id_satker) as satker');
		$this->db->from('geo_pantai AS pantai');
		$this->db->join('mst_jenis_pantai AS jenis_pantai', 'jenis_pantai.id_jenis_pantai=pantai.id_jenis_pantai', 'inner');

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
			'satker_tree.id_satker = pantai.id_satker',
			'inner'
			);
		}
		if ( $jenisPantai ) {
			$this->db->where('pantai.id_jenis_pantai',$jenisPantai);
		}

		$this->db->group_by('pantai.id_jenis_pantai');

		return $this->db->get()->result();
	}

    public function get()
    {
		$sql = "SELECT DISTINCT
					pantai.*,
					satker.nama_satker,
					geografi.*,
					jenis_pantai.nama AS jenis_pantai
				FROM
					geo_pantai AS pantai
					JOIN org_satker AS satker
					ON pantai.id_satker = satker.id_satker
					JOIN mst_jenis_pantai AS jenis_pantai
					ON pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai
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
					pantai.id_geografi = geografi.id_provinsi OR
					pantai.id_geografi = geografi.id_kabupaten OR
					pantai.id_geografi = geografi.id_kecamatan OR
					pantai.id_geografi = geografi.id_kelurahan
				WHERE
					pantai.is_active = 1 
				GROUP BY
					pantai.id_pantai
				ORDER BY
					pantai.id_pantai DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pantai.*,
		satker.nama_satker,
		geografi.*,
		jenis_pantai.nama AS jenis_pantai');
		$this->db->from('geo_pantai AS pantai');
		$this->db->join('org_satker AS satker','pantai.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_pantai AS jenis_pantai','pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pantai.id_geografi = geografi.id_provinsi OR
			pantai.id_geografi = geografi.id_kabupaten OR
			pantai.id_geografi = geografi.id_kecamatan OR
			pantai.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pantai.id_satker', $request['satker']);
			}
		}
		$this->db->where('pantai.is_active',1);
		$this->db->group_by('pantai.id_pantai');
		$this->db->order_by('pantai.id_pantai','DESC');
			
		return $this->db->get()->result();
	}
	
	public function byLantamalAndLanal($lantamal, $lanal)
    {
		$this->db->select(' pantai.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_pantai.nama AS jenis_pantai ');
		$this->db->from("geo_pantai AS pantai");
		$this->db->join('org_satker as satker','pantai.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_pantai AS jenis_pantai','pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai');
		$this->db->join('org_geografi as geografi','geografi.id_geografi = pantai.id_geografi', 'left');
		if ($lantamal && $lanal) {
			$this->db->where_in('pantai.id_satker', array($lantamal, $lanal));
		} else if ( $lantamal ) {
			$this->db->join(
				"( 
					select id_satker from org_satker where id_parent_satker=$lantamal 
					union all select $lantamal as id_satker
				) as satker_tree",
				'pantai.id_satker = satker_tree.id_satker'
			);
		} else if ( $lanal ) {
			$this->db->where('pantai.id_satker', $lanal);
		}
        $this->db->where('pantai.is_active',1);
		$this->db->order_by('pantai.id_pantai', 'asc');
		$query = $this->db->get();

		return $query->result();
    }

	public function getdataForDatatable($request = null, $id_satker = null, $id_jenis_pantai = null)
    {
		$this->db->select('pantai.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_pantai.nama AS jenis_pantai,
		user1.nama_pegawai,
		DATE_FORMAT(pantai.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pantai AS pantai');
		$this->db->join('org_satker AS satker','pantai.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_pantai AS jenis_pantai','pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai');
		$this->db->join('org_geografi AS geografi','pantai.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pantai.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pantai.id_satker', $request['satker']);
			}
		} else {
			if ($id_satker) {
				$this->db->where('pantai.id_satker', $id_satker);
			}
			if ($id_jenis_pantai) {
				$this->db->where('pantai.id_jenis_pantai', $id_jenis_pantai);
			}
		}
		$this->db->where('pantai.is_active',1);
		//$this->db->group_by('pantai.id_pantai');
		$this->db->order_by('pantai.id_pantai','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('pantai.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_pantai.nama AS jenis_pantai,
		user1.nama_pegawai,
		DATE_FORMAT(pantai.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pantai AS pantai');
		$this->db->join('org_satker AS satker','pantai.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_pantai AS jenis_pantai','pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai');
		$this->db->join('org_geografi AS geografi','pantai.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pantai.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pantai.id_satker', $id);
		}
		
		$this->db->where('pantai.is_active',1);
		//$this->db->group_by('pantai.id_pantai');
		$this->db->order_by('pantai.id_pantai','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pantai.*,
					satker.nama_satker,
					geografi.*,
					jenis_pantai.nama AS jenis_pantai
				FROM
					geo_pantai AS pantai
					JOIN org_satker AS satker
					ON pantai.id_satker = satker.id_satker
					JOIN mst_jenis_pantai AS jenis_pantai
					ON pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai
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
					pantai.id_geografi = geografi.id_provinsi OR
					pantai.id_geografi = geografi.id_kabupaten OR
					pantai.id_geografi = geografi.id_kecamatan OR
					pantai.id_geografi = geografi.id_kelurahan
				WHERE
					pantai.is_active = 1 AND
					pantai.id_pantai = $id
				GROUP BY
					pantai.id_pantai
				ORDER BY
					pantai.id_pantai DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }
    
    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pantai.*,
					satker.nama_satker,
					geografi.*,
					jenis_pantai.nama AS jenis_pantai
				FROM
					geo_pantai AS pantai
					JOIN org_satker AS satker
					ON pantai.id_satker = satker.id_satker
					JOIN mst_jenis_pantai AS jenis_pantai
					ON pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai
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
					pantai.id_geografi = geografi.id_provinsi OR
					pantai.id_geografi = geografi.id_kabupaten OR
					pantai.id_geografi = geografi.id_kecamatan OR
					pantai.id_geografi = geografi.id_kelurahan
				WHERE
					pantai.is_active = 1 AND
					pantai.id_satker = $id 
				GROUP BY
					pantai.id_pantai
				ORDER BY
					pantai.id_pantai DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pantai.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_pantai.nama AS jenis_pantai
				FROM
					geo_pantai AS pantai
					JOIN org_satker AS satker
					ON pantai.id_satker = satker.id_satker
					JOIN mst_jenis_pantai AS jenis_pantai
					ON pantai.id_jenis_pantai = jenis_pantai.id_jenis_pantai
					LEFT JOIN org_geografi AS geografi ON pantai.id_geografi = geografi.id_geografi
				WHERE
					pantai.is_active = 1 AND
					pantai.id_satker = $id 
				GROUP BY
					pantai.id_pantai
				ORDER BY
					pantai.id_pantai DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pantai" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pantai" => $id]);
    }
}
