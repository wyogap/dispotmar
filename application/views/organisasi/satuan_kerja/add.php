<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Organisasi</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url()?>organisasi_satker"><i class="ti-package mr-1"></i> Satker</a></li>
			<li class="breadcrumb-item active" aria-current="page">Add</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Add Satker</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form class="form-horizontal" method="POST" id="editForm">
								<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Nama Satker</label>
									<div class="col-md-4">
										<input type="text" name="area" class="form-control" value="">
										<div class="text-danger warning-unit"></div>
									</div>
									<label class="col-md-2 col-form-label">Kode Satker</label>
									<div class="col-md-4">
										<input type="text" name="area" class="form-control" value="">
										<div class="invalid-feedback warning-area"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Tipe Organisasi</label>
									<div class="col-md-4">
										<select class="form-control nice-select" name="unit">
											<option value="">Pilih Tipe</option>
										</select>
										<div class="text-danger warning-unit"></div>
									</div>
									<label class="col-md-2 col-form-label">Parent Satker</label>
									<div class="col-md-4">
										<select class="form-control nice-select" name="unit">
											<option value="">Pilih Parent</option>
										</select>
										<div class="text-danger warning-unit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Lokasi</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-3">
												<select class="form-control" id="provinsi" name="provinsi">
													<option value="">Pilih Provinsi</option>
													<?php foreach($provinsi as $prov): ?>
													<option value="<?= $prov->id_geografi ?>"
														<?= ($pangan->id_provinsi == $prov->id_geografi) ? 'selected' : '' ?>>
														<?= $prov->nama ?></option>
													<?php endforeach ?>
												</select>
												<div class="text-danger warning-provinsi"></div>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kabupaten" name="kabupaten">
													<option value="">Pilih Kabupaten</option>
												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kecamatan" name="kecamatan">
													<option value="">Pilih Kecamatan</option>
												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kelurahan" name="kelurahan">
													<option value="">Pilih Kelurahan</option>
												</select>
											</div>
											<div class="col-md-12" style="padding-top:10px">
												<textarea class="form-control" rows="2" name="notes" placeholder="Alamat"></textarea>
											</div>
										</div>
										<div class="form-group">
												<div class="mt-2 mb-2">
													<a href="#" class="btn btn-outline-secondary btn-sm btn-square"><i
															class="fa fa-map-pin mr-2"></i> Dapatkan Lokasi</a>
												</div>
											<div class="map-view">
											<div class="row">
												<div class="form-group col-md-6">
													<label>Latitude</label>
													<input type="text" id="latitude" name="latitude" class="form-control" readonly>
												</div>
												<div class="form-group col-md-6">
													<label>Longitude</label>
													<input type="text" id="longitude" name="longitude" class="form-control" readonly>
												</div>
											</div>
												<div id="map" style="width:100%;height:380px;"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
										<button id="btnLoading" class="btn btn-secondary" style="display: none;"
											disabled>Sedang menyimpan data</button>
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
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=initMap"></script>
<script>
	// Note: This example requires that you consent to location sharing when
	// prompted by your browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.
	var map, infoWindow, marker;

	function placeMarker(map, latlong){
	    if(marker){
			// pindahkan marker
			marker.setPosition(latlong);
	    } else {
			// buat marker baru
			marker = new google.maps.Marker({
				position: latlong,
				map: map
			});
		}
	}

	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -6.1755367, lng: 106.8273503},
			zoom: 6
		});
		infoWindow = new google.maps.InfoWindow;

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				marker = new google.maps.Marker({
					position: pos,
					map,
				});
				
				$("#latitude").val(position.coords.latitude);
				$("#longitude").val(position.coords.longitude);
				
				map.setCenter(pos);
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitude").val(event.latLng.lat());
			$("#longitude").val(event.latLng.lng());
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
								'Error: The Geolocation service failed.' :
								'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}
</script>
