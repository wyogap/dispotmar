<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			in_access();
			$this->load->model('Role','role');
			$this->load->model('User','user');
			$this->load->model('SatuanKerja','satker');
			$this->load->model('Pelaporan','report');
			$this->load->model('Geografi','geo');
			$this->load->model('KomoditasPangan', 'comodity');
			$this->load->model('RekapSensor', 'sensor');
	}
	
	public function getSatker($id_user)
	{
		$user = $this->user->find($id_user);
		$response = $this->satker->find($user->id_satker);
  
		echo json_encode($response);
	}

	public function getSatkerById($id)
	{
		$response = $this->satker->findByIdSatker($id);
  
		echo json_encode($response);
	}
	
	public function getReports()
	{
		$this->load->helper('date');

		$this->db->select('notif.*, pengguna.nama_pegawai, pelapor.nama_pegawai AS pelapor, activity.what, activity.created_date AS notifDate');
		$this->db->from('notifications AS notif');
		$this->db->join('mst_user AS pengguna','notif.id_user = pengguna.id_user');
		$this->db->join('mst_user AS pelapor','notif.id_pelapor = pelapor.id_user');
		$this->db->join('rekap_activity_sosial AS activity','notif.id_activity_sosial = activity.id_activity_sosial');
		$this->db->limit(3);
		$this->db->where('notif.id_user',$this->session->userdata('id_user'));
		$this->db->order_by('notif.id_notification','DESC');
		$query = $this->db->get();

		$data = $query->result();
		// $data = $this->report->get();

		foreach($data as $res) {
			$substrValue = strlen($res->what) > 20 ? substr($res->what,0,20)."..." : $res->what;
			$spotlight = '#FFF';
			if ($res->is_read != 1) {
				$spotlight = '#f0f1f7';
			}
			echo '<a href="'.site_url().'data_pelaporan/'.encrypt($res->id_activity_sosial).'/notification/'.encrypt($res->id_notification).'" class="dropdown-item d-flex pb-3 pl-4 pr-2 border-bottom notificationItem" style="background: '.$spotlight.'">
					<div class="notifyimg bg-info-transparent text-info-shadow"><i
							class="fa fa-envelope-o fs-18 text-info"></i></div>
					<div>
					<strong> '.$substrValue.'</strong><br>
					<small> oleh: '.$res->pelapor.' </small><br>
						<small class="text-muted">'.date('d M Y',strtotime($res->notifDate)).'</small>
					</div>
				</a>';
		}
	}

	public function checkReports()
	{
		$sql = "SELECT * FROM notifications WHERE is_read IS NULL";
		
		echo $this->db->query($sql)->num_rows();
	}
	
	public function getRoles()
	{
		$keywords = $this->input->post('keywords');
		$response = $this->role->getRoles($keywords);
  
		echo json_encode($response);
	}

	public function getProvinsi($id)
	{
		$geografi = $this->geo->findProvinsi($id,1);
		echo json_encode($geografi);
	}
	public function getKabupaten($id)
	{
		$geografi = $this->geo->findLevel($id,2);
		echo json_encode($geografi);
	}
	public function getKecamatan($id)
	{
		$geografi = $this->geo->findLevel($id,3);
		echo json_encode($geografi);
	}
	public function getKelurahan($id)
	{
		$geografi = $this->geo->findLevel($id,4);
		echo json_encode($geografi);
	}

	public function getKomoditas($id)
	{
		$komoditas = $this->comodity->getKomoditas($id);
		echo json_encode($komoditas);
	}

	public function getSatuanKomoditas($id)
	{
		$this->db->select('t1.*');
		$this->db->from('mst_pangan_komoditas AS t1');
		$this->db->where('t1.id_komoditas',$id);
		$this->db->where('t1.is_active',1);
		$result = $this->db->get()->result();
		
		echo json_encode($result);
	}

	public function getLatLong_byIdSatker($id)
	{
		$LatLong = $this->satker->getLatLong_byIdSatker($id);
		echo json_encode($LatLong);
	}

	public function getComodityResult()
	{
		$komoditas = $this->comodity->getComodityResult($this->input->get());

		$total = []; $label = [];
		foreach ($komoditas as $kom) {
			$total[] = $kom->total;
			$label[] = $kom->nama_komoditas;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getClusterResult()
	{
		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, cluster.nama_cluster');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->where('pangan.is_active',1);
		$this->db->group_by('cluster.id_cluster');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
		$clusters = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($clusters as $cluster) {
			$total[] = $cluster->total;
			$label[] = $cluster->nama_cluster;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getAreaByKotama()
	{
		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, satker.nama_satker');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		$this->db->join('org_level AS level','satker.id_level = level.id_level');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->where('level.level',1);
		$this->db->group_by('satker.id_satker');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getAreaBySatker()
	{
		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, satker.nama_satker');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('satker.id_satker');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getAreaByComodity()
	{
		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, komoditas.nama_komoditas');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('komoditas.id_komoditas');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_komoditas;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getEstimateByComodity()
	{
		$this->db->select('ROUND(SUM(pangan.luas_lahan), 2) AS total, komoditas.nama_komoditas');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('komoditas.id_komoditas');
		$this->db->order_by('SUM(pangan.luas_lahan)','DESC');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_komoditas;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getComodityPieChart()
	{
		$this->db->select('COUNT(pangan.id_komoditas) AS total, komoditas.nama_komoditas');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('komoditas.id_komoditas');
		$this->db->order_by('COUNT(pangan.id_komoditas)', 'asc');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_komoditas;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getClusterPieChart()
	{
		$this->db->select('COUNT(pangan.id_komoditas) AS total, cluster.nama_cluster');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_komoditas AS komoditas','pangan.id_komoditas = komoditas.id_komoditas');
		$this->db->join('mst_cluster AS cluster','komoditas.id_cluster = cluster.id_cluster');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('cluster.id_cluster');
		$this->db->order_by('COUNT(pangan.id_komoditas)','asc');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_cluster;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getSatkerPieChart()
	{
		$this->db->select('COUNT(pangan.id_satker) AS total, satker.nama_satker');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('org_satker AS satker','pangan.id_satker = satker.id_satker');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
		}
		$this->db->group_by('satker.id_satker');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPanganProgress()
	{
		$this->db->select('COUNT(pangan.id_satker) AS total, progres.nama_progres');
		$this->db->from('rekap_pangan AS pangan');
		$this->db->join('mst_pangan_progres AS progres','pangan.id_progres = progres.id_progres');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('pangan.id_satker',$satker);
			}
			if ($progres = $this->input->get('progres')) {
				$this->db->where('pangan.id_progres',$progres);
			}
			if ($komoditas = $this->input->get('komoditas')) {
				$this->db->where('pangan.id_komoditas',$komoditas);
			}
			if ($tmt = $this->input->get('tmt')) {
				$tmtStart = explode(' ',$tmt)[0];
				$tmtEnd = explode(' ',$tmt)[2];
				$this->db->where("pangan.tmt BETWEEN '$tmtStart' AND '$tmtEnd'", null, false);
			}
			if ($panen = $this->input->get('panen')) {
				$panenStart = explode(' ',$panen)[0];
				$panenEnd = explode(' ',$panen)[2];
				$this->db->where("pangan.estimasi_panen BETWEEN '$panenStart' AND '$panenEnd'", null, false);
			}
		}
		$this->db->group_by('pangan.id_progres');
		$this->db->order_by('COUNT(pangan.id_satker)','asc');
		$areas = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($areas as $area) {
			$total[] = $area->total;
			$label[] = $area->nama_progres;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPersonelBySatker()
	{
		$this->db->select('COUNT(personel.id_satker) AS total, satker.nama_satker');
		$this->db->from('org_personel AS personel');
		$this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('personel.id_satker',$satker);
			}
		}
		$this->db->group_by('personel.id_satker');
		$personels = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($personels as $personel) {
			$total[] = $personel->total;
			$label[] = $personel->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPersonelByStrataPieChart()
	{
		$this->db->select('SUM(personel.perwira) AS Perwira,
					SUM(personel.bintara) AS Bintara,
					SUM(personel.tamtama) AS Tamtama');
		$this->db->from('org_personel AS personel');
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('personel.id_satker',$satker);
			}
		}
		$personels = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($personels as $personel) {
			$total = [$personel->Perwira,$personel->Bintara,$personel->Tamtama];
			$label = ["Perwira","Bintara","Tamtama"];
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getPersonelByKotamaPieChart()
	{
		$this->db->select('COUNT(personel.id_satker) AS total, satker.nama_satker');
		$this->db->from('org_personel AS personel');
		$this->db->join('org_satker AS satker','personel.id_satker = satker.id_satker');
		$this->db->join('org_level AS level','satker.id_level = level.id_level');
		$this->db->where('personel.is_active',1);
		$this->db->where('level.level',1);
		if ($this->input->get()) {
			if ($satker = $this->input->get('satker')) {
				$this->db->where('personel.id_satker',$satker);
			}
		}
		$this->db->group_by('personel.id_satker');
		$personels = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($personels as $personel) {
			$total[] = $personel->total;
			$label[] = $personel->nama_satker;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getReportCategoryRankPieChart()
	{
		$this->db->select("COUNT(activity.id_activity_jenis) AS total, concat(jenis.nama_jenis, ' ', '(', COUNT(activity.id_activity_jenis), ' Laporan)') as nama_jenis");
		$this->db->from('rekap_activity_sosial AS activity');
		$this->db->join('mst_activity_jenis AS jenis', 'activity.id_activity_jenis = jenis.id_activity_jenis');
		$this->db->where('activity.is_active',1);
		$this->db->group_by('activity.id_activity_jenis');
		$this->db->order_by('COUNT(activity.id_activity_jenis)','asc');

		$categories = $this->db->get()->result();

		$total = []; $label = [];
		foreach ($categories as $category) {
			$total[] = $category->total;
			$label[] = $category->nama_jenis;
		}

		$result = [
			'total' => $total,
			'labels' => $label
		];

		echo json_encode($result);
	}

	public function getAllActivity($offset)
	{
		if ($offset == 'dashboard5') {
			$offset = 1;
		}
		
		if (policy('LAPHAR','read')) {
			$activities = $this->report->getDataPagination(['satker' => $this->session->userdata('id_satker')],10,$offset);
			foreach ($activities as $actv) {
				if ($actv->id_activity_sosial) {
					$actv->id_activity_sosial = encrypt($actv->id_activity_sosial);
				}
			}
		}else if (policy('LAPHAR','read_all')){
			// $activities = $this->report->getDataPagination(null,10,$offset);
			$activities = $this->report->getDataPagination(null,10,$offset);
			foreach ($activities as $actv) {
				if ($actv->id_activity_sosial) {
					$actv->id_activity_sosial = encrypt($actv->id_activity_sosial);
				}
			}
		}
		
		echo json_encode($activities);
	}

	public function getCriminalsActivity()
	{
		
		if (policy('LAPHAR','read')) {
			$activities = $this->report->criminals(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('LAPHAR','read_all')){
			$activities = $this->report->criminals();
		}
		
		echo json_encode($activities);
	}

	public function getDataByMonth($year)
	{
		$months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		$data = [];
		foreach ($months as $key => $month) {
			$data[$month] = $this->report->getByMonth($key+1,$year);
		}

		echo json_encode($data);
	}

	public function getdatabyyear()
	{
		$data = $this->report->getsummarydatatahun();

		echo json_encode($data);
	}

	public function getGeodemokonsosChart($level)
	{
		$type = decrypt($this->input->get('jenisdata'));

		if ($type) {
			$kotama = $this->input->get('kotama');
			$satker = $this->input->get('satker');

			$satkerLevel = "";
			if ($satker){
				$this->db->select('id_level');
				$this->db->from('org_satker');
				$this->db->where('id_satker',$satker);
				$satkerLevel = $this->db->get()->result()[0]->id_level;
			}

			$idSatkerLevel2 = "";
			if ( $satkerLevel == 3 ) {
				$this->db->select('id_parent_satker');
				$this->db->from('org_satker');
				$this->db->where('id_satker',$satker);
				$idSatkerLevel2 = $this->db->get()->result()[0]->id_parent_satker;
			}

			$param = [
				'type' => $type,
				'level' => $level,
				'kotama' => $kotama,
				'satker' => $satker,
				'satkerLevel' => $satkerLevel,
				'idSatkerLevel2' => $idSatkerLevel2
			];
			// var_dump($param);

			$areas = [];

			if ( $level == 1 ) {
				$satker_tree_table = satker_tree_table();

				$this->db->select('COUNT('.$type.'.id_satker) AS total, satker_tree.nama_kotama as nama_satker, satker_tree.id_kotama as id_satker, 0 as order_satker');
				$this->db->from($type);
				$this->db->join("( $satker_tree_table ) AS satker_tree", $type.'.id_satker = satker_tree.id_satker');			

				$this->db->where("$type.is_active",1);
				$this->db->group_by('satker_tree.id_kotama');
				$areas = $this->db->get()->result();

			} else if ( $level == 2 ){

				$satker_tree_table = satker_tree_table();

				$this->db->select('COUNT('.$type.'.id_satker) AS total, satker_tree.nama_lantamal as nama_satker, satker_tree.id_lantamal as id_satker, satker_tree.order_lantamal as order_satker');
				$this->db->from($type);
				$this->db->join("( $satker_tree_table ) AS satker_tree", $type.'.id_satker = satker_tree.id_satker');			

				if ( $satker ) {			
					if ( $satkerLevel == 2 ) {
						$this->db->where('satker_tree.id_lantamal',$satker);
					} else if ( $satkerLevel == 3 ) {
						$this->db->where('satker_tree.id_lantamal',$idSatkerLevel2);
					} 
				} else if ( $kotama ) {
					$this->db->where("satker_tree.id_kotama", $kotama);
				} else {
				}

				$this->db->where("satker_tree.level in (2,3)");
				
				$this->db->where("$type.is_active",1);
				$this->db->group_by('satker_tree.id_lantamal');
				$this->db->order_by('COUNT('.$type.'.id_satker)','desc');
				$areas = $this->db->get()->result();

			} else if( $level == 3 ) {

				$this->db->select('COUNT('.$type.'.id_satker) AS total, satker.nama_satker, satker.id_satker, satker.order_satker');
				$this->db->from($type);

				if ( $satker ) {
					if ( $satkerLevel == 2 ) {
						$this->db->join(
							"(
								select 
								level3.* 
							from 
								org_satker level2
								inner join org_satker level3 on level3.id_parent_satker = level2.id_satker 
							where 
								level2.id_level = 2
								and level2.id_satker = $satker
							) as satker",
							$type.'.id_satker = satker.id_satker',
							'inner'
						);
					} else if ( $satkerLevel == 3 ) {
						$this->db->join('org_satker AS satker',$type.'.id_satker = satker.id_satker');			
						$this->db->join('org_level AS level','satker.id_level = level.id_level');
						$this->db->where($type.'.id_satker',$satker);
						$this->db->where('level.level',$level);
					} 

				} else if ( $kotama ) {
					$this->db->join(
						"(
							select 
								level3.* 
							from 
								org_satker level1 
								inner join org_satker level2 on level2.id_parent_satker = level1.id_satker 
								inner join org_satker level3 on level3.id_parent_satker = level2.id_satker 
							where 
								level1.id_level = 1
								and level1.id_satker = $kotama
						) as satker",
						$type.'.id_satker = satker.id_satker',
						'inner'
					);
				} else {
					$this->db->join('org_satker AS satker',$type.'.id_satker = satker.id_satker');			
					$this->db->join('org_level AS level','satker.id_level = level.id_level');
					$this->db->where('level.level',$level);	
				}

				$this->db->where("$type.is_active",1);
				$this->db->group_by($type.'.id_satker');
				$areas = $this->db->get()->result();

			} 

			$areas = orderChartData($level, $areas);

			$total = []; $label = []; $id_satkers = [];
			foreach ($areas as $area) {
				$total[] = $area->total;
				$label[] = $area->nama_satker;
				$id_satkers[] = $area->id_satker;
			}

			$result = [
				'total' => $total,
				'labels' => $label,
				'id_satkers' => $id_satkers
			];
	
			echo json_encode($result);
		} else {
			error_reporting(0);
			$total = []; $label = []; $id_satkers = [];
			$result = [
				'total' => $total,
				'labels' => $label,
				'id_satkers' => $id_satkers
			];
			echo json_encode($result);
		}
	}

	public function getActivitySosialBySatkerAndActivityType($idsatker, $namajenis)
	{
		$this->db->select('t1.*, t2.*, DATE_FORMAT(t1.when,"%d/%m/%Y") as tgl, t3.nama_satker');
		$this->db->from('rekap_activity_sosial AS t1');
		$this->db->join('mst_activity_jenis AS t2','t1.id_activity_jenis = t2.id_activity_jenis');
		$this->db->join('org_satker AS t3', 't1.id_satker = t3.id_satker');
		$this->db->where('t1.id_satker',$idsatker);
		$this->db->where('t2.id_activity_jenis',$namajenis);
		$this->db->order_by('t1.id_activity_sosial','DESC');
		$result = $this->db->get()->result();
		
		echo json_encode($result);
	}

	public function getActivitySosialBySatker($idsatker)
	{
		$this->db->select('t1.*, t2.*, DATE_FORMAT(t1.when,"%d/%m/%Y") as tgl, t3.nama_satker');
		$this->db->from('rekap_activity_sosial AS t1');
		$this->db->join('mst_activity_jenis AS t2','t1.id_activity_jenis = t2.id_activity_jenis');
		$this->db->join('org_satker AS t3', 't1.id_satker = t3.id_satker');
		$this->db->where('t1.is_active',1);
		$this->db->where('t1.id_satker',$idsatker);
		$this->db->order_by('t1.id_activity_sosial','DESC');
		$result = $this->db->get()->result();
		
		echo json_encode($result);
	}

	public function getActivitySosialByPersonal($idsatker)
	{
		$this->db->select('t1.*, t2.*, DATE_FORMAT(t1.when,"%d/%m/%Y") as tgl, t3.nama_satker');
		$this->db->from('rekap_activity_sosial AS t1');
		$this->db->join('mst_activity_jenis AS t2','t1.id_activity_jenis = t2.id_activity_jenis');
		$this->db->join('org_satker AS t3', 't1.id_satker = t3.id_satker');
		$this->db->join('mst_user AS t4', 't1.created_by = t4.id_user');
		$this->db->where('t1.created_by',$idsatker);
		$this->db->order_by('t1.id_activity_sosial','DESC');
		$result = $this->db->get()->result();
		
		echo json_encode($result);
	}

	public function getdatatemperaturTanaman($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','temp');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "temp"
			and rs.group_th = 1
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','temp');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getdatatemperaturTorrent($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','temp');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "temp"
			and rs.group_th = 0
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','temp');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getdataPhTanaman($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','ph');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "ph"
			and rs.group_th = 1
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','ph');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getdataPhTorrent($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','ph');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "ph"
			and rs.group_th = 0
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','ph');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getdataTDSTanaman($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','tds');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "tds"
			and rs.group_th = 1
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','tds');
			$this->db->where('t1.group_th',1);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getdataTDSTorrent($date_start, $date_end)
	{
		if($date_start != '0' and $date_end != '0')
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->where('t1.category','tds');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);	
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")>=',$date_start);
			$this->db->where('DATE_FORMAT(t1.timestamp, "%Y-%m-%d")<=',$date_end);
			$this->db->order_by('t1.timestamp','asc');
		}
		else
		{
			$this->db->select('t1.*, DATE_FORMAT(t1.timestamp, "%d/%m/%Y %H:%i:%s") AS timestampnew');
			$this->db->from('rekap_sensor AS t1');
			$this->db->join('
			(
			select DATE_FORMAT(rs.timestamp, "%d/%m/%Y") as getdatetime 
			from rekap_sensor rs 
			where 
			rs.category = "tds"
			and rs.group_th = 0
			and rs.is_active = 1
			order by rs.timestamp 
			desc LIMIT 1
			) as t2','DATE_FORMAT(t1.timestamp, "%d/%m/%Y") = t2.getdatetime');
			$this->db->where('t1.category','tds');
			$this->db->where('t1.group_th',0);
			$this->db->where('t1.is_active',1);
			$this->db->order_by('t1.timestamp','asc');
		}

		$result = $this->db->get()->result();
		echo json_encode($result);
	}

	public function getsatkerLevel2And3($id)
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

		if ($id) {
			$sql = $sql . " AND top_id_satker = " . $id;
		}
		$sql = $sql . " ORDER BY sequence asc;";
		$query = $this->db->query($sql);
		
		echo json_encode($query->result());
	}
}
