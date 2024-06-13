<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Dispotmar" name="description">
	<meta content="Wisatech" name="author">
	<meta name="keywords" content="Dispotmar">

	<!-- Favicon-->
	<link rel="icon" href="<?= site_url()?>assets/images/logonew.jpg" type="image/x-icon" />

	<!-- Title -->
	<title><?php echo $title ?></title>

	<!-- Bootstrap css -->
	<link href="<?php echo base_url() ?>assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Style css -->
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />

	<!-- Default css -->
	<link href="<?php echo base_url() ?>assets/css/default.css" rel="stylesheet">

	<!-- Sidemenu css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sidemenu/icon-sidemenu.css">

	<!-- Owl-carousel css-->
	<link href="<?php echo base_url() ?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

	<!-- Bootstrap-daterangepicker css -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css">

	<!-- Bootstrap-datepicker css -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

	<!-- Sidemenu-repsonsive-tabs  css -->
	<link href="<?php echo base_url() ?>assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css"
		rel="stylesheet">

	<!-- Data table css -->
	<link href="<?php echo base_url() ?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatable/css/buttons.bootstrap4.min.css">
	<link href="<?php echo base_url() ?>assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

	<!-- P-scroll css -->
	<link href="<?php echo base_url() ?>assets/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

	<!-- Font-icons css -->
	<link href="<?php echo base_url() ?>assets/css/icons.css" rel="stylesheet">
	<!-- Rightsidebar css -->
	<link href="<?php echo base_url() ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

	<!-- Nice-select css  -->
	<link href="<?php echo base_url() ?>assets/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet" />
	<!-- Select css -->
	<link href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css" rel="stylesheet" />

	<!-- Color-palette css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/skins.css" />

	<link href="<?php echo base_url() ?>assets/css/toastr.min.css" rel="stylesheet">
	<!-- C3 charts css -->
	<link href="<?php echo base_url() ?>assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />
	<!--Bootstrap-daterangepicker css-->
	<link href="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css"
		rel="stylesheet" />

	<!--Bootstrap-datepicker css-->
	<link href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css"
		rel="stylesheet" />

	<!--Bootstrap-timepicker css-->
	<link href="<?php echo base_url() ?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css"
		rel="stylesheet">

	<!-- News-Ticker css-->
	<link href="<?php echo base_url() ?>assets/plugins/newsticker/jquery.jConveyorTicker.css" rel="stylesheet" />
	<!-- <link href="<?php echo base_url() ?>assets/plugins/jquery-conveyor-ticker/jquery.jConveyorTicker.css" rel="stylesheet" /> -->
	<link href="<?php echo base_url() ?>assets/plugins/limarquee/liMarquee.css" rel="stylesheet" />

	<link rel="stylesheet"
		href="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">

	<!-- Gallery css-->
	<link href="<?php echo base_url() ?>assets/plugins/gallery/gallery.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/plugins/gallery/simplelightbox.css" rel="stylesheet">

	<!-- Gallery Scroll Css -->
	<link href="<?php echo base_url() ?>assets/plugins/gallery-scroll/lc_lightbox.css" rel="stylesheet">

	<!-- Gallery Shuffle Css -->
	<!-- <link href="<?php echo base_url() ?>assets/plugins/gallery-shuffle/gallery-shuffle.css" rel="stylesheet"> -->

	<!-- File Upload css-->
	<link href="<?php echo base_url() ?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />

	<!--Mutipleselect css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/multipleselect/multiple-select.css">

	<!--Sumoselect css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sumoselect/sumoselect.css">

	<!--multi css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/multi/multi.min.css">
	<link href="<?php echo base_url() ?>assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />

	<!--Jquerytransfer css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQuerytransfer/jquery.transfer.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQuerytransfer/icon_font/icon_font.css">

	<!--multi css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/multi/multi.min.css">

	<style>
        /* Important part */
        .modal-dialog{
            overflow-y: initial !important
        }

        .modal-body{
            height: 80vh;
            overflow-y: auto;
        }

        .select2-selection {
            min-height: 41px;
        }
        
		.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 16px;
			font-size: 16px;
			border: none;
			cursor: pointer;
		}

		.dropbtn:hover,
		.dropbtn:focus {
			background-color: #3e8e41;
		}

		#myInput {
			box-sizing: border-box;
			background-image: url('searchicon.png');
			background-position: 14px 12px;
			background-repeat: no-repeat;
			font-size: 16px;
			padding: 14px 20px 12px 45px;
			border: none;
			border-bottom: 1px solid #ddd;
		}

		#myInput:focus {
			outline: 3px solid #ddd;
		}

		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			background-color: #f6f6f6;
			overflow: auto;
			height: 400px;
			border: 1px solid #ddd;
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropdown a:hover {
			background-color: #ddd;
		}

		.show {
			display: block;
		}

	</style>

</head>

