<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RekapMangrove extends CI_Model
{
    private $_table = "rekap_mangrove";

    public $id_mangrove;

    public function get()
    {
		$this->db->select('mangrove.*,satker.nama_satker');
		$this->db->from("$this->_table AS mangrove");
        $this->db->join('org_satker as satker','mangrove.id_satker = satker.id_satker');
        $this->db->where('mangrove.is_active',1);
		$this->db->order_by('mangrove.id_mangrove', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('mangrove.*, satker.nama_satker, geografi.nama as nama_geografi, user1.nama_pegawai, DATE_FORMAT(mangrove.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from("$this->_table AS mangrove");
		$this->db->join('org_satker as satker','mangrove.id_satker = satker.id_satker');
		$this->db->join('org_geografi as geografi','geografi.id_geografi = mangrove.id_geografi', 'left');
		$this->db->join('mst_user AS user1','mangrove.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('mangrove.id_satker', $request['satker']);
			}
		}
        $this->db->where('mangrove.is_active',1);
		$this->db->order_by('mangrove.id_mangrove', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	public function getExport($id)
    {
		$this->db->select('mangrove.*, satker.nama_satker, geografi.nama as nama_geografi, user1.nama_pegawai, DATE_FORMAT(mangrove.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from("$this->_table AS mangrove");
		$this->db->join('org_satker as satker','mangrove.id_satker = satker.id_satker');
		$this->db->join('org_geografi as geografi','geografi.id_geografi = mangrove.id_geografi', 'left');
		$this->db->join('mst_user AS user1','mangrove.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('mangrove.id_satker', $id);
		}
        $this->db->where('mangrove.is_active',1);
		$this->db->order_by('mangrove.id_mangrove', 'desc');
		$query = $this->db->get();

		return $query->result();
	}
	
	public function byLantamalAndLanal($lantamal, $lanal)
    {
		$satker_tree_table = satker_tree_table();

		$this->db->select(' mangrove.*, satker.nama_satker, satker.nama_pimpinan, satker.id_kotama, satker.level, geografi.nama as nama_geografi ');
		$this->db->from("$this->_table AS mangrove");
		// $this->db->join('org_satker as satker','mangrove.id_satker = satker.id_satker');
		$this->db->join(
			"($satker_tree_table) as satker",
			'mangrove.id_satker = satker.id_satker',
			"inner"
		);
		$this->db->join('org_geografi as geografi','geografi.id_geografi = mangrove.id_geografi', 'left');
		if ($lantamal && $lanal) {
			$this->db->where_in('mangrove.id_satker', array($lantamal, $lanal));
		} else if ( $lantamal ) {
			$this->db->join(
				"( 
					select id_satker from org_satker where id_parent_satker=$lantamal 
					union all select $lantamal as id_satker
				) as satker_tree",
				'mangrove.id_satker = satker_tree.id_satker'
			);
		} else if ( $lanal ) {
			$this->db->where('mangrove.id_satker', $lanal);
		}
        $this->db->where('mangrove.is_active',1);
		$this->db->order_by('mangrove.id_mangrove', 'asc');
		$query = $this->db->get();

		$queryResults =  $query->result();		
		foreach ( $queryResults as $row ) {
			$row->id_satker_encrypted = encrypt($row->id_satker);
		}
		return $queryResults;
    }
    
    public function find($id)
    {
		
		$sql = "SELECT DISTINCT
			mangrove.*,
			geografi.*,
			DATE_FORMAT(mangrove.tgl_tanam,'%Y-%m-%d') as 'tgl_tanamNew',
			DATE_FORMAT(mangrove.tgl_lapor,'%Y-%m-%d') as 'tgl_laporNew'
		FROM
			rekap_mangrove AS mangrove
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
			mangrove.id_geografi = geografi.id_provinsi OR
			mangrove.id_geografi = geografi.id_kabupaten OR
			mangrove.id_geografi = geografi.id_kecamatan OR
			mangrove.id_geografi = geografi.id_kelurahan
		WHERE
			mangrove.is_active = 1 AND
			mangrove.id_mangrove = $id
		GROUP BY
			mangrove.id_mangrove";
			$query = $this->db->query($sql);
			
			return $query->row();
	}

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_mangrove" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_mangrove" => $id]);
	}
	
	public function getDataSummary($kotama, $lantamal, $lanal)
    {
		$this->db->select('
			sum(mangrove.jumlah) as jumlah_mangrove,
			count(distinct mangrove.id_geografi) as wilayah,
			count(distinct mangrove.id_satker) as satker
		');
		$this->db->from('rekap_mangrove as mangrove');

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
			'satker_tree.id_satker = mangrove.id_satker',
			'inner'
			);
		}

		$this->db->where('mangrove.is_active',1);

		return $this->db->get()->row();
	}
}
