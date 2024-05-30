<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Ketahanan Pangan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Edit Ketahanan Pangan</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
						<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
							<input type="hidden" name="id" value="<?= encrypt($pangan->id_rekap_pangan) ?>">
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
											<option value="<?= $satker->id_satker ?>"
											<?php if ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')): ?>
												selected
											<?php elseif($satker->id_satker == $pangan->id_satker): ?>
												selected
											<?php endif ?>><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Kluster</label>
									<div class="col-md-4">
										<select class="form-control" id="cluster" name="cluster" style="width:100%;">
											<option value="">Pilih Kluster</option>
											<?php foreach($clusters as $cluster): ?>
											<option value="<?= $cluster->id_cluster ?>" <?= ($pangan->id_cluster == $cluster->id_cluster) ? 'selected' : '' ?>><?= $cluster->nama_cluster ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-cluster"></div>
									</div>
									<label class="col-md-2 col-form-label">Komoditas</label>
									<div class="col-md-4">
										<select class="form-control" id="comodities" name="comodity" style="width:100%;">
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
													<option value="<?= $prov->id_geografi ?>" <?= ($pangan->id_provinsi == $prov->id_geografi) ? 'selected' : '' ?>><?= $prov->nama ?></option>
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
												<input type="text" id="flag_locationedit" name="flag_locationedit" value="<?= $pangan->flag_location ?>" style="display:none;" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="map-view">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Latitude</label>
											<input type="text" id="latitude" name="latitude" class="form-control" value="<?= $pangan->latitude ?>" readonly>
										</div>
										<div class="form-group col-md-6">
											<label>Longitude</label>
											<input type="text" id="longitude" name="longitude" class="form-control" value="<?= $pangan->longitude ?>" readonly>
										</div>
									</div>
										<div id="map" style="width:100%;height:380px;"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Luas Lahan (HA)</label>
									<div class="col-md-4">
										<input type="text" name="area" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $pangan->luas_lahan ?>">
										<div class="invalid-feedback warning-area"></div>
									</div>
									<label class="col-md-2 col-form-label">Estimasi Hasil</label>
									<div class="col-md-2">
										<input type="text" name="result" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $pangan->estimasi_hasil ?>">
										<div class="invalid-feedback warning-result"></div>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="unit" id="unit" style="width:100%;" disabled>
											<option value="">Pilih Satuan</option>
											<?php foreach($units as $unit): ?>
											<option value="<?= $unit->id_satuan ?>" <?= ($pangan->id_satuan == $unit->id_satuan) ? 'selected' : '' ?>><?= $unit->nama_satuan ?></option>
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
										<input type="text" name="jmlbibit" onkeypress="return isNumberKey(event)" class="form-control" value="<?= $pangan->jmlbibit ?>">
										<div class="invalid-feedback warning-result"></div>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="unit2" id="unit2" style="width:100%;">
											<option value="">Pilih Satuan</option>
											<?php foreach($units as $unit): ?>
											<option value="<?= $unit->id_satuan ?>" <?= ($pangan->id_satuan2 == $unit->id_satuan) ? 'selected' : '' ?>><?= $unit->nama_satuan ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-unit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">TMT Pelaksanaan</label>
									<div class="col-md-4">
										<input class="form-control" type="date" name="tmt" value="<?= date("Y-m-d", strtotime($pangan->tmt)); ?>">
										<div class="invalid-feedback warning-tmt"></div>
									</div>
									<label class="col-md-2 col-form-label">Estimasi Panen</label>
									<div class="col-md-4">
										<input class="form-control" type="date" name="estimate" value="<?= date("Y-m-d", strtotime($pangan->estimasi_panen)) ?>">
										<div class="invalid-feedback warning-estimate"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Status Lahan</label>
									<div class="col-md-4">
										<select class="form-control" name="areaStatus" id="areaStatus" style="width:100%;">
											<option value="">Pilih Status Lahan</option>
											<?php foreach($areaStatus as $area): ?>
											<option value="<?= $area->id_statuslahan ?>" <?= ($pangan->id_pangan_status == $area->id_statuslahan) ? 'selected' : '' ?>><?= $area->nama_statuslahan ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-areaStatus"></div>
									</div>
									<label class="col-md-2 col-form-label">Progres</label>
									<div class="col-md-4">
										<select class="form-control" name="progress" id="progress" style="width:100%;">
											<option value="">Pilih Progres</option>
											<?php foreach($progress as $prog): ?>
											<option value="<?= $prog->id_progres ?>" <?= ($pangan->id_progres == $prog->id_progres) ? 'selected' : '' ?>><?= $prog->nama_progres ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-progress"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Keterangan</label>
									<div class="col-md-10">
										<textarea class="form-control" rows="2" name="notes" id="notes"><?= $pangan->keterangan ?></textarea>
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
								<div class="form-group row">
									<label class="col-md-2 col-form-label"></label>
									<div class="col-md-10">
										<div class="demo-gallery">
											<ul id="lightgallery" class="list-unstyled row">
												<li class="col-xs-6 col-sm-4 col-md-6 col-xl-3" data-responsive="<?= site_url() ?>uploads/rekappangan/<?= $pangan->gambar ?>" data-src="<?= site_url() ?>uploads/rekappangan/<?= $pangan->gambar ?>" data-sub-html="<?= $pangan->keterangan ?>" >
													<a href="" class="shadow">
														<img class="img-responsive" alt="Thumb-1" src="<?= site_url() ?>uploads/rekappangan/<?= $pangan->gambar ?>">
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button id="btnSubmit" type="submit" style="height:44px;" class="btn btn-primary">Simpan</button>
										<button id="btnLoading" class="btn btn-secondary" style="display: none;" disabled>Sedang menyimpan data</button>
										<button type="submit" class="btn btn-sm btn-danger"><a style="color:white;" href="<?= site_url()?>pangan_rekap" class="slide-item">Kembali ke List Data</a></button>
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
$(document).ready(function () {
	$('#satker').select2();
	$("#cluster").select2();
	$("#comodities").select2();
	$("#provinsi").select2();
	$("#kabupaten").select2();
	$("#kecamatan").select2();
	$("#kelurahan").select2();
	$("#areaStatus").select2();
	$("#unit").select2();
	$("#unit2").select2();
	$("#progress").select2();

	getComodity(<?= $pangan->id_cluster ?>,<?= $pangan->id_komoditas ?>);
	// getProvinsi(<?= $pangan->id_provinsi ?>);
	// getKabupaten(<?= $pangan->id_provinsi ?>,<?= $pangan->id_kabupaten ?>);
	// getKecamatan(<?= $pangan->id_kabupaten ?>,<?= $pangan->id_kecamatan ?>);
	// getKelurahan(<?= $pangan->id_kecamatan ?>,<?= $pangan->id_kelurahan ?>);

	if($("#flag_locationedit").val() == 'prov')
	{
		getProvinsi(<?= $pangan->id_provinsi ?>);
		getKabupaten(<?= $pangan->id_provinsi ?>,0)
		getKecamatan(0,0)
		getKelurahan(0,0)
	}
	else if($("#flag_locationedit").val() == 'kab')
	{
		getProvinsi(<?= $pangan->id_provinsi ?>)
		getKabupaten(<?= $pangan->id_provinsi ?>,<?= $pangan->id_kabupaten ?>)
		getKecamatan(<?= $pangan->id_kabupaten ?>,0)
		getKelurahan(0,0)
	}
	else if($("#flag_locationedit").val() == 'kec')
	{
		getProvinsi(<?= $pangan->id_provinsi ?>)
		getKabupaten(<?= $pangan->id_provinsi ?>,<?= $pangan->id_kabupaten ?>)
		getKecamatan(<?= $pangan->id_kabupaten ?>,<?= $pangan->id_kecamatan ?>)
		getKelurahan(<?= $pangan->id_kecamatan ?>,0)
	}
	else if($("#flag_locationedit").val() == 'kel')
	{
		getProvinsi(<?= $pangan->id_provinsi ?>)
		getKabupaten(<?= $pangan->id_provinsi ?>,<?= $pangan->id_kabupaten ?>)
		getKecamatan(<?= $pangan->id_kabupaten ?>,<?= $pangan->id_kecamatan ?>)
		getKelurahan(<?= $pangan->id_kecamatan ?>,<?= $pangan->id_kelurahan ?>)
	}
	else
	{
		getProvinsi(<?= $pangan->id_provinsi ?>);
		getKabupaten(<?= $pangan->id_provinsi ?>,<?= $pangan->id_kabupaten ?>);
		getKecamatan(<?= $pangan->id_kabupaten ?>,<?= $pangan->id_kecamatan ?>);
		getKelurahan(<?= $pangan->id_kecamatan ?>,<?= $pangan->id_kelurahan ?>);
	}

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
			$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
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
			$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
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

	$('#cluster').change(function(){ 
		var id= $(this).val();
		if (id) {

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
			// $("#unit").trigger('change');

			$.ajax({
				url : "<?= site_url() ?>/api/getKomoditas/"+id,
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
			$('#comodities').html('<option value="">Pilih Komoditas</option>');
		}
	});

	$('#comodities').change(function(){ 
		
		var id= $(this).val();

		if (id) {
			$.ajax({
				url : "<?= site_url() ?>/api/getSatuanKomoditas/"+id,
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
	
	$('#editForm').submit(function(){
		$('#btnSubmit').hide()
		$('#btnLoading').show()
		
		var valueSatker = '';

		if($('#hiddensatker').val() == undefined)
		{
			valueSatker =$('select[name="satker"]').val();
		}else if($('#hiddensatker').val() != undefined){
			valueSatker =  $('#hiddensatker').val();
		}

		var formData = new FormData();
			formData.append('csrf_al', $('input[name="csrf_al"]').val());
			formData.append('id', $('input[name="id"]').val());
			formData.append('satker', valueSatker);
			formData.append('cluster', $('#cluster').val());
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
			formData.append('flag_locationedit', $('#flag_locationedit').val());
			// Attach file
			formData.append('gambar', $('#gambar')[0].files[0]); 
		$.ajax({
			type : "POST",
			url  : "<?= site_url() ?>/pangan_rekap_editz/update",
			dataType : "json",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data){
				//console.log(data)
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
});

function getComodity(id_cluster,id_komoditas) {
	$.ajax({
		url : "<?= site_url() ?>/api/getKomoditas/"+id_cluster,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			//console.log(data)
			var html = '';
			var i;
			html += '<option value="">Pilih Komoditas</option>';
			for(i=0; i<data.length; i++){
				if (data[i].id_komoditas == id_komoditas) {
					html += '<option value='+data[i].id_komoditas+' selected>'+data[i].nama_komoditas+'</option>';
				} else {
					html += '<option value='+data[i].id_komoditas+'>'+data[i].nama_komoditas+'</option>';
				}
			}
			$('#comodities').html(html);
		}
	});
}

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
				center: {lat: <?= $pangan->latitude ?>, lng: <?= $pangan->longitude ?>},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: <?= $pangan->latitude ?>, lng: <?= $pangan->longitude ?>},
					map,
				});
				
			$("#latitude").val(<?= $pangan->latitude ?>);
			$("#longitude").val(<?= $pangan->longitude ?>);
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitude").val(event.latLng.lat());
			$("#longitude").val(event.latLng.lng());
		});
	}
</script>