<body class="app sidebar-mini">

	<!-- Loader -->
	<div id="loading">
		<img src="<?php echo base_url() ?>assets/images/other/loader.svg" class="loader-img" alt="Loader">
	</div>

	<!-- PAGE -->
	<div class="page">
		<div class="page-main">

			<!-- Top-header opened -->
			<div class="header-main header sticky">
				<div class="app-header header top-header navbar-collapse ">
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="<?= site_url()?>home">
								<img src="<?php echo base_url() ?>assets/images/LOGOATAS.jpg"
									class="header-brand-img desktop-logo " alt="Dashlot logo"
									style="height:40px; margin-top:10px; margin-right:10px;">
								<img src="<?php echo base_url() ?>assets/images/LOGOATAS.jpg"
									class="header-brand-img desktop-logo-1 " alt="Dashlot logo">
								<img src="<?php echo base_url() ?>assets/images/LOGOATAS.jpg" class="mobile-logo"
									alt="Dashlot logo">
								<img src="<?php echo base_url() ?>assets/images/LOGOATAS.jpg" class="mobile-logo-1"
									alt="Dashlot logo">
							</a>
							<a href="#" data-toggle="sidebar" class="nav-link icon toggle"><i
									class="fe fe-align-justify fs-20"></i></a>
							<div class="d-flex header-right ml-auto">
								<div class="dropdown header-fullscreen">
									<a class="nav-link icon full-screen-link" id="fullscreen-button">
										<i class="mdi mdi-arrow-collapse fs-20"></i>
									</a>
								</div><!-- Fullscreen -->
								<div class=" " id="bs-example-navbar-collapse-1" style="display:none;">
									<form class="navbar-form" role="search">
										<div class="input-group ">
											<input type="text" class="form-control" placeholder="Search...">
											<span class="input-group-btn">
												<button type="reset" class="btn btn-default">
													<i class="fa fa-times"></i>
												</button>
												<button type="submit" class="btn btn-default">
													<i class="fa fa-search"></i>
												</button>
											</span>
										</div>
									</form>
								</div><!-- Search -->
								<div class="dropdown header-notify">
									<a class="nav-link icon text-center" data-toggle="dropdown">
										<i class="typcn typcn-bell"></i>
										<span class="pulse bg-success"></span>
									</a>
									<div
										class="dropdown-menu dropdown-menu-right animated bounceInDown dropdown-menu-arrow w-250">
										<div class="dropdown-header p-4 mb-2 bg-header-image p-5 text-white">
											<h5 class="dropdown-title mb-1 font-weight-semibold text-drak">Pemberitahuan
											</h5>
											<p class="dropdown-title-text subtext mb-0 pb-0 fs-13">Daftar pemberitahuan
												anda</p>
										</div>
										<div class="drop-notify" id="notificationList">
										</div>
										<a href="#" class="dropdown-item text-center br-br-6 br-bl-6">See all
											Messages</a>
									</div>
								</div><!-- Notification -->
								<div class="dropdown drop-profile">
									<a class="nav-link pr-0 leading-none" href="#" data-toggle="dropdown"
										aria-expanded="false">
										<div class="profile-details mt-1">
											<span
												class="mr-3 mb-0  fs-15 font-weight-semibold"><?= $this->session->userdata('nama_pegawai') ?></span>
											<small class="text-muted mr-3"
												id="userroles"><?= $this->session->userdata('role') ?></small>
										</div>
										<img class="avatar avatar-md brround"
											src="<?php echo base_url() ?>uploads/users/<?= $this->session->userdata('photo') ?>"
											alt="image">
									</a>
									<div
										class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated bounceInDown w-250">
										<div class="user-profile bg-header-image border-bottom p-3">
											<div class="user-image text-center">
												<img class="user-images"
													src="<?php echo base_url() ?>uploads/users/<?= $this->session->userdata('photo') ?>"
													alt="image" style="height:60px;">
											</div>
											<div class="user-details text-center">
												<h4 class="mb-0"><?= $this->session->userdata('nama_pegawai') ?></h4>
												<p class="mb-1 fs-13 text-white-50">
													<?= $this->session->userdata('email') ?></p>
											</div>
										</div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
										</a>
										<a class="dropdown-item mb-1" href="logout">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
										</a>
									</div>
								</div><!-- Profile -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Top-header closed -->

			<!-- Sidebar menu-->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar toggle-sidebar">
				<div class="app-sidebar__user">
					<div class="user-body">
						<img src="<?php echo base_url() ?>uploads/users/<?= $this->session->userdata('photo') ?>"
							alt="profile-img" class="rounded-circle" style="width:60%; height:140px;">
					</div>
					<div class="user-info">
						<h4 class="mb-0" style="color:white;"><?= $this->session->userdata('nama_pegawai') ?></h4>
						<p class="mb-1 fs-13 text-white-50">
							<?= $this->session->userdata('email') ?></p>
						<!-- <a href="#" class=""><span class="app-sidebar__user-name font-weight-semibold">
								Admin-01</span><br>
							<span class="text-muted app-sidebar__user-designation text-sm">Kadiv</span>
						</a> -->
					</div>
				</div>
				<ul class="side-menu toggle-menu">
					<div class="form-group row">
						<div class="dropdown" style="margin-left:10px;">
							<button onclick="myFunction()" class="btn btn-success"
								style="margin-left:10px; height:40px; width:227px;">Search Menu</button>
							<div id="myDropdown" class="dropdown-content" style="margin-top:5px;">
								<input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
								<a class="slide-item" href="<?= site_url()?>home"><span>Dashboard Gelar
										Pangkalan</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard1"><span>Dashboard Sebaran Produksi
										Ketahanan Pangan</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard2"><span>Dashboard Monitoring
										Status Ketahanan Pangan</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard3"><span>Dashboard Monitoring
										Produksi Ketahanan Pangan</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard4"><span>Dashboard Personel dan
										Lahan</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard5"><span>Dashboard Pelaporan
										Babinpotmar</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard6"><span>Dashboard
										Geodemokonsos</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard7"><span>Dashboard Desa Binaan
										Dashboard</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard8"><span>Dashboard
										Pantai</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard9"><span>Dashboard
										Mangrove</span></a>
								<a class="slide-item" href="<?= site_url()?>dashboard10"><span>Dashboard
										Sensor</span></a>

								<a href="<?= site_url()?>form_pelaporan" class="slide-item">Form Pelaporan</a>
								<a href="<?= site_url()?>data_pelaporan" class="slide-item">Data Pelaporan</a>
								<a href="<?= site_url()?>jenis_pelaporan" class="slide-item">Jenis Pelaporan</a>

								<a href="<?= site_url()?>pangan_komoditas" class="slide-item">Master Komoditas</a>
								<a href="<?= site_url()?>pangan_rekap_add" class="slide-item">Form Rekap Pangan</a>
								<a href="<?= site_url()?>pangan_lahantidur_add" class="slide-item">Form Lahan Tidur</a>
								<a href="<?= site_url()?>pangan_rekap" class="slide-item">Rekap Pangan</a>
								<a href="<?= site_url()?>pangan_lahantidur" class="slide-item">Rekap Lahan Tidur</a>

								<a href="<?= site_url()?>geografi_pantai" class="slide-item">Pantai</a>
								<a href="<?= site_url()?>geografi_hutan" class="slide-item">Hutan</a>
								<a href="<?= site_url()?>geografi_gunung" class="slide-item">Gunung</a>
								<a href="<?= site_url()?>geografi_kerawanan" class="slide-item">Kerawanan Geografi</a>
								<a href="<?= site_url()?>geografi_curahHujan" class="slide-item">Curah Hujan</a>
								<a href="<?= site_url()?>geografi_strukTanah" class="slide-item">Struktur Tanah</a>
								<a href="<?= site_url()?>geografi_sumberAir" class="slide-item">Sumber Air</a>
								<a href="<?= site_url()?>geografi_sungai" class="slide-item">Sungai</a>
								<a href="<?= site_url()?>geografi_pulauTerluar" class="slide-item">Pulau Terluar</a>
								<!-- <a href="<?= site_url()?>pangan_mangrove_add" style="display:none;" class="slide-item">Form Mangrove</a> -->
								<a href="<?= site_url()?>pangan_mangrove" class="slide-item">Rekap Mangrove</a>

								<a href="<?= site_url()?>geografi_perkebunan" class="slide-item">Perkebunan</a>
								<a href="<?= site_url()?>geografi_pertanian" class="slide-item">Pertanian</a>
								<a href="<?= site_url()?>geografi_peternakan" class="slide-item">Peternakan</a>
								<a href="<?= site_url()?>geografi_pertambangan" class="slide-item">Pertambangan</a>
								<a href="<?= site_url()?>geografi_budidayaIkan" class="slide-item">Pembudidayaan
									Ikan</a>
								<a href="<?= site_url()?>geografi_kerambaJaring" class="slide-item">Keramba Jaring
									Apung</a>
								<a href="<?= site_url()?>geografi_konservasi" class="slide-item">Konservasi Lingkungan
									Hidup</a>
								<a href="<?= site_url()?>geografi_sumberListrik" class="slide-item">Sumber Listrik</a>

								<a href="<?= site_url()?>geografi_pelabuhanSungai" class="slide-item">Pelabuhan
									Sungai</a>
								<a href="<?= site_url()?>geografi_pelabuhanLaut" class="slide-item">Pelabuhan Laut</a>
								<a href="<?= site_url()?>geografi_pelabuhanIkan" class="slide-item">Pelabuhan Ikan</a>
								<a href="<?= site_url()?>geografi_sarprasJalan" class="slide-item">Sarana Prasarana
									Jalan</a>

								<a href="<?= site_url()?>geografi_galanganKapal" class="slide-item">Galangan Kapal</a>
								<a href="<?= site_url()?>geografi_industriMesin" class="slide-item">Industri Mesin dan
									Spare Part Perkapalan</a>
								<a href="<?= site_url()?>geografi_alNasional" class="slide-item">Angkutan Laut
									Nasional</a>
								<a href="<?= site_url()?>geografi_shipHandler" class="slide-item">Ship Chandler</a>
								<a href="<?= site_url()?>geografi_industriIkan" class="slide-item">Industri
									Perikanan</a>

								<a href="<?= site_url()?>demografi_jumlahPenduduk" class="slide-item">Jumlah
									Penduduk</a></li>
								<a href="<?= site_url()?>demografi_agama" class="slide-item">Agama</a>
								<a href="<?= site_url()?>demografi_sukuBangsa" class="slide-item">Suku Bangsa</a>
								<a href="<?= site_url()?>demografi_desaBinaan" class="slide-item">Desa Binaan</a>
								<a href="<?= site_url()?>demografi_desaPesisir" class="slide-item">Desa Pesisir</a>
								<a href="<?= site_url()?>demografi_sakaBahari" class="slide-item">Saka Bahari</a>
								<a href="<?= site_url()?>demografi_pekerjaanMasyarakat" class="slide-item">Pekerjaan
									Masyarakat</a>
								<a href="<?= site_url()?>demografi_sekolahMaritim" class="slide-item">Sekolah
									Maritim</a>
								<a href="<?= site_url()?>demografi_rumahSakit" class="slide-item">Rumah Sakit</a>
								<a href="<?= site_url()?>kondsos_tkhMasyarakat" class="slide-item">Tokoh Masyarakat</a>
								<a href="<?= site_url()?>kondsos_orgAgama" class="slide-item">Organisasi Agama</a>
								<a href="<?= site_url()?>kondsos_orgPolitik" class="slide-item">Organisasi Politik</a>
								<a href="<?= site_url()?>kondsos_orgMassa" class="slide-item">Organisasi Massa</a>
								<a href="<?= site_url()?>kondsos_parPol" class="slide-item">Partai Politik</a>
								<a href="<?= site_url()?>kondsos_indUmkm" class="slide-item">Industri UMKM</a>
								<a href="<?= site_url()?>kondsos_indMenengah" class="slide-item">Industri Menengah</a>
								<a href="<?= site_url()?>kondsos_objPariwisata" class="slide-item">Objek Pariwisata</a>
								<a href="<?= site_url()?>kondsos_penSejarah" class="slide-item">Peninggalan Sejarah</a>
								<a href="<?= site_url()?>kondsos_budaya" class="slide-item">Budaya</a>
								<a href="<?= site_url()?>kondsos_insMiliter" class="slide-item">Instansi Militer dan Polisi</a>

								<a href="<?= site_url()?>daftar_vaksin" class="slide-item">Pendaftaran Vaksin</a>
								<a href="<?= site_url()?>entry_kasus_covid" class="slide-item">Entry Kasus Covid</a>
								<a href="<?= site_url()?>entry_serbuvaksin" class="slide-item">Entry Serbu Vaksin</a>
							</div>
						</div>
					</div>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/homepage.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= site_url()?>home"><span>Gelar Pangkalan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard1"><span>Sebaran Produksi Ketahanan
										Pangan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard2"><span>Monitoring Status
										Ketahanan Pangan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard3"><span>Monitoring Produksi
										Ketahanan Pangan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard4"><span>Personel dan
										Lahan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>kbn/dashboard"><span>Kampung Bahari Nusantara</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>komcad/dashboard"><span>Komcad / Komduk</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>sakabahari/dashboard"><span>Saka Bahari</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard5"><span>Pelaporan
										Babinpotmar</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard6"><span>Geodemokonsos</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard7"><span>Desa Binaan</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard8"><span>Pantai</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard9"><span>Mangrove</span></a>
							</li>
							<li><a class="slide-item" href="<?= site_url()?>dashboard10"><span>Sensor</span></a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Laporan Harian</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>form_pelaporan" id="form_pelaporan" class="slide-item">Form
									Pelaporan</a></li>
							<li><a href="<?= site_url()?>data_pelaporan" class="slide-item">Data Pelaporan</a></li>
							<li><a href="<?= site_url()?>jenis_pelaporan" id="jenis_pelaporan" class="slide-item">Jenis
									Pelaporan</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/happy.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Ketahanan Pangan</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>pangan_komoditas" class="slide-item">Master Komoditas</a>
							</li>
							<li><a href="<?= site_url()?>pangan_rekap_add" id="pangan_rekap_add" class="slide-item">Form
									Rekap Pangan</a>
							</li>
							<li><a href="<?= site_url()?>pangan_lahantidur_add" id="pangan_lahantidur_add"
									class="slide-item">Form Lahan Tidur</a>
							</li>
							<li><a href="<?= site_url()?>pangan_rekap" class="slide-item">Rekap Pangan</a>
							</li>
							<li><a href="<?= site_url()?>pangan_lahantidur" class="slide-item">Rekap Lahan Tidur</a>
							</li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Kampung Bahari Nusantara</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>kbn" id="data_kbn" class="slide-item">Data KBN</a></li>
							<li><a href="<?= site_url()?>kbn/edukasi" class="slide-item">Klaster Edukasi</a></li>
							<li><a href="<?= site_url()?>kbn/ekonomi" class="slide-item">Klaster Ekonomi</a></li>
							<li><a href="<?= site_url()?>kbn/kesehatan" class="slide-item">Klaster Kesehatan</a></li>
							<li><a href="<?= site_url()?>kbn/pariwisata" id="klaster_pariwisata" class="slide-item">Klaster Pariwisata</a></li>
							<li><a href="<?= site_url()?>kbn/pertahanan" id="klaster_pertahanan" class="slide-item">Klaster Pertahanan</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Komcad / Komduk</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>komcad" id="data_komcad" class="slide-item">Data Komcad</a></li>
							<li><a href="<?= site_url()?>komcad/pelaporan" class="slide-item">Laporan Kegiatan</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Saka Bahari</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>sakabahari" id="data_sakabahari" class="slide-item">Data Saka Bahari</a></li>
							<li><a href="<?= site_url()?>sakabahari/pelaporan" class="slide-item">Laporan Kegiatan</a></li>
						</ul>
					</li>

					<!-- <li class="slide" id="tracercovid_div">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Tracer
								Covid</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>daftar_vaksin" class="slide-item">Pendaftaran Vaksin</a>
							<li>
							<li><a href="<?= site_url()?>entry_kasus_covid" class="slide-item">Entry Kasus Covid</a>
							<li>
							<li><a href="<?= site_url()?>entry_serbuvaksin" class="slide-item">Entry Serbu Vaksin</a>
							<li>
						</ul>
					</li> -->
					<li class="slide">
						<a class="side-menu__item" href="<?= site_url()?>unduhdata_unduh" id="unduhdata_unduh"><span
								class="icon-menu-img"><img src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Export
								Data</span></a>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Data
								Geografi</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li class="py-2"><a href="#" class="slide-item">Sumber Daya Alam</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pantai" class="slide-item">Pantai</a>
							</li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_hutan" class="slide-item">Hutan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_gunung" class="slide-item">Gunung</a>
							</li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_kerawanan" class="slide-item">Kerawanan
									Geografi</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_curahHujan" class="slide-item">Curah
									Hujan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_strukTanah" class="slide-item">Struktur
									Tanah</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_sumberAir" class="slide-item">Sumber
									Air</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_sungai" class="slide-item">Sungai</a>
							</li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pulauTerluar" class="slide-item">Pulau
									Terluar</a></li>
							<!-- <li class="ml-5"><a href="<?= site_url()?>pangan_mangrove_add" style="display:none;" class="slide-item">Form Mangrove</a></li> -->
							<li class="ml-5"><a href="<?= site_url()?>pangan_mangrove" class="slide-item">Rekap
									Mangrove</a></li>

							<li class="py-2"><a href="#" class="slide-item">Sumber Daya Alam Buatan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_perkebunan"
									class="slide-item">Perkebunan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pertanian"
									class="slide-item">Pertanian</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_peternakan"
									class="slide-item">Peternakan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pertambangan"
									class="slide-item">Pertambangan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_budidayaIkan"
									class="slide-item">Pembudidayaan Ikan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_kerambaJaring" class="slide-item">Keramba
									Jaring Apung</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_konservasi" class="slide-item">Konservasi
									Lingkungan Hidup</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_sumberListrik" class="slide-item">Sumber
									Listrik</a></li>

							<li class="py-2"><a href="#" class="slide-item">Sarana Prasarana</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pelabuhanSungai"
									class="slide-item">Pelabuhan Sungai</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pelabuhanLaut"
									class="slide-item">Pelabuhan Laut</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_pelabuhanIkan"
									class="slide-item">Pelabuhan Ikan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_sarprasJalan" class="slide-item">Sarana
									Prasarana Jalan</a></li>

							<li class="py-2"><a href="#" class="slide-item">Industri Jasa Maritim</a>
							<li class="ml-5"><a href="<?= site_url()?>geografi_galanganKapal"
									class="slide-item">Galangan Kapal</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_industriMesin"
									class="slide-item">Industri Mesin dan Spare Part Perkapalan</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_alNasional" class="slide-item">Angkutan
									Laut Nasional</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_shipHandler" class="slide-item">Ship
									Chandler</a></li>
							<li class="ml-5"><a href="<?= site_url()?>geografi_industriIkan" class="slide-item">Industri
									Perikanan</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Data
								Demografi</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>demografi_jumlahPenduduk" class="slide-item">Jumlah
									Penduduk</a></li>
							<li><a href="<?= site_url()?>demografi_agama" class="slide-item">Agama</a></li>
							<li><a href="<?= site_url()?>demografi_sukuBangsa" class="slide-item">Suku Bangsa</a></li>
							<li><a href="<?= site_url()?>demografi_desaBinaan" class="slide-item">Desa Binaan</a></li>
							<li><a href="<?= site_url()?>demografi_desaPesisir" class="slide-item">Desa Pesisir</a></li>
							<li><a href="<?= site_url()?>demografi_sakaBahari" class="slide-item">Saka Bahari</a></li>
							<li><a href="<?= site_url()?>demografi_pekerjaanMasyarakat" class="slide-item">Pekerjaan
									Masyarakat</a>
							</li>
							<!-- <li><a href="<?= site_url()?>demografi_tingkatPendidikan" class="slide-item">Tingkat
									Pendidikan</a></li> -->
							<li><a href="<?= site_url()?>demografi_sekolahMaritim" class="slide-item">Sekolah
									Maritim</a>
							</li>
							<li><a href="<?= site_url()?>demografi_rumahSakit" class="slide-item">Rumah Sakit</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/calendar.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Data
								Kondisi Sosial</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>kondsos_tkhMasyarakat" class="slide-item">Tokoh Masyarakat</a>
							</li>
							<li><a href="<?= site_url()?>kondsos_orgAgama" class="slide-item">Organisasi Agama</a></li>
							<li><a href="<?= site_url()?>kondsos_orgPolitik" class="slide-item">Organisasi Politik</a>
							</li>
							<li><a href="<?= site_url()?>kondsos_orgMassa" class="slide-item">Organisasi Massa</a></li>
							<li><a href="<?= site_url()?>kondsos_parPol" class="slide-item">Partai Politik</a></li>
							<li><a href="<?= site_url()?>kondsos_indUmkm" class="slide-item">Industri UMKM</a></li>
							<li><a href="<?= site_url()?>kondsos_indMenengah" class="slide-item">Industri Menengah</a>
							</li>
							<li><a href="<?= site_url()?>kondsos_objPariwisata" class="slide-item">Objek Pariwisata</a>
							</li>
							<li><a href="<?= site_url()?>kondsos_penSejarah" class="slide-item">Peninggalan Sejarah</a>
							</li>
							<li><a href="<?= site_url()?>kondsos_budaya" class="slide-item">Budaya</a></li>
							<li><a href="<?= site_url()?>kondsos_insMiliter" class="slide-item">Instansi Militer dan
									Polisi</a></li>
						</ul>
					</li>
					<li class="slide" id="organisasi_div">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span
								class="side-menu__label">Organisasi</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>organisasi_level" id="organisasi_level" class="slide-item">Data
									Level</a>
							<li>
							<li><a href="<?= site_url()?>organisasi_satker" class="slide-item">Data Satker</a>
							<li>
							<li><a href="<?= site_url()?>organisasi_satker_personel" class="slide-item">Satker
									Personel</a>
							<li>
						</ul>
					</li>
					<li class="slide" id="usermanagement_div">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">User
								Management</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="<?= site_url()?>user_master_role" class="slide-item">Master Role</a>
							<li>
							<li><a href="<?= site_url()?>user_management" class="slide-item">Data User</a>
							<li>
						</ul>
					</li>
					<li class="slide" style="display:none;">
						<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img
									src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Master
								Data</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<!-- <li><a href="<?= site_url()?>user_master_role" class="slide-item">Master Role</a>
							<li>
							<li><a href="<?= site_url()?>user_management" class="slide-item">Data User</a>
							<li> -->
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" href="<?= site_url()?>audit_trail" id="audit_trail"><span
								class="icon-menu-img"><img src="<?php echo base_url() ?>assets/images/svgs/login.svg"
									class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Audit
								Trail</span></a>
					</li>
				</ul>
			</aside>
			<!-- Sidemenu closed -->

			<!-- App-content opened -->
			<div class="app-content icon-content">
				<?php if($this->session->flashdata()){ ?>
				<div class="alert <?= ($this->session->flashdata('success')) ? 'alert-success' : 'alert-danger' ?>"
					style="position: fixed;margin-top: 3%;z-index: 1;width: 30%;right: 0;">
					<button style="position: relative;" type="button" class="close" data-dismiss="alert"
						aria-label="Close"> <span aria-hidden="true"></span></button>
					<h3 style="color: white;"><i
							class="fa fa-<?= ($this->session->flashdata('success')) ? 'check' : 'times' ?>-circle"></i>
						<?= ($this->session->flashdata('success')) ? 'Sukses!' : 'Gagal!' ?></h3>
					<?= $this->session->flashdata('success').$this->session->flashdata('error');?>
				</div>
				<?php } ?>
				<?php echo $isi?>
			</div>
			<!-- App-content closed -->
		</div>

		<!-- Footer opened -->
		<footer class="footer-main icon-footer">
			<div class="container">
				<div class="  mt-2 mb-2 text-center">
					Copyright © 2020 <a href="#" class="fs-14 text-primary">Dispotmar</a>. Designed by <a href="#"
						class="fs-14 text-primary">Wisatech</a>
					All rights reserved.
				</div>
			</div>
		</footer>
		<!-- Footer closed -->
	</div>

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

	<!-- Jquery-scripts -->
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
	</script>
	<!-- Moment js-->
	<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>

	<!-- Bootstrap-scripts js -->
	<script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>

	<!-- Sparkline js -->
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>

	<!-- Bootstrap-daterangepicker js -->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- Bootstrap-datepicker js -->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

	<!-- Chart-circle js -->
	<script src="<?php echo base_url() ?>assets/js/vendors/circle-progress.min.js"></script>

	<!-- Rating-star js -->
	<script src="<?php echo base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>

	<!-- Custom scroll bar js-->
	<script src="<?php echo base_url() ?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Nice-select js-->
	<script src="<?php echo base_url() ?>assets/plugins/jquery-nice-select/js/jquery.nice-select.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/jquery-nice-select/js/nice-select.js"></script>

	<!-- P-scroll js -->
	<script src="<?php echo base_url() ?>assets/plugins/p-scroll/p-scroll.js"></script>
	<!-- <script src="<?php echo base_url() ?>assets/plugins/p-scroll/p-scroll-1.js"></script> -->

	<!-- Sidemenu js-->
	<script src="<?php echo base_url() ?>assets/plugins/sidemenu/icon-sidemenu.js"></script>

	<!-- Data tables -->
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/jszip.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/pdfmake.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/vfs_fonts.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/buttons.colVis.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/responsive.bootstrap4.min.js"></script>

	<!-- Data table js -->
	<script src="<?php echo base_url() ?>assets/js/datatable.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/datatable/js/sum.js"></script>

	<!-- Sidemenu-respoansive-tabs js -->
	<script src="<?php echo base_url() ?>assets/plugins/sidemenu-responsive-tabs/js/sidemenu-responsive-tabs.js">
	</script>

	<!-- Leftmenu js -->
	<script src="<?php echo base_url() ?>assets/js/left-menu.js"></script>

	<!-- Rightsidebar js -->
	<script src="<?php echo base_url() ?>assets/plugins/sidebar/sidebar.js"></script>

	<!-- Select2 js -->
	<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>

	<!-- Custom js-->
	<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
	<!-- <script src="<?php echo base_url() ?>assets/js/tab.js"></script> -->

	<script src="<?php echo base_url() ?>assets/js/vendors/toastr.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/pusher.min.js"></script>

	<!-- C3 CHART JS -->
	<script src="<?php echo base_url() ?>assets/plugins/charts-c3/d3.v5.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/charts-c3/c3-chart.js"></script>


	<!-- C3-PIE CHART JS -->
	<script src="<?php echo base_url() ?>assets/js/charts.js"></script>

	<!-- Chart js-->
	<script src="<?php echo base_url() ?>assets/plugins/chart/chart.min.js"></script>

	<!-- ECharts Plugin -->
	<script src="<?php echo base_url() ?>assets/plugins/echarts/echarts.js"></script>

	<!-- Rightsidebar js -->
	<script src="<?php echo base_url() ?>assets/plugins/sidebar/sidebar.js"></script>

	<!-- Flot Charts js-->
	<script src="<?php echo base_url() ?>assets/plugins/flot/jquery.flot.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/flot/jquery.flot.resize.js"></script>

	<!-- Apexchart js-->
	<script src="<?php echo base_url() ?>assets/js/apexcharts.js"></script>

	<!-- Owl Carousel js -->
	<script src="<?php echo base_url() ?>assets/plugins/owl-carousel/owl.carousel.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/owl-carousel/owl-main.js"></script>

	<!-- Timepicker js -->
	<script src="<?php echo base_url() ?>assets/plugins/time-picker/jquery.timepicker.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/time-picker/toggles.min.js"></script>

	<!--Bootstrap-daterangepicker js-->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!--Bootstrap-datepicker js-->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

	<!--Bootstrap-colorpicker js-->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
	<!--advancedforms js -->
	<!-- <script src="<?php echo base_url() ?>assets/js/select2.js"></script> -->
	<!-- <script src="<?php echo base_url() ?>assets/js/formelements.js"></script>
	<script src="<?php echo base_url() ?>assets/js/formelementadvnced.js"></script> -->

	<!-- Index Js-->
	<!-- <script src="<?php echo base_url() ?>assets/js/analytics-reports.js"></script> -->
	<!--Newsticker js-->
	<script src="<?php echo base_url() ?>assets/plugins/newsticker/jquery.jConveyorTicker.js"></script>
	<!-- <script src="<?php echo base_url() ?>assets/plugins/jquery-conveyor-ticker/jquery.jConveyorTicker.js"></script> -->
	<script src="<?php echo base_url() ?>assets/plugins/limarquee/jquery.liMarquee.js"></script>

	<script src="<?php echo base_url() ?>assets/js/newsticker.js"></script>
	<!-- Index js-->
	<!-- <script src="<?php echo base_url() ?>assets/js/index2.js"></script> -->

	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js">
	</script>

	<!-- Gallery js -->
	<script src="<?php echo base_url() ?>assets/plugins/gallery/lightgallery-all.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/gallery/jquery.mousewheel.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/gallery/lightgallery.js"></script>

	<!--Simple-lightbox Gallery js -->
	<script src="<?php echo base_url() ?>assets/plugins/gallery/simple-lightbox.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/gallery/gallery.js"></script>

	<!-- Gallery Scroll js -->
	<script src="<?php echo base_url() ?>assets/plugins/gallery-scroll/lc_lightbox.lite.js"></script>

	<!-- Gallery Shuffle js -->
	<script src="<?php echo base_url() ?>assets/plugins/gallery-shuffle/jquery.shuffle-images.js"></script>

	<!-- Gallery js -->
	<script src="<?php echo base_url() ?>assets/js/gallery.js"></script>

	<!-- File uploads js -->
	<script src="<?php echo base_url() ?>assets/plugins/fileuploads/js/dropify.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/fileuploads/js/fileupload.js"></script>

	<!--MutipleSelect js-->
	<script src="<?php echo base_url() ?>assets/plugins/multipleselect/multiple-select.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/multipleselect/multi-select.js"></script>

	<!--Sumoselect js-->
	<script src="<?php echo base_url() ?>assets/plugins/sumoselect/jquery.sumoselect.js"></script>

	<!--jquery transfer js-->
	<script src="<?php echo base_url() ?>assets/plugins/jQuerytransfer/jquery.transfer.js"></script>

	<!--multi js-->
	<script src="<?php echo base_url() ?>assets/plugins/multi/multi.min.js"></script>

	<!--advancedforms js -->
	<script src="<?php echo base_url() ?>assets/js/formelements.js"></script>
	<script src="<?php echo base_url() ?>assets/js/formelementadvnced.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/chartjs-plugin-datalabels.js"></script>

	<script type="text/javascript">
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
			if ($('#datetimepicker1').length) {
				$('#datetimepicker1').datetimepicker({
					format: 'YYYY-MM-DD HH:mm:ss'
				});
			}
		});

	</script>
	<script>
		window.setTimeout(function () {
			$(".alert").animate({
				opacity: 0
			}, 500).hide('slow');
		}, 3000);

		function getNotification() {
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getReports",
				dataType: "html",
				success: function (response) {
					$('#notificationList').html(response)
				}
			});
		}

		function playSound(url) {
			const audio = new Audio(url);
			audio.play();
		}

		$(document).ready(function () {
			var getdataUserRoles = $('#userroles').text();
			if (getdataUserRoles == 'User Guest') {
				$('#tambahdatas').hide();
				$('#tambahdatas1').hide();

				//hide menu
				//$('#form_pelaporan').hide();
				$('#jenis_pelaporan').hide();
				//$('#pangan_rekap_add').hide();
				//$('#pangan_lahantidur_add').hide();
				$('#unduhdata_unduh').hide();
				$('#usermanagement_div').hide();
				$('#tracercovid_div').show();
				$('#organisasi_level').hide();
				$('#audit_trail').hide();
				//
			} else if (getdataUserRoles == 'Satker') {
				$('#jenis_pelaporan').hide();
				$('#unduhdata_unduh').hide();
				$('#organisasi_div').hide();
				$('#usermanagement_div').hide();
				$('#tracercovid_div').show();
				$('#audit_trail').hide();
			} else if (getdataUserRoles == 'Admin Data Center') {
				$('#usermanagement_div').hide();
				$('#tracercovid_div').show();
				$('#audit_trail').hide();
			}


			$.ajax({
				type: 'ajax',
				method: 'GET',
				url: "<?= site_url() ?>/api/checkReports",
				dataType: 'json',
				success: function (data) {
					if (data == 0) {
						$('.pulse').hide()
						$('.typcn-bell').attr('class', 'typcn typcn-bell')
					} else {
						$('.pulse').show()
						$('.typcn-bell').attr('class', 'typcn typcn-bell bell-animations')
					}
				},
			});

			<?php if ($this -> session -> userdata('notifable') == 1): ?> getNotification(); <?php endif ?>

				toastr.options = {
					"closeButton": true,
					"debug": false,
					"newestOnTop": true,
					"progressBar": false,
					"positionClass": "toast-bottom-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}
				// Enable pusher logging - don't include this in production
				// Pusher.log = function(message) {
				// 	if (window.console && window.console.log) {
				// 		window.console.log(message);
				// 	}
				// };
			<?php if ($this -> session -> userdata('notifable') == 1): ?>
				var pusher = new Pusher('aa7f90da2672cdc05af1', {
					cluster: 'ap1'
				});
			var channel = pusher.subscribe('angkatanlaut');

			channel.bind('my-event', function (data) {
				playSound('<?= site_url() ?>assets/sounds/note.mp3')
				$('.pulse').show()
				$('.typcn-bell').attr('class', 'typcn typcn-bell bell-animations')
				toastr["info"](data.message)
				getNotification()
				if ($('#mainActivities').length) {
					getMainActitivies()
				}
			}); 
			<?php endif ?>
				// $('.typcn').on('click', function () {
				// 	$('.pulse').hide()
				// 	$('.typcn-bell').attr('class', 'typcn typcn-bell')
				// });

				/* init datatables */
				var table = $('#tblasa').DataTable({
					lengthChange: false,
					buttons: ['copy', 'excel', 'pdf', 'colvis']
				});
			table.buttons().container()
				.appendTo('#example_wrapper .col-md-6:eq(0)');

			$('#dt-basic').dataTable({
				responsive: true

			});

			var tblRekap = $('#tbl-rekap').dataTable({
				drawCallback: function () {
					var api = this.api();
					$('#luasLahanTotal').html(
						api.column(1).data().sum()
					);
					$('#estimasiHasilTotal').html(
						api.column(3).data().sum()
					);
				},
				responsive: true
			});

		});

	</script>
	<script>
		/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}

		function filterFunction() {
			var input, filter, ul, li, a, i;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			div = document.getElementById("myDropdown");
			a = div.getElementsByTagName("a");
			for (i = 0; i < a.length; i++) {
				txtValue = a[i].textContent || a[i].innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					a[i].style.display = "";
				} else {
					a[i].style.display = "none";
				}
			}
		}

	</script>
</body>

</html>
