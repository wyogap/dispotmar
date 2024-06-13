<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'LoginController';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// AUTH
$route['login'] = 'LoginController/index';
$route['login/store'] = 'LoginController/login';
$route['logout'] = 'LoginController/logout';

// API
$route['api/getSatker/(:any)'] = 'ApiController/getSatker/$1';
$route['api/getSatkerById/(:any)'] = 'ApiController/getSatkerById/$1';
$route['api/getsatkerLevel2And3/(:any)'] = 'ApiController/getsatkerLevel2And3/$1';
$route['api/getReports'] = 'ApiController/getReports';
$route['api/checkReports'] = 'ApiController/checkReports';
$route['api/getProvinsi/(:any)'] = 'ApiController/getProvinsi/$1';
$route['api/getKabupaten/(:any)'] = 'ApiController/getKabupaten/$1';
$route['api/getKecamatan/(:any)'] = 'ApiController/getKecamatan/$1';
$route['api/getKelurahan/(:any)'] = 'ApiController/getKelurahan/$1';
$route['api/getKomoditas/(:any)'] = 'ApiController/getKomoditas/$1';
$route['api/getSatuanKomoditas/(:any)'] = 'ApiController/getSatuanKomoditas/$1';
$route['api/getComodityResult'] = 'ApiController/getComodityResult';
$route['api/getClusterResult'] = 'ApiController/getClusterResult';
$route['api/getAreaByKotama'] = 'ApiController/getAreaByKotama';
$route['api/getAreaBySatker'] = 'ApiController/getAreaBySatker';
$route['api/getAreaByComodity'] = 'ApiController/getAreaByComodity';
$route['api/getEstimateByComodity'] = 'ApiController/getEstimateByComodity';
$route['api/getComodityPieChart'] = 'ApiController/getComodityPieChart';
$route['api/getClusterPieChart'] = 'ApiController/getClusterPieChart';
$route['api/getSatkerPieChart'] = 'ApiController/getSatkerPieChart';
$route['api/getPanganProgress'] = 'ApiController/getPanganProgress';
$route['api/getPersonelBySatker'] = 'ApiController/getPersonelBySatker';
$route['api/getPersonelByStrataPieChart'] = 'ApiController/getPersonelByStrataPieChart';
$route['api/getPersonelByKotamaPieChart'] = 'ApiController/getPersonelByKotamaPieChart';
$route['api/getReportCategoryRankPieChart'] = 'ApiController/getReportCategoryRankPieChart';
$route['api/getAllActivity/(:any)'] = 'ApiController/getAllActivity/$1';
$route['api/getCriminalsActivity'] = 'ApiController/getCriminalsActivity';
$route['api/getDataByMonth/(:any)'] = 'ApiController/getDataByMonth/$1';
$route['api/getdatabyyear'] = 'ApiController/getdatabyyear';
$route['api/getGeodemokonsosChart/(:num)'] = 'ApiController/getGeodemokonsosChart/$1';
$route['api/getActivitySosialBySatkerAndActivityType/(:any)/(:any)'] = 'ApiController/getActivitySosialBySatkerAndActivityType/$1/$2';
$route['api/getActivitySosialBySatker/(:any)'] = 'ApiController/getActivitySosialBySatker/$1';
$route['api/getActivitySosialByPersonal/(:any)'] = 'ApiController/getActivitySosialByPersonal/$1';

// Dashboard
$route['home'] = 'DashboardController/home';
$route['dashboard1'] = 'DashboardController/dashboard1';
$route['dashboard2'] = 'DashboardController/dashboard2';
$route['dashboard3'] = 'DashboardController/dashboard3';

// $route['dashboard4'] = 'DashboardController/dashboard4';
$route['dashboard4'] = 'Dashboard4Controller/index';
$route['dashboard4/getPersonelByKotama'] = 'Dashboard4Controller/getPersonelByKotama';
$route['dashboard4/getPersonelByStrata'] = 'Dashboard4Controller/getPersonelByStrata';
$route['dashboard4/getPersonelBySatker'] = 'Dashboard4Controller/getPersonelBySatker';


$route['dashboard5'] = 'DashboardController/dashboard5';
$route['dashboard5/(:any)'] = 'DashboardController/dashboard5/$1';
$route['dashboard6'] = 'DashboardController/dashboard6';

$route['dashboard7/cart/(:num)'] = 'Dashboard7Controller/chart/$1';
$route['dashboard7/detail'] = 'Dashboard7Controller/detail';
$route['dashboard7'] = 'Dashboard7Controller/index';

// $route['dashboard8'] = 'DashboardController/dashboard8';
$route['dashboard8'] = 'Dashboard8Controller/index';
$route['dashboard8/cart/(:num)'] = 'Dashboard8Controller/chart/$1';
$route['dashboard8/detail'] = 'Dashboard8Controller/detail';

// $route['dashboard9'] = 'DashboardController/dashboard9';
$route['dashboard9/cart/(:num)'] = 'Dashboard9Controller/chart/$1';
$route['dashboard9/detail'] = 'Dashboard9Controller/detail';
$route['dashboard9'] = 'Dashboard9Controller/index';


// Organisasi
$route['organisasi_level'] = 'LevelController/index';
$route['organisasi_level/store'] = 'LevelController/store';
$route['organisasi_level/(:any)'] = 'LevelController/show/$1';
$route['organisasi_levels/update'] = 'LevelController/update';
$route['organisasi_level/(:any)/delete'] = 'LevelController/delete/$1';

$route['organisasi_satker'] = 'SatuanKerjaController/index';
$route['organisasi_satker/create'] = 'SatuanKerjaController/create';
$route['organisasi_satker/store'] = 'SatuanKerjaController/store';
$route['organisasi_satker/update'] = 'SatuanKerjaController/update';
$route['organisasi_satker/(:any)/edit'] = 'SatuanKerjaController/edit/$1';
$route['organisasi_satker/(:any)/show'] = 'SatuanKerjaController/show/$1';
$route['organisasi_satker/(:any)/delete'] = 'SatuanKerjaController/delete/$1';
$route['organisasi_satker/getSatkerData/(:any)'] = 'SatuanKerjaController/getSatkerData/$1';
$route['organisasi_satker_detail'] = 'SatuanKerjaController/detail';

$route['organisasi_satker_personel'] = 'SatuanKerjaPersonelController/index';
$route['organisasi_satker_personel/update'] = 'SatuanKerjaPersonelController/update';
$route['organisasi_satker_personel/(:any)'] = 'SatuanKerjaPersonelController/show/$1';

