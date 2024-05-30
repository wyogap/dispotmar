<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class KomoditasPangan extends CI_Model
{
    private $_table = "mst_pangan_komoditas";

    public $id_komoditas;

    public function get($order = null)
    {
		$this->db->select('A.*,B.nama_cluster, satuan.nama_satuan, user1.nama_pegawai, DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->join('mst_cluster AS B','A.id_cluster = B.id_cluster');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
		$this->db->join('mst_satuan AS satuan','A.id_satuan = satuan.id_satuan','left');
		$this->db->where('A.is_active',1);
		if ($order) {
			$this->db->order_by('A.' . $order->column, $order->direction);
		} else {
			$this->db->order_by('A.id_komoditas', 'DESC');
		}
        return $this->db->get("$this->_table AS A")->result();
    }

	public function getExport()
    {
		$this->db->select('A.*,B.nama_cluster, user1.nama_pegawai, DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->join('mst_cluster AS B','A.id_cluster = B.id_cluster');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
		$this->db->where('A.is_active',1);
		$this->db->order_by('A.id_komoditas', 'DESC');
		return $this->db->get("$this->_table AS A")->result();
    }

    public function getNocluster($order = null)
    {
		$this->db->distinct();
		$this->db->select('A.*');
		$this->db->where('A.is_active',1);
		if ($order) {
			$this->db->order_by('A.' . $order->column, $order->direction);
		} else {
			$this->db->order_by('A.id_komoditas', 'DESC');
		}
        return $this->db->get("$this->_table AS A")->result();
	}
	
	public function getByCluster($cluster)
    {
		$this->db->select('A.*,B.nama_cluster');
		$this->db->join('mst_cluster AS B','A.id_cluster = B.id_cluster');
        $this->db->where('B.id_cluster',$cluster);
        $this->db->where('A.is_active',1);
        $this->db->order_by('A.id_komoditas', 'DESC');
        return $this->db->get("$this->_table AS A")->result();
    }

    public function checkKomoditas($id)
    {
		$this->db->where('id_komoditas', $id);
		return $this->db->get('rekap_pangan')->result();
	}
	
	public function getKomoditas($id)
	{
		$this->db->where('id_cluster', $id);
		$this->db->where('is_active',1);
		return $this->db->get($this->_table)->result();
	}
	
	public function getComodityResultByParentSatkerGroupBySatker($request = null)
	{
		$tmtStart = '';$tmtEnd = '';$panenStart = '';$panenEnd = '';
		if ($request) {
			if ($request['tmt']) {
				$tmtStart = explode(' ',$request['tmt'])[0];
				$tmtEnd = explode(' ',$request['tmt'])[2];
			}
			if ($request['panen']) {
				$panenStart = explode(' ',$request['panen'])[0];
				$panenEnd = explode(' ',$request['panen'])[2];
			}
		}

		$this->db->select('pangan.id_satker, SUM(pangan.estimasi_hasil) AS total');
		$this->db->from('rekap_pangan AS pangan');
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
				'satker_tree.id_satker = pangan.id_satker',
				'inner'
				);
			}


			if ($request['progres']) {
				$this->db->where('pangan.id_progres',$request['progres']);
			}

			if ($request['komoditas']) {
				$this->db->where('pangan.id_komoditas',$request['komoditas']);
			}

			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('pangan.id_satker');
        return $this->db->get()->result();
    }
    public function getComodityResultByParentSatkerGroupBySatkerNew($request = null)
	{
		$this->db->distinct();
		$this->db->select('komi.id_komoditas, komi.nama_komoditas ');
		$this->db->from('rekap_pangan AS pangan');
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
				'satker_tree.id_satker = pangan.id_satker',
				'inner'
				);
			}			
		}
		$this->db->join(" (select id_komoditas,nama_komoditas from mst_pangan_komoditas where is_active = 1  )as komi "
				,'komi.id_komoditas = pangan.id_komoditas','inner');
		$this->db->order_by('pangan.id_satker ASC,pangan.id_komoditas ASC, komi.nama_komoditas ASC');
        return $this->db->get()->result();
    }

	public function getComodityResultByParentSatker($request = null)
	{
		$tmtStart = '';$tmtEnd = '';$panenStart = '';$panenEnd = '';
		if ($request) {
			if ($request['tmt']) {
				$tmtStart = explode(' ',$request['tmt'])[0];
				$tmtEnd = explode(' ',$request['tmt'])[2];
			}
			if ($request['panen']) {
				$panenStart = explode(' ',$request['panen'])[0];
				$panenEnd = explode(' ',$request['panen'])[2];
			}
		}

		$this->db->select('SUM(pangan.estimasi_hasil) AS total, komoditas.nama_komoditas, mst_satuan.nama_satuan ');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('mst_satuan','pangan.id_satuan = mst_satuan.id_satuan');
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
				'satker_tree.id_satker = pangan.id_satker',
				'inner'
				);
			}


			if ($request['progres']) {
				$this->db->where('pangan.id_progres',$request['progres']);
			}

			if ($request['komoditas']) {
				$this->db->where('pangan.id_komoditas',$request['komoditas']);
			}

			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->where('pangan.is_active',1);
		$this->db->group_by('komoditas.id_komoditas');
        return $this->db->get()->result();
    }
    
	public function getComodityResult($request = null)
	{
		$tmtStart = '';$tmtEnd = '';$panenStart = '';$panenEnd = '';
		if ($request) {
			if ($request['tmt']) {
				$tmtStart = explode(' ',$request['tmt'])[0];
				$tmtEnd = explode(' ',$request['tmt'])[2];
			}
			if ($request['panen']) {
				$panenStart = explode(' ',$request['panen'])[0];
				$panenEnd = explode(' ',$request['panen'])[2];
			}
		}

		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, komoditas.nama_komoditas, mst_satuan.nama_satuan, komoditas.id_komoditas ');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('mst_satuan','pangan.id_satuan = mst_satuan.id_satuan');
		if ($request) {
			
			// else if ( $request['kotama'] ) {
			// 	$this->db->where('pangan.id_satker',$request['kotama']);
			// }
			if ($request['progres']) {
				$this->db->where('pangan.id_progres',$request['progres']);
			}
			if($request['satker']) {
			 	$this->db->where('pangan.id_satker',$request['satker']);
			}
			if ($request['komoditas']) {
				$this->db->where('pangan.id_komoditas',$request['komoditas']);
			}

			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		//$this->db->group_by('komoditas.id_komoditas , mst_satuan.nama_satuan');
		$this->db->where("pangan.is_active",1);
		$this->db->group_by('komoditas.id_komoditas');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
        return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$this->db->select('A.*,B.nama_cluster');
		$this->db->join('mst_cluster AS B','A.id_cluster = B.id_cluster');
        $this->db->where('A.is_active',1);
        $this->db->where('A.id_komoditas',$id);
        return $this->db->get("$this->_table AS A")->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_komoditas" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_komoditas" => $id]);
    }
}
