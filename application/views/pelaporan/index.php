<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Pelaporan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Pelaporan</li>
		</ol>
	</div>
	<!-- Page-header closed -->
	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Filter</h3>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="data_pelaporan">
						<!-- <div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control select2-show-search border-bottom-0 br-md-0"
										data-placeholder="Select">
										<optgroup label="Kotama">
											<option>-- Pilih Kotama --</option>
											<option value="1">Koarmada I</option>
											<option value="1">Koarmada II</option>
											<option value="1">Koarmada III</option>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control select2-show-search border-bottom-0 br-md-0"
										data-placeholder="Select">
										<optgroup label="Lantamal">
											<option>-- Pilih Lantamal --</option>
											<option value="1">Lantamal I Belawan</option>
											<option value="1">Lantamal II Padang</option>
											<option value="1">Lantamal III Jakarta</option>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control select2-show-search border-bottom-0 br-md-0"
										data-placeholder="Select">
										<optgroup label="Satker">
											<option>-- Pilih Satker --</option>
											<option value="1">Lanal Nias</option>
											<option value="1">Lanal Bengkulu</option>
											<option value="1">Lanal Sibolga</option>
										</optgroup>
									</select>
								</div>
							</div>
						</div> -->
						<div class="row">
							<!-- <div class="col-md-4">
								<div class="form-group">
									<select class="form-control select2-show-search border-bottom-0 br-md-0"
										data-placeholder="Select">
										<optgroup label="Kotama">
											<option>-- Pilih Jenis --</option>
											<option>Bakti Sosial</option>
											<option>Kegiatan Keagamaan</option>
											<option>Penanganan Bencana</option>
										</optgroup>
									</select>
								</div>
							</div> -->
							<div class="col-xl-4">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Satker </label>
									<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" id="hiddensatker" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
										<?php else: ?>
											<select class="form-control" id="satker" name="satker" style="width:100%;">
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option 
												<?= $this->input->get('satker') == $satker->id_satker ? 'selected' : '' ?> 
												value="<?= $satker->id_satker ?>" 
												<?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>
											>
											<?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xl-4">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Dari</label>
									<div class="col-md-9">
										<input class="form-control" type="date" name="startDate"
											value="<?= $this->input->get('startDate') ?>">
									</div>
								</div>
							</div>
							<div class="col-xl-4">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Sampai</label>
									<div class="col-md-9">
										<input class="form-control" type="date" name="finishDate"
											value="<?= $this->input->get('finishDate') ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="text-center">
									<button class="btn btn-primary btn-block mt-5" type="submit">Filter</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->


	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">
						Data Pelaporan &emsp;
						<?= $this->input->get() ? '<a href="data_pelaporan" style="color:white;" class="btn btn-sm btn-warning">Hapus Filter</a>' : '' ?>
					</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<tr>
									<th class="text-center">Opsi</th>
									<th style="width: 5%;" class="text-center">No</th>
									<th class="text-center">Satker</th>
									<th class="text-center">Jenis</th>
									<th class="text-center">Siapa</th>
									<th class="text-center">Apa</th>
									<th class="text-center">Kapan</th>
									<th class="text-center">Dimana</th>
									<th class="text-center">Mengapa</th>
									<th class="text-center">Bagaimana</th>
									<th class="text-center">Created Date</th>
									<th class="text-center">Updated By</th>
									<th class="text-center">Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($reports as $report): ?>
								<tr>
									<td class="text-center">
									<?php if(policy('LAPHAR','update')): ?>
										<a class="btn btn-sm btn-default" href="<?= site_url()?>data_pelaporan/<?= encrypt($report->id_activity_sosial); ?>/show">
											<i class="fa fa-eye"></i>	
										</a>
										<button onclick="editModal(`<?= encrypt($report->id_activity_sosial); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										
									<?php endif ?>
									<?php if(policy('LAPHAR','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($report->id_activity_sosial); ?>`,'<?= $report->nama_jenis; ?>')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
									<?php endif ?>
									</td>
									<td class="text-center"><?= $no++ ?></td>
									<td class="text-center"><?= $report->nama_satker ?></td>
									<td class="text-center"><?= $report->nama_jenis ?></td>
									<td class="text-center"><?= $report->who ?></td>
									<td class="text-center"><?= $report->what ?></td>
									<td class="text-center"><?= date('d M y',strtotime($report->when)) ?></td>
									<td class="text-center"><?= $report->where ?></td>
									<td class="text-center"><?= $report->why ?></td>
									<td class="text-center"><?= $report->how ?></td>
									<td class="text-center"><?= $report->createddate ?></td>
									<td class="text-center"><?= $report->nama_pegawai ?></td>
									<td class="text-center"><?= $report->LastUpdated ?></td>
								</tr>
								<?php endforeach?>
							</tbody>
						</table>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>

<!-- Hapus Data-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="formDelete" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<span id="delete-modal-content"></span>
				</div>
				<div class="modal-footer">
					<button class="btn" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data Pelaporan Harian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" id="id_activity_sosial" name="id_activity_sosial" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Satuan Kerja</label>
                                <div class="col-md-9">
                                    <?php if(($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin Data' || $this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Admin Data Center')): ?>
                                        <select class="form-control" id="satkerEdit" name="id_satker" style="width:100%;" tcg-type='input'>
                                    <?php else: ?>
                                        <input type="hidden" class="form-control" id="hiddensatker" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
                                        <select class="form-control" id="satkerPicked" name="id_satker" tcg-type='input' disabled>
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
                                <label class="col-md-3 col-form-label">Jenis Pelaporan</label>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" id="typeEdit" name="id_activity_jenis" style="width:100%;" tcg-type='input'>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach($categories as $cat): ?>
                                                <option value="<?= $cat->id_activity_jenis ?>"><?= $cat->nama_jenis ?>
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="text-danger warning-type"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" tcg-tag='subcategory' style="display: none;">
                                        <div class="col-md-12">
                                            <select class="form-control" id="id_activity_jenis2" name="id_activity_jenis2" style="width:100%;" data-placeholder='Sub-kategori' tcg-type='input'>
                                                <option value="">Pilih Subkategori</option>
                                            </select>
                                            <div class="text-danger warning-id_activity_jenis2"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" tcg-tag="rekaptable" style="display: none;">
                                        
                                        <div class="col-md-12">
                                            <select class="form-control" id="id_rekap_table" name="id_rekap_table" style="width:100%;" tcg-type='input'>
                                                <option value="">Pilih Referensi</option>
                                            </select>
                                            <div class="text-danger warning-id_rekap_table"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" tcg-tag="tags" style="display: none;">
                                        <div class="col-md-12">
                                            <select class="form-control" id="tags" name="tags" style="width:100%;" data-placeholder='Tags' tcg-type='input' multiple>
                                            </select>
                                            <div class="text-danger warning-tags"></div>
                                        </div>
                                    </div>									
                                </div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Siapa ?</label>
									<div class="col-md-9">
										<input type="text" id="whoEdit" name="who" class="form-control" tcg-type='input'>
										<div class="invalid-feedback warning-who"></div>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Apa ?</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="whatEdit" name="what" value="" tcg-type='input'>
									<div class="invalid-feedback warning-what"></div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Kapan?</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="when" id="whenEdit" placeholder="YYYY-MM-DD HH:ii:ss" tcg-type='input'>
										<div class="invalid-feedback warning-when"></div>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Dimana ?</label>
								<div class="col-md-9">
									<select class="form-control" id="provinsiEdit" name="id_provinsi" style="width:100%;" tcg-type='input'>
										<option value="">Pilih Provinsi</option>
										<?php foreach($provinsi as $prov): ?>
										<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
										<select class="form-control" id="kabupatenEdit" name="id_kabupaten" style="width:100%;" tcg-type='input'>
											<option value="">Pilih Kabupaten</option>
										</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
										<select class="form-control" id="kecamatanEdit" name="id_kecamatan" style="width:100%;" tcg-type='input'>
											<option value="">Pilih Kecamatan</option>
										</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
										<select class="form-control" id="kelurahanEdit" name="id_kelurahan" style="width:100%;" tcg-type='input'>
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_locationedit" name="flag_locationedit" style="display:none;" class="form-control" tcg-type='input'>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
									<input type="text" class="form-control" rows="2" id="whereEdit" name="where" placeholder="Detail Alamat" tcg-type='input'>
									<div class="invalid-feedback warning-where"></div>
									<br>
									<div class="form-group">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" checked id="pinLocation">
												<span class="custom-control-label">Pin Lokasi Saya</span>
											</label>
											<br>
											<div class="map-view" style="display: block;">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitudeEdit" name="latitude"
															class="form-control" tcg-type='input' readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitudeEdit" name="longitude"
															class="form-control" tcg-type='input' readonly>
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
										<input type="text" class="form-control" rows="3" id="whyEdit" name="why" tcg-type='input'>
										<div class="invalid-feedback warning-why"></div>
									</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Bagaimana ?</label>
									<div class="col-md-9">
									<input type="text" class="form-control" rows="3" id="howEdit" name="how" tcg-type='input'>
										<div class="invalid-feedback warning-how"></div>
									</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Catatan Penting</label>
									<div class="col-md-9">
									<input type="text" class="form-control" rows="6" id="notesEdit" name="catatan_penting" tcg-type='input'>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Foto</label>
								<div class="col-md-4">
									<input type="file" class="dropify" id="gambarEdit" name="gambarEdit">
									<img class="img-thumbnail mb-3" id="imagePreview" src="">
									<input type="hidden" class="form-control-file" name="oldImage" value="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=initMap"></script>
<script>
    var report = null;

    var subcategories = <?= json_encode($subcategories, JSON_INVALID_UTF8_IGNORE); ?>;
    var tags = <?= json_encode($tags, JSON_INVALID_UTF8_IGNORE); ?>;

	$(document).ready(function () {
		// $("#satker").select2();

		$("#editModal select").select2({
			dropdownParent: $('#editModal')
		});
		
	$('input').on('keyup change', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
	});

	$('select').on('change', function(){
		var name = $(this).attr('name')
		$('.warning-'+name).html('')
	});

	$('#editModal').on('hidden.bs.modal', function (e) {
		$('input').val('');
		$('select').find('option:selected').removeAttr('selected');
		$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
	});

	$('#editForm').submit(function () {
		var valueSatker = '';

		if($('#hiddensatker').val() == undefined)
		{
			valueSatker = $('#satkerEdit').val();
		}
		else if($('#hiddensatker').val() != undefined)
		{
			valueSatker =  $('#hiddensatker').val();
		}

		// var formData = new FormData();
		// formData.append('csrf_al', $('input[name="csrf_al"]').val());
		// formData.append('id_activity_sosial', $('input[name="id_activity_sosial"]').val());
		// formData.append('type', $('#typeEdit').val());
		// formData.append('who', $('#whoEdit').val());
		// formData.append('satker', valueSatker);
		// formData.append('what', $('#whatEdit').val());
		// formData.append('provinsi', $('#provinsiEdit').val());
		// formData.append('kabupaten', $('#kabupatenEdit').val());
		// formData.append('kecamatan', $('#kecamatanEdit').val());
		// formData.append('kelurahan', $('#kelurahanEdit').val());
		// formData.append('where', $('#whereEdit').val());
		// formData.append('latitude', $('#latitudeEdit').val());
		// formData.append('longitude', $('#longitudeEdit').val());
		// formData.append('why', $('#whyEdit').val());
		// formData.append('how', $('#howEdit').val());
		// formData.append('notes', $('#notesEdit').val());
		// formData.append('date', $('#datetimepicker1').val());
		// formData.append('flag_locationedit', $('#flag_locationedit').val());

        // formData.append('gambar', $('#gambarEdit')[0].files[0]);

        var frmData = new FormData();
        elements = $('#editForm').find("[tcg-type='input']");
        elements.each(function(idx, dom) {
            el = $(dom);
            field = el.attr('name');
            val = el.val();
            frmData.append(field, val);
        })

        fileInput = document.querySelector("#gambar");
        if (fileInput.files.length > 0) {
            frmData.append('gambar', fileInput.files[0]);
        }

		$.ajax({
			type: "POST",
			url: "form_pelaporan/update",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data)
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function (key, value) {
                        if (value == null || value == '')   return;

						$('.warning-' + key).html(value)
						$('.warning-' + key).show()
						if ($('#' + key + 'Edit').val() == '') {
							$('#' + key + 'Edit').addClass('is-invalid')
						}
					});
				} else {
					window.location.reload();
				}
			},
			error: function(data) {
				//alert("error")
				console.log(data)
			}
		});
		return false;
	});

	// $('#provinsi').change(function(){ 
	// 		var id= $(this).val();
	// 		if (id) {
	// 			$.ajax({
	// 				url : "<?= site_url() ?>/api/getKabupaten/"+id,
	// 				method : "GET",
	// 				async : true,
	// 				dataType : 'json',
	// 				success: function(data){
	// 					var html = '';
	// 					var i;
	// 					html += '<option value="">Pilih Kabupaten</option>';
	// 					for(i=0; i<data.length; i++){
	// 						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
	// 					}
	// 					$('#kabupaten').html(html);
	// 				}
	// 			});
	// 			return false;
	// 		} else {
	// 			$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
	// 		}
	// }); 

	// $('#kabupaten').change(function(){ 
	// 		var id= $(this).val();
	// 		if (id) {
	// 			$.ajax({
	// 				url : "<?= site_url() ?>/api/getKecamatan/"+id,
	// 				method : "GET",
	// 				async : true,
	// 				dataType : 'json',
	// 				success: function(data){
	// 					var html = '';
	// 					var i;
	// 					html += '<option value="">Pilih Kecamatan</option>';
	// 					for(i=0; i<data.length; i++){
	// 						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
	// 					}
	// 					$('#kecamatan').html(html);
	// 				}
	// 			});
	// 			return false;
	// 		} else {
	// 			$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
	// 		}
	// }); 

	// $('#kecamatan').change(function(){ 
	// 		var id= $(this).val();
	// 		if (id) {
	// 			$.ajax({
	// 				url : "<?= site_url() ?>/api/getKelurahan/"+id,
	// 				method : "GET",
	// 				async : true,
	// 				dataType : 'json',
	// 				success: function(data){
	// 					var html = '';
	// 					var i;
	// 					html += '<option value="">Pilih Kelurahan</option>';
	// 					for(i=0; i<data.length; i++){
	// 						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
	// 					}
	// 					$('#kelurahan').html(html);
	// 				}
	// 			});
	// 			return false;
	// 		} else {
	// 			$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
	// 		}
	// });

	$('#provinsiEdit').change(function(){ 
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
                        let field = $('#kabupatenEdit');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");
	
						$('#kecamatanEdit').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');

					}
				});
				return false;
			} else {
				$('#kabupatenEdit').html('<option value="">Pilih Kabupaten</option>');
			}
	}); 
	
	$('#kabupatenEdit').change(function(){ 
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
                        let field = $('#kecamatanEdit');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");

						$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatanEdit').html('<option value="">Pilih Kecamatan</option>');
			}
	}); 
		
	$('#kecamatanEdit').change(function(){ 
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

                        let field = $('#kelurahanEdit');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");
					}
				});
				return false;
			} else {
				$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');
			}
	}); 
	
	$('#kelurahanEdit').change(function(){ 
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

	$('#satkerEdit').change(function(){ 
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
					initMap(data[0].latitude, data[0].longitude, 1);
				}
			});
			return false;
		} else {
		}
	});

    $("#typeEdit").on("change", function() {
        var id= $(this).val();

        if (id == '') {
            $("[tcg-tag='subcategory']").hide();
            $("[tcg-tag='rekaptable']").hide();
            $("[tcg-tag='tags']").hide();
            return;
        }

        //populate subcategory (if any)
        vsubcategories = [];
        for (i=0; i<subcategories.length; i++) {
            s = subcategories[i];
            if (s.id_parent == id) {
                vsubcategories.push(s);
            }
        }

        if (vsubcategories.length > 0) {
            //populate the satker select
            el = $("#id_activity_jenis2");
            let val = el.val()
            el.empty();

            if (val == null) {
                val = '';
            }

            let _option = $("<option>").val('').text('-- Pilih sub-kategori --');
            el.append(_option);
            for (i=0; i<vsubcategories.length; i++) {
                let s = vsubcategories[i];

                _option = $("<option>").val(s.id_activity_jenis).text(s.nama_jenis);
                el.append(_option);
            }

            //reset the value
            //el.val(val).trigger("change");
            val = el.attr("defaultValue");
            el.val( val ).trigger("change");

            $("[tcg-tag='subcategory']").show();
        }
        else {
            $("[tcg-tag='subcategory']").hide();
        }

        //populate tags (if any)
        vtags = [];
        for (i=0; i<tags.length; i++) {
            s = tags[i];
            if (s.id_activity_jenis == id) {
                vtags.push(s);
            }
        }

        if (vtags.length > 0) {
            //populate the satker select
            el = $("#tags");
            let val = el.val()
            el.empty();

            for (i=0; i<vtags.length; i++) {
                let s = vtags[i];

                let _option = $("<option>").val(s.tag).text(s.label);
                el.append(_option);
            }

            //reset the value
            val = el.attr("defaultValue");
            el.val( val ).trigger("change");

            $("[tcg-tag='tags']").show();
        }
        else {
            $("[tcg-tag='tags']").hide();
        }

        //get rekap_table (if any)
        $.ajax({
            url : "<?= site_url() ?>/api/getPelaporanRekapTable/"+id,
            method : "GET",
            async : true,
            dataType : 'json',
            success: function(json){
                if (json.data !== undefined && json.data != null && json.data.length > 0) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih ' +json['label']+ '</option>';
                    for(i=0; i<json.data.length; i++){
                        html += '<option value='+json.data[i].value+'>'+json.data[i].label+'</option>';
                    }
                    $('#id_rekap_table').html(html);
                    //show
                    $("[tcg-tag='rekaptable']").show();
                }
                else {
                    //hide
                    $("[tcg-tag='rekaptable']").hide();
                }
            }
        });
    });

    $("#id_activity_jenis2").on("change", function() {
        var id= $(this).val();

        if (id == '') {
            $("[tcg-tag='rekaptable']").hide();
            $("[tcg-tag='tags']").hide();
            return;
        }

        //populate tags (if any)
        vtags = [];
        for (i=0; i<tags.length; i++) {
            s = tags[i];
            if (s.id_activity_jenis == id) {
                vtags.push(s);
            }
        }

        if (vtags.length > 0) {
            //populate the satker select
            el = $("#tags");
            let val = el.val()
            el.empty();

            for (i=0; i<vtags.length; i++) {
                let s = vtags[i];

                let _option = $("<option>").val(s.tag).text(s.label);
                el.append(_option);
            }

            //reset the value
            el.val(val);

            $("[tcg-tag='tags']").show();

        }
        else {
            $("[tcg-tag='tags']").hide();
        }

        //get rekap_table
        $.ajax({
            url : "<?= site_url() ?>/api/getPelaporanRekapTable/"+id,
            method : "GET",
            async : true,
            dataType : 'json',
            success: function(json){
                if (json.data !== undefined && json.data != null && json.data.length > 0) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih ' +json['label']+ '</option>';
                    for(i=0; i<json.data.length; i++){
                        html += '<option value='+json.data[i].value+'>'+json.data[i].label+'</option>';
                    }
                    $('#id_rekap_table').html(html);
                    //show
                    $("[tcg-tag='rekaptable']").show();
                }
                else {
                    //hide
                    $("[tcg-tag='rekaptable']").hide();
                }
            }
        });
    });

	});