// User Management & audit Trail
$route['user_master_role'] = 'RoleController/index';
$route['user_master_role/store'] = 'RoleController/store';
$route['user_master_role/update'] = 'RoleController/update';
$route['user_master_role/(:any)/delete'] = 'RoleController/delete/$1';

$route['role_permission/(:any)/store'] = 'PermissionController/store/$1';
$route['role_permission/(:any)'] = 'PermissionController/index/$1';
$route['role_permission/(:any)/update'] = 'PermissionController/update/$1';

$route['user_management'] = 'UserController/index';
$route['user_management/store'] = 'UserController/store';
$route['user_management/(:any)'] = 'UserController/show/$1';
$route['user_managements/update'] = 'UserController/update';
$route['user_management/(:any)/delete'] = 'UserController/delete/$1';
$route['user_management/notifable/update'] = 'UserController/notifable';

$route['user_management_edit'] = 'UserController/edit';


// Pelaporan
$route['data_pelaporan'] = 'PelaporanController/index';
$route['api/getPelaporanRekapTable/(:any)'] = 'PelaporanController/getPelaporanRekapTable/$1';
$route['data_pelaporan/(:any)'] = 'PelaporanController/show/$1';
$route['data_pelaporan/(:any)/show'] = 'PelaporanController/detail/$1';
$route['form_pelaporan'] = 'PelaporanController/create';
$route['form_pelaporan/store'] = 'PelaporanController/store';
$route['data_pelaporan/(:any)/delete'] = 'PelaporanController/delete/$1';
$route['form_pelaporan/update'] = 'PelaporanController/update';


$route['data_pelaporan/(:any)/notification/(:any)'] = 'PelaporanController/read/$1/$2';
$route['data_pelaporan_detail'] = 'PelaporanController/detail';



// Jenis Pelaporan
$route['jenis_pelaporan'] = 'PelaporanJenisController/index';
$route['jenis_pelaporan/store'] = 'PelaporanJenisController/store';
$route['jenis_pelaporan/update'] = 'PelaporanJenisController/update';
$route['jenis_pelaporan/(:any)/delete'] = 'PelaporanJenisController/delete/$1';
$route['jenis_pelaporan/(:any)'] = 'PelaporanJenisController/show/$1';


// Pangan Komoditas
$route['pangan_komoditas'] = 'PanganKomoditasController/index';
$route['pangan_komoditas/store'] = 'PanganKomoditasController/store';
$route['pangan_komoditas/(:any)'] = 'PanganKomoditasController/show/$1';
$route['pangan_komoditass/update'] = 'PanganKomoditasController/update';
$route['pangan_komoditas/(:any)/delete'] = 'PanganKomoditasController/delete/$1';

// Pangan Rekap
$route['pangan_rekap'] = 'PanganRekapController/index';
$route['pangan_rekap/(:any)'] = 'PanganRekapController/show/$1';
$route['pangan_rekap_add'] = 'PanganRekapController/create';
$route['pangan_rekap_add/store'] = 'PanganRekapController/store';
$route['pangan_rekap_detail'] = 'PanganRekapController/viewdetail';
$route['pangan_rekap/(:any)/delete'] = 'PanganRekapController/delete/$1';
$route['pangan_rekap_edit/(:any)'] = 'PanganRekapController/edit/$1';
$route['pangan_rekap_editz/update'] = 'PanganRekapController/update';

// Pangan Lahan Tidur
$route['pangan_lahantidur'] = 'PanganLahantidurController/index';
$route['pangan_lahantidur_add'] = 'PanganLahantidurController/create';
$route['pangan_lahantidur_add/store'] = 'PanganLahantidurController/store';
$route['pangan_lahantidur_edit/(:any)'] = 'PanganLahantidurController/edit/$1';
$route['pangan_lahantidur_edits/update'] = 'PanganLahantidurController/update';
$route['pangan_lahantidur/(:any)/delete'] = 'PanganLahantidurController/delete/$1';

// Pangan Mangrove
$route['pangan_mangrove'] = 'PanganMangroveController/index';
$route['pangan_mangrove_add'] = 'PanganMangroveController/create';
$route['pangan_mangrove_add/store'] = 'PanganMangroveController/store';
$route['pangan_mangrove_edit/(:any)'] = 'PanganMangroveController/edit/$1';
$route['pangan_mangrove_edits/update'] = 'PanganMangroveController/update';
$route['pangan_mangrove/(:any)/delete'] = 'PanganMangroveController/delete/$1';


// Geografi - sda 
// pantai
$route['geografi_pantai'] = 'geografi/PantaiController/index';
$route['geografi_pantai/store'] = 'geografi/PantaiController/store';
$route['geografi_pantai/(:any)'] = 'geografi/PantaiController/show/$1';
$route['geografi_pantais/update'] = 'geografi/PantaiController/update';
$route['geografi_pantai/(:any)/delete'] = 'geografi/PantaiController/delete/$1';
// hutan
$route['geografi_hutan'] = 'geografi/HutanController/index';
$route['geografi_hutan/store'] = 'geografi/HutanController/store';
$route['geografi_hutan/(:any)'] = 'geografi/HutanController/show/$1';
$route['geografi_hutans/update'] = 'geografi/HutanController/update';
$route['geografi_hutan/(:any)/delete'] = 'geografi/HutanController/delete/$1';
// gunung
$route['geografi_gunung'] = 'geografi/GunungController/index';
$route['geografi_gunung/store'] = 'geografi/GunungController/store';
$route['geografi_gunung/(:any)'] = 'geografi/GunungController/show/$1';
$route['geografi_gunungs/update'] = 'geografi/GunungController/update';
$route['geografi_gunung/(:any)/delete'] = 'geografi/GunungController/delete/$1';
// hujan
$route['geografi_curahHujan'] = 'geografi/HujanController/index';
$route['geografi_curahHujan/store'] = 'geografi/HujanController/store';
$route['geografi_curahHujan/(:any)'] = 'geografi/HujanController/show/$1';
$route['geografi_curahHujans/update'] = 'geografi/HujanController/update';
$route['geografi_curahHujan/(:any)/delete'] = 'geografi/HujanController/delete/$1';
// tanah
$route['geografi_strukTanah'] = 'geografi/StruktanahController/index';
$route['geografi_strukTanah/store'] = 'geografi/StruktanahController/store';
$route['geografi_strukTanah/(:any)'] = 'geografi/StruktanahController/show/$1';
$route['geografi_strukTanahs/update'] = 'geografi/StruktanahController/update';
$route['geografi_strukTanah/(:any)/delete'] = 'geografi/StruktanahController/delete/$1';
// air
$route['geografi_sumberAir'] = 'geografi/SumberAirController/index';
$route['geografi_sumberAir/store'] = 'geografi/SumberAirController/store';
$route['geografi_sumberAir/(:any)'] = 'geografi/SumberAirController/show/$1';
$route['geografi_sumberAirs/update'] = 'geografi/SumberAirController/update';
$route['geografi_sumberAir/(:any)/delete'] = 'geografi/SumberAirController/delete/$1';
// sungai
$route['geografi_sungai'] = 'geografi/SungaiController/index';
$route['geografi_sungai/store'] = 'geografi/SungaiController/store';
$route['geografi_sungai/(:any)'] = 'geografi/SungaiController/show/$1';
$route['geografi_sungais/update'] = 'geografi/SungaiController/update';
$route['geografi_sungai/(:any)/delete'] = 'geografi/SungaiController/delete/$1';
// pulau
$route['geografi_pulauTerluar'] = 'geografi/PulauTerluarController/index';
$route['geografi_pulauTerluar/store'] = 'geografi/PulauTerluarController/store';
$route['geografi_pulauTerluar/(:any)'] = 'geografi/PulauTerluarController/show/$1';
$route['geografi_pulauTerluars/update'] = 'geografi/PulauTerluarController/update';
$route['geografi_pulauTerluar/(:any)/delete'] = 'geografi/PulauTerluarController/delete/$1';
// kerawanan
$route['geografi_kerawanan'] = 'geografi/KerawananController/index';
$route['geografi_kerawanan/store'] = 'geografi/KerawananController/store';
$route['geografi_kerawanan/(:any)'] = 'geografi/KerawananController/show/$1';
$route['geografi_kerawanans/update'] = 'geografi/KerawananController/update';
$route['geografi_kerawanan/(:any)/delete'] = 'geografi/KerawananController/delete/$1';

