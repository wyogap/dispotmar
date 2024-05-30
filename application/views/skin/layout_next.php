<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Dispotmar" name="description">
	<meta content="Wisatech name=" author">
	<meta name="keywords" content="Dispotmar">

	<!-- Favicon-->
	<link rel="icon" href="<?= site_url()?>assets/images/brand/favicon.png" type="image/x-icon" />

	<!-- Title -->
	<title><?php echo $title ?></title>

	<!-- Bootstrap css -->
	<link href="<?= site_url()?>assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Style css -->
	<link href="<?= site_url()?>assets/css/style.css" rel="stylesheet" />

	<!-- Default css -->
	<link href="<?= site_url()?>assets/css/default.css" rel="stylesheet">

	<!-- Sidemenu css-->
	<link rel="stylesheet" href="<?= site_url()?>assets/plugins/sidemenu/sidemenu.css">

	<!-- Owl-carousel css-->
	<link href="<?= site_url()?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

	<!-- Bootstrap-daterangepicker css -->
	<link rel="stylesheet" href="<?= site_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css">

	<!-- Bootstrap-datepicker css -->
	<link rel="stylesheet" href="<?= site_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

	<!-- Custom scroll bar css -->
	<link href="<?= site_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

	<!-- Sidemenu-repsonsive-tabs  css -->
	<link href="<?= site_url()?>assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css"
		rel="stylesheet">

	<!-- P-scroll css -->
	<link href="<?= site_url()?>assets/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

	<!-- Font-icons css -->
	<link href="<?= site_url()?>assets/css/icons.css" rel="stylesheet">

	<!-- Rightsidebar css -->
	<link href="<?= site_url()?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

	<!-- Nice-select css  -->
	<link href="<?= site_url()?>assets/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet" />

	<!-- Color-palette css-->
	<link rel="stylesheet" href="<?= site_url()?>assets/css/skins.css" />


	<!-- Data table css -->
	<link href="<?php echo base_url() ?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatable/css/buttons.bootstrap4.min.css">
	<link href="<?php echo base_url() ?>assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

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

	<link rel="stylesheet"
		href="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
</head>

