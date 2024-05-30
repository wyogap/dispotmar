<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Pelaporan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Form Pelaporan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Pelaporan</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form id="addForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
									value="<?= $this->security->get_csrf_hash();?>">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Jenis Pelaporan</label>
									<div class="col-md-9">
										<select class="form-control" id="type" name="type" style="width:100%;">
											<option value="">Pilih Kategori</option>
											<?php foreach($categories as $cat): ?>
											<option value="<?= $cat->id_activity_jenis ?>"><?= $cat->nama_jenis ?>
											</option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-type"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Siapa ?</label>
									<div class="col-md-9">
										<input type="text" name="who" class="form-control">
										<div class="invalid-feedback warning-who"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Satuan Kerja</label>
									<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin Data' || $this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Admin Data Center')): ?>
											<select class="form-control" id="satker" name="satker" style="width:100%;">
										<?php else: ?>
											<input type="hidden" class="form-control" id="hiddensatker" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled style="width:100%;">
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option value="<?= $satker->id_satker ?>"
												<?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>>
												<?= $satker->nama_satker ?>
											</option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Apa ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="what" name="what"></textarea>
										<div class="invalid-feedback warning-what"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Kapan?</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="date" id="datetimepicker1" placeholder="YYYY-MM-DD HH:ii:ss">
										<!-- <input class="form-control" type="date" name="date"> -->
										<div class="invalid-feedback warning-date"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Dimana ?</label>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-3">
												<select class="form-control" id="provinsi" name="provinsi" style="width:100%;">
													<option value="">Pilih Provinsi</option>
													<?php foreach($provinsi as $prov): ?>
													<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?>
													</option>
													<?php endforeach ?>
												</select>
												<div class="text-danger warning-provinsi"></div>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kabupaten" name="kabupaten" style="width:100%;">
													<option value="">Pilih Kabupaten</option>
												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kecamatan" name="kecamatan" style="width:100%;">
													<option value="">Pilih Kecamatan</option>
												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kelurahan" name="kelurahan" style="width:100%;">
													<option value="">Pilih Kelurahan</option>
												</select>
												<input type="text" id="flag_location" name="flag_location" style="display:none;" class="form-control">
											</div>
										</div>
										<br>
										<textarea class="form-control" rows="2" id="where" name="where" placeholder="Detail Alamat"></textarea>
										<div class="invalid-feedback warning-where"></div>
										<br>
										<div class="form-group">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="pinLocation" checked>
												<span class="custom-control-label">Pin Lokasi Saya</span>
											</label>
											<div class="map-view" style="display: block;">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitude" name="latitude"
															class="form-control" readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitude" name="longitude"
															class="form-control" readonly>
													</div>
												</div>
												<div id="map" style="width:100%;height:380px;"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Mengapa ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="why" name="why"></textarea>
										<div class="invalid-feedback warning-why"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Bagaimana ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="how" name="how"></textarea>
										<div class="invalid-feedback warning-how"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Catatan Penting</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="6" id="notes" name="notes"></textarea>
									</div>
								</div>
								<!-- Tambah Field -->
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Foto</label>
									<div class="col-md-4">
										<input type="file" class="dropify" id="gambar" name="gambar">
										<div class="invalid-feedback warning-gambar"></div>
									</div>
									<!-- <div class="col-md-6">
										<div id="my_camera"></div>
										<br />
										<input type=button value="Take Snapshot" onClick="take_snapshot()">
										<input type="hidden" name="image" class="image-tag">
									</div>
									<div class="col-md-6">
										<div id="results">Your captured image will appear here...</div>
									</div> -->
								</div>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="loadingButton" class="btn btn-primary" style="display: none;"
											disabled>Sedang mengirimkan laporan</button>
										<button type="submit" id="submitButton" class="btn btn-primary">Kirim</button>
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
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
	integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
	integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script language="JavaScript">
	Webcam.set({
		width: 490,
		height: 390,
		image_format: 'jpeg',
		jpeg_quality: 90
	});

	Webcam.attach('#my_camera');

	function take_snapshot() {
		Webcam.snap(function (data_uri) {
			$(".image-tag").val(data_uri);
			document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
		});
	}