// geografi - sdab
// perkebunan
$route['geografi_perkebunan'] = 'geografi/PerkebunanController/index';
$route['geografi_perkebunan/store'] = 'geografi/PerkebunanController/store';
$route['geografi_perkebunan/(:any)'] = 'geografi/PerkebunanController/show/$1';
$route['geografi_perkebunans/update'] = 'geografi/PerkebunanController/update';
$route['geografi_perkebunan/(:any)/delete'] = 'geografi/PerkebunanController/delete/$1';
// pertanian
$route['geografi_pertanian'] = 'geografi/PertanianController/index';
$route['geografi_pertanian/store'] = 'geografi/PertanianController/store';
$route['geografi_pertanian/(:any)'] = 'geografi/PertanianController/show/$1';
$route['geografi_pertanians/update'] = 'geografi/PertanianController/update';
$route['geografi_pertanian/(:any)/delete'] = 'geografi/PertanianController/delete/$1';
// peternakan
$route['geografi_peternakan'] = 'geografi/PeternakanController/index';
$route['geografi_peternakan/store'] = 'geografi/PeternakanController/store';
$route['geografi_peternakan/(:any)'] = 'geografi/PeternakanController/show/$1';
$route['geografi_peternakans/update'] = 'geografi/PeternakanController/update';
$route['geografi_peternakan/(:any)/delete'] = 'geografi/PeternakanController/delete/$1';
// pertambangan
$route['geografi_pertambangan'] = 'geografi/PertambanganController/index';
$route['geografi_pertambangan/store'] = 'geografi/PertambanganController/store';
$route['geografi_pertambangan/(:any)'] = 'geografi/PertambanganController/show/$1';
$route['geografi_pertambangans/update'] = 'geografi/PertambanganController/update';
$route['geografi_pertambangan/(:any)/delete'] = 'geografi/PertambanganController/delete/$1';
// budidaya ikan
$route['geografi_budidayaIkan'] = 'geografi/BudidayaIkanController/index';
$route['geografi_budidayaIkan/store'] = 'geografi/BudidayaIkanController/store';
$route['geografi_budidayaIkan/(:any)'] = 'geografi/BudidayaIkanController/show/$1';
$route['geografi_budidayaIkans/update'] = 'geografi/BudidayaIkanController/update';
$route['geografi_budidayaIkan/(:any)/delete'] = 'geografi/BudidayaIkanController/delete/$1';
// keramba
$route['geografi_kerambaJaring'] = 'geografi/KerambaController/index';
$route['geografi_kerambaJaring/store'] = 'geografi/KerambaController/store';
$route['geografi_kerambaJaring/(:any)'] = 'geografi/KerambaController/show/$1';
$route['geografi_kerambaJarings/update'] = 'geografi/KerambaController/update';
$route['geografi_kerambaJaring/(:any)/delete'] = 'geografi/KerambaController/delete/$1';
// konservasi
$route['geografi_konservasi'] = 'geografi/KonservasiController/index';
$route['geografi_konservasi/store'] = 'geografi/KonservasiController/store';
$route['geografi_konservasi/(:any)'] = 'geografi/KonservasiController/show/$1';
$route['geografi_konservasis/update'] = 'geografi/KonservasiController/update';
$route['geografi_konservasi/(:any)/delete'] = 'geografi/KonservasiController/delete/$1';
// listrik
$route['geografi_sumberListrik'] = 'geografi/ListrikController/index';
$route['geografi_sumberListrik/store'] = 'geografi/ListrikController/store';
$route['geografi_sumberListrik/(:any)'] = 'geografi/ListrikController/show/$1';
$route['geografi_sumberListriks/update'] = 'geografi/ListrikController/update';
$route['geografi_sumberListrik/(:any)/delete'] = 'geografi/ListrikController/delete/$1';