</script>
<script>
	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', '<?= site_url() ?>data_pelaporan/' + id + '/delete');
		$('#deleteModal').modal();
	}

	function editModal(id){
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'data_pelaporan/'+id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function(data){
				//console.log(data)
				// if(data.report.latitude == null && data.report.longitude == null)
				// {
				// }
				// else
				// {
				// 	$('#pinLocation').prop('checked', true);
				// 	$('.map-view').toggle()
				// }
				
				// $('select[name=type]').find('option:selected').removeAttr('selected');
				// $('select[name=satker]').find('option:selected').removeAttr('selected');
				// $('select[name=provinsi]').find('option:selected').removeAttr('selected');
				// $('select[name=kabupaten]').find('option:selected').removeAttr('selected');
				// $('select[name=kecamatan]').find('option:selected').removeAttr('selected');
				// $('select[name=kelurahan]').find('option:selected').removeAttr('selected');
				// $('input[name="id_activity_sosial"]').val(id);
				// $('input[name="what"]').val(data.report.what);
				// $('input[name="who"]').val(data.report.who);
				// $('input[name="where"]').val(data.report.where);
				// $('input[name="latitude"]').val(data.report.latitude);
				// $('input[name="longitude"]').val(data.report.longitude);
				// $('input[name="why"]').val(data.report.why);
				// $('input[name="how"]').val(data.report.how);
				// $('input[name="notes"]').val(data.report.catatan_penting);
				// $('input[name="date"]').val(data.report.when);
				// $('input[name="flag_locationedit"]').val(data.report.flag_location);
				
				// //$("select[name=type] option[value="+data.report.id_activity_jenis+"]").attr('selected','selected');
				// //$("select[name=satker] option[value="+data.report.id_satker+"]").attr('selected','selected');
				// //$("select[name=provinsi] option[value="+data.report.id_provinsi+"]").attr('selected','selected');
				// $("#typeEdit").val(data.report.id_activity_jenis);
				// $("#satkerEdit").val(data.report.id_satker);
				// $("#provinsiEdit").val(data.report.id_provinsi);
				// $('input[name="oldImage"]').val(data.report.gambar);
				// $('#imagePreview').attr('src',`<?= base_url();?>/uploads/reports/`+data.report.gambar);
				// $("#typeEdit").trigger('change');
				// $("#satkerEdit").trigger('change');
				// // $("#provinsiEdit").trigger('change');
				// // $("#kabupatenEdit").trigger('change');
				// // $("#kecamatanEdit").trigger('change');
				// // $("#kelurahanEdit").trigger('change');

				// if(data.report.flag_location == 'prov')
				// {
				// 	getProvinsi(data.report.id_provinsi)
				// 	getKabupaten(data.report.id_provinsi,0)
				// 	getKecamatan(0,0)
				// 	getKelurahan(0,0)
				// }
				// else if(data.report.flag_location == 'kab')
				// {
				// 	getProvinsi(data.report.id_provinsi)
				// 	getKabupaten(data.report.id_provinsi,data.report.id_kabupaten)
				// 	getKecamatan(data.report.id_kabupaten,0)
				// 	getKelurahan(0,0)
				// }
				// else if(data.report.flag_location == 'kec')
				// {
				// 	getProvinsi(data.report.id_provinsi)
				// 	getKabupaten(data.report.id_provinsi,data.report.id_kabupaten)
				// 	getKecamatan(data.report.id_kabupaten,data.report.id_kecamatan)
				// 	getKelurahan(data.report.id_kecamatan,0)
				// }
				// else if(data.report.flag_location == 'kel')
				// {
				// 	getProvinsi(data.report.id_provinsi)
				// 	getKabupaten(data.report.id_provinsi,data.report.id_kabupaten)
				// 	getKecamatan(data.report.id_kabupaten,data.report.id_kecamatan)
				// 	getKelurahan(data.report.id_kecamatan,data.report.id_kelurahan)
				// }
				// else
				// {
				// 	getProvinsi(data.report.id_provinsi)
				// 	getKabupaten(data.report.id_provinsi,data.report.id_kabupaten)
				// 	getKecamatan(data.report.id_kabupaten,data.report.id_kecamatan)
				// 	getKelurahan(data.report.id_kecamatan,data.report.id_kelurahan)
				// }

                report = data.report;

                elements = $('#editForm').find("[tcg-type='input']");
                elements.each(function(idx) {
                    el = $(this);
                    field = el.attr('name');
                    val = data.report[field];
                    el.val(val);
                    el.attr("defaultValue",val);
                })

                val = $("#satkerEdit").val();
                $("#satkerEdit").trigger("change");
                $("#typeEdit").trigger("change");
                $("#whenEdit").trigger("change");
                $("#whatEdit").trigger("change");
                $("#provinsiEdit").trigger("change");

                // val = $("#id_activity_jenis2").val();
                // if (val != null && val != '') {
                //     $("[tcg-tag='subcategory']").show();
                // }
                // else {
                //     $("[tcg-tag='subcategory']").hide();
                // }

                // val = $("#id_rekap_table").val();
                // if (val != null && val != '') {
                //     $("[tcg-tag='rekaptable']").show();
                // }
                // else {
                //     $("[tcg-tag='rekaptable']").hide();
                // }

                // val = $("#tags").val();
                // if (val != null && val != '') {
                //     $("[tcg-tag='tags']").show();
                // }
                // else {
                //     $("[tcg-tag='tags']").hide();
                // }

                //dropify
                if (data.report["gambar"] != null && data.report["gambar"] != '') {
                    let img = "<?= site_url() ?>" +data.report["gambar"];

                    // Get dropify instance
                    var dropify = $("#gambarEdit").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

				initMap(data.report.latitude, data.report.longitude, 2);
			},
			error: function(){
				alert('Could not displaying data');
			}           
		});
	}

	function getProvinsi(id_provinsi) {
		$.ajax({
			url : "api/getProvinsi/"+id_provinsi,
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
				$('#provinsiEdit').html(html);
			}
		});
	}

	function getKabupaten(id_provinsi,id_kabupaten) {
		$.ajax({
			url : "api/getKabupaten/"+id_provinsi,
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
				$('#kabupatenEdit').html(html);
			}
		});
	}

	function getKecamatan(id_kabupaten,id_kecamatan) {
		$.ajax({
			url : "api/getKecamatan/"+id_kabupaten,
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
				$('#kecamatanEdit').html(html);
			}
		});
	}

	function getKelurahan(id_kecamatan,id_kelurahan) {
		$.ajax({
			url : "api/getKelurahan/"+id_kecamatan,
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
				$('#kelurahanEdit').html(html);
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
				
			$("#latitudeEdit").val(_LAT);
			$("#longitudeEdit").val(_LONG);
		}
		else
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitudeEdit").val(_LAT);
			$("#longitudeEdit").val(_LONG);
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitudeEdit").val(event.latLng.lat());
			$("#longitudeEdit").val(event.latLng.lng());
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
