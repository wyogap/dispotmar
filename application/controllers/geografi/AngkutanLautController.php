<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AngkutanLautController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPelayaranRakyat', 'pelayaran');
		$this->load->model('geografi/GeoEkspedisiLaut', 'ekspedisi');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
		$this->load->model('JenisMuatan','muatan');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Angkutan Laut Nasional';

		if (policy('GEO','read')) {
			$this->data['dataPelayaran'] = $this->pelayaran->LISTgetdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
			$this->data['dataEkspedisi'] = $this->ekspedisi->LISTgetdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPelayaran'] = $this->pelayaran->LISTgetdataForDatatable();
			$this->data['dataEkspedisi'] = $this->ekspedisi->LISTgetdataForDatatable();
		}

		$this->data['jenisMuatan'] = $this->muatan->get();
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/injasMaritim/alNasional/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}
}