//geografi - sarpras
// pelabuhan sungai
$route['geografi_pelabuhanSungai'] = 'geografi/LabuhSungaiController/index';
$route['geografi_pelabuhanSungai/store'] = 'geografi/LabuhSungaiController/store';
$route['geografi_pelabuhanSungai/(:any)'] = 'geografi/LabuhSungaiController/show/$1';
$route['geografi_pelabuhanSungais/update'] = 'geografi/LabuhSungaiController/update';
$route['geografi_pelabuhanSungai/(:any)/delete'] = 'geografi/LabuhSungaiController/delete/$1';
// pelabuhan ikan
$route['geografi_pelabuhanIkan'] = 'geografi/LabuhIkanController/index';
$route['geografi_pelabuhanIkan/store'] = 'geografi/LabuhIkanController/store';
$route['geografi_pelabuhanIkan/(:any)'] = 'geografi/LabuhIkanController/show/$1';
$route['geografi_pelabuhanIkans/update'] = 'geografi/LabuhIkanController/update';
$route['geografi_pelabuhanIkan/(:any)/delete'] = 'geografi/LabuhIkanController/delete/$1';
// sarpras
$route['geografi_sarprasJalan'] = 'geografi/SarprasController/index';
$route['geografi_sarprasJalan/store'] = 'geografi/SarprasController/store';
$route['geografi_sarprasJalan/(:any)'] = 'geografi/SarprasController/show/$1';
$route['geografi_sarprasJalans/update'] = 'geografi/SarprasController/update';
$route['geografi_sarprasJalan/(:any)/delete'] = 'geografi/SarprasController/delete/$1';
// pelabuhan laut
$route['geografi_pelabuhanLaut'] = 'geografi/LabuhLautController/index';
$route['geografi_pelabuhanLaut/create'] = 'geografi/LabuhLautController/create';
$route['geografi_pelabuhanLaut/store'] = 'geografi/LabuhLautController/store';
$route['geografi_pelabuhanLaut/update'] = 'geografi/LabuhLautController/update';
$route['geografi_pelabuhanLaut/(:any)/edit'] = 'geografi/LabuhLautController/edit/$1';
$route['geografi_pelabuhanLaut/(:any)/data'] = 'geografi/LabuhLautController/data/$1';
$route['geografi_pelabuhanLaut/(:any)/show'] = 'geografi/LabuhLautController/show/$1';
$route['geografi_pelabuhanLaut/(:any)/delete'] = 'geografi/LabuhLautController/delete/$1';



//geografi - sarpras
// galangan kapal
$route['geografi_galanganKapal'] = 'geografi/GalanganKapalController/index';
$route['geografi_galanganKapal/store'] = 'geografi/GalanganKapalController/store';
$route['geografi_galanganKapal/(:any)'] = 'geografi/GalanganKapalController/show/$1';
$route['geografi_galanganKapals/update'] = 'geografi/GalanganKapalController/update';
$route['geografi_galanganKapal/(:any)/delete'] = 'geografi/GalanganKapalController/delete/$1';
// industri mesin
$route['geografi_industriMesin'] = 'geografi/IndustriMesinController/index';
$route['geografi_industriMesin/store'] = 'geografi/IndustriMesinController/store';
$route['geografi_industriMesin/(:any)'] = 'geografi/IndustriMesinController/show/$1';
$route['geografi_industriMesins/update'] = 'geografi/IndustriMesinController/update';
$route['geografi_industriMesin/(:any)/delete'] = 'geografi/IndustriMesinController/delete/$1';
// industri perikanan
$route['geografi_industriIkan'] = 'geografi/IndustriIkanController/index';
$route['geografi_industriIkan/store'] = 'geografi/IndustriIkanController/store';
$route['geografi_industriIkan/(:any)'] = 'geografi/IndustriIkanController/show/$1';
$route['geografi_industriIkans/update'] = 'geografi/IndustriIkanController/update';
$route['geografi_industriIkan/(:any)/delete'] = 'geografi/IndustriIkanController/delete/$1';
// ship handler
$route['geografi_shipHandler'] = 'geografi/ShipHandlerController/index';
$route['geografi_shipHandler/store'] = 'geografi/ShipHandlerController/store';
$route['geografi_shipHandler/(:any)'] = 'geografi/ShipHandlerController/show/$1';
$route['geografi_shipHandlers/update'] = 'geografi/ShipHandlerController/update';
$route['geografi_shipHandler/(:any)/delete'] = 'geografi/ShipHandlerController/delete/$1';

$route['geografi_alNasional'] = 'geografi/AngkutanLautController/index';
$route['geografi_pelayaran/store'] = 'geografi/PelayaranRakyatController/store';
$route['geografi_pelayaran/(:any)'] = 'geografi/PelayaranRakyatController/show/$1';
$route['geografi_pelayarans/update'] = 'geografi/PelayaranRakyatController/update';
$route['geografi_pelayaran/(:any)/delete'] = 'geografi/PelayaranRakyatController/delete/$1';
$route['geografi_ekspedisi/store'] = 'geografi/EkspedisiLautController/store';
$route['geografi_ekspedisi/(:any)'] = 'geografi/EkspedisiLautController/show/$1';
$route['geografi_ekspedisis/update'] = 'geografi/EkspedisiLautController/update';
$route['geografi_ekspedisi/(:any)/delete'] = 'geografi/EkspedisiLautController/delete/$1';

$route['master_sda'] ='masterdata/sda';
$route['master_sdab'] = 'masterdata/sdab';
$route['master_sarana'] ='masterdata/sarana';
$route['master_industri'] ='masterdata/industri';

