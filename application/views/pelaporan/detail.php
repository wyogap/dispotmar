<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Pelaporan Harian</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Detail Pelaporan Harian</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form id="addForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
									value="<?= $this->security->get_csrf_hash();?>">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Pelapor</label>
									<div class="col-md-9">
										<input type="text" name="who" class="form-control" value="<?= $report->nama_pegawai ?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Satker</label>
									<div class="col-md-9">
										<input type="text" name="who" class="form-control" value="<?= $report->nama_satker ?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Jenis Pelaporan</label>
									<div class="col-md-9">
										<input type="text" name="who" class="form-control" value="<?= $report->nama_jenis ?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Siapa ?</label>
									<div class="col-md-9">
										<input type="text" name="who" class="form-control" value="<?= $report->who ?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Apa ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="what" disabled><?= $report->what ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Kapan?</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="date" value="<?= date('d M Y',strtotime($report->when)) ?>" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Dimana ?</label>
									<div class="col-md-9">
										<!-- alamat, kel, kec, kab, prop -->
										<textarea class="form-control" rows="3" id="what" disabled><?= $report->where ?></textarea>
										<!-- tambahkan maps -->
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Mengapa ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="why" disabled><?= $report->why ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Bagaimana ?</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" id="how" name="how" disabled><?= $report->how ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Catatan Penting</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="6" id="notes" disabled><?= $report->catatan_penting ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Foto</label>
									<div class="col-md-9">
										<div class="demo-gallery">
											<ul id="lightgallery" class="list-unstyled row">
												<li class="col-xs-6 col-sm-4 col-md-6 col-xl-3" data-responsive="<?= site_url() ?>uploads/reports/<?= $report->gambar ?>" data-src="<?= site_url() ?>uploads/reports/<?= $report->gambar ?>" data-sub-html="<?= $report->what ?>" >
													<a href="" class="shadow">
														<img class="img-responsive" alt="Thumb-1" src="<?= site_url() ?>uploads/reports/<?= $report->gambar ?>">
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<button type="submit" class="btn btn-sm btn-danger"><a style="color:white;" href="<?= site_url()?>data_pelaporan" class="slide-item">Kembali ke List Data</a></button>
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
	$(document).ready(function () {
		$("select[name='satker']").select2();

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
			var formData = new FormData();
			formData.append('csrf_al', $('input[name="csrf_al"]').val());
			formData.append('type', $('select[name="type"]').val());
			formData.append('who', $('input[name="who"]').val());
			formData.append('satker', $('#satker').val());
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

		$('#provinsi').change(function () {
			var id = $(this).val();
			if (id) {
				$.ajax({
					url: "api/getKabupaten/" + id,
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
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		});
		$('#kabupaten').change(function () {
			var id = $(this).val();
			if (id) {
				$.ajax({
					url: "api/getKecamatan/" + id,
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
					}
				});
				return false;
			} else {
				$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			}
		});
		$('#kecamatan').change(function () {
			var id = $(this).val();
			if (id) {
				$.ajax({
					url: "api/getKelurahan/" + id,
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

		$('#pinLocation').on('click', function () {
			$('.map-view').toggle()
		});
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

	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {
				lat: -6.1755367,
				lng: 106.8273503
			},
			zoom: 6
		});
		infoWindow = new google.maps.InfoWindow;

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
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
			}, function () {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function (event) {
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
