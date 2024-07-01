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
					<div class="card-title text-center">Form Edit Satker</div>
					<div class="card-options">
						<div class="col-md-12 text-right">
							<a href="<?= site_url()?>organisasi_satker/<?= encrypt($satker->id_satker) ?>/show" class="btn btn-success btn-sm"><i class="fa fa-eye mr-2"></i> Lihat</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form class="form-horizontal" method="POST" id="editForm" enctype="multipart/form-data">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
								<input type="hidden" id="id" name="id" value="<?= encrypt($satker->id_satker)?>">
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Nama Satker</label>
									<div class="col-md-4">
										<input type="text" id="name" name="name" class="form-control" value="">
										<div class="text-danger warning-name"></div>
									</div>
									<label class="col-md-2 col-form-label">Kode Satker</label>
									<div class="col-md-4">
										<input type="text" id="kode_satker" name="kode_satker" class="form-control" value="">
										<div class="invalid-feedback warning-kode_satker"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Tipe Organisasi</label>
									<div class="col-md-4">
										<select class="form-control select w-100" name="tipeORG" id="tipeORG">
											<option value="">Pilih Tipe Organisasi</option>
											<?php foreach($levels as $level): ?>
											<option value="<?= $level->id_level ?>"><?= $level->jenis_organisasi ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-tipe"></div>
									</div>
									<label class="col-md-2 col-form-label">Parent Satker</label>
									<div class="col-md-4">
										<select class="form-control" id="parent" name="parent" style="width: 100%;">
											<option value="">Tidak memiliki parent</option>
											<optgroup label="Level 1">
												<?php foreach($satker1 as $satker): ?>
												<option value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?>
												</option>
												<?php endforeach ?>
											</optgroup>
											<optgroup label="Level 2">
												<?php foreach($satker2 as $satker): ?>
												<option value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?>
												</option>
												<?php endforeach ?>
											</optgroup>
											<optgroup label="Level 3">
												<?php foreach($satker3 as $satker): ?>
												<option value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?>
												</option>
												<?php endforeach ?>
											</optgroup>
										</select>
										<div class="text-danger warning-parent"></div>
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
													<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
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
												<input type="text" id="flag_locationedit" name="flag_locationedit" style="display:none;" class="form-control">
											</div>
											<div class="col-md-12" style="padding-top:10px">
												<textarea class="form-control" rows="2" id="address" name="address" placeholder="Alamat"></textarea>
											</div>
										</div>
										<div class="form-group">
												<div class="mt-2 mb-2">
													<button type="button" class="btn btn-outline-secondary btn-sm btn-square" onclick="getCurrentPlace()"><i
															class="fa fa-map-pin mr-2"></i> Dapatkan Lokasi</button>
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
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Nama Pimpinan</label>
									<div class="col-md-5">
										<input type="text" id="nama_pimpinan" name="nama_pimpinan" class="form-control" value="">
										<div class="text-danger warning-nama_pimpinan"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Email</label>
									<div class="col-md-5">
										<input type="text" id="email" name="email" class="form-control" value="">
										<div class="text-danger warning-email"></div>
									</div>
									<label class="col-md-1 col-form-label">Phone</label>
									<div class="col-md-4">
										<input type="number" id="No_Telp" name="No_Telp" class="form-control" value="">
										<div class="text-danger warning-No_Telp"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Keterangan</label>
									<div class="col-md-10">
										<textarea class="form-control" rows="2" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
										<div class="invalid-feedback warning-keterangan"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Gambar Sampul</label>
									<div class="col-md-4">
										<input type="file" class="dropify" id="gambarsampul" name="gambarsampul">
										<div class="invalid-feedback warning-gambarsampul"></div>
									</div>
									<div class="col-md-6">
										<div class="demo-gallery">
											<ul id="lightgallery" class="list-unstyled row">
												<li class="col-md-6" id="viewgambar_li">
													<a href="" class="shadow">
														<img class="img-responsive" id="viewgambar" alt="Thumb-1">
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="btnSubmit" type="submit" style="height:44px;" class="btn btn-primary">Simpan</button>
										<button id="btnLoading" class="btn btn-secondary" style="display: none;"
											disabled>Sedang menyimpan data</button>
										<button type="submit" class="btn btn-sm btn-danger"><a style="color:white;" href="<?= site_url()?>organisasi_satker" class="slide-item">Kembali ke List Data</a></button>
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
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=initMap&libraries=places"></script>
<script>
$(document).ready(function () {
	$("#parent").select2();
	$("#tipeORG").select2();
	$("#provinsi").select2();
	$("#kabupaten").select2();
	$("#kecamatan").select2();
	$("#kelurahan").select2();

	var id = $('#id').val()
	$.ajax({
		type: 'ajax',
		method: 'GET',
		url: '<?= site_url()?>organisasi_satker/getSatkerData/' + id,
		dataType: 'json',
		success: function (data) {
			var html = '';

			$('select[name=tipe]').find('option:selected').removeAttr('selected');
			$('select[name=parent]').find('option:selected').removeAttr('selected');
			$('select[name=provinsi]').find('option:selected').removeAttr('selected');
			$('input[name="id"]').val(id);
			$('input[name="name"]').val(data.satker.nama_satker);
			$('input[name="kode_satker"]').val(data.satker.kode_satker);
			$('input[name="latitude"]').val(data.satker.latitude);
			$('input[name="longitude"]').val(data.satker.longitude);
			$('textarea[name="address"]').val(data.satker.alamat);
			$('input[name="No_Telp"]').val(data.satker.No_Telp);
			$('input[name="nama_pimpinan"]').val(data.satker.nama_pimpinan);
			$('input[name="email"]').val(data.satker.email);
			$('textarea[name="keterangan"]').val(data.satker.keterangan);
			$('input[name="flag_locationedit"]').val(data.satker.flag_location);
			$("select[name=tipeORG] option[value=" + data.satker.id_level + "]").attr('selected', 'selected');
			$("select[name=parent] option[value=" + data.satker.id_parent_satker + "]").attr('selected',
				'selected');
			$("select[name=provinsi] option[value=" + data.satker.id_provinsi + "]").attr('selected',
				'selected');
				
			$('#viewgambar').attr('src',`<?= base_url();?>/uploads/satker/sampul/`+data.satker.gambarsampul);
			$('#viewgambar_li').attr('data-src',`<?= base_url();?>/uploads/satker/sampul/`+data.satker.gambarsampul);
			$('#viewgambar_li').attr('data-responsive',`<?= base_url();?>/uploads/satker/sampul/`+data.satker.gambarsampul);
			$('#viewgambar_li').attr('data-sub-html',data.satker.keterangan);

			$("#tipeORG").trigger('change');
			$("#parent").trigger('change');
			// $("#provinsi").trigger('change');
			// $("#kabupaten").trigger('change');
			// $("#kecamatan").trigger('change');
			// $("#kelurahan").trigger('change');

			if(data.satker.flag_location == 'prov')
				{
					getProvinsi(data.satker.id_provinsi)
					getKabupaten(data.satker.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.satker.flag_location == 'kab')
				{
					getProvinsi(data.satker.id_provinsi)
					getKabupaten(data.satker.id_provinsi,data.satker.id_kabupaten)
					getKecamatan(data.satker.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.satker.flag_location == 'kec')
				{
					getProvinsi(data.satker.id_provinsi)
					getKabupaten(data.satker.id_provinsi,data.satker.id_kabupaten)
					getKecamatan(data.satker.id_kabupaten,data.satker.id_kecamatan)
					getKelurahan(data.satker.id_kecamatan,0)
				}
				else if(data.satker.flag_location == 'kel')
				{
					getProvinsi(data.satker.id_provinsi)
					getKabupaten(data.satker.id_provinsi,data.satker.id_kabupaten)
					getKecamatan(data.satker.id_kabupaten,data.satker.id_kecamatan)
					getKelurahan(data.satker.id_kecamatan,data.satker.id_kelurahan)
				}
				else
				{
					getProvinsi(data.satker.id_provinsi);
					getKabupaten(data.satker.id_provinsi, data.satker.id_kabupaten);
					getKecamatan(data.satker.id_kabupaten, data.satker.id_kecamatan);
					getKelurahan(data.satker.id_kecamatan, data.satker.id_kelurahan);
				}

			initMaps(data.satker.latitude,data.satker.longitude)
		},
		error: function (data) {
			console.log(data);
		}
	});

	$('#editForm').submit(function () {

		var formData = new FormData();
			formData.append('csrf_al', $('input[name="csrf_al"]').val());
			formData.append('id', $('input[name="id"]').val());
			formData.append('name', $('input[name="name"]').val());
			formData.append('kode_satker', $('input[name="kode_satker"]').val());
			formData.append('tipeORG', $('#tipeORG').val());
			formData.append('parent', $('#parent').val());
			formData.append('provinsi', $('#provinsi').val());
			formData.append('kabupaten', $('#kabupaten').val());
			formData.append('kecamatan', $('#kecamatan').val());
			formData.append('kelurahan', $('#kelurahan').val());
			formData.append('address', $('#address').val());
			formData.append('latitude', $('input[name="latitude"]').val());
			formData.append('longitude', $('input[name="longitude"]').val());
			formData.append('nama_pimpinan', $('input[name="nama_pimpinan"]').val());
			formData.append('email', $('input[name="email"]').val());
			formData.append('No_Telp', $('input[name="No_Telp"]').val());
			formData.append('keterangan', $('#keterangan').val());
			formData.append('flag_locationedit', $('#flag_locationedit').val());

			// Attach file
			formData.append('gambarsampul', $('#gambarsampul')[0].files[0]);

		$.ajax({
			type: "POST",
			url: "<?= site_url()?>organisasi_satker/update",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function (key, value) {
						$('input[name="' + key + '"]').addClass('is-invalid')
						$('.warning-' + key).html(value)
					});
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

	$('#provinsi').change(function () {
		var id = $(this).val();
		$('#flag_locationedit').val("prov");

		if (id) {
			$.ajax({
				url: "<?= site_url() ?>api/getKabupaten/" + id,
				method: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					var html = '';
					var i;
					html += '<option value="">Pilih Kabupaten</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_geografi + '>' + data[i]
							.nama + '</option>';
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

	$('#kabupaten').change(function () {
		var id = $(this).val();
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
				url: "<?= site_url() ?>api/getKecamatan/" + id,
				method: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					var html = '';
					var i;
					html += '<option value="">Pilih Kecamatan</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_geografi + '>' + data[i]
							.nama + '</option>';
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

	$('#kecamatan').change(function () {
		var id = $(this).val();
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
				url: "<?= site_url() ?>api/getKelurahan/" + id,
				method: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					var html = '';
					var i;
					html += '<option value="">Pilih Kelurahan</option>';
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id_geografi + '>' + data[i]
							.nama + '</option>';
					}
					$('#kelurahan').html(html);
				}
			});
			return false;
		} else {
			$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
		}
	});

	$('#kelurahan').change(function () {
		var id = $(this).val();
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
				//console.log(data);
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

function getKabupaten(id_provinsi, id_kabupaten) {
	$.ajax({
		url: "<?= site_url() ?>api/getKabupaten/" + id_provinsi,
		method: "GET",
		async: true,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			html += '<option value="">Pilih Kabupaten</option>';
			for (i = 0; i < data.length; i++) {
				if (data[i].id_geografi == id_kabupaten) {
					html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
						'</option>';
				} else {
					html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
				}
			}
			$('#kabupaten').html(html);
		}
	});
}

function getKecamatan(id_kabupaten, id_kecamatan) {
	$.ajax({
		url: "<?= site_url() ?>api/getKecamatan/" + id_kabupaten,
		method: "GET",
		async: true,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			html += '<option value="">Pilih Kecamatan</option>';
			for (i = 0; i < data.length; i++) {
				if (data[i].id_geografi == id_kecamatan) {
					html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
						'</option>';
				} else {
					html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
				}
			}
			$('#kecamatan').html(html);
		}
	});
}

function getKelurahan(id_kecamatan, id_kelurahan) {
	$.ajax({
		url: "<?= site_url() ?>api/getKelurahan/" + id_kecamatan,
		method: "GET",
		async: true,
		dataType: 'json',
		success: function (data) {
			var html = '';
			var i;
			html += '<option value="">Pilih Kelurahan</option>';
			for (i = 0; i < data.length; i++) {
				if (data[i].id_geografi == id_kelurahan) {
					html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
						'</option>';
				} else {
					html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
				}
			}
			$('#kelurahan').html(html);
		}
	});
}
</script>
<script>
	var map, infoWindow, marker, service, infoWindow;

	function getCurrentPlace(){
		var provisi, kabupaten, kecamatan, kelurahan, loc;
		provisi = $('#provinsi').children("option:selected").text();
		kabupaten = $('#kabupaten').children("option:selected").text();
		kecamatan = $('#kecamatan').children("option:selected").text();
		kelurahan = $('#kelurahan').children("option:selected").text();

		if (kelurahan != 'Pilih Kelurahan') {
			loc = kelurahan
		}else if (kecamatan != 'Pilih Kecamatan') {
			loc = kecamatan
		}else if (kabupaten != 'Pilih Kabupaten') {
			loc = kabupaten
		}else if (provisi != 'Pilih Provinsi') {
			loc = provisi
		}

		getLocation(loc)
	}

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

	function getLocation(loc){
		const request = {
			query: loc,
			fields: ["name", "geometry"],
		};
		service = new google.maps.places.PlacesService(map);
		service.findPlaceFromQuery(request, (results, status) => {
			if (status === google.maps.places.PlacesServiceStatus.OK) {
				for (let i = 0; i < results.length; i++) {
					createMarker(results[i]);
				}

				map.setCenter(results[0].geometry.location);
			}
		});
	}

	function createMarker(place) {
		if(marker){
			marker.setPosition(place.geometry.location);
	    } else {
			marker = new google.maps.Marker({
				map,
				position: place.geometry.location,
			});
		}
		$("#latitude").val(place.geometry.location.lat());
		$("#longitude").val(place.geometry.location.lng());
	}

	function initMaps(lat,long) {
		const startLocation = new google.maps.LatLng(lat,long);
		infowindow = new google.maps.InfoWindow();
		map = new google.maps.Map(document.getElementById("map"), {
			center: startLocation,
			zoom: 15,
		});

		placeMarker(map, startLocation);

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

	// function initMap() {
	// 	map = new google.maps.Map(document.getElementById('map'), {
	// 		center: {lat: -6.1755367, lng: 106.8273503},
	// 		zoom: 6
	// 	});
	// 	infoWindow = new google.maps.InfoWindow;

	// 	// Try HTML5 geolocation.
	// 	if (navigator.geolocation) {
	// 		navigator.geolocation.getCurrentPosition(function(position) {
	// 			var pos = {
	// 				lat: position.coords.latitude,
	// 				lng: position.coords.longitude
	// 			};

	// 			marker = new google.maps.Marker({
	// 				position: pos,
	// 				map,
	// 			});
				
	// 			$("#latitude").val(position.coords.latitude);
	// 			$("#longitude").val(position.coords.longitude);
				
	// 			map.setCenter(pos);
	// 		}, function() {
	// 			handleLocationError(true, infoWindow, map.getCenter());
	// 		});
	// 	} else {
	// 		// Browser doesn't support Geolocation
	// 		handleLocationError(false, infoWindow, map.getCenter());
	// 	}

	// 	// even listner ketika peta diklik
	// 	google.maps.event.addListener(map, 'click', function(event) {
	// 		placeMarker(this, event.latLng);
	// 		$("#latitude").val(event.latLng.lat());
	// 		$("#longitude").val(event.latLng.lng());
	// 	});
	// }
</script>