// Demografi
// jumlah penduduk
$route['demografi_jumlahPenduduk'] = 'demografi/JumlahPendudukController/index';
$route['demografi_jumlahPenduduk/store'] = 'demografi/JumlahPendudukController/store';
$route['demografi_jumlahPenduduk/(:any)'] = 'demografi/JumlahPendudukController/show/$1';
$route['demografi_jumlahPenduduks/update'] = 'demografi/JumlahPendudukController/update';
$route['demografi_jumlahPenduduk/(:any)/delete'] = 'demografi/JumlahPendudukController/delete/$1';
// agama
$route['demografi_agama'] = 'demografi/AgamaController/index';
$route['demografi_agama/store'] = 'demografi/AgamaController/store';
$route['demografi_agama/(:any)'] = 'demografi/AgamaController/show/$1';
$route['demografi_agamas/update'] = 'demografi/AgamaController/update';
$route['demografi_agama/(:any)/delete'] = 'demografi/AgamaController/delete/$1';
// suku
$route['demografi_sukuBangsa'] = 'demografi/SukuBangsaController/index';
$route['demografi_sukuBangsa/store'] = 'demografi/SukuBangsaController/store';
$route['demografi_sukuBangsa/(:any)'] = 'demografi/SukuBangsaController/show/$1';
$route['demografi_sukuBangsas/update'] = 'demografi/SukuBangsaController/update';
$route['demografi_sukuBangsa/(:any)/delete'] = 'demografi/SukuBangsaController/delete/$1';
// desa pesisir
$route['demografi_desaPesisir'] = 'demografi/DesaPesisirController/index';
$route['demografi_desaPesisir/store'] = 'demografi/DesaPesisirController/store';
$route['demografi_desaPesisir/(:any)'] = 'demografi/DesaPesisirController/show/$1';
$route['demografi_desaPesisirs/update'] = 'demografi/DesaPesisirController/update';
$route['demografi_desaPesisir/(:any)/delete'] = 'demografi/DesaPesisirController/delete/$1';
// desa Binaan
$route['demografi_desaBinaan'] = 'demografi/DesaBinaanController/index';
$route['demografi_desaBinaan/store'] = 'demografi/DesaBinaanController/store';
$route['demografi_desaBinaan/(:any)'] = 'demografi/DesaBinaanController/show/$1';
$route['demografi_desaBinaans/update'] = 'demografi/DesaBinaanController/update';
$route['demografi_desaBinaan/(:any)/delete'] = 'demografi/DesaBinaanController/delete/$1';
// saka bahari
$route['demografi_sakaBahari'] = 'demografi/SakaBahariController/index';
$route['demografi_sakaBahari/store'] = 'demografi/SakaBahariController/store';
$route['demografi_sakaBahari/(:any)'] = 'demografi/SakaBahariController/show/$1';
$route['demografi_sakaBaharis/update'] = 'demografi/SakaBahariController/update';
$route['demografi_sakaBahari/(:any)/delete'] = 'demografi/SakaBahariController/delete/$1';
// pekerjaan
$route['demografi_pekerjaanMasyarakat'] = 'demografi/PekerjaanMasyarakatController/index';
$route['demografi_pekerjaanMasyarakat/store'] = 'demografi/PekerjaanMasyarakatController/store';
$route['demografi_pekerjaanMasyarakat/(:any)'] = 'demografi/PekerjaanMasyarakatController/show/$1';
$route['demografi_pekerjaanMasyarakats/update'] = 'demografi/PekerjaanMasyarakatController/update';
$route['demografi_pekerjaanMasyarakat/(:any)/delete'] = 'demografi/PekerjaanMasyarakatController/delete/$1';
// pendidikan
$route['demografi_tingkatPendidikan'] = 'demografi/TingkatPendidikanController/index';
$route['demografi_tingkatPendidikan/store'] = 'demografi/TingkatPendidikanController/store';
$route['demografi_tingkatPendidikan/(:any)'] = 'demografi/TingkatPendidikanController/show/$1';
$route['demografi_tingkatPendidikans/update'] = 'demografi/TingkatPendidikanController/update';
$route['demografi_tingkatPendidikan/(:any)/delete'] = 'demografi/TingkatPendidikanController/delete/$1';
// maritim
$route['demografi_sekolahMaritim'] = 'demografi/SekolahMaritimController/index';
$route['demografi_sekolahMaritim/store'] = 'demografi/SekolahMaritimController/store';
$route['demografi_sekolahMaritim/(:any)'] = 'demografi/SekolahMaritimController/show/$1';
$route['demografi_sekolahMaritims/update'] = 'demografi/SekolahMaritimController/update';
$route['demografi_sekolahMaritim/(:any)/delete'] = 'demografi/SekolahMaritimController/delete/$1';

$route['demografi_rumahSakit'] = 'demografi/RumahSakitController/index';
$route['demografi_rumahSakit/store'] = 'demografi/RumahSakitController/store';
$route['demografi_rumahSakit/(:any)'] = 'demografi/RumahSakitController/show/$1';
$route['demografi_rumahSakits/update'] = 'demografi/RumahSakitController/update';
$route['demografi_rumahSakit/(:any)/delete'] = 'demografi/RumahSakitController/delete/$1';

// Konsos
// tokoh masyarakat
$route['kondsos_tkhMasyarakat'] = 'kondsos/TokohMasyarakatController/index';
$route['kondsos_tkhMasyarakat/store'] = 'kondsos/TokohMasyarakatController/store';
$route['kondsos_tkhMasyarakat/(:any)'] = 'kondsos/TokohMasyarakatController/show/$1';
$route['kondsos_tkhMasyarakats/update'] = 'kondsos/TokohMasyarakatController/update';
$route['kondsos_tkhMasyarakat/(:any)/delete'] = 'kondsos/TokohMasyarakatController/delete/$1';
// agama
$route['kondsos_orgAgama'] = 'kondsos/OrganisasiAgamaController/index';
$route['kondsos_orgAgama/store'] = 'kondsos/OrganisasiAgamaController/store';
$route['kondsos_orgAgama/(:any)'] = 'kondsos/OrganisasiAgamaController/show/$1';
$route['kondsos_orgAgamas/update'] = 'kondsos/OrganisasiAgamaController/update';
$route['kondsos_orgAgama/(:any)/delete'] = 'kondsos/OrganisasiAgamaController/delete/$1';
// politik
$route['kondsos_orgPolitik'] = 'kondsos/OrganisasiPolitikController/index';
$route['kondsos_orgPolitik/store'] = 'kondsos/OrganisasiPolitikController/store';
$route['kondsos_orgPolitik/(:any)'] = 'kondsos/OrganisasiPolitikController/show/$1';
$route['kondsos_orgPolitiks/update'] = 'kondsos/OrganisasiPolitikController/update';
$route['kondsos_orgPolitik/(:any)/delete'] = 'kondsos/OrganisasiPolitikController/delete/$1';
// masa
$route['kondsos_orgMassa'] = 'kondsos/OrganisasiMassaController/index';
$route['kondsos_orgMassa/store'] = 'kondsos/OrganisasiMassaController/store';
$route['kondsos_orgMassa/(:any)'] = 'kondsos/OrganisasiMassaController/show/$1';
$route['kondsos_orgMassas/update'] = 'kondsos/OrganisasiMassaController/update';
$route['kondsos_orgMassa/(:any)/delete'] = 'kondsos/OrganisasiMassaController/delete/$1';
// partai politik
$route['kondsos_parPol'] = 'kondsos/PartaiPolitikController/index';
$route['kondsos_parPol/store'] = 'kondsos/PartaiPolitikController/store';
$route['kondsos_parPol/(:any)'] = 'kondsos/PartaiPolitikController/show/$1';
$route['kondsos_parPols/update'] = 'kondsos/PartaiPolitikController/update';
$route['kondsos_parPol/(:any)/delete'] = 'kondsos/PartaiPolitikController/delete/$1';
// umkm
$route['kondsos_indUmkm'] = 'kondsos/UmkmController/index';
$route['kondsos_indUmkm/store'] = 'kondsos/UmkmController/store';
$route['kondsos_indUmkm/(:any)'] = 'kondsos/UmkmController/show/$1';
$route['kondsos_indUmkms/update'] = 'kondsos/UmkmController/update';
$route['kondsos_indUmkm/(:any)/delete'] = 'kondsos/UmkmController/delete/$1';
// menengah
$route['kondsos_indMenengah'] = 'kondsos/IndustriMenengahController/index';
$route['kondsos_indMenengah/store'] = 'kondsos/IndustriMenengahController/store';
$route['kondsos_indMenengah/(:any)'] = 'kondsos/IndustriMenengahController/show/$1';
$route['kondsos_indMenengahs/update'] = 'kondsos/IndustriMenengahController/update';
$route['kondsos_indMenengah/(:any)/delete'] = 'kondsos/IndustriMenengahController/delete/$1';
// pariwisata
$route['kondsos_objPariwisata'] = 'kondsos/ObyekPariwisataController/index';
$route['kondsos_objPariwisata/store'] = 'kondsos/ObyekPariwisataController/store';
$route['kondsos_objPariwisata/(:any)'] = 'kondsos/ObyekPariwisataController/show/$1';
$route['kondsos_objPariwisatas/update'] = 'kondsos/ObyekPariwisataController/update';
$route['kondsos_objPariwisata/(:any)/delete'] = 'kondsos/ObyekPariwisataController/delete/$1';
// sejarah
$route['kondsos_penSejarah'] = 'kondsos/PeninggalanSejarahController/index';
$route['kondsos_penSejarah/store'] = 'kondsos/PeninggalanSejarahController/store';
$route['kondsos_penSejarah/(:any)'] = 'kondsos/PeninggalanSejarahController/show/$1';
$route['kondsos_penSejarahs/update'] = 'kondsos/PeninggalanSejarahController/update';
$route['kondsos_penSejarah/(:any)/delete'] = 'kondsos/PeninggalanSejarahController/delete/$1';
//budaya
$route['kondsos_budaya'] = 'kondsos/BudayaController/index';
$route['kondsos_budaya/store'] = 'kondsos/BudayaController/store';
$route['kondsos_budaya/(:any)'] = 'kondsos/BudayaController/show/$1';
$route['kondsos_budayas/update'] = 'kondsos/BudayaController/update';
$route['kondsos_budaya/(:any)/delete'] = 'kondsos/BudayaController/delete/$1';
// militer
$route['kondsos_insMiliter'] = 'kondsos/InstansiMiliterController/index';
$route['kondsos_insMiliter/store'] = 'kondsos/InstansiMiliterController/store';
$route['kondsos_insMiliter/(:any)'] = 'kondsos/InstansiMiliterController/show/$1';
$route['kondsos_insMiliters/update'] = 'kondsos/InstansiMiliterController/update';
$route['kondsos_insMiliter/(:any)/delete'] = 'kondsos/InstansiMiliterController/delete/$1';
// $route['konsos_'] = 'geografi/Controller/index';

