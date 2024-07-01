<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SakaBahari extends CI_Model
{
    static $ACTIVITYID_SAKABAHARI = 32;
    private $_table = "rekap_sakabahari";

    public function get($filter = null)
    {
		$this->db->select("a.*");
		$this->db->select("w1.id_geografi as id_kelurahan, w1.nama as nama_kelurahan");
		$this->db->select("w2.id_geografi as id_kecamatan, w2.nama as nama_kecamatan");
		$this->db->select("w3.id_geografi as id_kabupaten, w3.nama as nama_kabupaten");
		$this->db->select("w4.id_geografi as id_provinsi, w4.nama as nama_provinsi");
		$this->db->select("s.nama_satker");
        $this->db->select("case when s.id_level=2 then s2.id_satker else s3.id_satker end as id_kotama", false);
        $this->db->select("case when s.id_level=2 then s2.nama_satker else s3.nama_satker end as nama_kotama", false);
        $this->db->select("case when s.id_level=2 then s.id_satker else s2.id_satker end as id_lantamal", false);
        $this->db->select("case when s.id_level=2 then s.nama_satker else s2.nama_satker end as nama_lantamal", false);
        $this->db->from("rekap_sakabahari a");
        $this->db->join("org_geografi w1", "w1.id_geografi=a.id_geografi and w1.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w2", "w2.id_geografi=w1.id_geografi_parent and w2.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w3", "w3.id_geografi=w2.id_geografi_parent and w3.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w4", "w4.id_geografi=w3.id_geografi_parent and w4.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s", "s.id_satker=a.id_satker and s.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s2", "s2.id_satker=s.id_parent_satker and s2.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s3", "s3.id_satker=s2.id_parent_satker and s3.is_active=1", "LEFT OUTER");

        $this->db->where("a.is_active", 1);
        if ($filter != null) {
            $this->db->where($filter);
        }

        $this->db->order_by("a.id_satker, a.id_sakabahari");

		$query = $this->db->get();
			
		return $query->result();
    }

    public function find($id)
    {
        $filter = array(
            "a.id_sakabahari" => $id
        );

		$result = $this->get($filter);
		if ($result == null)    return null;

		return $result[0];
    }

    public function getBySatker($id)
    {
        $filter = array(
            "a.id_satker" => $id
        );

		return $this->get($filter);
	}
	
    public function create($data)
    {		
        $result = $this->db->insert($this->_table, $data);
        if ($result == null)    return 0;

        return $this->db->insert_id();
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_sakabahari" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table, ['is_active' => 0], ["id_sakabahari" => $id]);
    }

    public function getRankCriminals()
	{
		$this->db->select("COUNT(activity.id_satker) AS total, activity.id_satker, activity.id_activity_jenis, satker.nama_satker, jenis.nama_jenis");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
		$this->db->where('activity.is_active',1);
		$this->db->where('jenis.nama_jenis','Kerawanan Sosial');
        
        $this->db->where("activity.id_activity_jenis", static::$ACTIVITYID_SAKABAHARI);
 
		$this->db->group_by('activity.id_satker');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}

    public function getReportCount($satker = null, $startDate = null, $finishDate = null)
    {
		$this->db->select('count(*) as cnt');
		$this->db->from('rekap_activity_sosial AS A');

		if ($satker && $startDate && $finishDate) {
			$this->db->where('A.id_satker',$satker);
			$this->db->where("date_format(A.when, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
		}else if ($startDate && $finishDate) {
			$this->db->where("date_format(A.when, '%Y-%m-%d') BETWEEN '$startDate' AND '$finishDate'", null, false);
		}else if($satker){
		    $this->db->where('A.id_satker',$satker);
		}

        $this->db->where("A.id_activity_jenis", static::$ACTIVITYID_SAKABAHARI);

        $this->db->where('A.is_active',1);
		$this->db->order_by('A.id_activity_sosial', 'DESC');
		$result = $this->db->get()->row_array();

		return $result['cnt'];
    } 
    
	public function getRankSatker()
	{
		$this->db->select("COUNT(activity.id_satker) AS total, satker.nama_satker, activity.id_satker");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->where('activity.is_active',1);

        $this->db->where("activity.id_activity_jenis", static::$ACTIVITYID_SAKABAHARI);

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

        $this->db->where("activity.id_activity_jenis", static::$ACTIVITYID_SAKABAHARI);

        $this->db->group_by('activity.created_by');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}   

    public function getReport($satker = null, $limit = 0, $offset = 1, $filters = null)
    {
		$this->db->select('A.*,B.nama_satker,C.nama_jenis,D.nama_pegawai,DATE_FORMAT(A.created_date, "%d/%m/%Y") as createddate,user1.nama_pegawai as nama_pegawai2,DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
        $this->db->select('case when geo1.level_geografi=4 then geo4.nama when geo1.level_geografi=3 then geo3.nama when geo1.level_geografi=2 then geo2.nama else geo1.nama end as PROVINSI', false);
        $this->db->select('case when geo1.level_geografi=4 then geo3.nama when geo1.level_geografi=3 then geo2.nama when geo1.level_geografi=2 then geo1.nama else null end as KABUPATEN', false);
        $this->db->select('case when geo1.level_geografi=4 then geo2.nama when geo1.level_geografi=3 then geo1.nama else null end as KECAMATAN', false);
        $this->db->select('case when geo1.level_geografi=4 then geo1.nama else null end as KELURAHAN', false);
        $this->db->from('rekap_activity_sosial AS A');
		$this->db->join('org_satker AS B', 'A.id_satker = B.id_satker');
		$this->db->join('mst_activity_jenis AS C', 'A.id_activity_jenis = C.id_activity_jenis');
		$this->db->join('mst_user AS D', 'A.created_by = D.id_user');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');

        $this->db->join('org_geografi AS geo1','geo1.id_geografi=a.id_geografi and geo1.is_active=1','left outer');
        $this->db->join('org_geografi AS geo2','geo2.id_geografi=geo1.id_geografi_parent and geo2.is_active=1','left outer');
        $this->db->join('org_geografi AS geo3','geo3.id_geografi=geo2.id_geografi_parent and geo3.is_active=1','left outer');
        $this->db->join('org_geografi AS geo4','geo4.id_geografi=geo3.id_geografi_parent and geo4.is_active=1','left outer');

		if ($satker) {
			$this->db->where('A.id_satker',$satker);
        }

        if ($filters != null) {
            if (!empty($filters['startDate']) && !empty($filters['finishDate'])) {
                $this->db->where("date_format(A.when, '%Y-%m-%d') BETWEEN '" .$filters['startDate']. "' AND '" .$filters['finishDate']. "'", null, false);
                unset ($filters['startDate']);
                unset ($filters['finishDate']);
            }
            $this->db->where($filters);
        }

        $this->db->where("A.id_activity_jenis", static::$ACTIVITYID_SAKABAHARI);

        if($limit > 0) {
            $this->db->limit($limit, $offset-1);
        }

        $this->db->where('A.is_active',1);
		$this->db->order_by('A.id_activity_sosial', 'DESC');
		$query = $this->db->get();

		return $query->result();
        // return $this->db->get($this->_table)->result();
    }    

    public function getReportBySatker($idsatker) {
        return $this->getReport($idsatker);
    }
    
    public function getReportByPersonel($iduser) {
        $filters = array(
            "A.created_by" => $iduser
        );

        return $this->getReport(null, 0, 1, $filters);
    }
    
    public function getReportBySaka($idsaka) {
        $filters = array(
            "A.id_rekap_table" => $idsaka
        );

        return $this->getReport(null, 0, 1, $filters);
    } 

    
    public function daftaranggota($idsaka) {
        $sql = "select a.* from rekap_sakabahari_anggota a where a.is_active=1 and a.id_sakabahari=?";

        return $this->db->query($sql, array($idsaka))->result_array();
    } 
 
    public function find_anggota($id)
    {
        $sql = "select a.* from rekap_sakabahari_anggota a where a.is_active=1 and a.id_anggota=?";

		$result = $this->db->query($sql, array($id))->result();
        if ($result == null)    return null;

        return $result[0];
    }
 	
    public function create_anggota($data)
    {		
        $result = $this->db->insert("rekap_sakabahari_anggota", $data);
        if ($result == null)    return 0;

        return $this->db->insert_id();
    }

    public function update_anggota($id,$data)
    {
        return $this->db->update("rekap_sakabahari_anggota", $data, ["id_anggota" => $id]);
    }

    public function delete_anggota($id)
    {
        return $this->db->update("rekap_sakabahari_anggota", ['is_active' => 0], ["id_anggota" => $id]);
    }
   
    public function do_upload($field)
	{
        $config['upload_path']          = './uploads/reports/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = uniqid();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!empty($_FILES[$field]["name"])) {
            if ($this->upload->do_upload($field))
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

                return 'uploads/reports/'.$gbr['file_name'];
            }

            return '';
        } else {
            return "";
        }
	}
}
