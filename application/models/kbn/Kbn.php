<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Kbn extends CI_Model
{
    static $ACTIVITYID_KBN = 25;
    static $ACTIVITYID_KLASTER_EDUKASI = 26;
    static $ACTIVITYID_KLASTER_EKONOMI = 27;
    static $ACTIVITYID_KLASTER_KESEHATAN = 28;
    static $ACTIVITYID_KLASTER_PARIWISATA = 29;
    static $ACTIVITYID_KLASTER_PERTAHANAN = 30;

    private $_table = "rekap_kbn";

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
        $this->db->from("rekap_kbn a");
        $this->db->join("org_geografi w1", "w1.id_geografi=a.id_geografi and w1.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w2", "w2.id_geografi=w1.id_geografi_parent and w2.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w3", "w3.id_geografi=w2.id_geografi_parent and w3.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w4", "w4.id_geografi=w3.id_geografi_parent and w4.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s", "s.id_satker=a.id_satker and s.is_active=1");
        $this->db->join("org_satker s2", "s2.id_satker=s.id_parent_satker and s2.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s3", "s3.id_satker=s2.id_parent_satker and s3.is_active=1", "LEFT OUTER");
        $this->db->where("a.is_active", 1);

        if ($filter != null) {
            $this->db->where($filter);
        }

        $this->db->order_by("a.id_satker, a.id_kbn");

        //echo $this->db->get_compiled_select(); exit;
		$query = $this->db->get();
			
		return $query->result();
    }

    public function find($id)
    {
        $filter = array(
            "a.id_kbn" => $id
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
        return $this->db->update($this->_table, $data, ["id_kbn" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table, ['is_active' => 0], ["id_kbn" => $id]);
    }

    public function getReport($klaster, $satker = null, $limit = 0, $offset = 1, $filters = null)
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

        $this->db->where("A.id_activity_jenis", static::$ACTIVITYID_KBN);
        if (strtolower($klaster) == 'edukasi') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EDUKASI);
        }
        else if (strtolower($klaster) == 'ekonomi') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EKONOMI);
        }
        else if (strtolower($klaster) == 'kesehatan') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_KESEHATAN);
        }
        else if (strtolower($klaster) == 'pariwisata') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PARIWISATA);
        }
        else if (strtolower($klaster) == 'pertahanan') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PERTAHANAN);
        }

        if($limit > 0) {
            $this->db->limit($limit, $offset-1);
        }

        $this->db->where('A.is_active',1);
		$this->db->order_by('A.id_activity_sosial', 'DESC');

        //echo $this->db->get_compiled_select(); exit;

		$query = $this->db->get();

		return $query->result();
        // return $this->db->get($this->_table)->result();
    }    

    public function getReportCount($klaster, $satker = null, $startDate = null, $finishDate = null)
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

        $this->db->where("A.id_activity_jenis", static::$ACTIVITYID_KBN);
        if (strtolower($klaster) == 'edukasi') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EDUKASI);
        }
        else if (strtolower($klaster) == 'ekonomi') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EKONOMI);
        }
        else if (strtolower($klaster) == 'kesehatan') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_KESEHATAN);
        }
        else if (strtolower($klaster) == 'pariwisata') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PARIWISATA);
        }
        else if (strtolower($klaster) == 'pertahanan') {
            $this->db->where("A.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PERTAHANAN);
        }

        $this->db->where('A.is_active',1);
		$this->db->order_by('A.id_activity_sosial', 'DESC');
		$result = $this->db->get()->row_array();

		return $result['cnt'];
    }  

	public function getRankSatker($klaster)
	{
		$this->db->select("COUNT(activity.id_satker) AS total, satker.nama_satker, activity.id_satker");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('org_satker AS satker', 'activity.id_satker = satker.id_satker');
		$this->db->where('activity.is_active',1);

        $this->db->where("activity.id_activity_jenis", static::$ACTIVITYID_KBN);
        if (strtolower($klaster) == 'edukasi') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EDUKASI);
        }
        else if (strtolower($klaster) == 'ekonomi') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EKONOMI);
        }
        else if (strtolower($klaster) == 'kesehatan') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_KESEHATAN);
        }
        else if (strtolower($klaster) == 'pariwisata') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PARIWISATA);
        }
        else if (strtolower($klaster) == 'pertahanan') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PERTAHANAN);
        }

        $this->db->group_by('activity.id_satker');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}
	
	public function getRankPersonel($klaster)
	{
		$this->db->select("COUNT(activity.created_by) AS total, who, users.id_user, users.nama_pegawai");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('mst_user AS users', 'activity.created_by = users.id_user');
		$this->db->where('activity.is_active',1);

        $this->db->where("activity.id_activity_jenis", static::$ACTIVITYID_KBN);
        if (strtolower($klaster) == 'edukasi') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EDUKASI);
        }
        else if (strtolower($klaster) == 'ekonomi') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_EKONOMI);
        }
        else if (strtolower($klaster) == 'kesehatan') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_KESEHATAN);
        }
        else if (strtolower($klaster) == 'pariwisata') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PARIWISATA);
        }
        else if (strtolower($klaster) == 'pertahanan') {
            $this->db->where("activity.id_activity_jenis2", static::$ACTIVITYID_KLASTER_PERTAHANAN);
        }

        $this->db->group_by('activity.created_by');
		$this->db->order_by('total','DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}  
    
    public function getReportBySatker($klaster, $idsatker) {
        return $this->getReport($klaster, $idsatker);
    }
    
    public function getReportByPersonel($klaster, $iduser) {
        $filters = array(
            "A.created_by" => $iduser
        );

        return $this->getReport($klaster, null, 0, 1, $filters);
    }
    
    public function getReportByKbn($klaster, $idkbn) {
        $filters = array(
            "A.id_rekap_table" => $idkbn
        );

        return $this->getReport($klaster, null, 0, 1, $filters);
    }    

    public function do_upload($field)
	{
			$config['upload_path']          = './uploads/reports/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_name']            = uniqid();
			// $config['max_size']             = 20000;

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

    public function getSDAPantai($idkbn) {
        $sda = 'select a.* from geo_pantai a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAHutan($idkbn) {
        $sda = 'select a.* from geo_hutan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAGunung($idkbn) {
        $sda = 'select a.* from geo_gunung a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAKerawanan($idkbn) {
        $sda = 'select a.* from geo_kerawanan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAHujan($idkbn) {
        $sda = 'select a.* from geo_curah_hujan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDATanah($idkbn) {
        $sda = 'select a.* from geo_struktur_tanah a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDASumberAir($idkbn) {
        $sda = 'select a.* from geo_sumber_air a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDASungai($idkbn) {
        $sda = 'select a.* from geo_sungai a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAPulauTerluar($idkbn) {
        $sda = 'select a.* from geo_pulau_terluar a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDAMangrove($idkbn) {
        $sda = 'select a.* from rekap_mangrove a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABPerkebunan($idkbn) {
        $sda = 'select a.* from geo_perkebunan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABPertanian($idkbn) {
        $sda = 'select a.* from geo_pertanian a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABPeternakan($idkbn) {
        $sda = 'select a.* from geo_peternakan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABPertambangan($idkbn) {
        $sda = 'select a.* from geo_pertambangan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABBudidayaIkan($idkbn) {
        $sda = 'select a.* from geo_budidaya_ikan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABKerambaJaring($idkbn) {
        $sda = 'select a.* from geo_keramba_jaring a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABKonservasi($idkbn) {
        $sda = 'select a.* from geo_konservasi_lingkungan a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

    public function getSDABSumberListrik($idkbn) {
        $sda = 'select a.* from geo_listrik a join rekap_kbn b on b.id_geografi=a.id_geografi and b.is_active=1 where a.is_active=1 and b.id_kbn=?';
        return $this->db->query($sda, array($idkbn))->result_array();
    }

}

