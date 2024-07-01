<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Ketahanan Pangan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Lahan Tidur</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Lahan Tidur</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
								<input type="hidden" name="id" value="<?= encrypt($lahantidur->id_lahan_tidur) ?>">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Satuan Kerja</label>
									<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
										<?php else: ?>
											<select class="form-control" id="satker" name="satker" style="width:100%;">
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option value="<?= $satker->id_satker ?>"
											<?php if ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')): ?>
												selected
											<?php elseif($satker->id_satker == $lahantidur->id_satker): ?>
												selected
											<?php endif ?>><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Lokasi</label>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-3">
												<select class="form-control" id="provinsi" name="provinsi" style="width:100%;">
													<option value="">Pilih Provinsi</option>
													<?php foreach($provinsi as $prov): ?>
													<option value="<?= $prov->id_geografi ?>" <?= ($lahantidur->id_provinsi == $prov->id_geografi) ? 'selected' : '' ?>><?= $prov->nama ?></option>
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
												<input type="text" id="flag_locationedit" name="flag_locationedit" value="<?= $lahantidur->flag_location ?>" style="display:none;" class="form-control">
											</div>
										</div>
										<br>
										<textarea class="form-control" rows="2" name="location"><?= $lahantidur->lokasi ?></textarea>
										<div class="invalid-feedback warning-location"></div>
										<br>
										<div class="form-group">
											<div class="map-view">
											<div class="row">
												<div class="form-group col-md-6">
													<label>Latitude</label>
													<input type="text" id="latitude" name="latitude" class="form-control" value="<?= $lahantidur->latitude ?>" readonly>
												</div>
												<div class="form-group col-md-6">
													<label>Longitude</label>
													<input type="text" id="longitude" name="longitude" class="form-control" value="<?= $lahantidur->longitude ?>"" readonly>
												</div>
											</div>
												<div id="map" style="width:100%;height:380px;"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Luas Total (HA)</label>
									<div class="col-md-9">
										<input type="text" name="totalArea" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $lahantidur->luas_total ?>">
										<div class="invalid-feedback warning-totalArea"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Digarap (HA)</label>
									<div class="col-md-9">
										<input type="text" name="usedArea" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $lahantidur->digarap ?>">
										<div class="invalid-feedback warning-usedArea"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Lahan Tidur (HA)</label>
									<div class="col-md-9">
										<input type="text" name="restArea" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $lahantidur->lahan_tidur ?>">
										<div class="invalid-feedback warning-restArea"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Keterangan</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="notes"><?= $lahantidur->keterangan ?></textarea>
										<div class="invalid-feedback warning-notes"></div>
									</div>
								</div>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="loadingButton" class="btn btn-primary" style="display: none;" disabled>Sedang mengirimkan laporan</button>
										<button type="submit" style="height:44px;" id="submitButton" class="btn btn-primary">Kirim</button>
										<button type="submit" class="btn btn-sm btn-danger"><a style="color:white;" href="<?= site_url()?>pangan_lahantidur" class="slide-item">Kembali ke List Data</a></button>
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
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=initMap"></script>
<script>
	$(document).ready(function () {
		$("#satker").select2();
		$("#provinsi").select2();
		$("#kabupaten").select2();
		$("#kecamatan").select2();
		$("#kelurahan").select2();

	if($("#flag_locationedit").val() == 'prov')
	{
		getProvinsi(<?= $lahantidur->id_provinsi ?>);
		getKabupaten(<?= $lahantidur->id_provinsi ?>,0)
		getKecamatan(0,0)
		getKelurahan(0,0)
	}
	else if($("#flag_locationedit").val() == 'kab')
	{
		getProvinsi(<?= $lahantidur->id_provinsi ?>)
		getKabupaten(<?= $lahantidur->id_provinsi ?>,<?= $lahantidur->id_kabupaten ?>)
		getKecamatan(<?= $lahantidur->id_kabupaten ?>,0)
		getKelurahan(0,0)
	}
	else if($("#flag_locationedit").val() == 'kec')
	{
		getProvinsi(<?= $lahantidur->id_provinsi ?>)
		getKabupaten(<?= $lahantidur->id_provinsi ?>,<?= $lahantidur->id_kabupaten ?>)
		getKecamatan(<?= $lahantidur->id_kabupaten ?>,<?= $lahantidur->id_kecamatan ?>)
		getKelurahan(<?= $lahantidur->id_kecamatan ?>,0)
	}
	else if($("#flag_locationedit").val() == 'kel')
	{
		getProvinsi(<?= $lahantidur->id_provinsi ?>)
		getKabupaten(<?= $lahantidur->id_provinsi ?>,<?= $lahantidur->id_kabupaten ?>)
		getKecamatan(<?= $lahantidur->id_kabupaten ?>,<?= $lahantidur->id_kecamatan ?>)
		getKelurahan(<?= $lahantidur->id_kecamatan ?>,<?= $lahantidur->id_kelurahan ?>)
	}
	else
	{
		getProvinsi(<?= $lahantidur->id_provinsi ?>);
		getKabupaten(<?= $lahantidur->id_provinsi ?>,<?= $lahantidur->id_kabupaten ?>);
		getKecamatan(<?= $lahantidur->id_kabupaten ?>,<?= $lahantidur->id_kecamatan ?>);
		getKelurahan(<?= $lahantidur->id_kecamatan ?>,<?= $lahantidur->id_kelurahan ?>);
	}


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
			$(this).removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('#editForm').submit(function () {
			$('#submitButton').hide()
			$('#loadingButton').show()
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>/pangan_lahantidur_edits/update",
				dataType: "json",
				data: $(this).serialize(),
				success: function (data) {
					if (data[0].status == 0) {
						$('input[name="csrf_al"]').val(data[0].csrf)
						$.each(data[1], function (key, value) {
							if (value != '') {
								$('#'+key).addClass('is-invalid')
								$('input[name="' + key + '"]').addClass('is-invalid')
								$('textarea[name="' + key + '"]').addClass('is-invalid')
								$('.warning-' + key).html(value)
							}
						});
						$('#submitButton').show()
						$('#loadingButton').hide()
					} else {
						location.reload(true);
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
				url : "<?= site_url() ?>/api/getLatLong_byIdSatker/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#latitude').val(data[0].latitude);
					$('#longitude').val(data[0].longitude);
					initMap(data[0].latitude, data[0].longitude, 1);
					}
				});
			return false;
			} else {
			}
		});

		$('#provinsi').change(function(){ 
			var id= $(this).val();
			$('#flag_locationedit').val("prov");

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
				$('#flag_locationedit').val("prov");
			}
			else
			{
				$('#flag_locationedit').val("kab");
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
				$('#flag_locationedit').val("kab");
			}
			else
			{
				$('#flag_locationedit').val("kec");
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
				$('#flag_locationedit').val("kec");
			}
			else
			{
				$('#flag_locationedit').val("kel");
			}
		});

	}); 

	function getProvinsi(id_provinsi) {
		$.ajax({
			url : "<?= site_url() ?>api/getProvinsi/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Provinsi</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_provinsi) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#provinsi').html(html);
			}
		});
	}

	function getKabupaten(id_provinsi,id_kabupaten) {
		$.ajax({
			url : "<?= site_url() ?>/api/getKabupaten/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kabupaten</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kabupaten) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kabupaten').html(html);
			}
		});
	}

	function getKecamatan(id_kabupaten,id_kecamatan) {
		$.ajax({
			url : "<?= site_url() ?>/api/getKecamatan/"+id_kabupaten,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kecamatan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kecamatan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kecamatan').html(html);
			}
		});
	}

	function getKelurahan(id_kecamatan,id_kelurahan) {
		$.ajax({
			url : "<?= site_url() ?>/api/getKelurahan/"+id_kecamatan,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kelurahan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kelurahan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kelurahan').html(html);
			}
		});
	}
</script>
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

	function initMap(_LAT, _LONG, cek) {
		_LAT = parseFloat(_LAT);
		_LONG = parseFloat(_LONG);

		if(cek == 1)
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitude").val(_LAT);
			$("#longitude").val(_LONG);
		}
		else
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: <?= $lahantidur->latitude ?>, lng: <?= $lahantidur->longitude ?>},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: <?= $lahantidur->latitude ?>, lng: <?= $lahantidur->longitude ?>},
					map,
				});
				
			$("#latitude").val(<?= $lahantidur->latitude ?>);
			$("#longitude").val(<?= $lahantidur->longitude ?>);
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitude").val(event.latLng.lat());
			$("#longitude").val(event.latLng.lng());
		});
	}
</script>
