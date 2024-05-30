<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RekapPangan extends CI_Model
{
    private $_table = "rekap_pangan";

    public $id_rekap_pangan;

	public function getByParentSatker($request = null)
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

		$this->db->select('pangan.*,
						COUNT(pangan.id_satker) AS totalSatker,
						COUNT(pangan.id_komoditas) AS totalKomoditas,
						SUM(pangan.luas_lahan) AS totalLuas,
						satker.nama_satker,
						satuan.nama_satuan,
						statuslahan.nama_statuslahan,
						progres.nama_progres,
						komoditas.nama_komoditas');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->where('pangan.is_active',1);
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

			if($request['progres']) {
				$this->db->where('pangan.id_progres', $request['progres']);
			}
			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->order_by('pangan.id_rekap_pangan','DESC');
		return $this->db->get("$this->_table AS pangan")->result();
	}
	
	public function getSummaryLahanByParentSatker($request = null)
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

		$this->db->select('
			SUM(pangan.luas_lahan) AS sum_pangan_luas_lahan,
			SUM(lahanTidur.lahan_tidur) AS sum_lahan_tidur
		');
		$this->db->join("rekap_lahan_tidur as lahanTidur", "lahanTidur.id_satker=pangan.id_satker", "left");
		$this->db->where('pangan.is_active',1);
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

			if($request['progres']) {
				$this->db->where('pangan.id_progres', $request['progres']);
			}
			if($request['komoditas']) {
				$this->db->where('pangan.id_komoditas', $request['komoditas']);
			}
			
			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		return $this->db->get("$this->_table AS pangan")->result();
	}
	
	public function getSummary($request = null)
    {

		$this->db->select('
						COUNT(distinct pangan.id_satker) AS totalSatker,
						COUNT(distinct pangan.id_komoditas) AS totalKomoditas
						');
		$this->db->from('rekap_pangan as pangan');

		if ($request) {
			$tmtStart = '';
			$tmtEnd = '';
			$panenStart = '';
			$panenEnd = '';
			$komoditas = '';
			$progres = '';
			$parent_satker = '';
	
			if ($request['tmt']) {
				$tmtStart = explode(' ',$request['tmt'])[0];
				$tmtEnd = explode(' ',$request['tmt'])[2];
			}
			if ($request['panen']) {
				$panenStart = explode(' ',$request['panen'])[0];
				$panenEnd = explode(' ',$request['panen'])[2];
			}
			if($request['komoditas']) {
				$komoditas = $request['komoditas'];
			}
			if($request['progres']) {
				$progres = $request['progres'];
			}

			if($request['satker']) {
				$parent_satker = $request['satker'];
			} else if ($request['kotama']) {
				$parent_satker = $request['kotama'];
			}

			// $params = [
			// 	'tmtStar' => $tmtStart,
			// 	'tmtEnd' => $tmtEnd,
			// 	'panenStart' => $panenStart,
			// 	'panenEnd' => $panenEnd,
			// 	'komoditas' => $komoditas,
			// 	'progres' => $progres,
			// 	'parent_satker' => $parent_satker
			// ];
			// var_dump($params);

			if($komoditas) {
				$this->db->where('pangan.id_komoditas', $komoditas);
			}

			if($progres) {
				$this->db->where('pangan.id_progres', $progres);
			}

			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}

			if ($parent_satker){
				$satker_id_by_parent = satker_id_by_parent($parent_satker);
				$this->db->join(" ($satker_id_by_parent) AS satker",'pangan.id_satker = satker.id_satker');
			}

		}
		return $this->db->get()->row();
    }

    public function get($request = null)
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

		$this->db->select('pangan.*,
						COUNT(pangan.id_satker) AS totalSatker,
						COUNT(pangan.id_komoditas) AS totalKomoditas,
						SUM(pangan.luas_lahan) AS totalLuas,
						satker.nama_satker,
						satuan.nama_satuan,
						statuslahan.nama_statuslahan,
						progres.nama_progres,
						komoditas.nama_komoditas');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->where('pangan.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('pangan.id_satker', $request['satker']);
			}
			if($request['progres']) {
				$this->db->where('pangan.id_progres', $request['progres']);
			}
			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->order_by('pangan.id_rekap_pangan','DESC');
		return $this->db->get("$this->_table AS pangan")->result();
    }

    public function get2($request = null)
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

		$this->db->select('pangan.*,
						satker.nama_satker,
						satuan.nama_satuan,
						statuslahan.nama_statuslahan,
						progres.nama_progres,
						komoditas.nama_komoditas');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->where('pangan.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('pangan.id_satker', $request['satker']);
			}
			if($request['komoditas']) {
				$this->db->where('pangan.id_komoditas', $request['komoditas']);
			}
			if($request['progres']) {
				$this->db->where('pangan.id_progres', $request['progres']);
			}
			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('pangan.id_rekap_pangan');
		$this->db->order_by('pangan.id_rekap_pangan','DESC');
		return $this->db->get("$this->_table AS pangan")->result();
    }

    public function mapping($request = null)
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
		
		$this->db->select('pangan.*,
						satker.nama_satker,
						satuan.nama_satuan,
						statuslahan.nama_statuslahan,
						progres.nama_progres,
						komoditas.nama_komoditas,
						GEOGRAFI.PROVINSI, 
						GEOGRAFI.KABUPATEN, 
						GEOGRAFI.KECAMATAN, 
						GEOGRAFI.KELURAHAN');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','pangan.id_geografi = GEOGRAFI.id_provinsi OR
			pangan.id_geografi = GEOGRAFI.id_kabupaten OR
			pangan.id_geografi = GEOGRAFI.id_kecamatan OR
			pangan.id_geografi = GEOGRAFI.id_kelurahan','left');
		$this->db->where('pangan.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('pangan.id_satker', $request['satker']);
			}
			if($request['progres']) {
				$this->db->where('pangan.id_progres', $request['progres']);
			}
			if ($tmtStart && $tmtEnd) {
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panenStart && $panenEnd) {
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('pangan.id_rekap_pangan');
		$this->db->order_by('pangan.id_rekap_pangan','DESC');
		return $this->db->get("$this->_table AS pangan")->result();
    }

    public function list($request = null)
    {
			$this->db->select('pangan.*,
							satker.nama_satker,
							satuan.nama_satuan,
							statuslahan.nama_statuslahan,
							progres.nama_progres,
							komoditas.nama_komoditas,
							GEOGRAFI.PROVINSI, 
							GEOGRAFI.KABUPATEN, 
							GEOGRAFI.KECAMATAN, 
							GEOGRAFI.KELURAHAN');
			$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
			$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
			$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
			$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
			$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','pangan.id_geografi = GEOGRAFI.id_provinsi OR
				pangan.id_geografi = GEOGRAFI.id_kabupaten OR
				pangan.id_geografi = GEOGRAFI.id_kecamatan OR
				pangan.id_geografi = GEOGRAFI.id_kelurahan','left');
			$this->db->where('pangan.is_active',1);
			if ($request) {
				if($request['satker']) {
					$this->db->where('pangan.id_satker', $request['satker']);
				}
			}
			$this->db->group_by('pangan.id_rekap_pangan');
			$this->db->order_by('pangan.id_rekap_pangan','DESC');
			return $this->db->get("$this->_table AS pangan")->result();
    }
	
	public function listnew($request = null)
    {
		$satker = $request['satker'];

			$this->db->select('pangan.*,
							cluster.nama_cluster,
							satker.nama_satker,
							satuan.nama_satuan,
							satuan2.nama_satuan as nama_satuan2,
							statuslahan.nama_statuslahan,
							progres.nama_progres,
							komoditas.nama_komoditas,
							GEOGRAFI.nama as PROVINSI,
							DATE_FORMAT(pangan.tmt, "%d/%m/%Y") as tmt_,
							DATE_FORMAT(pangan.estimasi_panen, "%d/%m/%Y") as estimasi_panen_,
							DATE_FORMAT(pangan.created_date, "%d/%m/%Y") as createddate,
							user1.nama_pegawai,
							DATE_FORMAT(pangan.updated_date, "%d/%m/%Y") as LastUpdated');
			$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
			$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan','left');
			$this->db->join('mst_satuan AS satuan2','pangan.id_satuan2 = satuan2.id_satuan','left');
			$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
			$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
			$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
			$this->db->join('org_geografi AS GEOGRAFI','pangan.id_geografi = GEOGRAFI.id_geografi','left');
			$this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster ','left');
			$this->db->join('mst_user AS user1','pangan.updated_by = user1.id_user','left');
			$this->db->where('pangan.is_active',1);
			
			// if ($satker && $startDate && $finishDate) {
			// 	$this->db->where('pangan.id_satker',$satker);
			// 	$this->db->where("date_format(pangan.estimasi_panen, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
			// }else if ($startDate && $finishDate) {
			// 	$this->db->where("date_format(pangan.estimasi_panen, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
			// }else if($satker){
			// 	$this->db->where('pangan.id_satker',$satker);
			// }
			
			if($satker){
				$this->db->where('pangan.id_satker',$satker);
			}

			if ($request) {
				$tmtStart = '';
				$tmtEnd = '';
				$panenStart = '';
				$panenEnd = '';
		
				if ($request['tmt']) {
					$tmtStart = explode(' ',$request['tmt'])[0];
					$tmtEnd = explode(' ',$request['tmt'])[2];
				}
				if ($request['panen']) {
					$panenStart = explode(' ',$request['panen'])[0];
					$panenEnd = explode(' ',$request['panen'])[2];
				}
			
				
				if ($tmtStart && $tmtEnd) {
					$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
				}
				if ($panenStart && $panenEnd) {
					$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
				}
			}

			$this->db->group_by('pangan.id_rekap_pangan');
			$this->db->order_by('pangan.id_rekap_pangan','DESC');
			return $this->db->get("$this->_table AS pangan")->result();
	}
	
	public function getExport($id)
    {
			$this->db->select('pangan.*,
							cluster.nama_cluster,
							satker.nama_satker,
							satuan.nama_satuan,
							satuan2.nama_satuan as nama_satuan2,
							statuslahan.nama_statuslahan,
							progres.nama_progres,
							komoditas.nama_komoditas,
							GEOGRAFI.nama as PROVINSI,
							DATE_FORMAT(pangan.tmt, "%d/%m/%Y") as tmt_,
							DATE_FORMAT(pangan.estimasi_panen, "%d/%m/%Y") as estimasi_panen_,
							user1.nama_pegawai,
							DATE_FORMAT(pangan.updated_date, "%d/%m/%Y") as LastUpdated');
			$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
			$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan','left');
			$this->db->join('mst_satuan AS satuan2','pangan.id_satuan2 = satuan2.id_satuan','left');
			$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
			$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
			$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
			$this->db->join('org_geografi AS GEOGRAFI','pangan.id_geografi = GEOGRAFI.id_geografi','left');
			$this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster ','left');
			$this->db->join('mst_user AS user1','pangan.updated_by = user1.id_user','left');
			$this->db->where('pangan.is_active',1);
			
			if ($id != 0) {
				$this->db->where('pangan.id_satker', $id);
			}

			$this->db->group_by('pangan.id_rekap_pangan');
			$this->db->order_by('pangan.id_rekap_pangan','DESC');
			return $this->db->get("$this->_table AS pangan")->result();
    }

    public function find($id)
    {
		// $this->db->select('pangan.*,
		// 				satker.nama_satker,
		// 				satuan.nama_satuan,
		// 				statuslahan.nama_statuslahan,
		// 				progres.nama_progres,
		// 				komoditas.nama_komoditas,
		// 				cluster.id_cluster,
		// 				cluster.nama_cluster');
		// $this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		// $this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		// $this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		// $this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		// $this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		// $this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster');
		// $this->db->where('pangan.is_active',1);
		// $this->db->where('pangan.id_rekap_pangan',$id);

		// return $this->db->get("$this->_table AS pangan")->row();

		$sql = "SELECT DISTINCT
		pangan.*,
		satker.nama_satker,
		satuan.nama_satuan,
		statuslahan.nama_statuslahan,
		progres.nama_progres,
		komoditas.nama_komoditas,
		cluster.id_cluster,
		cluster.nama_cluster,
							geografi.*
						FROM
							rekap_pangan AS pangan
						JOIN org_satker AS satker
							ON pangan.id_satker = satker.id_satker 
						JOIN mst_satuan AS satuan
							ON pangan.id_satuan = satuan.id_satuan 
						JOIN mst_pangan_statuslahan AS statuslahan
							ON pangan.id_pangan_status = statuslahan.id_statuslahan 
						JOIN mst_pangan_progres AS progres
							ON pangan.id_progres = progres.id_progres 
						JOIN mst_pangan_komoditas AS komoditas
							ON pangan.id_komoditas = komoditas.id_komoditas 
						JOIN mst_cluster AS cluster
							ON komoditas.id_cluster = cluster.id_cluster 
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
							pangan.id_geografi = geografi.id_provinsi OR
							pangan.id_geografi = geografi.id_kabupaten OR
							pangan.id_geografi = geografi.id_kecamatan OR
							pangan.id_geografi = geografi.id_kelurahan
						WHERE
							pangan.is_active = 1 AND
							pangan.id_rekap_pangan = $id
						GROUP BY
							pangan.id_rekap_pangan
						ORDER BY pangan.id_rekap_pangan DESC";
		$query = $this->db->query($sql);
		
		return $query->row();
	}

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_rekap_pangan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_rekap_pangan" => $id]);
	}
	
	public function createHistory($id)
	{
		$this->db->select('pangan.*,
						satker.nama_satker,
						satuan.nama_satuan,
						statuslahan.nama_statuslahan,
						progres.nama_progres,
						komoditas.nama_komoditas,
						cluster.nama_cluster');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('mst_satuan AS satuan','pangan.id_satuan = satuan.id_satuan');
		$this->db->join('mst_pangan_statuslahan AS statuslahan','pangan.id_pangan_status = statuslahan.id_statuslahan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster');
		$this->db->where('pangan.is_active',1);
		$this->db->where('pangan.id_rekap_pangan',$id);
		$data = $this->db->get("$this->_table AS pangan")->row();

		return $this->db->insert('rekap_pangan_history', [
			'id_rekap_pangan' 	=> $id,
			'luas_lahan' 		=> $data->luas_lahan,
			'tmt' 				=> $data->tmt,
			'estimasi_panen' 	=> $data->estimasi_panen,
			'estimasi_hasil' 	=> $data->estimasi_hasil,
			'satuan' 			=> $data->nama_satuan,
			'status' 			=> $data->nama_statuslahan,
			'keterangan' 		=> $data->keterangan,
			'progress' 			=> $data->nama_progres,
			'cluster' 			=> $data->nama_cluster,
			'komoditas' 		=> $data->nama_komoditas,
			'latitude' 			=> $data->latitude,
			'longitude' 		=> $data->longitude,
			'id_geografi' 		=> $data->id_geografi
		]);
	}
	
    public function getHistory($id)
    {
		$this->db->where('rekap_pangan_history.id_rekap_pangan',$id);

		return $this->db->get("rekap_pangan_history")->result();
	}
	
	public function do_upload()
	{
			$config['upload_path']          = './uploads/rekappangan/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_name']            = uniqid();
			// $config['max_size']             = 20000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!empty($_FILES["gambar"]["name"])) {
				if ($this->upload->do_upload('gambar'))
				{
					// return $this->upload->data('file_name');
					$gbr = $this->upload->data();
					//Compress Image
					$config['image_library']='gd2';
					$config['source_image']='./uploads/rekappangan/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '20%';
					$config['width']= 600;
                	$config['height']= 400;
					$config['new_image']= './uploads/rekappangan/'.$gbr['file_name'];
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
