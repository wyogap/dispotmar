<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SatuanKerjaController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Level', 'level');
		$this->load->model('Geografi','geo');
		$this->load->model('geografi/GeoPantai', 'pantai');
		$this->load->model('geografi/GeoHutan', 'hutan');
		$this->load->model('geografi/GeoGunung', 'gunung');
		$this->load->model('geografi/GeoKerawanan', 'kerawanan');
		$this->load->model('geografi/GeoHujan', 'hujan');
		$this->load->model('geografi/GeoTanah', 'tanah');
		$this->load->model('geografi/GeoAir', 'air');
		$this->load->model('geografi/GeoSungai', 'sungai');
		$this->load->model('geografi/GeoPulau', 'pulau');
		$this->load->model('geografi/GeoPerkebunan', 'perkebunan');
		$this->load->model('geografi/GeoPertanian', 'pertanian');
		$this->load->model('geografi/GeoPeternakan', 'peternakan');
		$this->load->model('geografi/GeoPertambangan', 'pertambangan');
		$this->load->model('geografi/GeoBudidayaIkan', 'budidayaIkan');
		$this->load->model('geografi/GeoKeramba', 'keramba');
		$this->load->model('geografi/GeoKonservasi', 'konservasi');
		$this->load->model('geografi/GeoListrik', 'listrik');
		$this->load->model('geografi/GeoPelabuhanSungai', 'pelabuhanSungai');
		$this->load->model('geografi/GeoPelabuhanLaut', 'pelabuhanLaut');
		$this->load->model('geografi/GeoPelabuhanIkan', 'pelabuhanIkan');
		$this->load->model('geografi/GeoSarpras', 'sarpras');
		$this->load->model('geografi/GeoGalanganKapal', 'galanganKapal');
		$this->load->model('geografi/GeoIndustriMesin', 'industriMesin');
		$this->load->model('geografi/GeoPelayaranRakyat', 'pelayaran');
		$this->load->model('geografi/GeoEkspedisiLaut', 'ekspedisi');
		$this->load->model('geografi/GeoShipHandler', 'shipHandler');
		$this->load->model('geografi/GeoIndustriIkan', 'industriIkan');
		$this->load->model('demografi/JumlahPenduduk', 'jumlahPenduduk');
		$this->load->model('demografi/Agama', 'agama');
		$this->load->model('demografi/SukuBangsa', 'sukuBangsa');
		$this->load->model('demografi/Pesisir', 'pesisir');
		$this->load->model('demografi/SakaBahari', 'sakaBahari');
		$this->load->model('demografi/PekerjaanMasyarakat', 'pekerjaanMasyarakat');
		//$this->load->model('demografi/TingkatPendidikan', 'tingkatPendidikan');
		$this->load->model('demografi/SekolahMaritim', 'sekolahMaritim');
		$this->load->model('demografi/RumahSakit', 'rumahSakit');
		$this->load->model('kondsos/TokohMasyarakat', 'tokohMasyarakat');
		$this->load->model('kondsos/OrganisasiAgama', 'organisasiAgama');
		$this->load->model('kondsos/OrganisasiPolitik', 'organisasiPolitik');
		$this->load->model('kondsos/OrganisasiMasa', 'organisasiMasa');
		$this->load->model('kondsos/PartaiPolitik', 'partaiPolitik');
		$this->load->model('kondsos/IndustriMenengah', 'industriMenengah');
		$this->load->model('kondsos/Pariwisata', 'pariwisata');
		$this->load->model('kondsos/PeninggalanSejarah', 'peninggalanSejarah');
		$this->load->model('kondsos/Budaya', 'budaya');
		$this->load->model('kondsos/InstansiMiliter', 'instansiMiliter');
		$this->load->model('kondsos/Umkm', 'umkm');
	}

	public function index()
	{
		if (!policy('ORG','read_all')) show_404();

		$this->data['title'] = 'Data Satker';
		$this->data['satkers'] = $this->satker->get();

		$data['isi'] = $this->load->view('organisasi/satuan_kerja/index', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function create()
	{
		$this->data['title'] = 'Add Satker';

		$this->data['levels'] = $this->level->get();
		$this->data['satker1'] = $this->satker->getLevel(1);
		$this->data['satker2'] = $this->satker->getLevel(2);
		$this->data['satker3'] = $this->satker->getLevel(3);
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('organisasi/satuan_kerja/create', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		//if (!policy('ORG','update')) show_404();

		$this->data['title'] = 'Detail Satker';

		$satker = $this->satker->find(decrypt($id));
		$this->data['satker'] = $satker;
		// var_dump($satker);
		
		if ($satker->level == 1) {
			$this->data['parentSatker1'] = $satker;
		} else if ($satker->level == 2) {
			$this->data['parentSatker1'] = $this->satker->find($satker->id_parent_satker);
		} else if ($satker->level == 3) {
			$this->data['parentSatker2'] = $this->satker->find($satker->id_parent_satker);
			$this->data['parentSatker1'] = $this->satker->find($this->data['parentSatker2']->id_parent_satker);
		}

		// Geo SDA
		// $this->data['dataPantai'] = $this->pantai->getBySatker(decrypt($id));
		// $this->data['dataHutan'] = $this->hutan->getBySatker(decrypt($id));
		// $this->data['dataGunung'] = $this->gunung->getBySatker(decrypt($id));
		// $this->data['dataKerawanan'] = $this->kerawanan->getBySatker(decrypt($id));
		// $this->data['dataHujan'] = $this->hujan->getBySatker(decrypt($id));
		// $this->data['dataTanah'] = $this->tanah->getBySatker(decrypt($id));
		// $this->data['dataAir'] = $this->air->getBySatker(decrypt($id));
		// $this->data['dataSungai'] = $this->sungai->getBySatker(decrypt($id));
		// $this->data['dataPulau'] = $this->pulau->getBySatker(decrypt($id));
		// Geo SDAB
		// $this->data['dataPerkebunan'] = $this->perkebunan->getBySatker(decrypt($id));
		// $this->data['dataPertanian'] = $this->pertanian->getBySatker(decrypt($id));
		// $this->data['dataPeternakan'] = $this->peternakan->getBySatker(decrypt($id));
		// $this->data['dataPertambangan'] = $this->pertambangan->getBySatker(decrypt($id));
		// $this->data['dataIkan'] = $this->budidayaIkan->getBySatker(decrypt($id));
		// $this->data['dataKeramba'] = $this->keramba->getBySatker(decrypt($id));
		// $this->data['dataKonservasi'] = $this->konservasi->getBySatker(decrypt($id));
		// $this->data['dataListrik'] = $this->listrik->getBySatker(decrypt($id));
		// Geo Sarpras
		// $this->data['dataPelabuhanSungai'] = $this->pelabuhanSungai->getBySatker(decrypt($id));
		// $this->data['dataPelabuhanLaut'] = $this->pelabuhanLaut->getBySatker(decrypt($id));
		// $this->data['dataPelabuhanIkan'] = $this->pelabuhanIkan->getBySatker(decrypt($id));
		// $this->data['dataSarpras'] = $this->sarpras->getBySatker(decrypt($id));
		// Geo Injas
		// $this->data['dataGalanganKapal'] = $this->galanganKapal->getBySatker(decrypt($id));
		// $this->data['dataMesin'] = $this->industriMesin->getBySatker(decrypt($id));
		// $this->data['dataPelayaran'] = $this->pelayaran->getBySatker(decrypt($id));
		// $this->data['dataEkspedisi'] = $this->ekspedisi->getBySatker(decrypt($id));
		// $this->data['dataShip'] = $this->shipHandler->getBySatker(decrypt($id));
		// Demografi
		// $this->data['dataPenduduk'] = $this->jumlahPenduduk->getBySatker(decrypt($id));
		// $this->data['dataAgama'] = $this->agama->getBySatker(decrypt($id));
		// $this->data['dataSuku'] = $this->sukuBangsa->getBySatker(decrypt($id));
		// $this->data['dataPesisir'] = $this->pesisir->getBySatker(decrypt($id));
		// $this->data['dataBahari'] = $this->sakaBahari->getBySatker(decrypt($id));
		// $this->data['dataPekerjaan'] = $this->pekerjaanMasyarakat->getBySatker(decrypt($id));
		//$this->data['dataPendidikan'] = $this->tingkatPendidikan->getBySatker(decrypt($id));
		// $this->data['dataRumahsakit'] = $this->rumahSakit->getBySatker(decrypt($id));
		// Kondsos
		// $this->data['dataTokoh'] = $this->tokohMasyarakat->getBySatker(decrypt($id));
		// $this->data['dataOrganisasiAgama'] = $this->organisasiAgama->getBySatker(decrypt($id));
		// $this->data['dataPolitik'] = $this->organisasiPolitik->getBySatker(decrypt($id));
		// $this->data['dataMasa'] = $this->organisasiMasa->getBySatker(decrypt($id));
		// $this->data['dataParpol'] = $this->partaiPolitik->getBySatker(decrypt($id));
		// $this->data['dataIndustri'] = $this->industriMenengah->getBySatker(decrypt($id));
		// $this->data['dataPariwisata'] = $this->pariwisata->getBySatker(decrypt($id));
		// $this->data['dataSejarah'] = $this->peninggalanSejarah->getBySatker(decrypt($id));
		// $this->data['dataBudaya'] = $this->budaya->getBySatker(decrypt($id));
		// $this->data['dataMiliter'] = $this->instansiMiliter->getBySatker(decrypt($id));
		// $this->data['dataUmkm'] = $this->umkm->getBySatker(decrypt($id));

		// // Geo SDA
		// $this->data['dataPantai'] = [];
		// $this->data['dataPantainew'] = [];
		// $this->data['dataHutan'] = [];
		// $this->data['dataHutannew'] = [];
		// $this->data['dataGunung'] = [];
		// $this->data['dataGunungnew'] = [];
		// $this->data['dataKerawanan'] = [];
		// $this->data['dataKerawanannew'] = [];
		// $this->data['dataHujan'] = [];
		// $this->data['dataHujannew'] = [];
		// $this->data['dataTanah'] = [];
		// $this->data['dataTanahnew'] = [];
		// $this->data['dataAir'] = [];
		// $this->data['dataAirnew'] = [];
		// $this->data['dataSungai'] = [];
		// $this->data['dataSungainew'] = [];
		// $this->data['dataPulau'] = [];
		// $this->data['dataPulaunew'] = [];
		// // Geo SDAB
		// $this->data['dataPerkebunan'] = [];
		// $this->data['dataPerkebunannew'] = [];
		// $this->data['dataPertanian'] = [];
		// $this->data['dataPertaniannew'] = [];
		// $this->data['dataPeternakan'] = [];
		// $this->data['dataPeternakannew'] = [];
		// $this->data['dataPertambangan'] = [];
		// $this->data['dataPertambangannew'] = [];
		// $this->data['dataIkan'] = [];
		// $this->data['dataIkannew'] = [];
		// $this->data['dataKeramba'] = [];
		// $this->data['dataKerambanew'] = [];
		// $this->data['dataKonservasi'] = [];
		// $this->data['dataKonservasinew'] = [];
		// $this->data['dataListrik'] = [];
		// $this->data['dataListriknew'] = [];
		// // Geo Sarpras
		// $this->data['dataPelabuhanSungai'] = [];
		// $this->data['dataPelabuhanSungainew'] = [];
		// $this->data['dataPelabuhanLaut'] = [];
		// $this->data['dataPelabuhanLautnew'] = [];
		// $this->data['dataPelabuhanIkan'] = [];
		// $this->data['dataPelabuhanIkannew'] = [];
		// $this->data['dataSarpras'] = [];
		// $this->data['dataSarprasnew'] = [];
		// // Geo Injas
		// $this->data['dataGalanganKapal'] = [];
		// $this->data['dataGalanganKapalnew'] = [];
		// $this->data['dataMesin'] = [];
		// $this->data['dataMesinnew'] = [];
		// $this->data['dataPelayaran'] = [];
		// $this->data['dataPelayarannew'] = [];
		// $this->data['dataEkspedisi'] = [];
		// $this->data['dataEkspedisinew'] = [];
		// $this->data['dataShip'] = [];
		// $this->data['dataShipnew'] = [];
		// $this->data['dataIndustriIkannew'] = [];
		// // Demografi
		// $this->data['dataPenduduk'] = [];
		// $this->data['dataPenduduknew'] = [];
		// $this->data['dataAgama'] = [];
		// $this->data['dataAgamanew'] = [];
		// $this->data['dataSuku'] = [];
		// $this->data['dataSukunew'] = [];
		// $this->data['dataPesisir'] = [];
		// $this->data['dataPesisirnew'] = [];
		// $this->data['dataBahari'] = [];
		// $this->data['dataBaharinew'] = [];
		// $this->data['dataPekerjaan'] = [];
		// $this->data['dataPekerjaannew'] = [];
		// //$this->data['dataPendidikan'] = $this->tingkatPendidikan->getBySatker(decrypt($id));
		// $this->data['dataMaritim'] = [];
		// $this->data['dataMaritimnew'] = [];
		// $this->data['dataRumahsakit'] = [];
		// $this->data['dataRumahsakitnew'] = [];
		// // Kondsos
		// $this->data['dataTokoh'] = [];
		// $this->data['dataTokohnew'] = [];
		// $this->data['dataOrganisasiAgama'] = [];
		// $this->data['dataOrganisasiAgamanew'] = [];
		// $this->data['dataPolitik'] = [];
		// $this->data['dataPolitiknew'] = [];
		// $this->data['dataMasa'] = [];
		// $this->data['dataMasanew'] = [];
		// $this->data['dataParpol'] = [];
		// $this->data['dataParpolnew'] = [];
		// $this->data['dataIndustri'] = [];
		// $this->data['dataIndustrinew'] = [];
		// $this->data['dataPariwisata'] = [];
		// $this->data['dataPariwisatanew'] = [];
		// $this->data['dataSejarah'] = [];
		// $this->data['dataSejarahnew'] = [];
		// $this->data['dataBudaya'] = [];
		// $this->data['dataBudayanew'] = [];
		// $this->data['dataMiliter'] = [];
		// $this->data['dataMiliternew'] = [];
		// $this->data['dataUmkm'] = [];
		// $this->data['dataUmkmnew'] = [];

		$markerDatas = [
			[
				'latitude' => $satker->latitude,
				'longitude' => $satker->longitude,
				'id_kotama' => $this->data['parentSatker1']->id_satker,
				'level' => $satker->level,
				'nama_satker' => $satker->nama_satker,
				'nama_pimpinan' => $satker->nama_pimpinan,
				'lokasi' => "$satker->KELURAHAN, $satker->KECAMATAN, $satker->KABUPATEN, $satker->PROVINSI"
			]
		];

		$this->data['markerDatasJson'] = json_encode($markerDatas);
	
		$data['isi'] = $this->load->view('organisasi/satuan_kerja/detail', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function store(){
		if (!policy('ORG','create')) show_404();

		$this->form_validation->set_rules('tipeORG', 'Tipe Organisasi', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Satker', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kode_satker', 'Kode Satker', 'trim|required');
		$this->form_validation->set_rules('parent', 'Parent Satker', 'trim');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('No_Telp', 'No_Telp', 'trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
		$this->form_validation->set_rules('nama_pimpinan', 'nama_pimpinan', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'tipeORG' 			=> form_error('tipeORG'),
				'name' 			=> form_error('name'),
				'kode_satker'	=> form_error('kode_satker'),
				'parent' 		=> form_error('parent'),
				'latitude' 		=> form_error('latitude'),
				'longitude' 	=> form_error('longitude'),
				'address' 		=> form_error('address'),
				'provinsi' 		=> form_error('provinsi'),
				'No_Telp' 		=> form_error('No_Telp'),
				'keterangan' 	=> form_error('keterangan'),
				'nama_pimpinan' => form_error('nama_pimpinan'),
				'email' 		=> form_error('email'),
				'flag_location' 		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'nama_satker'		=> $this->input->post('name'),
				'kode_satker'		=> $this->input->post('kode_satker'),
				'id_level'			=> $this->input->post('tipeORG'),
				'id_parent_satker'	=> $this->input->post('parent'),
				'latitude'			=> $this->input->post('latitude'),
				'longitude'			=> $this->input->post('longitude'),
				'alamat'			=> $this->input->post('address'),
				'No_Telp'			=> $this->input->post('No_Telp'),
				'keterangan'		=> $this->input->post('keterangan'),
				'nama_pimpinan' 	=> $this->input->post('nama_pimpinan'),
				'email' 			=> $this->input->post('email'),
				'flag_location' 			=> $this->input->post('flag_location'),
				'is_active'			=> TRUE,
				'created_by'		=> $this->session->userdata('id_user'),
				'created_date'		=> date("Y-m-d H:i:s"),
				'gambarsampul'		=> $this->satker->do_upload()
			);

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			if ($this->satker->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}
	
	public function edit($id)
	{
		if (!policy('ORG','update')) show_404();

		$this->data['title'] = 'Edit Satker';

		$this->data['satker'] = $this->satker->find(decrypt($id));
		$this->data['levels'] = $this->level->get();
		$this->data['satker1'] = $this->satker->getLevel(1);
		$this->data['satker2'] = $this->satker->getLevel(2);
		$this->data['satker3'] = $this->satker->getLevel(3);
		$this->data['provinsi'] = $this->geo->getLevel(1);
		
		$data['isi'] = $this->load->view('organisasi/satuan_kerja/edit', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function update(){
		if (!policy('ORG','update')) show_404();

		$this->form_validation->set_rules('tipeORG', 'Tipe Organisasi', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Satker', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kode_satker', 'Kode Satker', 'trim|required');
		$this->form_validation->set_rules('parent', 'Parent Satker', 'trim');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('No_Telp', 'No_Telp', 'trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
		$this->form_validation->set_rules('nama_pimpinan', 'nama_pimpinan', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'tipeORG' 			=> form_error('tipeORG'),
				'name' 			=> form_error('name'),
				'kode_satker'	=> form_error('kode_satker'),
				'parent' 		=> form_error('parent'),
				'latitude' 		=> form_error('latitude'),
				'longitude' 	=> form_error('longitude'),
				'address' 		=> form_error('address'),
				'provinsi' 	=> form_error('provinsi'),
				'No_Telp' 	=> form_error('No_Telp'),
				'keterangan' 	=> form_error('keterangan'),
				'nama_pimpinan' 	=> form_error('nama_pimpinan'),
				'email' 	=> form_error('email'),
				'flag_locationedit' 	=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{

			if($this->input->post('gambarsampul') == "undefined")
			{
				$data = array(
					'nama_satker'	=> $this->input->post('name'),
					'kode_satker'	=> $this->input->post('kode_satker'),
					'id_level'		=> $this->input->post('tipeORG'),
					'id_parent_satker'	=> $this->input->post('parent'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude'),
					'alamat'		=> $this->input->post('address'),
					'No_Telp'		=> $this->input->post('No_Telp'),
					'keterangan'		=> $this->input->post('keterangan'),
					'nama_pimpinan'		=> $this->input->post('nama_pimpinan'),
					'email' 	=> $this->input->post('email'),
					'flag_location' 	=> $this->input->post('flag_locationedit'),
					'updated_by'	=> $this->session->userdata('id_user'),
					'updated_date'	=> date("Y-m-d H:i:s")
				);
			}
			else if($this->input->post('gambarsampul') != "undefined")
			{
				$data = array(
					'nama_satker'	=> $this->input->post('name'),
					'kode_satker'	=> $this->input->post('kode_satker'),
					'id_level'		=> $this->input->post('tipeORG'),
					'id_parent_satker'	=> $this->input->post('parent'),
					'latitude'		=> $this->input->post('latitude'),
					'longitude'		=> $this->input->post('longitude'),
					'alamat'		=> $this->input->post('address'),
					'No_Telp'		=> $this->input->post('No_Telp'),
					'keterangan'		=> $this->input->post('keterangan'),
					'nama_pimpinan'		=> $this->input->post('nama_pimpinan'),
					'email' 	=> $this->input->post('email'),
					'flag_location' 	=> $this->input->post('flag_locationedit'),
					'updated_by'	=> $this->session->userdata('id_user'),
					'updated_date'	=> date("Y-m-d H:i:s"),
					'gambarsampul'		=> $this->satker->do_upload()
				);
			}
			
			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			$id = decrypt($this->input->post('id'));

			if ($this->satker->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('ORG','delete')) show_404();

        if (!isset($id)) show_404();

		if ($this->satker->checkSatker(decrypt($id))) {
			$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
			redirect_back();
		} else {
			if ($this->satker->delete(decrypt($id))) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect_back();
			} else {
				$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
				redirect_back();
			}
		}
	}

	public function getSatkerData($id)
	{
		if (!policy('ORG','update')) show_404();

		$this->data['satker'] = $this->satker->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function getProfile_Geo_SDA($id,$id2)
	{
		if($id2 == "pantai")
		{
			$this->data1['dataPantainew'] = $this->pantai->getBySatkernew($id);
			echo json_encode($this->data1['dataPantainew']);
		}
		if($id2 == "hutan")
		{
			$this->data2['dataHutannew'] = $this->hutan->getBySatkernew($id);
			echo json_encode($this->data2['dataHutannew']);
		}
		if($id2 == "gunung")
		{
			$this->data3['dataGunungnew'] = $this->gunung->getBySatkernew($id);
			echo json_encode($this->data3['dataGunungnew']);
		}
		if($id2 == "kerawanan")
		{
			$this->data4['dataKerawanannew'] = $this->kerawanan->getBySatkernew($id);
			echo json_encode($this->data4['dataKerawanannew']);
		}
		if($id2 == "hujan")
		{
			$this->data5['dataHujannew'] = $this->hujan->getBySatkernew($id);
			echo json_encode($this->data5['dataHujannew']);
		}
		if($id2 == "tanah")
		{
			$this->data6['dataTanahnew'] = $this->tanah->getBySatkernew($id);
			echo json_encode($this->data6['dataTanahnew']);
		}
		if($id2 == "air")
		{
			$this->data7['dataAirnew'] = $this->air->getBySatkernew($id);
			echo json_encode($this->data7['dataAirnew']);
		}
		if($id2 == "sungai")
		{
			$this->data8['dataSungainew'] = $this->sungai->getBySatkernew($id);
			echo json_encode($this->data8['dataSungainew']);
		}
		if($id2 == "pulau")
		{
			$this->data9['dataPulaunew'] = $this->pulau->getBySatkernew($id);
			echo json_encode($this->data9['dataPulaunew']);
		}
	}

	public function getProfile_Geo_SDAB($id,$id2)
	{
		if($id2 == "perkebunan")
		{
			$this->data1['dataPerkebunannew'] = $this->perkebunan->getBySatkernew($id);
			echo json_encode($this->data1['dataPerkebunannew']);
		}
		if($id2 == "pertanian")
		{
			$this->data2['dataPertaniannew'] = $this->pertanian->getBySatkernew($id);
			echo json_encode($this->data2['dataPertaniannew']);
		}
		if($id2 == "peternakan")
		{
			$this->data3['dataPeternakannew'] = $this->peternakan->getBySatkernew($id);
			echo json_encode($this->data3['dataPeternakannew']);
		}
		if($id2 == "pertambangan")
		{
			$this->data4['dataPertambangannew'] = $this->pertambangan->getBySatkernew($id);
			echo json_encode($this->data4['dataPertambangannew']);
		}
		if($id2 == "budidayaikan")
		{
			$this->data5['dataIkannew'] = $this->budidayaIkan->getBySatkernew($id);
			echo json_encode($this->data5['dataIkannew']);
		}
		if($id2 == "jaringapung")
		{
			$this->data6['dataKerambanew'] = $this->keramba->getBySatkernew($id);
			echo json_encode($this->data6['dataKerambanew']);
		}
		if($id2 == "konservasi")
		{
			$this->data7['dataKonservasinew'] = $this->konservasi->getBySatkernew($id);
			echo json_encode($this->data7['dataKonservasinew']);
		}
		if($id2 == "listrik")
		{
			$this->data8['dataListriknew'] = $this->listrik->getBySatkernew($id);
			echo json_encode($this->data8['dataListriknew']);
		}
	}

	public function getProfile_Geo_SARPRAS($id,$id2)
	{
		if($id2 == "pelabuhansungai")
		{
			$this->data1['dataPelabuhanSungainew'] = $this->pelabuhanSungai->getBySatkernew($id);
			echo json_encode($this->data1['dataPelabuhanSungainew']);
		}
		if($id2 == "pelabuhanlaut")
		{
			$this->data2['dataPelabuhanLautnew'] = $this->pelabuhanLaut->getBySatkernew($id);
			echo json_encode($this->data2['dataPelabuhanLautnew']);
		}
		if($id2 == "pelabuhanikan")
		{
			$this->data3['dataPelabuhanIkannew'] = $this->pelabuhanIkan->getBySatkernew($id);
			echo json_encode($this->data3['dataPelabuhanIkannew']);
		}
		if($id2 == "sapras")
		{
			$this->data4['dataSarprasnew'] = $this->sarpras->getBySatkernew($id);
			echo json_encode($this->data4['dataSarprasnew']);
		}
	}

	public function getProfile_Geo_INJASMAR($id,$id2)
	{
		if($id2 == "galangankapal")
		{
			$this->data1['dataGalanganKapalnew'] = $this->galanganKapal->getBySatkernew($id);
			echo json_encode($this->data1['dataGalanganKapalnew']);
		}
		if($id2 == "industrimesin")
		{
			$this->data2['dataMesinnew'] = $this->industriMesin->getBySatkernew($id);
			echo json_encode($this->data2['dataMesinnew']);
		}
		if($id2 == "lautnasional_pelayaran")
		{
			$this->data3['dataPelayarannew'] = $this->pelayaran->getBySatkernew($id);
			echo json_encode($this->data3['dataPelayarannew']);
		}
		if($id2 == "shipchandler")
		{
			$this->data4['dataShipnew'] = $this->shipHandler->getBySatkernew($id);
			echo json_encode($this->data4['dataShipnew']);
		}
		if($id2 == "industriperikanan")
		{
			$this->data4['dataIndustriIkannew'] = $this->industriIkan->getBySatkernew($id);
			echo json_encode($this->data4['dataIndustriIkannew']);
		}
		if($id2 == "lautnasional_ekspedisi")
		{
			$this->data5['dataEkspedisinew'] = $this->ekspedisi->getBySatkernew($id);
			echo json_encode($this->data5['dataEkspedisinew']);
		}
	}

	public function getProfile_KONSOS($id,$id2)
	{
		if($id2 == "tokohmasyarakat")
		{
			$this->data1['dataTokohnew'] = $this->tokohMasyarakat->getBySatkernew($id);
			echo json_encode($this->data1['dataTokohnew']);
		}
		if($id2 == "orgagama")
		{
			$this->data2['dataOrganisasiAgamanew'] = $this->organisasiAgama->getBySatkernew($id);
			echo json_encode($this->data2['dataOrganisasiAgamanew']);
		}
		if($id2 == "orgpolitik")
		{
			$this->data3['dataPolitiknew'] = $this->organisasiPolitik->getBySatkernew($id);
			echo json_encode($this->data3['dataPolitiknew']);
		}
		if($id2 == "orgmasa")
		{
			$this->data4['dataMasanew'] = $this->organisasiMasa->getBySatkernew($id);
			echo json_encode($this->data4['dataMasanew']);
		}
		if($id2 == "partaipolitik")
		{
			$this->data5['dataParpolnew'] = $this->partaiPolitik->getBySatkernew($id);
			echo json_encode($this->data5['dataParpolnew']);
		}
		if($id2 == "umkm")
		{
			$this->data6['dataUmkmnew'] = $this->umkm->getBySatkernew($id);
			echo json_encode($this->data6['dataUmkmnew']);
		}
		if($id2 == "industrimenengah")
		{
			$this->data7['dataIndustrinew'] = $this->industriMenengah->getBySatkernew($id);
			echo json_encode($this->data7['dataIndustrinew']);
		}
		if($id2 == "pariwisata")
		{
			$this->data8['dataPariwisatanew'] = $this->pariwisata->getBySatkernew($id);
			echo json_encode($this->data8['dataPariwisatanew']);
		}
		if($id2 == "sejarah")
		{
			$this->data9['dataSejarahnew'] = $this->peninggalanSejarah->getBySatkernew($id);
			echo json_encode($this->data9['dataSejarahnew']);
		}
		if($id2 == "budaya")
		{
			$this->data10['dataBudayanew'] = $this->budaya->getBySatkernew($id);
			echo json_encode($this->data10['dataBudayanew']);
		}
		if($id2 == "militerpolisi")
		{
			$this->data11['dataMiliternew'] = $this->instansiMiliter->getBySatkernew($id);
			echo json_encode($this->data11['dataMiliternew']);
		}
	}

	public function getProfile_DEMOGRAFI($id,$id2)
	{
		if($id2 == "jumlahpenduduk")
		{
			$this->data1['dataPenduduknew'] = $this->jumlahPenduduk->getBySatkernew($id);
			echo json_encode($this->data1['dataPenduduknew']);
		}
		if($id2 == "demoagama")
		{
			$this->data2['dataAgamanew'] = $this->agama->getBySatkernew($id);
			echo json_encode($this->data2['dataAgamanew']);
		}
		if($id2 == "sukubangsa")
		{
			$this->data3['dataSukunew'] = $this->sukuBangsa->getBySatkernew($id);
			echo json_encode($this->data3['dataSukunew']);
		}
		if($id2 == "desapesisir")
		{
			$this->data4['dataPesisirnew'] = $this->pesisir->getBySatkernew($id);
			echo json_encode($this->data4['dataPesisirnew']);
		}
		if($id2 == "sakabahari")
		{
			$this->data4['dataBaharinew'] = $this->sakaBahari->getBySatkernew($id);
			echo json_encode($this->data4['dataBaharinew']);
		}
		if($id2 == "pekerjaanmasyarakat")
		{
			$this->data5['dataPekerjaannew'] = $this->pekerjaanMasyarakat->getBySatkernew($id);
			echo json_encode($this->data5['dataPekerjaannew']);
		}
		if($id2 == "sekolahmaritim")
		{
			$this->data5['dataMaritimnew'] = $this->sekolahMaritim->getBySatkernew($id);
			echo json_encode($this->data5['dataMaritimnew']);
		}
		if($id2 == "rumahsakit")
		{
			$this->data5['dataRumahsakitnew'] = $this->rumahSakit->getBySatkernew($id);
			echo json_encode($this->data5['dataRumahsakitnew']);
		}
	}
}