// Audit Trail
$route['audit_trail'] = 'AuditController/index';

$route['master_satKerja'] = 'masterdata/satKerja';
$route['master_wilker'] = 'masterdata/wilker';

//profile satker
$route['organisasi_satker/getProfile_Geo_SDA/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_Geo_SDA/$1/$2';
$route['organisasi_satker/getProfile_Geo_SDAB/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_Geo_SDAB/$1/$2';
$route['organisasi_satker/getProfile_Geo_SARPRAS/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_Geo_SARPRAS/$1/$2';
$route['organisasi_satker/getProfile_Geo_INJASMAR/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_Geo_INJASMAR/$1/$2';
$route['organisasi_satker/getProfile_Geo_KONSOS/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_Geo_KONSOS/$1/$2';
$route['organisasi_satker/getProfile_KONSOS/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_KONSOS/$1/$2';
$route['organisasi_satker/getProfile_DEMOGRAFI/(:any)/(:any)'] = 'SatuanKerjaController/getProfile_DEMOGRAFI/$1/$2';
$route['api/getLatLong_byIdSatker/(:any)'] = 'ApiController/getLatLong_byIdSatker/$1';

//exportdata
$route['unduhdata_unduh'] = 'unduhdata/UnduhDataController/index';
$route['unduhdata_unduh/getdatasatker_bykotama/(:any)'] = 'unduhdata/UnduhDataController/getdatasatker_bykotama/$1';
//laporan harian
$route['unduhdata_unduh/getdatalaporanharian/(:any)'] = 'unduhdata/UnduhDataController/getdatalaporanharian/$1';
$route['unduhdata_unduh/getdatajenislaporanharian'] = 'unduhdata/UnduhDataController/getdatajenislaporanharian';
// ketahanan pangan
$route['unduhdata_unduh/getdatakomoditas'] = 'unduhdata/UnduhDataController/getdatakomoditas';
$route['unduhdata_unduh/getdatalahantidur/(:any)'] = 'unduhdata/UnduhDataController/getdatalahantidur/$1';
$route['unduhdata_unduh/getdatarekappangan/(:any)'] = 'unduhdata/UnduhDataController/getdatarekappangan/$1';
// user
$route['unduhdata_unduh/getdatauser/(:any)'] = 'unduhdata/UnduhDataController/getdatauser/$1';
//satker
$route['unduhdata_unduh/getdatasatuankerjapersonel/(:any)'] = 'unduhdata/UnduhDataController/getdatasatuankerjapersonel/$1';
$route['unduhdata_unduh/getdatasatuankerja/(:any)'] = 'unduhdata/UnduhDataController/getdatasatuankerja/$1';
//konsos
$route['unduhdata_unduh/getdatatokohmasyarakat/(:any)'] = 'unduhdata/UnduhDataController/getdatatokohmasyarakat/$1';
$route['unduhdata_unduh/getdataorgagama/(:any)'] = 'unduhdata/UnduhDataController/getdataorgagama/$1';
$route['unduhdata_unduh/getdataorgpolitik/(:any)'] = 'unduhdata/UnduhDataController/getdataorgpolitik/$1';
$route['unduhdata_unduh/getdataorgmasa/(:any)'] = 'unduhdata/UnduhDataController/getdataorgmasa/$1';
$route['unduhdata_unduh/getdatapartaipolitik/(:any)'] = 'unduhdata/UnduhDataController/getdatapartaipolitik/$1';
$route['unduhdata_unduh/getdataumkm/(:any)'] = 'unduhdata/UnduhDataController/getdataumkm/$1';
$route['unduhdata_unduh/getdataindustrimenengah/(:any)'] = 'unduhdata/UnduhDataController/getdataindustrimenengah/$1';
$route['unduhdata_unduh/getdatapariwisata/(:any)'] = 'unduhdata/UnduhDataController/getdatapariwisata/$1';
$route['unduhdata_unduh/getdatasejarah/(:any)'] = 'unduhdata/UnduhDataController/getdatasejarah/$1';
$route['unduhdata_unduh/getdatabudaya/(:any)'] = 'unduhdata/UnduhDataController/getdatabudaya/$1';
$route['unduhdata_unduh/getdatamiliterpolisi/(:any)'] = 'unduhdata/UnduhDataController/getdatamiliterpolisi/$1';
//demo
$route['unduhdata_unduh/getdatajumlahpenduduk/(:any)'] = 'unduhdata/UnduhDataController/getdatajumlahpenduduk/$1';
$route['unduhdata_unduh/getdatademoagama/(:any)'] = 'unduhdata/UnduhDataController/getdatademoagama/$1';
$route['unduhdata_unduh/getdatasukubangsa/(:any)'] = 'unduhdata/UnduhDataController/getdatasukubangsa/$1';
$route['unduhdata_unduh/getdatadesabinaan/(:any)'] = 'unduhdata/UnduhDataController/getdatadesabinaan/$1';
$route['unduhdata_unduh/getdatadesapesisir/(:any)'] = 'unduhdata/UnduhDataController/getdatadesapesisir/$1';
$route['unduhdata_unduh/getdatasakabahari/(:any)'] = 'unduhdata/UnduhDataController/getdatasakabahari/$1';
$route['unduhdata_unduh/getdatapekerjaanmasyarakat/(:any)'] = 'unduhdata/UnduhDataController/getdatapekerjaanmasyarakat/$1';
$route['unduhdata_unduh/getdatasekolahmaritim/(:any)'] = 'unduhdata/UnduhDataController/getdatasekolahmaritim/$1';
$route['unduhdata_unduh/getdatarumahsakit/(:any)'] = 'unduhdata/UnduhDataController/getdatarumahsakit/$1';
//geo sda
$route['unduhdata_unduh/getdatapantainew/(:any)'] = 'unduhdata/UnduhDataController/getdatapantainew/$1';
$route['unduhdata_unduh/getdatahutan/(:any)'] = 'unduhdata/UnduhDataController/getdatahutan/$1';
$route['unduhdata_unduh/getdatagunung/(:any)'] = 'unduhdata/UnduhDataController/getdatagunung/$1';
$route['unduhdata_unduh/getdatakerawanan/(:any)'] = 'unduhdata/UnduhDataController/getdatakerawanan/$1';
$route['unduhdata_unduh/getdatahujan/(:any)'] = 'unduhdata/UnduhDataController/getdatahujan/$1';
$route['unduhdata_unduh/getdatatanah/(:any)'] = 'unduhdata/UnduhDataController/getdatatanah/$1';
$route['unduhdata_unduh/getdataair/(:any)'] = 'unduhdata/UnduhDataController/getdataair/$1';
$route['unduhdata_unduh/getdatasungai/(:any)'] = 'unduhdata/UnduhDataController/getdatasungai/$1';
$route['unduhdata_unduh/getdatapulau/(:any)'] = 'unduhdata/UnduhDataController/getdatapulau/$1';
$route['unduhdata_unduh/getdatamangrove/(:any)'] = 'unduhdata/UnduhDataController/getdatamangrove/$1';
//geo sdab
$route['unduhdata_unduh/getdataperkebunan/(:any)'] = 'unduhdata/UnduhDataController/getdataperkebunan/$1';
$route['unduhdata_unduh/getdatapertanian/(:any)'] = 'unduhdata/UnduhDataController/getdatapertanian/$1';
$route['unduhdata_unduh/getdatapeternakan/(:any)'] = 'unduhdata/UnduhDataController/getdatapeternakan/$1';
$route['unduhdata_unduh/getdatapertambangan/(:any)'] = 'unduhdata/UnduhDataController/getdatapertambangan/$1';
$route['unduhdata_unduh/getdatabudidayaikan/(:any)'] = 'unduhdata/UnduhDataController/getdatabudidayaikan/$1';
$route['unduhdata_unduh/getdatajaringapung/(:any)'] = 'unduhdata/UnduhDataController/getdatajaringapung/$1';
$route['unduhdata_unduh/getdatakonservasi/(:any)'] = 'unduhdata/UnduhDataController/getdatakonservasi/$1';
$route['unduhdata_unduh/getdatalistrik/(:any)'] = 'unduhdata/UnduhDataController/getdatalistrik/$1';
//geo sarpras
$route['unduhdata_unduh/getdatapelabuhansungai/(:any)'] = 'unduhdata/UnduhDataController/getdatapelabuhansungai/$1';
$route['unduhdata_unduh/getdatapelabuhanlaut/(:any)'] = 'unduhdata/UnduhDataController/getdatapelabuhanlaut/$1';
$route['unduhdata_unduh/getdatapelabuhanikan/(:any)'] = 'unduhdata/UnduhDataController/getdatapelabuhanikan/$1';
$route['unduhdata_unduh/getdatasapras/(:any)'] = 'unduhdata/UnduhDataController/getdatasapras/$1';
//geo injasmar
$route['unduhdata_unduh/getdatagalangankapal/(:any)'] = 'unduhdata/UnduhDataController/getdatagalangankapal/$1';
$route['unduhdata_unduh/getdataindustrimesin/(:any)'] = 'unduhdata/UnduhDataController/getdataindustrimesin/$1';
$route['unduhdata_unduh/getdatalautnasional_pelayaran/(:any)'] = 'unduhdata/UnduhDataController/getdatalautnasional_pelayaran/$1';
$route['unduhdata_unduh/getdatalautnasional_ekspedisi/(:any)'] = 'unduhdata/UnduhDataController/getdatalautnasional_ekspedisi/$1';
$route['unduhdata_unduh/getdatashipchandler/(:any)'] = 'unduhdata/UnduhDataController/getdatashipchandler/$1';
$route['unduhdata_unduh/getdataindustriperikanan/(:any)'] = 'unduhdata/UnduhDataController/getdataindustriperikanan/$1';

//sensor
$route['jobsensor'] = 'SensorController/index';
$route['insertdataSENSOR/store'] = 'SensorController/store';

//sensor dashboard
$route['dashboard10'] = 'Dashboard10Controller/index';
$route['api/getdatatemperaturTanaman/(:any)/(:any)'] = 'ApiController/getdatatemperaturTanaman/$1/$2';
$route['api/getdatatemperaturTorrent/(:any)/(:any)'] = 'ApiController/getdatatemperaturTorrent/$1/$2';
$route['api/getdataPhTanaman/(:any)/(:any)'] = 'ApiController/getdataPhTanaman/$1/$2';
$route['api/getdataPhTorrent/(:any)/(:any)'] = 'ApiController/getdataPhTorrent/$1/$2';
$route['api/getdataTDSTanaman/(:any)/(:any)'] = 'ApiController/getdataTDSTanaman/$1/$2';
$route['api/getdataTDSTorrent/(:any)/(:any)'] = 'ApiController/getdataTDSTorrent/$1/$2';

//tracer covid
$route['daftar_vaksin'] = 'vaksin/DaftarVaksinController/index';
$route['daftar_vaksin/store'] = 'vaksin/DaftarVaksinController/store';
$route['daftar_vaksin/(:any)/delete'] = 'vaksin/DaftarVaksinController/delete/$1';
$route['daftar_vaksin/(:any)'] = 'vaksin/DaftarVaksinController/show/$1';
$route['daftar_vaksins/update'] = 'vaksin/DaftarVaksinController/update';

$route['entry_kasus_covid'] = 'vaksin/EntryKasusCovidController/index';
$route['entry_kasus_covid/(:any)/delete'] = 'vaksin/EntryKasusCovidController/delete/$1';
$route['entry_kasus_covid/create'] = 'vaksin/EntryKasusCovidController/create';
$route['entry_kasus_covid/store'] = 'vaksin/EntryKasusCovidController/store';
$route['entry_kasus_covid/view/(:any)/show'] = 'vaksin/EntryKasusCovidController/view/$1';
$route['entry_kasus_covid/edit/(:any)/edit'] = 'vaksin/EntryKasusCovidController/edit/$1';
$route['entry_kasus_covid/getdata/(:any)'] = 'vaksin/EntryKasusCovidController/getdata/$1';
$route['entry_kasus_covid/update'] = 'vaksin/EntryKasusCovidController/update';

$route['entry_serbuvaksin'] = 'vaksin/EntrySerbuVaksinController/index';
$route['entry_serbuvaksin/store'] = 'vaksin/EntrySerbuVaksinController/store';
$route['entry_serbuvaksin/(:any)/delete'] = 'vaksin/EntrySerbuVaksinController/delete/$1';
$route['entry_serbuvaksin/(:any)'] = 'vaksin/EntrySerbuVaksinController/show/$1';
$route['entry_serbuvaksins/update'] = 'vaksin/EntrySerbuVaksinController/update';

//kontak erat
$route['entry_kasus_covid/store_kontakerat'] = 'vaksin/EntryKasusCovidController/store_kontakerat';
$route['entry_kasus_covid/detail_kontakerat/(:any)/showdetail'] = 'vaksin/EntryKasusCovidController/showdetail/$1';
$route['entry_kasus_covid/(:any)/deletekontakerat'] = 'vaksin/EntryKasusCovidController/deletekontakerat/$1';
$route['entry_kasus_covid/edit_kontakerat/(:any)'] = 'vaksin/EntryKasusCovidController/edit_kontakerat/$1';
$route['entry_kasus_covid/update_kontakerat'] = 'vaksin/EntryKasusCovidController/update_kontakerat';

//kbn
$route['kbn'] = 'kbn/KbnController/index';
$route['kbn/dashboard'] = 'kbn/KbnController/dashboard';
$route['kbn/edukasi'] = 'kbn/KbnController/pelaporan/edukasi';
$route['kbn/ekonomi'] = 'kbn/KbnController/pelaporan/ekonomi';
$route['kbn/kesehatan'] = 'kbn/KbnController/pelaporan/kesehatan';
$route['kbn/pariwisata'] = 'kbn/KbnController/pelaporan/pariwisata';
$route['kbn/pertahanan'] = 'kbn/KbnController/pelaporan/pertahanan';
$route['api/getKbnActivity/(:any)/(:any)'] = 'kbn/KbnController/getKbnActivity/$1/$2';
//$route['api/getKbnActivity/(:any)'] = 'kbn/KbnController/getKbnActivity/$1/1';
$route['api/getKbnActivityBySatker/(:any)/(:any)'] = 'kbn/KbnController/getKbnActivityBySatker/$1/$2';
$route['api/getKbnActivityByPersonal/(:any)/(:any)'] = 'kbn/KbnController/getKbnActivityByPersonal/$1/$2';
$route['api/getKbnActivityByKbn/(:any)/(:any)'] = 'kbn/KbnController/getKbnActivityByKbn/$1/$2';
$route['kbn/store'] = 'kbn/KbnController/store';
$route['kbn/update'] = 'kbn/KbnController/update';
$route['kbn/(:any)/delete'] = 'kbn/KbnController/delete/$1';
$route['kbn/(:any)'] = 'kbn/KbnController/show/$1';
// $route['kbn/dashboard'] = 'kbn/KbnController/index';

//komcad
$route['komcad'] = 'komcad/KomcadController/index';
$route['komcad/dashboard'] = 'komcad/KomcadController/dashboard';
$route['komcad/pelaporan'] = 'komcad/KomcadController/pelaporan';
$route['api/getKomcadActivity/(:any)'] = 'komcad/KomcadController/getKomcadActivity/$1';
$route['api/getKomcadActivityBySatker/(:any)'] = 'komcad/KomcadController/getKomcadActivityBySatker/$1';
$route['api/getKomcadActivityByPersonal/(:any)'] = 'komcad/KomcadController/getKomcadActivityByPersonal/$1';
$route['komcad/store'] = 'komcad/KomcadController/store';
$route['komcad/update'] = 'komcad/KomcadController/update';
$route['komcad/(:any)/delete'] = 'komcad/KomcadController/delete/$1';
$route['komcad/(:any)'] = 'komcad/KomcadController/show/$1';

//sakabahari
$route['sakabahari'] = 'sakabahari/SakaBahariController/index';
$route['sakabahari/dashboard'] = 'sakabahari/SakaBahariController/dashboard';
$route['sakabahari/pelaporan'] = 'sakabahari/SakaBahariController/pelaporan';
$route['api/getSakaActivity/(:any)'] = 'sakabahari/SakaBahariController/getSakaActivity/$1';
$route['api/getSakaActivityBySatker/(:any)'] = 'sakabahari/SakaBahariController/getSakaActivityBySatker/$1';
$route['api/getSakaActivityByPersonal/(:any)'] = 'sakabahari/SakaBahariController/getSakaActivityByPersonal/$1';
$route['api/getSakaActivityBySaka/(:any)'] = 'sakabahari/SakaBahariController/getSakaActivityBySaka/$1';
$route['sakabahari/store'] = 'sakabahari/SakaBahariController/store';
$route['sakabahari/update'] = 'sakabahari/SakaBahariController/update';
$route['sakabahari/(:any)/delete'] = 'sakabahari/SakaBahariController/delete/$1';
$route['sakabahari/(:any)'] = 'sakabahari/SakaBahariController/show/$1';