<body class="app">

	<!-- Loader -->
	<div id="loading">
		<img src="<?= site_url()?>assets/images/other/loader.svg" class="loader-img" alt="Loader">
	</div>

	<!-- PAGE -->
	<div class="page">
		<div class="page-main">

			<!-- Top-header opened -->
			<div class="header-main header sticky">
				<div class="app-header header top-header navbar-collapse ">
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="index.html">
								<img src="<?= site_url()?>assets/images/brand/logo.png"
									class="header-brand-img desktop-logo " alt="Dashlot logo">
								<img src="<?= site_url()?>assets/images/brand/logo1.png"
									class="header-brand-img desktop-logo-1 " alt="Dashlot logo">
								<img src="<?= site_url()?>assets/images/brand/favicon.png" class="mobile-logo"
									alt="Dashlot logo">
								<img src="<?= site_url()?>assets/images/brand/favicon1.png" class="mobile-logo-1"
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
								<div class="" id="bs-example-navbar-collapse-1">
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
										<div class="dropdown-divider mb-0"></div>
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
											<small
												class="text-muted mr-3"><?= $this->session->userdata('role') ?></small>
										</div>
										<img class="avatar avatar-md brround"
											src="<?php echo base_url() ?>assets/images/users/fotoprofil.jpg"
											alt="image">
									</a>
									<div
										class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated bounceInDown w-250">
										<div class="user-profile bg-header-image border-bottom p-3">
											<div class="user-image text-center">
												<img class="user-images"
													src="<?php echo base_url() ?>assets/images/users/fotoprofil.jpg"
													alt="image">
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
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon  mdi mdi-settings"></i> Settings
										</a>
										<a class="dropdown-item" href="#">
											<span class="float-right"><span class="badge badge-success">6</span></span>
											<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-compass"></i> Need help?
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
			<aside class="app-sidebar">
				<div class="side-tab-body p-0 border-0" id="sidemenu-Tab">
					<div class="first-sidemenu">
						<div class="line-animations">
							<ul class="resp-tabs-list hor_1">
								<li class="resp-tab-active active"><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/homepage.svg"
										class="side_menu_img svg-1" alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/bitcoin-logo.svg"
										class="side_menu_img svg-1" alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/testing.svg" class="side_menu_img svg-1"
										alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/shopping-cart.svg"
										class="side_menu_img svg-1" alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/search.svg" class="side_menu_img svg-1"
										alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/writing.svg" class="side_menu_img svg-1"
										alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/bars-graphic.svg"
										class="side_menu_img svg-1" alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/layers.svg" class="side_menu_img svg-1"
										alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/calendar.svg"
										class="side_menu_img svg-1" alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/happy.svg" class="side_menu_img svg-1"
										alt="image"></li>
								<li><span class="side-menu__icon"></span><img
										src="<?= site_url()?>assets/images/svgs/login.svg" class="side_menu_img svg-1"
										alt="image"></li>
							</ul>
						</div>
					</div>
					<div class="second-sidemenu">
						<div class="resp-tabs-container hor_1">
							<div class="resp-tab-content-active">
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side1">
														<h5 class="mt-3 mb-4">Dashboard</h5>
														<a class="slide-item"
															href="<?= site_url()?>dashboard1"><span>Peta Sebaran
																Produksi</span></a>
														<a class="slide-item"
															href="<?= site_url()?>dashboard2"><span>Monitoring
																Status</span></a>
														<a class="slide-item"
															href="<?= site_url()?>dashboard3"><span>Monitoring
																Produksi</span></a>

														<a class="slide-item"
															href="<?= site_url()?>dashboard4"><span>Personel dan
																Lahan</span></a>

														<a class="slide-item"
															href="<?= site_url()?>dashboard5"><span>Pelaporan</span></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side11">
														<h5 class="mt-3 mb-4">LAPORAN HARIAN</h5>
														<?php if(policy('LAPHAR','create')): ?>
														<a href="<?= site_url()?>form_pelaporan" class="slide-item">Form
															Pelaporan</a>
														<?php endif ?>
														<?php if(policy('LAPHAR','read_all')): ?>
														<a href="<?= site_url()?>data_pelaporan" class="slide-item">Data
															Pelaporan</a>
														<?php endif ?>
														<?php if(policy('LAPHAR','create')): ?>
														<a href="<?= site_url()?>jenis_pelaporan"
															class="slide-item">Jenis Pelaporan</a>
														<?php endif ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active" id="side-1">
														<h5 class="mt-3 mb-4">Analytics</h5>
														<a href="analytics.html" class="slide-item">Dashboard</a>
														<a href="analytics-customers.html"
															class="slide-item">Customer</a>
														<a href="analytics-reports.html" class="slide-item">Reports</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Social</h5>
														<div class="mb-4">
															<p class="mb-2 ">Overall likes<span
																	class="float-right text-default">85%</span></p>
															<div class="progress progress-sm mb-3 h-1">
																<div
																	class="progress-bar progress-bar-striped progress-bar-animated bg-primary w-85">
																</div>
															</div>
														</div>
														<div class="mb-4">
															<p class="mb-2 ">Overall Shares<span
																	class="float-right text-default">65%</span></p>
															<div class="progress progress-sm mb-3 h-1">
																<div
																	class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-60">
																</div>
															</div>
														</div>
														<div class="mb-4">
															<p class="mb-2 ">Overall Comments<span
																	class="float-right text-default">35%</span></p>
															<div class="progress progress-sm mb-3 h-1">
																<div
																	class="progress-bar progress-bar-striped progress-bar-animated bg-info w-30">
																</div>
															</div>
														</div>
														<div class="mb-4">
															<p class="mb-2 ">Total Visits<span
																	class="float-right text-default">45%</span></p>
															<div class="progress progress-sm mb-3 h-1">
																<div
																	class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-45">
																</div>
															</div>
														</div>
														<div class="mb-4">
															<p class="mb-2 ">Total Impressions<span
																	class="float-right text-default">55%</span></p>
															<div class="progress progress-sm mb-3 h-1">
																<div
																	class="progress-bar progress-bar-striped progress-bar-animated bg-success w-55">
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side-11">
														<h5 class="mt-3 mb-4">Ecommerce</h5>
														<a href="ecommerce.html" class="slide-item">Dashboard</a>
														<a href="ecommerce-products.html"
															class="slide-item">Products</a>
														<a href="ecommerce-products1.html"
															class="slide-item">Products-style2</a>
														<a href="ecommerce-list.html" class="slide-item">Products
															list</a>
														<a href="ecommerce-details.html" class="slide-item">Product
															details</a>
														<a href="ecommerce-cart.html" class="slide-item">Cart</a>
														<a href="ecommerce-checkout.html"
															class="slide-item">Checkout</a>
														<a href="ecommerce-invoice.html" class="slide-item">Invoice</a>
														<a href="ecommerce-cards.html"
															class="slide-item">Ecommerce-cards</a>
														<a href="product-cards.html"
															class="slide-item">Product-cards</a>
														<a href="product-info.html" class="slide-item">Product-info</a>
													</div>
												</div>
												<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Overview</h5>
												<div class="card p-3 px-4">
													<div class=" fs-14 mb-1">Registered users</div>
													<div class=" m-0 mb-0 h3 text-primary-1">85</div>
													<div class="progress progress-xs box-shadow-0 mt-2 mb-2">
														<div
															class="progress-bar progress-animated bg-primary box-shadow-0 w-45">
														</div>
													</div>
													<div class="d-flex">
														<small class="text-muted">this month</small>
														<div class="ml-auto"><i class="fa fa-caret-up text-green"></i>
															12%</div>
													</div>
												</div>
												<div class="card p-3 px-4">
													<div class=" fs-14 mb-1">Daily Visitors</div>
													<div class=" m-0 mb-1 h3 text-primary-1">135</div>
													<div class="progress progress-xs box-shadow-0 mt-2 mb-2">
														<div
															class="progress-bar progress-animated bg-danger box-shadow-0 w-70">
														</div>
													</div>
													<div class="d-flex">
														<small class="text-muted">this month</small>
														<div class="ml-auto"><i
																class="fa fa-caret-down text-danger"></i> 08%</div>
													</div>
												</div>
												<div class="card p-3 px-4">
													<div class=" fs-14 mb-1">New Messages</div>
													<div class=" m-0 mb-1 h3 text-primary-1">45</div>
													<div class="progress progress-xs box-shadow-0 mt-2 mb-2">
														<div
															class="progress-bar progress-animated bg-success box-shadow-0 w-50">
														</div>
													</div>
													<div class="d-flex">
														<small class="text-muted">this month</small>
														<div class="ml-auto"><i class="fa fa-caret-up text-green"></i>
															11%</div>
													</div>
												</div>
												<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
												<div class="side-menu p-0">
													<div class="card-body p-0">
														<div class="list-group list-group-flush">
															<div
																class="list-group-item d-flex pl-0 pr-0 align-items-center">
																<div class="mr-2"> <span
																		class="avatar  brround cover-image"
																		data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																			class="avatar-status bg-green"></span></span>
																</div>
																<div class="">
																	<div class="font-weight-semibold fs-15">Mozelle
																	</div>
																</div>
																<div class="ml-auto"> <a href="#"
																		class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																			class="fa fa-phone fs-10"></i></a>
																</div>
															</div>
															<div
																class="list-group-item d-flex pl-0 pr-0 align-items-center">
																<div class="mr-2"> <span
																		class="avatar brround cover-image"
																		data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																</div>
																<div class="">
																	<div class="font-weight-semibold fs-15">Florinda
																	</div>
																</div>
																<div class="ml-auto"> <a href="#"
																		class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																			class="fa fa-phone fs-10"></i></a>
																</div>
															</div>
															<div
																class="list-group-item d-flex pl-0 pr-0 align-items-center">
																<div class="mr-2"> <span
																		class="avatar brround cover-image"
																		data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																			class="avatar-status bg-green"></span></span>
																</div>
																<div class="">
																	<div class="font-weight-semibold fs-15">lina Bernie
																	</div>
																</div>
																<div class="ml-auto"> <a href="#"
																		class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																			class="fa fa-phone fs-10"></i></a>
																</div>
															</div>
															<div
																class="list-group-item d-flex pl-0 pr-0 align-items-center">
																<div class="mr-2"> <span
																		class="avatar brround cover-image"
																		data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																			class="avatar-status bg-green"></span></span>
																</div>
																<div class="">
																	<div class="font-weight-semibold fs-15">Mclaughin
																	</div>
																</div>
																<div class="ml-auto"> <a href="#"
																		class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																			class="fa fa-phone fs-10"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
												<div class="">
													<a href="#" class="avatar brround avatar-md cover-image m-1"
														data-image-src="<?= site_url()?>assets/images/users/3.jpg">
														<span class="avatar-status bg-green"></span>
													</a>
													<a href="#" class="avatar brround avatar-md cover-image m-1"
														data-image-src="<?= site_url()?>assets/images/users/6.jpg">
														<span class="avatar-status bg-green"></span>
													</a>
													<a href="#" class="avatar brround avatar-md cover-image m-1"
														data-image-src="<?= site_url()?>assets/images/users/3.jpg">
														<span class="avatar-status bg-warning"></span>
													</a>
													<a href="#" class="avatar brround avatar-md cover-image m-1"
														data-image-src="<?= site_url()?>assets/images/users/4.jpg">
														<span class="avatar-status bg-green"></span>
													</a>
													<a href="#" class="avatar brround avatar-md cover-image m-1"
														data-image-src="<?= site_url()?>assets/images/users/9.jpg">
														<span class="avatar-status bg-warning"></span>
													</a>
													<a href="#" class="avatar brround avatar-md cover-image m-1">+34</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side-21">
														<h5 class="mt-3 mb-4">UI Elements</h5>
														<a href="alert.html" class="slide-item"> Alerts</a>
														<a href="buttons.html" class="slide-item">Buttons</a>
														<a href="cards.html" class="slide-item">Cards</a>
														<a href="cards-draggable.html" class="slide-item">Dragabble
															cards</a>
														<a href="carousel.html" class="slide-item">Carousel</a>
														<a href="colors.html" class="slide-item">Colors</a>
														<a href="cookies.html" class="slide-item">Cookies</a>
														<a href="avatars.html" class="slide-item">Avatars</a>
														<a href="dropdown.html" class="slide-item">Drop downs</a>
														<a href="chat.html" class="slide-item">Default Chat</a>
														<a href="designblocks.html" class="slide-item">Design blocks</a>
														<a href="list.html" class="slide-item">List</a>
														<a href="tags.html" class="slide-item">Tags</a>
														<a href="pagination.html" class="slide-item">Pagination</a>
														<a href="navigation.html" class="slide-item">Navigation</a>
														<a href="typography.html" class="slide-item">Typography</a>
														<a href="breadcrumbs.html" class="slide-item">Breadcrumbs</a>
														<a href="badges.html" class="slide-item">Badges</a>
														<a href="notify.html" class="slide-item">Notifications</a>
														<a href="sweetalert.html" class="slide-item">Sweet alerts</a>
														<a href="jumbotron.html" class="slide-item">Jumbotron</a>
														<a href="panels.html" class="slide-item">Panels</a>
														<a href="thumbnails.html" class="slide-item">Thumbnails</a>
														<a href="mediaobject.html" class="slide-item">Media Object</a>
														<a href="accordion.html" class="slide-item">Accordions</a>
														<a href="tabs.html" class="slide-item">Tabs</a>
														<a href="rangeslider.html" class="slide-item">Range slider</a>
														<a href="scroll.html" class="slide-item">Content Scroll bar</a>
														<a href="modals.html" class="slide-item">Modal</a>
														<a href="tooltipandpopover.html" class="slide-item">Tooltip and
															popover</a>
														<a href="progress.html" class="slide-item">Progress</a>
														<a href="headers.html" class="slide-item">Headers</a>
														<a href="footers.html" class="slide-item">Footers</a>
														<a href="loaders.html" class="slide-item">Loaders</a>
														<a href="counters.html" class="slide-item">Counters</a>
														<a href="rating.html" class="slide-item">Rating</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side21">
														<h5 class="mt-3 mb-4">Forms</h5>
														<a href="form-elements.html" class="slide-item">Form
															Elements</a>
														<a href="forms.html" class="slide-item">Forms</a>
														<a href="advancedforms.html"
															class="slide-item">Advancedforms</a>
														<a href="wysiwyag.html" class="slide-item">Form Editor</a>
														<a href="form-wizard.html" class="slide-item">Form Wizard</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side31">
														<h5 class="mt-3 mb-4">Charts</h5>
														<a href="chart-chartist.html" class="slide-item">Chart Js</a>
														<a href="chart-flot.html" class="slide-item">Flot Charts</a>
														<a href="chart-echart.html" class="slide-item">ECharts</a>
														<a href="chart-morris.html" class="slide-item">Morris Charts</a>
														<a href="chart-nvd3.html" class="slide-item">Nvd3 Charts</a>
														<div class="side-menu p-0">
															<div class="slide submenu">
																<a class="side-menu__item" data-toggle="slide"
																	href="#"><span class="side-menu__label"> C3
																		charts</span><i
																		class="angle fa fa-angle-down"></i></a>
																<ul class="slide-menu submenu-list">
																	<li>
																		<a href="charts.html" class="slide-item">C3 Bar
																			Charts</a>
																	</li>
																	<li>
																		<a href="chart-line.html" class="slide-item">C3
																			Line Charts</a>
																	</li>
																	<li>
																		<a href="chart-donut.html" class="slide-item">C3
																			Donut Charts</a>
																	</li>
																	<li>
																		<a href="chart-pie.html" class="slide-item">C3
																			Pie charts</a>
																	</li>
																</ul>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side41">
														<h5 class="mt-3 mb-4">Pages</h5>
														<a href="profile.html" class="slide-item">Profile</a>
														<a href="editprofile.html" class="slide-item">Edit Profile</a>
														<a href="empty.html" class="slide-item">Empty Page</a>
														<a href="gallery.html" class="slide-item">Gallery</a>
														<a href="about.html" class="slide-item">About us</a>
														<a href="services.html" class="slide-item">Services</a>
														<a href="faq.html" class="slide-item">FAQS</a>
														<a href="terms.html" class="slide-item">Terms</a>
														<a href="invoice.html" class="slide-item">Invoice</a>
														<a href="pricing.html" class="slide-item">Pricing Tables</a>
														<a href="blog.html" class="slide-item">Blog</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side51">
														<h5 class="mt-3 mb-4"> Components </h5>
														<a href="widgets.html" class="slide-item">Widgets</a>
														<a href="maps.html" class="slide-item">Map</a>
														<a href="calendar-styles.html" class="slide-item">Calendar</a>
														<a href="contact-styles.html"
															class="slide-item">Contact-styles</a>
														<a href="caltoaction.html" class="slide-item">Cal-to-actions</a>
														<a href="users-list.html" class="slide-item">UserList</a>
														<a href="timeline.html" class="slide-item">Timeline</a>
														<a href="ribbons.html" class="slide-item">Ribbons</a>
														<a href="testimonials.html" class="slide-item">Testimonials</a>
														<a href="tables.html" class="slide-item">Tables</a>
														<a href="images-comparison.html"
															class="slide-item">Images-comparison</a>
														<a href="newsticker.html" class="slide-item">Newsticker</a>
														<a href="newsletter.html" class="slide-item">Newsletter</a>
														<a href="parallax.html" class="slide-item">Parallax</a>
														<a href="portfolio.html" class="slide-item">Portfolio</a>
														<a href="search.html" class="slide-item">Search</a>
														<a href="user-cards.html" class="slide-item">User-cards</a>
														<a href="videos.html" class="slide-item">Videos</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side61">
														<h5 class="mt-3 mb-4">Icons</h5>
														<a href="icons.html" class="slide-item">Font Awesome</a>
														<a href="icons2.html" class="slide-item">MaterialDesign</a>
														<a href="icons3.html" class="slide-item">Simpleline</a>
														<a href="icons4.html" class="slide-item">Feather</a>
														<a href="icons5.html" class="slide-item">Ionic</a>
														<a href="icons6.html" class="slide-item">Flag</a>
														<a href="icons7.html" class="slide-item">Pe7</a>
														<a href="icons8.html" class="slide-item">Themify</a>
														<a href="icons9.html" class="slide-item">Typicons</a>
														<a href="icons10.html" class="slide-item">Weather</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active " id="side62">
														<h5 class="mt-3 mb-4">Custom Pages</h5>
														<a href="login.html" class="slide-item">Login</a>
														<a href="register.html" class="slide-item">Register</a>
														<a href="forgot-password.html" class="slide-item">Forgot
															Password</a>
														<a href="lockscreen.html" class="slide-item">Lock screen</a>
														<a href="construction.html" class="slide-item">Under
															Construction</a>
														<a href="400.html" class="slide-item">400</a>
														<a href="401.html" class="slide-item">401</a>
														<a href="403.html" class="slide-item">403</a>
														<a href="404.html" class="slide-item">404</a>
														<a href="500.html" class="slide-item">500</a>
														<a href="503.html" class="slide-item">503</a>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Notifications
														</h5>
														<div class="row p-2">
															<div class="col-6 p-0">
																<div class="border text-center border-right-0"><i
																		class="ti-headphone fs-30 text-secondary-shadow text-secondary"></i>
																	<a><small class="mb-0">Support</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center"><i
																		class="ti-bell fs-30 text-warning-shadow text-warning"></i>
																	<a><small class="mb-0">Notification</small></a>
																</div>
															</div>
															<div class="col-6 p-0">
																<div
																	class="border text-center border-right-0 border-top-0">
																	<i
																		class="ti-panel fs-30 text-primary text-primary-shadow"></i>
																	<a><small class="mb-0">Settings</small></a> </div>
															</div>
															<div class="col-6 p-0">
																<div class="border text-center border-top-0"> <i
																		class="ti-layers fs-30 text-danger text-danger-shadow"></i>
																	<a><small class="mb-0">Layouts</small></a> </div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Contacts</h5>
														<div class="side-menu p-0">
															<div class="card-body p-0">
																<div class="list-group list-group-flush">
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar  brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/12.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mozelle</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/11.jpg"></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Florinda</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/5.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">lina
																				Bernie</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																	<div
																		class="list-group-item d-flex pl-0 pr-0 align-items-center">
																		<div class="mr-2"> <span
																				class="avatar brround cover-image"
																				data-image-src="<?= site_url()?>assets/images/users/2.jpg"><span
																					class="avatar-status bg-green"></span></span>
																		</div>
																		<div class="">
																			<div class="font-weight-semibold fs-15">
																				Mclaughin</div>
																		</div>
																		<div class="ml-auto"> <a href="#"
																				class="btn btn-sm btn-light btn-icon box-shadow-0"><i
																					class="fa fa-phone fs-10"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Followers</h5>
														<div class="">
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/6.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/3.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/4.jpg">
																<span class="avatar-status bg-green"></span>
															</a>
															<a href="#" class="avatar brround avatar-md cover-image m-1"
																data-image-src="<?= site_url()?>assets/images/users/9.jpg">
																<span class="avatar-status bg-warning"></span>
															</a>
															<a href="#"
																class="avatar brround avatar-md cover-image m-1">+34</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</aside>
			<!-- Sidemenu closed -->

			<!-- App-content opened -->
			<div class="app-content">
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
		<footer class="footer-main leftmenu-footer">
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
	<script src="<?= site_url()?>assets/js/vendors/jquery-3.2.1.min.js"></script>

	<!-- Moment js-->
	<script src="<?= site_url()?>assets/plugins/moment/moment.min.js"></script>

	<!-- Bootstrap-scripts js -->
	<script src="<?= site_url()?>assets/js/vendors/bootstrap.bundle.min.js"></script>

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

	<!-- Sparkline JS-->
	<script src="<?= site_url()?>assets/js/vendors/jquery.sparkline.min.js"></script>

	<!-- Bootstrap-daterangepicker js -->
	<script src="<?= site_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- Bootstrap-datepicker js -->
	<script src="<?= site_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

	<!-- Chart-circle js -->
	<script src="<?= site_url()?>assets/js/vendors/circle-progress.min.js"></script>

	<!-- Rating-star js -->
	<script src="<?= site_url()?>assets/plugins/rating/jquery.rating-stars.js"></script>

	<!-- Clipboard js -->
	<script src="<?= site_url()?>assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="<?= site_url()?>assets/plugins/clipboard/clipboard.js"></script>

	<!-- Prism js -->
	<script src="<?= site_url()?>assets/plugins/prism/prism.js"></script>

	<!-- Custom scroll bar js-->
	<script src="<?= site_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Nice-select js-->
	<script src="<?= site_url()?>assets/plugins/jquery-nice-select/js/jquery.nice-select.js"></script>
	<script src="<?= site_url()?>assets/plugins/jquery-nice-select/js/nice-select.js"></script>

	<!-- P-scroll js -->
	<script src="<?= site_url()?>assets/plugins/p-scroll/p-scroll.js"></script>
	<script src="<?= site_url()?>assets/plugins/p-scroll/p-scroll-leftmenu.js"></script>

	<!-- Sidemenu js-->
	<script src="<?= site_url()?>assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidemenu-respoansive-tabs js -->
	<script src="<?= site_url()?>assets/plugins/sidemenu-responsive-tabs/js/sidemenu-responsive-tabs.js"></script>

	<!-- Apexchart js-->
	<script src="<?= site_url()?>assets/js/apexcharts.js"></script>

	<!-- Chart js-->
	<script src="<?= site_url()?>assets/plugins/chart/chart.min.js"></script>

	<!-- Index js -->
	<script src="<?= site_url()?>assets/js/index.js"></script>
	<script src="<?= site_url()?>assets/js/index-map.js"></script>

	<!-- Leftmenu js -->
	<script src="<?= site_url()?>assets/js/left-menu.js"></script>

	<!-- Rightsidebar js -->
	<script src="<?= site_url()?>assets/plugins/sidebar/sidebar.js"></script>

	<!-- Custom js -->
	<script src="<?= site_url()?>assets/js/custom.js"></script>

	<!-- Select2 js -->
	<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>


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

	<!--Newsticker js-->
	<script src="<?php echo base_url() ?>assets/plugins/newsticker/jquery.jConveyorTicker.js"></script>
	<script src="<?php echo base_url() ?>assets/js/newsticker.js"></script>
	<!-- Index js-->
	<!-- <script src="<?php echo base_url() ?>assets/js/index2.js"></script> -->

	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js">
	</script>
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

			<?php if ($this->session->userdata('notifable') == 1): ?>
			getNotification();
			<?php endif ?>

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
				<?php if ($this->session->userdata('notifable') == 1): ?>
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
				}); <?php endif ?>
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
</body>

</html>
