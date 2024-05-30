<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="" name="description">
	<meta content="" name="author">
	<meta name="keywords" content="">

	<!-- Favicon-->
	<link rel="icon" href="<?php echo base_url() ?>assets/images/logonew.jpg" type="image/x-icon" />

	<!-- Title -->
	<title>Dispotmar</title>

	<!-- Bootstrap css -->
	<link href="<?php echo base_url() ?>assets/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Style css -->
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/default.css" rel="stylesheet" />


	<!-- Sidemenu-responsive  css -->
	<link href="<?php echo base_url() ?>assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css"
		rel="stylesheet">

	<!-- P-scroll css -->
	<link href="<?php echo base_url() ?>assets/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

	<!--Font icons css-->
	<link href="<?php echo base_url() ?>assets/css/icons.css" rel="stylesheet">


	<!-- Nice-select css  -->
	<link href="<?php echo base_url() ?>assets/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet" />

	<!-- Color-palette css-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/skins.css" />
	<style>
		body {
			background-image: url("<?php echo base_url() ?>assets/images/bg-login8.jpg");
			/* Full height */
			height: 100%;

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		body .page .container .justify-content-center {
			opacity: 0.9;
		}
	</style>

</head>

<body class="app h-100vh">

	<!-- Loader -->
	<!-- <div id="loading">
			<img src="<?php echo base_url() ?>assets/images/other/loader.svg" class="loader-img" alt="Loader">
		</div> -->

	<!-- Page opened -->
	<div class="page">
		<div class="">
			<!-- container opened -->
			<div class="container">
				<div class="row">
					<div class="col-xl-4 justify-content-center mx-auto text-center">
						<?php
						// $this->session->set_flashdata('error', 'Gagal Login');
						$data = $this->session->flashdata('success');
						if ($data != "") {
							?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil !</strong> <?= $data; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php
						}
						?>
						<?php
						$data2 = $this->session->flashdata('error');
						if ($data2 != "") {
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal !</strong> <?= $data2; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php
						}
						?>
						<div class="card" style="opacity: 0.9;">
							<div class="row">
								<div class="text-center">
									<img src="<?php echo base_url() ?>assets/images/logonew.jpg" style="width:40%; margin-top:10px;"
										class="header-brand-img desktop-logo h-100" alt="Dashlot logo">
								</div>
								<!-- <div class="col-md-12 col-lg-7 pr-0 d-none d-lg-block">
									<img src="<?php echo base_url() ?>assets/images/photos/login.jpg" alt="img"
										class="br-tl-2 br-bl-2 ">
								</div> -->
								<div class="col-md-12 col-lg-12 pl-0 ">
									<div class="card-body p-6 about-con pabout">
									<br>
										<div style="display:none;" class="card-title text-center  mb-4">Login</div>
										<form method="POST" action="login/store">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
												value="<?= $this->security->get_csrf_hash();?>">
											<div class="form-group">
												<label for="username">Username:</label>
												<input type="text" name="username" style="background-color:#e0e0e0; color:black;" class="form-control" id="username">
											</div>
											<div class="form-group">
												<label for="pwd">Password:</label>
												<input type="password" name="password" style="background-color:#e0e0e0; color:black;" class="form-control" id="pwd">
											</div>

											<div class="form-group">
												<label class="custom-control custom-checkbox">
													<a href="#"
														class="float-right small text-info">Forgot password?</a>
												</label>
											</div>
											<button type="submit" class="btn btn-success btn-block">Submit</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- container closed -->
		</div>
	</div>
	<!-- Page closed -->
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-4.1.3/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/circle-progress.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>

	<!--Moment js-->
	<!--Moment js-->
	<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>

	<!-- Custom scroll bar js-->
	<script src="<?php echo base_url() ?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

	<!--owl-carousel js-->
	<script src="<?php echo base_url() ?>assets/plugins/owl-carousel/owl.carousel.js"></script>

	<script src="<?php echo base_url() ?>assets/plugins/jquery-countdown/jquery.plugin.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/jquery-countdown/jquery.countdown.js"></script>

	<!-- Custom js-->
	<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

</body>

</html>
