<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Sarana Prasarana</li>
			<li class="breadcrumb-item active" aria-current="page">Pelabuhan Laut</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Tambah Data Pelabuhan Laut</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form id="addForm" class="form-horizontal" method="POST">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
									value="<?= $this->security->get_csrf_hash();?>">

								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Satker</label>
											<div class="col-md-4">
												<?php if(($this->session->userdata('role') == 'Satker')): ?>
													<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
													<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
												<?php else: ?>
													<select class="form-control" id="satker" name="satker">
												<?php endif ?>
													<option value="">Pilih Satuan Kerja</option>
													<?php foreach($satkers as $satker): ?>
													<option value="<?= $satker->id_satker ?>" <?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>><?= $satker->nama_satker ?></option>
													<?php endforeach ?>
												</select>
												<div class="text-danger warning-provinsi"></div>
											</div>
											<label class="col-md-2 col-form-label">Nama Pelabuhan</label>
											<div class="col-md-4">
												<input type="text" name="nama_pelabuhan" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Wilayah</label>
											<div class="col-md-3">
												<select class="form-control" id="provinsi" name="provinsi">
													<option value="">Pilih Provinsi</option>
													<?php foreach($provinsi as $prov): ?>
													<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?>
													</option>
													<?php endforeach ?>
												</select>
												<div class="text-danger warning-provinsi"></div>
											</div>
											<div class="col-md-2">
												<select class="form-control" id="kabupaten" name="kabupaten">
													<option value="">Pilih Kabupaten</option>
												</select>
											</div>
											<div class="col-md-2">
												<select class="form-control" id="kecamatan" name="kecamatan">
													<option value="">Pilih Kecamatan</option>
												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="kelurahan" name="kelurahan">
													<option value="">Pilih Kelurahan</option>
												</select>
												<input type="text" id="flag_location" name="flag_location" style="display:none;" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Alamat</label>
											<div class="col-md-4">
												<input type="text" name="alamat" class="form-control">
											</div>
											<label class="col-md-2 col-form-label">Telepon</label>
											<div class="col-md-4">
												<input type="number" name="telepon" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<!-- <label class="col-md-2 col-form-label">Kelas Pelabuhan</label>
											<div class="col-md-4">
												<input type="text" name="kelas_pelabuhan" class="form-control">
											</div> -->
											<label class="col-md-2 col-form-label">Informasi Umum</label>
											<div class="col-md-4">
												<input type="text" name="informasi_umum" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Hidrografi</label>
											<div class="col-md-4">
												<input type="text" name="hidrografi" class="form-control">
											</div>
											<label class="col-md-2 col-form-label">Topografi</label>
											<div class="col-md-4">
												<input type="text" name="topografi" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Pasang Surut</label>
											<div class="col-md-4">
												<input type="text" name="pasang_surut" class="form-control">
											</div>
											<label class="col-md-2 col-form-label">Arus (Knot)</label>
											<div class="col-md-4">
												<input type="text" name="arus" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Iklim</label>
											<div class="col-md-2">
												<input type="text" name="iklim_cuaca" class="form-control" placeholder="Cuaca">
											</div>
											<div class="col-md-2">
												<input type="text" name="iklim_penglihatan" class="form-control" placeholder="Penglihatan">
											</div>
											<div class="col-md-2">
												<input type="text" name="iklim_angin" class="form-control" placeholder="Angin (Knot)">
											</div>
											<div class="col-md-2">
												<input type="text" name="iklim_gelombang" class="form-control" placeholder="Gelombang">
											</div>
											<div class="col-md-2">
												<input type="text" name="iklim_kondisi_klimatologi" class="form-control" placeholder="Kondisi Klimatologi">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Kelas Pelabuhan</label>
											<div class="col-md-4">
												<input type="text" name="kelas_pelabuhan" class="form-control">
											</div>
											<label class="col-md-2 col-form-label">Tanda Pengenal Masuk Pelabuhan</label>
											<div class="col-md-4">
												<input type="text" name="tanda_pengenal" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Alur Masuk Pelabuhan</label>
											<div class="col-md-3">
												<input type="text" name="alur_masuk_panjang" class="form-control" placeholder="Panjang (M)">
											</div>
											<div class="col-md-3">
												<input type="text" name="alur_masuk_luas" class="form-control" placeholder="Lebar (M)">
											</div>
											<div class="col-md-3">
												<input type="text" name="alur_masuk_kedalaman" class="form-control" placeholder="Kedalaman">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Kolam Pelabuhan</label>
											<div class="col-md-3">
												<input type="text" name="kolam_luas" class="form-control" placeholder="Luas">
											</div>
											<div class="col-md-3">
												<input type="text" name="kolam_dalam_min" class="form-control" placeholder="Dalam Minim">
											</div>
											<div class="col-md-3">
												<input type="text" name="kolam_dalam_max" class="form-control" placeholder="Dalam Maks">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Ukuran Maksimum Kapal</label>
											<div class="col-md-3">
												<input type="text" name="ukuran_kapal_panjang" class="form-control" placeholder="Panjang (M)">
											</div>
											<div class="col-md-3">
												<input type="text" name="ukuran_kapal_draft" class="form-control" placeholder="Draft (M)">
											</div>
											<div class="col-md-3">
												<input type="text" name="ukuran_kapal_berat" class="form-control" placeholder="Berat Total">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Berlabuh jangkar</label>
											<div class="col-md-2">
												<input type="text" name="berlabuh_lokasi" class="form-control" placeholder="Lokasi">
											</div>
											<div class="col-md-2">
												<input type="text" name="berlabuh_lokasi_dilarang" class="form-control" placeholder="Lokasi Dilarang">
											</div>
											<div class="col-md-2">
												<input type="text" name="berlabuh_kedalaman_laut" class="form-control" placeholder="Kedalaman Laut">
											</div>
											<div class="col-md-2">
												<input type="text" name="berlabuh_jenis_dasar_laut" class="form-control" placeholder="Jenis Dasar Laut">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Stasiun Radio Pantai</label>
											<div class="col-md-2">
												<input type="text" name="radio_jenis" class="form-control" placeholder="Jenis">
											</div>
											<div class="col-md-2">
												<input type="text" name="radio_nama_panggilan" class="form-control" placeholder="Nama Panggilan">
											</div>
											<div class="col-md-2">
												<input type="text" name="radio_frekuensi" class="form-control" placeholder="Frekuensi">
											</div>
											<div class="col-md-2">
												<input type="text" name="radio_kelas_pancaran" class="form-control" placeholder="Kelas Pancaran">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Karantina</label>
											<div class="col-md-4">
												<input type="text" name="karantina_daerah" class="form-control" placeholder="Daerah">
											</div>
											<div class="col-md-4">
												<input type="text" name="karantina_koordinat" class="form-control" placeholder="Koordinat">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Kepanduan</label>
											<div class="col-md-2">
												<input type="text" name="kepanduan_apakah_wajib" class="form-control" placeholder="Wajib">
											</div>
											<div class="col-md-2">
												<input type="text" name="kepanduan_batas_tonase" class="form-control" placeholder="Batas Tonase Wajib Pandu">
											</div>
											<div class="col-md-2">
												<input type="text" name="kepanduan_kapal_tunda" class="form-control" placeholder="Kapal Tunda">
											</div>
											<div class="col-md-2">
												<input type="text" name="kepanduan_posisi_antarjemput" class="form-control" placeholder="Posisi Jemput/antar">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Tempat Sandar</label>
											<div class="col-md-2">
												<input type="text" name="sandar_nama" class="form-control" placeholder="Nama">
											</div>
											<div class="col-md-2">
												<input type="text" name="sandar_panjang" class="form-control" placeholder="Panjang (M)">
											</div>
											<div class="col-md-2">
												<input type="text" name="sandar_lebar" class="form-control" placeholder="Lebar (M)">
											</div>
											<div class="col-md-2">
												<input type="text" name="sandar_kedalaman" class="form-control" placeholder="Kedalaman">
											</div>
											<div class="col-md-2">
												<input type="text" name="sandar_konstruksi" class="form-control" placeholder="Konstruksi">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row" style="background-color:#f7f7f7; padding-top:3px; padding-bottom:3px;">
											<label class="col-md-2 col-form-label">Gudang dan Lapangan Penumpukan</label>
											<div class="col-md-2">
												<input type="text" name="gudang_nama" class="form-control" placeholder="Nama">
											</div>
											<div class="col-md-2">
												<input type="text" name="gudang_luas" class="form-control" placeholder="Luas">
											</div>
											<div class="col-md-2">
												<input type="text" name="gudang_kapasitas" class="form-control" placeholder="Kapasitas">
											</div>
											<div class="col-md-2">
												<input type="text" name="gudang_jumlah" class="form-control" placeholder="Jumlah (Buah)">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="row">
											<label class="col-md-2 col-form-label">Terminal Penumpang</label>
											<div class="col-md-2">
												<input type="text" name="terminal_jumlah" class="form-control" placeholder="Jumlah (Buah)">
											</div>
											<div class="col-md-2">
												<input type="text" name="terminal_ukuran" class="form-control" placeholder="ukuran">
											</div>
											<div class="col-md-2">
												<input type="text" name="terminal_kapasitas" class="form-control" placeholder="Kapasitas">
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
<script>
	$(document).ready(function () {
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
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>geografi_pelabuhanLaut/store",
				dataType: "json",
				data: $(this).serialize(),
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
	});
</script>
