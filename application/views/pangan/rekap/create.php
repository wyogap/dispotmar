<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Ketahanan Pangan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Form Rekap Pangan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Rekap Pangan</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form class="form-horizontal" method="POST" id="addForm"  enctype="multipart/form-data">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Satker </label>
									<div class="col-md-10">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" id="hiddensatker" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
										<?php else: ?>
											<select class="form-control" id="satker" name="satker" style="width:100%;">
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option value="<?= $satker->id_satker ?>" <?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Kluster</label>
									<div class="col-md-4">
										<select class="form-control" id="cluster" name="cluster"  style="width:100%;">
											<option value="">Pilih Kluster</option>
											<?php foreach($clusters as $cluster): ?>
											<option value="<?= $cluster->id_cluster ?>"><?= $cluster->nama_cluster ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-cluster"></div>
									</div>
									<label class="col-md-2 col-form-label">Komoditas</label>
									<div class="col-md-4">
										<select class="form-control" id="comodities" name="comodity"  style="width:100%;">
											<option value="">Pilih Komoditas</option>
										</select>
										<div class="text-danger warning-comodity"></div>
										<small class="text-muted">* Kluster harus dipilih terlebih dahulu</small>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Lokasi</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-3">
												<select class="form-control" id="provinsi" name="provinsi" style="width:100%;">
													<option value="">Pilih Provinsi</option>
													<?php foreach($provinsi as $prov): ?>
													<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
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
									</div>
								</div>
								<div class="form-group">
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

								<div class="form-group row">
									<label class="col-md-2 col-form-label">Luas Lahan (HA)</label>
									<div class="col-md-4">
										<input type="text" name="area" onkeypress="return isNumberKey(event)" class="form-control">
										<div class="invalid-feedback warning-area"></div>
									</div>
									<label class="col-md-2 col-form-label">Estimasi Hasil</label>
									<div class="col-md-2">
										<input type="text" name="result" onkeypress="return isNumberKey(event)" class="form-control">
										<div class="invalid-feedback warning-result"></div>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="unit" id="unit" style="width:100%;" disabled>
											<option value="">Pilih Satuan</option>
											<?php foreach($units as $unit): ?>
											<option value="<?= $unit->id_satuan ?>"><?= $unit->nama_satuan ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-unit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label"></label>
									<div class="col-md-4">
										<input type="text" style="display:none;" class="form-control">
									</div>
									<label class="col-md-2 col-form-label">Jumlah Bibit/Bakalan</label>
									<div class="col-md-2">
										<input type="text" name="jmlbibit" onkeypress="return isNumberKey(event)" class="form-control">
										<div class="invalid-feedback warning-jmlbibit"></div>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="unit2" id="unit2" style="width:100%;">
											<option value="">Pilih Satuan</option>
											<?php foreach($units as $unit): ?>
											<option value="<?= $unit->id_satuan ?>"><?= $unit->nama_satuan ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-unit2"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">TMT Pelaksanaan</label>
									<div class="col-md-4">
										<input class="form-control" type="date" name="tmt">
										<div class="invalid-feedback warning-tmt"></div>
									</div>
									<label class="col-md-2 col-form-label">Estimasi Panen</label>
									<div class="col-md-4">
										<input class="form-control" type="date" name="estimate">
										<div class="invalid-feedback warning-estimate"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Status Lahan</label>
									<div class="col-md-4">
										<select class="form-control" name="areaStatus" id="areaStatus" style="width:100%;">
											<option value="">Pilih Status Lahan</option>
											<?php foreach($areaStatus as $area): ?>
											<option value="<?= $area->id_statuslahan ?>"><?= $area->nama_statuslahan ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-areaStatus"></div>
									</div>
									<label class="col-md-2 col-form-label">Progres</label>
									<div class="col-md-4">
										<select class="form-control" name="progress" id="progress" style="width:100%;">
											<option value="">Pilih Progres</option>
											<?php foreach($progress as $prog): ?>
											<option value="<?= $prog->id_progres ?>"><?= $prog->nama_progres ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-progress"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Keterangan</label>
									<div class="col-md-10">
										<textarea class="form-control" rows="2" name="notes" id="notes"></textarea>
										<div class="text-danger warning-notes"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Foto</label>
									<div class="col-md-4">
										<input type="file" class="dropify" id="gambar" name="gambar">
										<div class="invalid-feedback warning-gambar"></div>
									</div>
								</div>
								<hr>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
										<button id="btnLoading" class="btn btn-secondary" style="display: none;" disabled>Sedang menyimpan data</button>
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
	$('#satker').select2();
	$('#comodities').select2();
	$('#cluster').select2();
	$('#provinsi').select2();
	$('#kabupaten').select2();
	$('#kecamatan').select2();
	$('#kelurahan').select2();
	$('#unit').select2();
	$('#unit2').select2();
	$('#areaStatus').select2();
	$('#progress').select2();

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

	$('#cluster').change(function(){ 
		var id= $(this).val();
		if (id) {
			$.ajax({
				url : "api/getKomoditas/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					html += '<option value="">Pilih Komoditas</option>';
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].id_komoditas+'>'+data[i].nama_komoditas+'</option>';
					}
					$('#comodities').html(html);
				}
			});
			return false;
		} else {
			$('#comodities').html('<option value="">Pilih Kelurahan</option>');
		}
	});

	$('#comodities').change(function(){ 
		
		var id= $(this).val();

		//Dropdown Cluster
		//id 1 = Pertanian
		//id 2 = perikanan
		//id 3 = Peternakan
		//id 4 = Perkebunan

		//Dropdown Unit
		//id 1 = Ekor
		//id 3 = Ton
		
		// if (id == 2 || id == 3) 
		// {
		// 	$('#unit').val(1)
		// } 
		// else if(id == 1 || id == 4)
		// {
		// 	$('#unit').val(3)
		// } 

		if (id) {
			$.ajax({
				url : "api/getSatuanKomoditas/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#unit').val(data[0].id_satuan);
					$("#unit").trigger('change');
				}
			});
			return false;
		} 
		else 
		{
			alert("Data Satuan Komoditas Tersebut Tidak di Temukan")	
		}

		$("#unit").trigger('change');
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

	$('input').on('keyup change', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
	});

	$('select').on('change', function(){
		var name = $(this).attr('name')
		$('select[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
	});
	
	$('#addForm').submit(function(){
		$('#btnSubmit').hide()
		$('#btnLoading').show()

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
			formData.append('satker', valueSatker);
			formData.append('cluster', $('input[name="cluster"]').val());
			formData.append('comodity', $('#comodities').val());
			formData.append('provinsi', $('#provinsi').val());
			formData.append('kabupaten', $('#kabupaten').val());
			formData.append('kecamatan', $('#kecamatan').val());
			formData.append('kelurahan', $('#kelurahan').val());
			formData.append('latitude', $('input[name="latitude"]').val());
			formData.append('longitude', $('input[name="longitude"]').val());
			formData.append('area', $('input[name="area"]').val());
			formData.append('result', $('input[name="result"]').val());
			formData.append('unit', $('#unit').val());
			formData.append('jmlbibit', $('input[name="jmlbibit"]').val());
			formData.append('unit2', $('#unit2').val());
			formData.append('tmt', $('input[name="tmt"]').val());
			formData.append('estimate', $('input[name="estimate"]').val());
			formData.append('areaStatus', $('#areaStatus').val());
			formData.append('progress', $('#progress').val());
			formData.append('notes', $('#notes').val());
			formData.append('flag_location', $('#flag_location').val());
			// Attach file
			formData.append('gambar', $('#gambar')[0].files[0]); 
		$.ajax({
			type : "POST",
			url  : "pangan_rekap_add/store",
			dataType : "json",
			data: formData,
				processData: false,
				contentType: false,
			success: function(data){
				$('#btnSubmit').show()
				$('#btnLoading').hide()
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function(key, value) {
						$('input[name="'+key+'"]').addClass('is-invalid')
						$('select[name="'+key+'"]').addClass('is-invalid')
						$('.warning-'+key).html(value)
					});
				} else {
					window.location.reload();
				}
			},
			error: function(data) {
				console.log(data)
			}
		});
		return false;
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
	
});
</script>
<script>
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
</script>
