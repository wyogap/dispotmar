<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SatuanKerja extends CI_Model
{
    private $_table = "org_satker";

    public $id_satker;

	public function satkerCountByParent($parent_id_satker = null)
    {
		$sql = "select count(satker.id_satker) as sum_satker ";

		if ( $parent_id_satker ){
			$sql .= " from ( " . 
				satker_id_by_parent($parent_id_satker) .
			") satker ";
		} else {
			$sql .= " from ( select id_satker from org_satker where is_active=1 ) satker ";
		}

		$query = $this->db->query($sql);
		
		return $query->row();		
	}

	public function treeWithGeo($parent_id_satker = null)
    {
		$sql = satker_tree_geo_table();

		if ( $parent_id_satker ){
			$sql .= " inner join ( "+ 
			satker_id_by_parent($parent_id_satker) + 
			") satker_filter ON satker_filter.id_satker=satker.id_satker ";
		}

		$query = $this->db->query($sql);
		
		$queryResults =  $query->result();		
		foreach ( $queryResults as $row ) {
			$row->id_satker_encrypted = encrypt($row->id_satker);
		}
		return $queryResults;
	}
	
	public function allTree($join_with_geografi = false, $request = null)
    {
		$satker_tree_table = "
		select 
			`kotama`.`id_satker`, kotama.nama_satker, kotama.latitude, kotama.longitude,
			kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
			null as id_lantamal, null as nama_lantamal,
			null as id_lanal, null as nama_lanal,
			1 as level
		from 
			org_satker as kotama
		where
			kotama.id_level=1 and kotama.is_active = 1 
		union all
		select 
			lantamal.id_satker, lantamal.nama_satker, lantamal.latitude, lantamal.longitude,
			kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
			lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal,
			null id_lanal, null nama_lanal,
			2 as level
		from 
			org_satker as kotama
			inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
		where
			kotama.id_level = 1 and lantamal.is_active = 1 
		union all	
		select 
			lanal.id_satker, lanal.nama_satker, lanal.latitude, lanal.longitude,
			kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
			lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal,
			lanal.id_satker id_lanal, lanal.nama_satker nama_lanal,
			3 as level
		from 
			org_satker as kotama
			inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
			inner join org_satker as lanal on lanal.id_parent_satker =lantamal.id_satker 
		where
			kotama.id_level = 1 and lanal.is_active = 1 	
		";

		if ( $join_with_geografi ) {
			$this->db->select('SATKER.*, 
			SATKER_TREE.id_kotama, SATKER_TREE.nama_kotama, 
			SATKER_TREE.id_lantamal, SATKER_TREE.nama_lantamal, 
			SATKER_TREE.id_lanal, SATKER_TREE.nama_lanal, SATKER_TREE.level, 
			GEOGRAFI.PROVINSI, 
			GEOGRAFI.KABUPATEN, 
			GEOGRAFI.KECAMATAN, 
			GEOGRAFI.KELURAHAN');	
		} else {
			$this->db->select('SATKER.*, 
			SATKER_TREE.id_kotama, SATKER_TREE.nama_kotama, 
			SATKER_TREE.id_lantamal, SATKER_TREE.nama_lantamal, 
			SATKER_TREE.id_lanal, SATKER_TREE.nama_lanal, SATKER_TREE.level');
		}

		$this->db->from('org_satker AS SATKER');
		$this->db->join(
			"($satker_tree_table) AS SATKER_TREE",
			'SATKER_TREE.id_satker = SATKER.id_satker',
			'inner'
		);
		if ( $join_with_geografi ) {
			$this->db->join('
			(SELECT DISTINCT
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','SATKER.id_geografi = GEOGRAFI.id_provinsi OR
				SATKER.id_geografi = GEOGRAFI.id_kabupaten OR
				SATKER.id_geografi = GEOGRAFI.id_kecamatan OR
				SATKER.id_geografi = GEOGRAFI.id_kelurahan','left');			
		}
		
		if ($request) {
			$parent_satker = '';
			if($request['satker']) {
				$parent_satker = $request['satker'];
			} else if ($request['kotama']) {
				$parent_satker = $request['kotama'];
			}
			if ( $parent_satker ) {
				$this->db->join("
				(
					WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker) AS
					(
					SELECT 
						id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker
					FROM 
						org_satker
					WHERE 
						id_parent_satker = $parent_satker
					UNION ALL
					SELECT 
						c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker
					FROM 
						org_satker_path AS cp 
						JOIN org_satker AS c ON cp.id_satker = c.id_parent_satker
					)
					SELECT id_satker FROM org_satker_path
					union all
					select $parent_satker 
				) AS satker_tree2",
				'satker_tree2.id_satker = SATKER.id_satker',
				'inner'
				);
			}
		}
		
		$this->db->where('SATKER.is_active',1);
		$this->db->group_by('SATKER.id_satker');
		$this->db->order_by('SATKER.id_satker','DESC');

		return $this->db->get()->result();
	}
			
	public function all($request = null)
    {
		$this->db->select('SATKER.*,
		SATKER2.nama_satker AS nama_parent_satker, 
		SATKER_LEVEL.jenis_organisasi,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN');
		$this->db->from('org_satker AS SATKER');
		$this->db->join('org_satker AS SATKER2','SATKER.id_parent_satker = SATKER2.id_satker','left');
		$this->db->join('org_level AS SATKER_LEVEL','SATKER.id_level = SATKER_LEVEL.id_level','left');
		$this->db->join('
			(SELECT DISTINCT
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','SATKER.id_geografi = GEOGRAFI.id_provinsi OR
				SATKER.id_geografi = GEOGRAFI.id_kabupaten OR
				SATKER.id_geografi = GEOGRAFI.id_kecamatan OR
				SATKER.id_geografi = GEOGRAFI.id_kelurahan','left');
		$this->db->where('SATKER.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('SATKER.id_satker', $request['satker']);
			} else if ($request['kotama']) {
				$this->db->where('SATKER.id_satker', $request['kotama']);
			}
		}
		$this->db->group_by('SATKER.id_satker');
		$this->db->order_by('SATKER.id_satker','DESC');

		return $this->db->get()->result();
	}

    public function byParent($request = null)
    {
		$this->db->select('SATKER.*,
		SATKER2.nama_satker AS nama_parent_satker, 
		SATKER_LEVEL.jenis_organisasi,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN');
		$this->db->from('org_satker AS SATKER');
		$this->db->join('org_satker AS SATKER2','SATKER.id_parent_satker = SATKER2.id_satker','left');
		$this->db->join('org_level AS SATKER_LEVEL','SATKER.id_level = SATKER_LEVEL.id_level','left');
		$this->db->join('
			(SELECT DISTINCT
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','SATKER.id_geografi = GEOGRAFI.id_provinsi OR
				SATKER.id_geografi = GEOGRAFI.id_kabupaten OR
				SATKER.id_geografi = GEOGRAFI.id_kecamatan OR
				SATKER.id_geografi = GEOGRAFI.id_kelurahan','left');
		
		if ($request) {
			$parent_satker = '';
			if($request['satker']) {
				$parent_satker = $request['satker'];
			} else if ($request['kotama']) {
				$parent_satker = $request['kotama'];
			}
			if ( $parent_satker ) {
				$this->db->join("
				(
					WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker) AS
					(
					SELECT 
						id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker
					FROM 
						org_satker
					WHERE 
						id_parent_satker = $parent_satker
					UNION ALL
					SELECT 
						c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker
					FROM 
						org_satker_path AS cp 
						JOIN org_satker AS c ON cp.id_satker = c.id_parent_satker
					)
					SELECT id_satker FROM org_satker_path
					union all
					select $parent_satker 
				) AS satker_tree",
				'satker_tree.id_satker = SATKER.id_satker',
				'inner'
				);
			}
		}
		
		$this->db->where('SATKER.is_active',1);
		$this->db->group_by('SATKER.id_satker');
		$this->db->order_by('SATKER.id_satker','DESC');

		return $this->db->get()->result();
	}
	
	public function getLevel1()
	{
		$this->db->select('SATKER.*,
		SATKER2.nama_satker AS nama_parent_satker, 
		SATKER_LEVEL.jenis_organisasi');
		$this->db->from('org_satker AS SATKER');
		$this->db->join('org_satker AS SATKER2','SATKER.id_parent_satker = SATKER2.id_satker','left');
		$this->db->join('org_level AS SATKER_LEVEL','SATKER.id_level = SATKER_LEVEL.id_level','inner');
		$this->db->where('SATKER.id_level','1');
		$this->db->where('SATKER.is_active','1');
		$this->db->order_by('SATKER.sequence','ASC');

		return $this->db->get()->result();
	}

	public function getByLevelAndParent($level, $request = null)
	{
		$kotama_id = array_key_exists('kotama', $this->input->get()) ? $this->input->get()['kotama']:null ;
		$lantamal_id = array_key_exists('lantamal', $this->input->get()) ? $this->input->get()['lantamal']:null;
		if ( $level == 1 ) {
			$this->db->select('org_satker.*');
			$this->db->from('org_satker');
			$this->db->where('org_satker.id_level',$level);	
		} else if ( $level == 2 ) {
			$this->db->select('org_satker.*');
			$this->db->from('org_satker');
			$this->db->where('org_satker.id_level',$level);	
			if ($kotama_id) {
				$this->db->where('org_satker.id_parent_satker',$kotama_id);
			}	
		} else if ( $level == 3 ) {
			$this->db->select('org_satker.*');
			$this->db->from('org_satker');
			$this->db->where('org_satker.id_level',$level);	
			if ($lantamal_id) {
				$this->db->where('org_satker.id_parent_satker',$lantamal_id);
			} else if ($kotama_id) {
				$this->db->join('org_satker AS kotama','org_satker.id_parent_satker = kotama.id_satker','inner');
				$this->db->where('kotama.id_parent_satker',$kotama_id);
			}
		} else {
			$this->db->select('org_satker.*');
			$this->db->from('org_satker');
			$this->db->where('org_satker.id_level',$level);	
		}

		$this->db->where('org_satker.is_active','1');
		//$this->db->order_by('org_satker.nama_satker','ASC');
		$this->db->order_by('org_satker.sequence','ASC');

		return $this->db->get()->result();
	}


	public function getLevel2And3($request = null)
    {
		$sql = "WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker,kode_satker, sequence) AS
		(
		  SELECT id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker,kode_satker, sequence
			FROM org_satker
			WHERE id_parent_satker IS NULL OR id_parent_satker=0
		  UNION ALL
		  SELECT c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker,c.kode_satker, c.sequence
			FROM org_satker_path AS cp JOIN org_satker AS c
			  ON cp.id_satker = c.id_parent_satker
			WHERE c.is_active = 1
		)
		SELECT * FROM org_satker_path
		WHERE id_level in('2','3')
		";

		if ($request) {
			if(array_key_exists('kotama', $request) && $request['kotama']) {
				$sql = $sql . " AND top_id_satker = " . $request['kotama'];
			}
			// else if(array_key_exists('satker', $request) && $request['satker']) {
			// 	$sql = $sql . " AND top_id_satker = " . $request['satker'];
			// }
		}
		//$sql = $sql . " ORDER BY id_level ASC, nama_satker ASC; ";
		$sql = $sql . " ORDER BY sequence asc;";
		// 
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function getLevel2And3_forExportData($kotama)
    {
		$sql = "WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker,kode_satker, sequence) AS
		(
		  SELECT id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker,kode_satker, sequence
			FROM org_satker
			WHERE id_parent_satker IS NULL OR id_parent_satker=0
		  UNION ALL
		  SELECT c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker,c.kode_satker, c.sequence
			FROM org_satker_path AS cp JOIN org_satker AS c
			  ON cp.id_satker = c.id_parent_satker
			WHERE c.is_active = 1
		)
		SELECT * FROM org_satker_path
		WHERE id_level in('2','3')
		";

		if ($kotama != 0) {
				$sql = $sql . " AND top_id_satker = " . $kotama;
		}
		//$sql = $sql . " ORDER BY id_level ASC, nama_satker ASC; ";
		$sql = $sql . " ORDER BY sequence asc;";
		// 
		$query = $this->db->query($sql);
		
		return $query->result();
	}

    public function getLevel2($request = null)
    {
		$sql = "WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker,kode_satker) AS
		(
		  SELECT id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker,kode_satker
			FROM org_satker
			WHERE id_parent_satker IS NULL OR id_parent_satker=0
		  UNION ALL
		  SELECT c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker,c.kode_satker
			FROM org_satker_path AS cp JOIN org_satker AS c
			  ON cp.id_satker = c.id_parent_satker
		)
		SELECT * FROM org_satker_path
		WHERE id_level in('2')
		";

		if ($request) {
			if(array_key_exists('kotama', $request) && $request['kotama']) {
				$sql = $sql . "AND top_id_satker = " . $request['kotama'];
			}
		}
		$sql = $sql . " ORDER BY id_level ASC, nama_satker ASC; ";
		// 
		$query = $this->db->query($sql);
		
		return $query->result();
    }
    public function getLevel3($request = null)
    {
		$sql = "WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker,kode_satker) AS
		(
		  SELECT id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker,kode_satker
			FROM org_satker
			WHERE id_parent_satker IS NULL OR id_parent_satker=0
		  UNION ALL
		  SELECT c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker,c.kode_satker
			FROM org_satker_path AS cp JOIN org_satker AS c
			  ON cp.id_satker = c.id_parent_satker
		)
		SELECT * FROM org_satker_path
		WHERE id_level in('3')
		";

		if ($request) {
			if(array_key_exists('kotama', $request) && $request['kotama']) {
				$sql = $sql . "AND top_id_satker = " . $request['kotama'];
			}
		}
		$sql = $sql . " ORDER BY id_level ASC, nama_satker ASC; ";
		// 
		$query = $this->db->query($sql);
		
		return $query->result();
    }

	public function get($request = null)
	{
		$this->db->select('SATKER.*,
		SATKER2.nama_satker AS nama_parent_satker, 
		SATKER_LEVEL.jenis_organisasi,
		user1.nama_pegawai,
		DATE_FORMAT(SATKER.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('org_satker AS SATKER');
		$this->db->join('org_satker AS SATKER2','SATKER.id_parent_satker = SATKER2.id_satker','left');
		$this->db->join('org_level AS SATKER_LEVEL','SATKER.id_level = SATKER_LEVEL.id_level','left');
		$this->db->join('mst_user AS user1','SATKER.updated_by = user1.id_user','left');
		$this->db->where('SATKER.is_active','1');
		if ($request) {
			if($request['satker']) {
				$this->db->where('SATKER.id_satker', $request['satker']);
			}
		}
		$this->db->group_by('SATKER.id_satker');
		$this->db->order_by('SATKER.nama_satker','ASC');

		return $this->db->get()->result();

	}

	public function getExport($id)
	{
		$this->db->select('SATKER.*,
		SATKER2.nama_satker AS nama_parent_satker, 
		SATKER_LEVEL.jenis_organisasi,
		user1.nama_pegawai,
		DATE_FORMAT(SATKER.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('org_satker AS SATKER');
		$this->db->join('org_satker AS SATKER2','SATKER.id_parent_satker = SATKER2.id_satker','left');
		$this->db->join('org_level AS SATKER_LEVEL','SATKER.id_level = SATKER_LEVEL.id_level','left');
		$this->db->join('mst_user AS user1','SATKER.updated_by = user1.id_user','left');
		$this->db->where('SATKER.is_active','1');
		if ($id != 0) {
			$this->db->where('SATKER.id_satker', $id);
		}
		$this->db->group_by('SATKER.id_satker');
		$this->db->order_by('SATKER.nama_satker','ASC');

		return $this->db->get()->result();

	}
    
    public function getLevel($level)
    {
        $this->db->select('*');
        $this->db->from('org_satker as A');
        $this->db->join('org_level as B','A.id_level = B.id_level','LEFT');
        $this->db->where('A.is_active',1);
        $this->db->where('B.level',$level);
        $this->db->order_by('id_satker', 'DESC');
        
		$query = $this->db->get();

		return $query->result();
        // return $this->db->get_where($this->_table, ["level" => $level])->row();
	}
	
	public function getRankSatker()
	{
		$this->db->select("COUNT(activity.id_satker) AS total, satker.nama_satker, activity.id_satker");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->where('activity.is_active',1);
		$this->db->group_by('activity.id_satker');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}
	
	public function getRankPersonel()
	{
		$this->db->select("COUNT(activity.created_by) AS total, who, users.id_user, users.nama_pegawai");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('mst_user AS users', 'activity.created_by = users.id_user');
		$this->db->where('activity.is_active',1);
		$this->db->group_by('activity.created_by');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					SATKER.*,
					SATKER2.nama_satker AS nama_parent_satker, 
					SATKER_LEVEL.jenis_organisasi,
					SATKER_LEVEL.level,
					GEOGRAFI.*
				FROM
					org_satker AS SATKER
					LEFT JOIN org_satker AS SATKER2
						ON SATKER.id_parent_satker = SATKER2.id_satker 
					LEFT JOIN org_level AS SATKER_LEVEL
						ON SATKER.id_level = SATKER_LEVEL.id_level
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
									KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI
				ON
					SATKER.id_geografi = GEOGRAFI.id_provinsi OR
					SATKER.id_geografi = GEOGRAFI.id_kabupaten OR
					SATKER.id_geografi = GEOGRAFI.id_kecamatan OR
					SATKER.id_geografi = GEOGRAFI.id_kelurahan
				WHERE
					SATKER.is_active = 1 AND
					SATKER.id_satker = $id
				GROUP BY
					SATKER.id_satker
				ORDER BY SATKER.id_satker DESC";
		$query = $this->db->query($sql);
		
		return $query->row();
        // return $this->db->get_where($this->_table, ["id_satker" => $id,"is_active" => 1])->row();
	}
	
	public function findByIdSatker($idSatker)
    {
		$this->db->select('satker.*');
		$this->db->from('org_satker AS satker');
		$this->db->where('satker.id_satker',$idSatker);

		return $this->db->get()->row();
    }

    public function checkSatker($id)
    {
        return $this->db->get_where($this->_table, ["id_parent_satker" => $id])->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_satker" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_satker" => $id]);
        // return $this->db->delete($this->_table, ["id_satker" => $id]);
	}

	public function getLatLong_byIdSatker($id)
	{
		$this->db->where('id_satker ', $id);
		$this->db->where('is_active',1);
		return $this->db->get($this->_table)->result();
	}
	
	public function do_upload()
	{
			$config['upload_path']          = './uploads/satker/sampul/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_name']            = uniqid();
			//$config['max_size']             = 2000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!empty($_FILES["gambarsampul"]["name"])) {
				if ($this->upload->do_upload('gambarsampul'))
				{
					return $this->upload->data('file_name');
				}
	
				return $this->upload->display_errors();
			} else {
				return "null.jpg";
			}
	}

	public function do_upload1()
	{
			$config['upload_path']          = './uploads/satker/sampul/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_name']            = uniqid();
			// $config['max_size']             = 20000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!empty($_FILES["gambarsampul"]["name"])) {
				if ($this->upload->do_upload('gambarsampul'))
				{
					// return $this->upload->data('file_name');
					$gbr = $this->upload->data();
					//Compress Image
					$config['image_library']='gd2';
					$config['source_image']='./uploads/satker/sampul/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '20%';
					$config['width']= 600;
                	$config['height']= 400;
					$config['new_image']= './uploads/satker/sampul/'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					return $gbr['file_name'];
				}

				return $this->upload->display_errors();
			} else {
				return "null.jpg";
			}
	}
}