</script> -->
<script>
	$(document).ready(function () {
		$("select[name='type']").select2();
		$("select[name='satker']").select2();
		$("select[name='provinsi']").select2();
		$("select[name='kabupaten']").select2();
		$("select[name='kecamatan']").select2();
		$("select[name='kelurahan']").select2();

		$('input').on('keyup change', function () {
			var name = $(this).attr('name')
			$('input[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('textarea').on('keyup change', function () {
			var name = $(this).attr('name')
			$('textarea[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('select').on('change', function () {
			var name = $(this).attr('name')
			$('.warning-' + name).html('')
		});
		
		$('#addForm').submit(function () {
			$('#submitButton').hide()
			$('#loadingButton').show()

			var valueSatker = '';

			if($('#hiddensatker').val() == undefined)
			{
				valueSatker =$('select[name="satker"]').val();
			}
			else if($('#hiddensatker').val() != undefined)
			{
				valueSatker =  $('#hiddensatker').val();
			}

			var formData = new FormData();
			formData.append('csrf_al', $('input[name="csrf_al"]').val());
			formData.append('type', $('select[name="type"]').val());
			formData.append('who', $('input[name="who"]').val());
			formData.append('satker', valueSatker);
			formData.append('what', $('#what').val());
			formData.append('date', $('input[name="date"]').val());
			formData.append('provinsi', $('#provinsi').val());
			formData.append('kabupaten', $('#kabupaten').val());
			formData.append('kecamatan', $('#kecamatan').val());
			formData.append('kelurahan', $('#kelurahan').val());
			formData.append('where', $('#where').val());
			formData.append('latitude', $('input[name="latitude"]').val());
			formData.append('longitude', $('input[name="longitude"]').val());
			formData.append('why', $('#why').val());
			formData.append('how', $('#how').val());
			formData.append('notes', $('#notes').val());
			formData.append('flag_location', $('#flag_location').val());
			// Attach file
			formData.append('gambar', $('#gambar')[0].files[0]); 
			$.ajax({
				type: "POST",
				url: "form_pelaporan/store",
				dataType: "json",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if (data[0].status == 0) {
						$('input[name="csrf_al"]').val(data[0].csrf)
						$.each(data[1], function (key, value) {
							$('#' + key).addClass('is-invalid')
							$('input[name="' + key + '"]').addClass('is-invalid')
							$('textarea[name="' + key + '"]').addClass('is-invalid')
							$('.warning-' + key).html(value)
						});
						$('#submitButton').show()
						$('#loadingButton').hide()
					} else {
						window.location.reload();
					}
				},
				error: function (data) {
					console.log(data)
				}
			});
			return false;
		});

		$('#satker').change(function(){ 
			var id= $(this).val();
			if (id) {
			$.ajax({
				url : "api/getLatLong_byIdSatker/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#latitude').val(data[0].latitude);
					$('#longitude').val(data[0].longitude);
					initMap(data[0].latitude, data[0].longitude);
					}
				});
			return false;
			} else {
			}
		});

		$('#provinsi').change(function(){ 
			var id= $(this).val();
			$('#flag_location').val("prov");

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKabupaten/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kabupaten').html(html);
						$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 
		$('#kabupaten').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("prov");
			}
			else
			{
				$('#flag_location').val("kab");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKecamatan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kecamatan').html(html);
						$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 
		$('#kecamatan').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("kab");
			}
			else
			{
				$('#flag_location').val("kec");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKelurahan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kelurahan').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 
		$('#kelurahan').change(function(){
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("kec");
			}
			else
			{
				$('#flag_location').val("kel");
			}
		}); 

		if($('#hiddensatker').val() != undefined){
		var id = $('#hiddensatker').val();
		if (id) {
			$.ajax({
				url : "api/getLatLong_byIdSatker/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#latitude').val(data[0].latitude);
					$('#longitude').val(data[0].longitude);
					initMap(data[0].latitude, data[0].longitude);
				}
			});
			return false;
		}
	}

		// $('#pinLocation').on('click', function () {
		// 	$('.map-view').toggle()
		// });
	});

</script>
<script>
	// Note: This example requires that you consent to location sharing when
	// prompted by your browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.
	var map, infoWindow, marker;

	function placeMarker(map, latlong) {
		if (marker) {
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

	function initMap(_LAT, _LONG) {
		
		if(_LAT == undefined){
			_LAT = -6.175392;
		}
		if(_LONG == undefined){
			_LONG = 106.827153;
		}

		_LAT = parseFloat(_LAT);
		_LONG = parseFloat(_LONG);
		
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: _LAT, lng: _LONG},
			zoom: 6
		});
		
		marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
		//$("#latitude").val(-5.510070123509014);
		//$("#longitude").val(102.344928425);

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
