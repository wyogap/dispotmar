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
		<link href="<?= site_url()?>assets/css/default.css" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link rel="stylesheet" href="<?= site_url()?>assets/plugins/sidemenu/sidemenu.css">

		<!-- owl-carousel css-->
		<link href="<?= site_url()?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

		<!--Bootstrap-daterangepicker css-->
		<link rel="stylesheet" href="<?= site_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css">

		<!--Bootstrap-datepicker css-->
		<link rel="stylesheet" href="<?= site_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

		<!-- Sidemenu-responsive  css -->
		<link href="<?= site_url()?>assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css" rel="stylesheet">

		<!-- P-scroll css -->
		<link href="<?= site_url()?>assets/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

		<!--Font icons css-->
		<link  href="<?= site_url()?>assets/css/icons.css" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link href="<?= site_url()?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!--Color-palette css-->
		<link rel="stylesheet" href="<?= site_url()?>assets/css/skins.css"/>

	</head>

	<body class="h-100vh">

		<!--Loader-->
		<div id="loading">
			<img src="<?= site_url()?>assets/images/other/loader.svg" class="loader-img" alt="Loader">
		</div>

		<div class="page">
		   <!-- PAGE-CONTENT OPEN -->
			<div class="page-content error-page">
				<div class="container text-center">
					<img src="<?= site_url()?>assets/images/svg/error.svg" alt="error" class="w-50 floating">
					<h1 class="h2 mt-4 mb-5">Oops! Page Not Found</h1>
					<a class="btn btn-outline-primary" href="<?= site_url()?>home">
						Back To Home
					</a>
				</div>
			</div>
			<!-- PAGE-CONTENT OPEN CLOSED -->
		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

		<!-- Dashboard js -->
		<script src="<?= site_url()?>assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="<?= site_url()?>assets/plugins/bootstrap-4.1.3/popper.min.js"></script>
		<script src="<?= site_url()?>assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js"></script>
		<script src="<?= site_url()?>assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="<?= site_url()?>assets/js/vendors/circle-progress.min.js"></script>
		<script src="<?= site_url()?>assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="<?= site_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Moment js-->
        <script src="<?= site_url()?>assets/plugins/moment/moment.min.js"></script>

		<!--Bootstrap-daterangepicker js-->
		<script src="<?= site_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!--Bootstrap-datepicker js-->
		<script src="<?= site_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

		<!--Counters -->
		<script src="<?= site_url()?>assets/plugins/counters/counterup.min.js"></script>
		<script src="<?= site_url()?>assets/plugins/counters/waypoints.min.js"></script>

		<!--owl-carousel-->
		<script src="<?= site_url()?>assets/plugins/owl-carousel/owl.carousel.js"></script>
		<script src="<?= site_url()?>assets/js/carousel.js"></script>

		<!-- Custom Js-->
		<script src="<?= site_url()?>assets/js/custom.js"></script>

	</body>
</html>
