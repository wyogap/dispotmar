<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pelaporan extends CI_Model
{
    private $_table = "rekap_activity_sosial";

    public $id_activity_sosial;

    public function all($request=null)
    {
		$startDate = $request['startDate'];
		$finishDate = $request['finishDate'];

		$this->db->select('activity.*,satker.nama_satker,jenis.nama_jenis,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN');
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI',
				'activity.id_geografi = GEOGRAFI.id_provinsi OR
				activity.id_geografi = GEOGRAFI.id_kabupaten OR
				activity.id_geografi = GEOGRAFI.id_kecamatan OR
				activity.id_geografi = GEOGRAFI.id_kelurahan','left');
		if ($satker = $request['satker']) {
			$this->db->where('activity.id_satker',$satker);
		}else if ($startDate && $finishDate) {
			$this->db->where("activity.`when` BETWEEN '$startDate' AND '$finishDate'", null, false);
		}

        $this->db->where('activity.is_active',1);
		$this->db->group_by('activity.id_activity_sosial');
		$this->db->order_by('activity.id_activity_sosial', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
	
	public function getDataPagination($request = null,$limit, $offset)
	{
		$this->db->select('activity.*,satker.nama_satker,jenis.nama_jenis, users.nama_pegawai,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN');
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
		$this->db->join('mst_user AS users', 'activity.created_by = users.id_user');
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI',
				'activity.id_geografi = GEOGRAFI.id_provinsi OR
				activity.id_geografi = GEOGRAFI.id_kabupaten OR
				activity.id_geografi = GEOGRAFI.id_kecamatan OR
				activity.id_geografi = GEOGRAFI.id_kelurahan','left');
		$this->db->limit($limit, $offset-1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('activity.id_satker', $request['satker']);
			}
		}
        $this->db->where('activity.is_active',1);
		$this->db->group_by('activity.id_activity_sosial');
		$this->db->order_by('activity.id_activity_sosial', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

    public function criminals($request = null)
    {
		$finishDate = date('Y-m-d H:i:s');
		$startDate = date('Y-m-d H:i:s', strtotime("-3 month"));

		$this->db->select('Count(activity.id_activity_sosial) as total, activity.*,satker.nama_satker,jenis.nama_jenis,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN');
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI',
				'activity.id_geografi = GEOGRAFI.id_provinsi OR
				activity.id_geografi = GEOGRAFI.id_kabupaten OR
				activity.id_geografi = GEOGRAFI.id_kecamatan OR
				activity.id_geografi = GEOGRAFI.id_kelurahan','left');
		$this->db->where('jenis.nama_jenis','Kerawanan Sosial');
		// if ($request) {
		// 	if($request['satker']) {
		// 		$this->db->where('activity.id_satker', $request['satker']);
		// 	}
		// }
        $this->db->where('activity.is_active',1);
        $this->db->where("activity.created_date BETWEEN '$startDate' AND '$finishDate'", null, false);
		$this->db->group_by('activity.id_activity_sosial');
		$this->db->order_by('activity.id_activity_sosial', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
	
	public function getRankCriminals()
	{
		$this->db->select("COUNT(activity.id_satker) AS total, activity.id_satker, activity.id_activity_jenis, satker.nama_satker, jenis.nama_jenis");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
		$this->db->where('activity.is_active',1);
		$this->db->where('jenis.nama_jenis','Kerawanan Sosial');
		$this->db->group_by('activity.id_satker');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}

    public function get($request=null)
    {
        if ($request == null) {
            $startDate = null;
            $finishDate = null;
            $satker = null;
        }
        else {
            $startDate = $request['startDate'] ?: null;
            $finishDate = $request['finishDate'] ?: null;
            $satker = $request['satker'];
        }

		$this->db->select('A.*,B.nama_satker,C.nama_jenis,D.nama_pegawai,DATE_FORMAT(A.created_date, "%d/%m/%Y") as createddate,user1.nama_pegawai,DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('rekap_activity_sosial AS A');
		$this->db->join('org_satker AS B', 'A.id_satker = B.id_satker');
		$this->db->join('mst_activity_jenis AS C', 'A.id_activity_jenis = C.id_activity_jenis');
		$this->db->join('mst_user AS D', 'A.created_by = D.id_user');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');

		if ($satker && $startDate && $finishDate) {
			$this->db->where('A.id_satker',$satker);
			$this->db->where("date_format(A.when, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
		}else if ($startDate && $finishDate) {
			$this->db->where("date_format(A.when, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
		}else if($satker){
		    $this->db->where('A.id_satker',$satker);
		}

        $this->db->where('A.is_active',1);
		$this->db->order_by('A.id_activity_sosial', 'DESC');
        //echo $this->db->get_compiled_select(); exit;

		$query = $this->db->get();

		return $query->result();
        // return $this->db->get($this->_table)->result();
    }

    public function getByMonth($month, $year)
    {
		$this->db->select('activity.*');
		$this->db->from('rekap_activity_sosial AS activity');
        $this->db->where("DATE_FORMAT(created_date,'%m')", $month);
        $this->db->where("DATE_FORMAT(created_date,'%Y')", $year);
        $this->db->where('activity.is_active',1);
        $this->db->group_by('activity.created_date');
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function getsummarydatatahun($request=null)
    {
		$this->db->select("DISTINCT DATE_FORMAT(activity.created_date,'%Y') as tahun");
		$this->db->from('rekap_activity_sosial AS activity');
        $this->db->where('activity.is_active',1);
        $this->db->order_by("activity.created_date", 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
    
    public function find($id)
    {

		$sql = "SELECT DISTINCT
					ACTIVITY.*,
					satker.nama_satker,
					jenis.nama_jenis,
					users.nama_pegawai,
					geografi.*
				FROM
					rekap_activity_sosial AS ACTIVITY
					JOIN org_satker AS satker
					ON ACTIVITY.id_satker = satker.id_satker
					JOIN mst_activity_jenis AS jenis
					ON ACTIVITY.id_activity_jenis = jenis.id_activity_jenis
					left join mst_user users on ACTIVITY.created_by = users.id_user
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
					ACTIVITY.id_geografi = geografi.id_provinsi OR
					ACTIVITY.id_geografi = geografi.id_kabupaten OR
					ACTIVITY.id_geografi = geografi.id_kecamatan OR
					ACTIVITY.id_geografi = geografi.id_kelurahan
				WHERE
					ACTIVITY.is_active = 1 AND
					ACTIVITY.id_activity_sosial = $id
				GROUP BY
					ACTIVITY.id_activity_sosial
				ORDER BY
					ACTIVITY.id_activity_sosial DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
		// $this->db->select('ACTIVITY.*, 
		// 					SATKER.nama_satker,
		// 					JENIS.nama_jenis,
		// 					PROV.nama AS PROVINSI, 
		// 					KAB.nama AS KABUPATEN, 
		// 					KEC.nama AS KECAMATAN, 
		// 					KEL.nama AS KELURAHAN');
		// $this->db->from('org_geografi AS PROV');
		// $this->db->join('org_geografi AS KAB', 'KAB.id_geografi_parent = PROV.id_geografi','INNER');
		// $this->db->join('org_geografi AS KEC', 'KEC.id_geografi_parent = KAB.id_geografi','INNER');
		// $this->db->join('org_geografi AS KEL', 'KEL.id_geografi_parent = KEC.id_geografi','INNER');
		// $this->db->join('rekap_activity_sosial AS ACTIVITY', 'ACTIVITY.id_geografi = PROV.id_geografi OR
		// 				ACTIVITY.id_geografi = KAB.id_geografi OR
		// 				ACTIVITY.id_geografi = KEC.id_geografi OR
		// 				ACTIVITY.id_geografi = KEL.id_geografi','RIGHT');
		// $this->db->join('org_satker AS SATKER', 'ACTIVITY.id_satker = SATKER.id_satker');
		// $this->db->join('mst_activity_jenis AS JENIS', 'ACTIVITY.id_activity_jenis = JENIS.id_activity_jenis');
		// $this->db->where('PROV.level_geografi',1);
		// $this->db->where('KAB.level_geografi',2);
		// $this->db->where('KEC.level_geografi',3);
		// $this->db->where('KEL.level_geografi',4);
		// $this->db->group_by('ACTIVITY.id_geografi');
        // $this->db->where('id_activity_sosial',$id);
		// $query = $this->db->get();

		// return $query->row();
    }

	public function getExport($id)
    {
		$sql = "SELECT DISTINCT
					ACTIVITY.*,
					satker.nama_satker,
					jenis.nama_jenis,
					users.nama_pegawai,
					geografi.nama as wilayah,
					geografi.*
				FROM
					rekap_activity_sosial AS ACTIVITY
					JOIN org_satker AS satker
					ON ACTIVITY.id_satker = satker.id_satker
					JOIN mst_activity_jenis AS jenis
					ON ACTIVITY.id_activity_jenis = jenis.id_activity_jenis
					left join mst_user users on ACTIVITY.created_by = users.id_user
					LEFT JOIN org_geografi AS geografi ON ACTIVITY.id_geografi = geografi.id_geografi
				WHERE
					ACTIVITY.is_active = 1";

		if ($id != 0) {
			$sql = $sql . " AND satker.id_satker = " . $id . " GROUP BY ACTIVITY.id_activity_sosial ORDER BY ACTIVITY.id_activity_sosial DESC";
		}
		else if($id = 0)
		{
			$sql = $sql . " GROUP BY ACTIVITY.id_activity_sosial ORDER BY ACTIVITY.id_activity_sosial DESC";
		}

		$query = $this->db->query($sql);
		return $query->result();

    }
	
    public function categories()
    {
        $this->db->where('id_level',1);
        $this->db->where('is_active',1);
        $this->db->order_by("sequence asc, id_activity_jenis");
        return $this->db->get('mst_activity_jenis')->result();
    }

    public function subcategories()
    {
        $this->db->where('id_level',2);
        $this->db->where('is_active',1);
        $this->db->order_by("sequence asc, id_activity_jenis");
        return $this->db->get('mst_activity_jenis')->result();
    }

    public function tags()
    {
        $this->db->where('is_active',1);
        return $this->db->get('mst_activity_tag')->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_activity_sosial" => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ["id_activity_sosial" => $id]);
    }

	public function do_upload()
	{
			$config['upload_path']          = './uploads/reports/';
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
					$config['source_image']='./uploads/reports/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '20%';
					$config['width']= 600;
                	$config['height']= 400;
					$config['new_image']= './uploads/reports/'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					return $gbr['file_name'];
				}

				return $this->upload->display_errors();
			} else {
				return "null.jpg";
			}
	}

    function getPelaporanRekapTable($id_activity_jenis) {
        $sql = "select * from mst_activity_rekap_table a where a.is_active=1 and a.id_activity_jenis=?";
        $result = $this->db->query($sql, array($id_activity_jenis))->row_array();
        if($result == null) return null;

        $label = $result['label'];

        $sql = "select " .$result['kolom_value']. " as value, " .$result['kolom_label']. " as label from " .$result['nama_table']. " where is_active=1";
        if (!empty($result['where_clause'])) {
            $sql .= " AND (" .$result['where_clause']. ")";
        }
        $rekap = $this->db->query($sql)->result_array();
        if ($rekap == null)     return null;

        $result = array();
        $result[$label] = $rekap;

        return $result;
    }
}
