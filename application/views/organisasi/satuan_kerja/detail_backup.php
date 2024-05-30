<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Organisasi</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url()?>organisasi_satker"><i class="ti-package mr-1"></i> Satker</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Detail Satker</div>
					<div class="card-options">
						<div class="col-md-12 text-right">
							<a href="<?= site_url()?>organisasi_satker/<?= encrypt($satker->id_satker) ?>/edit" class="btn btn-success btn-sm"><i class="fa fa-pencil mr-2"></i> Edit</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form class="form-horizontal" method="POST" id="editForm">
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Nama Satker</label>
									<div class="col-md-4">
										<input type="text" name="name" class="form-control" value="<?= $satker->nama_satker ?>" readonly>
										<div class="text-danger warning-unit"></div>
									</div>
									<label class="col-md-2 col-form-label">Kode Satker</label>
									<div class="col-md-4">
										<input type="text" name="kode_satker" class="form-control" value="<?= $satker->kode_satker ?>" readonly>
										<div class="invalid-feedback warning-area"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Tipe Organisasi</label>
									<div class="col-md-4">
										<input type="text" name="area" class="form-control" value="<?= $satker->jenis_organisasi ?>" readonly>
										<div class="invalid-feedback warning-area"></div>
									</div>
									<label class="col-md-2 col-form-label">Parent Satker</label>
									<div class="col-md-4">
										<input type="text" name="area" class="form-control" value="<?= $satker->nama_parent_satker ?>" readonly>
										<div class="invalid-feedback warning-area"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Lokasi</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-3">
											<input type="text" name="area" class="form-control" value="<?= $satker->PROVINSI ?>" readonly>
												<div class="text-danger warning-provinsi"></div>
											</div>
											<div class="col-md-3">
											<input type="text" name="area" class="form-control" value="<?= $satker->KABUPATEN ?>" readonly>
											</div>
											<div class="col-md-3">
											<input type="text" name="area" class="form-control" value="<?= $satker->KECAMATAN ?>" readonly>
											</div>
											<div class="col-md-3">
											<input type="text" name="area" class="form-control" value="<?= $satker->KELURAHAN ?>" readonly>
											</div>
											<div class="col-md-12" style="padding-top:10px">
												<textarea class="form-control" rows="2" name="notes"
													placeholder="Alamat" readonly><?= $satker->alamat ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="map-view">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitude" name="latitude"
															class="form-control" value="<?= $satker->latitude ?>" readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitude" name="longitude"
															class="form-control" value="<?= $satker->longitude ?>" readonly>
													</div>
												</div>
												<div id="map" style="width:100%;height:380px;"></div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=initMap"></script>
<script>
	var map, infoWindow, marker;

	function initMap() {
		const startLocation = new google.maps.LatLng(<?= $satker->latitude ?>, <?= $satker->longitude ?>);
		map = new google.maps.Map(document.getElementById("map"), {
			center: startLocation,
			zoom: 15,
		});
		marker = new google.maps.Marker({
			map,
			position: startLocation,
		});
	}
</script>
