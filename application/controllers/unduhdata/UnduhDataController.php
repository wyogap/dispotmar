<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class UnduhDataController extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		in_access();



		$this->load->model('geografi/GeoPantai', 'pantai');

		$this->load->model('geografi/GeoHutan', 'hutan');

		$this->load->model('geografi/GeoGunung', 'gunung');

		$this->load->model('geografi/GeoKerawanan', 'kerawanan');

		$this->load->model('geografi/GeoHujan', 'hujan');

		$this->load->model('geografi/GeoTanah', 'tanah');

		$this->load->model('geografi/GeoAir', 'air');

		$this->load->model('geografi/GeoSungai', 'sungai');

		$this->load->model('geografi/GeoPulau', 'pulau');

		$this->load->model('RekapMangrove', 'mangrove');

		

		$this->load->model('geografi/GeoPerkebunan', 'perkebunan');

		$this->load->model('geografi/GeoPertanian', 'pertanian');

		$this->load->model('geografi/GeoPeternakan', 'peternakan');

		$this->load->model('geografi/GeoPertambangan', 'pertambangan');

		$this->load->model('geografi/GeoBudidayaIkan', 'ikan');

		$this->load->model('geografi/GeoKeramba', 'keramba');

		$this->load->model('geografi/GeoKonservasi', 'konservasi');

		$this->load->model('geografi/GeoListrik', 'listrik');

		

		$this->load->model('geografi/GeoPelabuhanSungai', 'pelabuhanSungai');

		$this->load->model('geografi/GeoPelabuhanLaut', 'pelabuhanLaut');

		$this->load->model('geografi/GeoPelabuhanIkan', 'pelabuhanIkan');

		$this->load->model('geografi/GeoSarpras', 'sarpras');

		

		$this->load->model('geografi/GeoGalanganKapal', 'galanganKapal');

		$this->load->model('geografi/GeoIndustriMesin', 'mesin');

		$this->load->model('geografi/GeoPelayaranRakyat', 'pelayaran');

		$this->load->model('geografi/GeoEkspedisiLaut', 'ekspedisi');

		$this->load->model('geografi/GeoShipHandler', 'ship');

		$this->load->model('geografi/GeoIndustriIkan', 'industriikan');



		$this->load->model('SatuanKerja', 'satker');

		$this->load->model('Geografi','geo');

		$this->load->model('JenisPantai','jenisPantai');

		$this->load->model('RekapPangan', 'pangan');

		$this->load->model('RekapLahanTidur', 'lahanTidur');

		$this->load->model('ProgresPangan', 'progres');

		$this->load->model('KomoditasPangan', 'komoditas');

		$this->load->model('SatuanKerja', 'satker');

		$this->load->model('SatuanKerja', 'satker23');

		$this->load->model('SatuanKerjaPersonel', 'personel');

		$this->load->model('Pelaporan', 'report');

		$this->load->model('PelaporanJenis', 'type');

		$this->load->model('JenisTanah','jenis');

		$this->load->model('StatusGunung','status');

		$this->load->model('JenisTanaman','jenis');

		$this->load->model('StatusHutan','status');

		$this->load->model('SumberAir','sumber');

		$this->load->model('PemanfaatanSungai','pemanfaatan');

		$this->load->model('User','user');



		$this->load->model('kondsos/TokohMasyarakat', 'tokoh');

		$this->load->model('kondsos/OrganisasiAgama', 'agama');

		$this->load->model('kondsos/OrganisasiPolitik', 'politik');

		$this->load->model('kondsos/OrganisasiMasa', 'masa');

		$this->load->model('kondsos/PartaiPolitik', 'parpol');

		$this->load->model('kondsos/Umkm', 'umkm');

		$this->load->model('kondsos/IndustriMenengah', 'industri');

		$this->load->model('kondsos/Pariwisata', 'pariwisata');

		$this->load->model('kondsos/PeninggalanSejarah', 'sejarah');

		$this->load->model('kondsos/Budaya', 'budaya');

		$this->load->model('kondsos/InstansiMiliter', 'militer');



		$this->load->model('demografi/Agama', 'demoagama');

		$this->load->model('demografi/Binaan', 'binaan');

		$this->load->model('demografi/Pesisir', 'pesisir');

		$this->load->model('demografi/JumlahPenduduk', 'penduduk');

		$this->load->model('demografi/PekerjaanMasyarakat', 'pekerjaan');

		$this->load->model('demografi/RumahSakit', 'rumahsakit');

		$this->load->model('demografi/SakaBahari', 'bahari');

		$this->load->model('demografi/SekolahMaritim', 'maritim');

		$this->load->model('demografi/SukuBangsa', 'suku');

    }



    public function index()

	{

		$this->data['title'] = 'Export Data';

	

		if (!policy('LAPHAR','create'))

		{

			show_404();

		}

		else

		{

			$this->data['kotama'] = $this->satker->getLevel1();

		}



		$data['isi'] = $this->load->view('unduhdata/unduh/index', $this->data, true);

		$this->load->view('skin/layout', $data);

	}



	public function getdataPantai($dataPantai)

	{

		$this->data['dataPantai'] = $this->pantai->getdataForDatatable(['satker' => $this->input->get('satker')]);



		if (policy('GEO','read')) {

			$this->data['dataGunung'] = $this->gunung->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataHutan'] = $this->hutan->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataKerawanan'] = $this->kerawanan->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataHujan'] = $this->hujan->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataTanah'] = $this->tanah->getdataForDatatable(['satker' =>$this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataAir'] = $this->air->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataSungai'] = $this->sungai->getdataForDatatable(['satker' => $this->input->get('satker')]);

		}



		if (policy('GEO','read')) {

			$this->data['dataPulau'] = $this->pulau->getdataForDatatable(['satker' =>$this->input->get('satker')]);

		}

		

		if (policy('KETPANG','read')) {

			$this->data['mangroves'] = $this->mangrove->list(['satker' => $this->input->get('satker')]);

		}

	}



	public function getdatasatker_bykotama($id)

	{

		$this->data['datasatker'] = $this->satker->getLevel2And3_forExportData($id);

			echo json_encode($this->data['datasatker']);

	}



	//laporan harian

	public function getdatalaporanharian($id)

	{
		if($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin')
		{
			$this->data['laporan'] = $this->report->getExport($id);
			echo json_encode($this->data['laporan']);
		}
		else
		{
			echo 'Anda tidak berwenang untuk mengakses data (You are not authorized to access the data)';
		}		
	}



	public function getdatajenislaporanharian()

	{

		$this->data['jenislaporan'] = $this->type->getExport();

			echo json_encode($this->data['jenislaporan']);

	}



	//ketahangan pangan

	public function getdatakomoditas()

	{

		$this->data['komoditas'] = $this->komoditas->getExport();

			echo json_encode($this->data['komoditas']);

	}



	public function getdatalahantidur($id)

	{

		$this->data['lahanTidur'] = $this->lahanTidur->getExport($id);

			echo json_encode($this->data['lahanTidur']);

	}



	public function getdatarekappangan($id)

	{

		$this->data['pangan'] = $this->pangan->getExport($id);

			echo json_encode($this->data['pangan']);

	}



	//user

	public function getdatauser($id)

	{
		if($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin')
		{
			$this->data['user'] = $this->user->getExport($id);
			echo json_encode($this->data['user']);			
		}
		else
		{
			echo 'Anda tidak berwenang untuk mengakses data (You are not authorized to access the data)';
		}
	}



	//satker

	public function getdatasatuankerjapersonel($id)
	{
		if($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin')
		{
			$this->data['personel'] = $this->personel->getExport($id);
			echo json_encode($this->data['personel']);	
		}
		else
		{
			echo 'Anda tidak berwenang untuk mengakses data (You are not authorized to access the data)';
		}		
	}



	public function getdatasatuankerja($id)

	{
		if($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin')
		{
			$this->data['satker'] = $this->satker->getExport($id);
			echo json_encode($this->data['satker']);
		}
		else
		{
			echo 'Anda tidak berwenang untuk mengakses data (You are not authorized to access the data)';
		}		
	}

	

	//konsos

	public function getdatatokohmasyarakat($id)

	{

		$this->data['tokoh'] = $this->tokoh->getExport($id);

			echo json_encode($this->data['tokoh']);

	}



	public function getdataorgagama($id)

	{

		$this->data['agama'] = $this->agama->getExport($id);

			echo json_encode($this->data['agama']);

	}



	public function getdataorgpolitik($id)

	{

		$this->data['politik'] = $this->politik->getExport($id);

			echo json_encode($this->data['politik']);

	}



	public function getdataorgmasa($id)

	{

		$this->data['masa'] = $this->masa->getExport($id);

			echo json_encode($this->data['masa']);

	}



	public function getdatapartaipolitik($id)

	{

		$this->data['parpol'] = $this->parpol->getExport($id);

			echo json_encode($this->data['parpol']);

	}



	public function getdataumkm($id)

	{

		$this->data['umkm'] = $this->umkm->getExport($id);

			echo json_encode($this->data['umkm']);

	}



	public function getdataindustrimenengah($id)

	{

		$this->data['industri'] = $this->industri->getExport($id);

			echo json_encode($this->data['industri']);

	}



	public function getdatapariwisata($id)

	{

		$this->data['pariwisata'] = $this->pariwisata->getExport($id);

			echo json_encode($this->data['pariwisata']);

	}



	public function getdatasejarah($id)

	{

		$this->data['sejarah'] = $this->sejarah->getExport($id);

			echo json_encode($this->data['sejarah']);

	}



	public function getdatabudaya($id)

	{

		$this->data['budaya'] = $this->budaya->getExport($id);

			echo json_encode($this->data['budaya']);

	}



	public function getdatamiliterpolisi($id)

	{

		$this->data['militer'] = $this->militer->getExport($id);

			echo json_encode($this->data['militer']);

	}



	//demo

	public function getdatajumlahpenduduk($id)

	{

		$this->data['penduduk'] = $this->penduduk->getExport($id);

			echo json_encode($this->data['penduduk']);

	}

	public function getdatademoagama($id)

	{

		$this->data['demoagama'] = $this->demoagama->getExport($id);

			echo json_encode($this->data['demoagama']);

	}

	public function getdatasukubangsa($id)

	{

		$this->data['suku'] = $this->suku->getExport($id);

			echo json_encode($this->data['suku']);

	}

	public function getdatadesabinaan($id)

	{

		$this->data['binaan'] = $this->binaan->getExport($id);

			echo json_encode($this->data['binaan']);

	}

	public function getdatadesapesisir($id)

	{

		$this->data['pesisir'] = $this->pesisir->getExport($id);

			echo json_encode($this->data['pesisir']);

	}

	public function getdatasakabahari($id)

	{

		$this->data['bahari'] = $this->bahari->getExport($id);

			echo json_encode($this->data['bahari']);

	}

	public function getdatapekerjaanmasyarakat($id)

	{

		$this->data['pekerjaan'] = $this->pekerjaan->getExport($id);

			echo json_encode($this->data['pekerjaan']);

	}

	public function getdatasekolahmaritim($id)

	{

		$this->data['maritim'] = $this->maritim->getExport($id);

			echo json_encode($this->data['maritim']);

	}

	public function getdatarumahsakit($id)

	{

		$this->data['rumahsakit'] = $this->rumahsakit->getExport($id);

			echo json_encode($this->data['rumahsakit']);

	}



	//geo sda

	public function getdatapantainew($id)

	{

		$this->data['pantai'] = $this->pantai->getExport($id);

			echo json_encode($this->data['pantai']);

	}

	public function getdatahutan($id)

	{

		$this->data['hutan'] = $this->hutan->getExport($id);

			echo json_encode($this->data['hutan']);

	}

	public function getdatagunung($id)

	{

		$this->data['gunung'] = $this->gunung->getExport($id);

			echo json_encode($this->data['gunung']);

	}

	public function getdatakerawanan($id)

	{

		$this->data['kerawanan'] = $this->kerawanan->getExport($id);

			echo json_encode($this->data['kerawanan']);

	}

	public function getdatahujan($id)

	{

		$this->data['hujan'] = $this->hujan->getExport($id);

			echo json_encode($this->data['hujan']);

	}

	public function getdatatanah($id)

	{

		$this->data['tanah'] = $this->tanah->getExport($id);

			echo json_encode($this->data['tanah']);

	}

	public function getdataair($id)

	{

		$this->data['air'] = $this->air->getExport($id);

			echo json_encode($this->data['air']);

	}

	public function getdatasungai($id)

	{

		$this->data['sungai'] = $this->sungai->getExport($id);

			echo json_encode($this->data['sungai']);

	}

	public function getdatapulau($id)

	{

		$this->data['pulau'] = $this->pulau->getExport($id);

			echo json_encode($this->data['pulau']);

	}

	public function getdatamangrove($id)

	{

		$this->data['mangrove'] = $this->mangrove->getExport($id);

			echo json_encode($this->data['mangrove']);

	}



	//geo sdab

	public function getdataperkebunan($id)

	{

		$this->data['perkebunan'] = $this->perkebunan->getExport($id);

			echo json_encode($this->data['perkebunan']);

	}

	public function getdatapertanian($id)

	{

		$this->data['pertanian'] = $this->pertanian->getExport($id);

			echo json_encode($this->data['pertanian']);

	}

	public function getdatapeternakan($id)

	{

		$this->data['peternakan'] = $this->peternakan->getExport($id);

			echo json_encode($this->data['peternakan']);

	}

	public function getdatapertambangan($id)

	{

		$this->data['pertambangan'] = $this->pertambangan->getExport($id);

			echo json_encode($this->data['pertambangan']);

	}

	public function getdatabudidayaikan($id)

	{

		$this->data['ikan'] = $this->ikan->getExport($id);

			echo json_encode($this->data['ikan']);

	}

	public function getdatajaringapung($id)

	{

		$this->data['keramba'] = $this->keramba->getExport($id);

			echo json_encode($this->data['keramba']);

	}

	public function getdatakonservasi($id)

	{

		$this->data['konservasi'] = $this->konservasi->getExport($id);

			echo json_encode($this->data['konservasi']);

	}

	public function getdatalistrik($id)

	{

		$this->data['listrik'] = $this->listrik->getExport($id);

			echo json_encode($this->data['listrik']);

	}



	//geo sarpras

	public function getdatapelabuhansungai($id)

	{

		$this->data['pelabuhanSungai'] = $this->pelabuhanSungai->getExport($id);

			echo json_encode($this->data['pelabuhanSungai']);

	}

	public function getdatapelabuhanlaut($id)

	{

		$this->data['pelabuhanLaut'] = $this->pelabuhanLaut->getExport($id);

			echo json_encode($this->data['pelabuhanLaut']);

	}

	public function getdatapelabuhanikan($id)

	{

		$this->data['pelabuhanIkan'] = $this->pelabuhanIkan->getExport($id);

			echo json_encode($this->data['pelabuhanIkan']);

	}

	public function getdatasapras($id)

	{

		$this->data['sarpras'] = $this->sarpras->getExport($id);

			echo json_encode($this->data['sarpras']);

	}



	//geo injasmar

	public function getdatagalangankapal($id)

	{

		$this->data['galanganKapal'] = $this->galanganKapal->getExport($id);

			echo json_encode($this->data['galanganKapal']);

	}

	public function getdataindustrimesin($id)

	{

		$this->data['mesin'] = $this->mesin->getExport($id);

			echo json_encode($this->data['mesin']);

	}

	public function getdatalautnasional_pelayaran($id)

	{

		$this->data['pelayaran'] = $this->pelayaran->getExport($id);

			echo json_encode($this->data['pelayaran']);

	}

	public function getdatalautnasional_ekspedisi($id)

	{

		$this->data['ekspedisi'] = $this->ekspedisi->getExport($id);

			echo json_encode($this->data['ekspedisi']);

	}

	public function getdatashipchandler($id)

	{

		$this->data['ship'] = $this->ship->getExport($id);

			echo json_encode($this->data['ship']);

	}

	public function getdataindustriperikanan($id)

	{

		$this->data['industriikan'] = $this->industriikan->getExport($id);

			echo json_encode($this->data['industriikan']);

	}

}

