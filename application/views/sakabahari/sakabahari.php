
<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Saka Bahari</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Saka Bahari</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<table id="dt" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>No</th>
								<th>Satker</th>
								<th>Nama</th>
								<th>Deskripsi</th>
								<th>Nama Ketua</th>
								<th>Foto Ketua</th>
								<th>Nama Pembina</th>
								<th>Foto Pembina</th>
								<th>Nama Sekolah</th>
								<th>No Gugus Depan</th>
								<th>Alamat</th>
								<th>Desa/Kelurahan</th>
								<th>Kwartir Rating</th>
								<th>Kwartir Cabang</th>
								<th>Kwartir Daerah</th>
								<th>Gambar Sampul</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<!-- <tbody>
								<?php $no=1; foreach($dataBahari as $bahari): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('SAKA','update')): ?>
										<button onclick="showEditModal(`<?= $bahari->id_sakabahari; ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('SAKA','delete')): ?>
										<button
											onclick="showDeleteModal(`<?= $bahari->id_sakabahari; ?>`)"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
										<?php if(policy('SAKA','update')): ?>
										<a href="<?php echo site_url() ?>sakabahari/profil/<?= $bahari->id_sakabahari; ?>"
											class="btn btn-sm btn-success">
											<i class="fa fa-user "></i>
                                        </a>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $bahari->nama_satker ?></td>
									<td><?= $bahari->nama ?></td>
									<td><?= $bahari->deskripsi ?></td>
									<td><?= $bahari->nama_ketua ?></td>
									<td><?= $bahari->foto_ketua ?></td>
									<td><?= $bahari->nama_pembina ?></td>
									<td><?= $bahari->foto_pembina ?></td>
									<td><?= $bahari->sekolah_terlibat ?></td>
									<td><?= $bahari->no_gugus_depan ?></td>
									<td><?= $bahari->alamat ?></td>
									<td><?= $bahari->nama_kelurahan ?></td>
									<td><?= $bahari->nama_kecamatan ?></td>
									<td><?= $bahari->nama_kabupaten ?></td>
									<td><?= $bahari->nama_provinsi ?></td>
									<td><?= $bahari->gambar_sampul ?></td>
									<td><?= $bahari->updated_by ?></td>
									<td><?= $bahari->updated_date?></td>
								</tr>
								<?php endforeach ?>
							</tbody> -->
						</table>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>

<!-- Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 800px; max-width: 800px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="editForm" tcg-mode="edit">
                <input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>" tcg-type='input'>
                <input type="hidden" name="id_sakabahari" value="" tcg-type='input'>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12" tcg-allow-edit=1 tcg-allow-add=1>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker </label>
								<div class="col-md-9">
									<?php if(($this->session->userdata('role') == 'Satker')): ?>
										<input type="hidden" class="form-control" name="id_satker" value="<?= $this->session->userdata('id_satker') ?>" tcg-type='input'>
										<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
									<?php else: ?>
										<select class="form-control" id="satker" name="id_satker" style="width: 100%;" tcg-type='input'>
									<?php endif ?>
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker): ?>
										<option value="<?= $satker->id_satker ?>" <?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>><?= $satker->nama_satker ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="nama">Nama</label>
								<div class="col-md-9">
									<input type="text" id="nama" name="nama" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-nama"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="deskripsi">Deskripsi</label>
								<div class="col-md-9">
									<input type="text" id="deskripsi" name="deskripsi" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-deskripsi"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="nama_ketua">Nama Ketua</label>
								<div class="col-md-9">
									<input type="text" id="nama_ketua" name="nama_ketua" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-nama_ketua"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                                <label class="col-md-3 col-form-label" for="foto_ketua">Foto Ketua</label>
								<div class="col-md-9">
                                    <input type="file" class="dropify" id="foto_ketua" name="foto_ketua">
									<div class="invalid-feedback warning-foto_ketua"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="nama_pembina">Nama Pembina</label>
								<div class="col-md-9">
									<input type="text" id="nama_pembina" name="nama_pembina" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-nama_pembina"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                                <label class="col-md-3 col-form-label" for="foto_pembina">Foto Pembina</label>
								<div class="col-md-9">
                                    <input type="file" class="dropify" id="foto_pembina" name="foto_pembina">
									<div class="invalid-feedback warning-foto_pembina"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="sekolah_terlibat">Nama Sekolah</label>
								<div class="col-md-9">
									<input type="text" id="sekolah_terlibat" name="sekolah_terlibat" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-sekolah_terlibat"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="no_gugus_depan">No Gugus Depan</label>
								<div class="col-md-9">
									<input type="text" id="no_gugus_depan" name="no_gugus_depan" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-no_gugus_depan"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label">Alamat/Kwartir</label>
								<div class="col-md-9">
                                    <div class="row">
									<div class="col-md-6 mb-4">
										<select class="form-control" id="provinsi" name="id_provinsi" style="width: 100%;" tcg-type='input'>
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<div class="col-md-6 mb-4">
										<select class="form-control" id="kabupaten" name="id_kabupaten" style="width: 100%;" tcg-type='input'>
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<div class="col-md-6 mb-4">
										<select class="form-control" id="kecamatan" name="id_kecamatan" style="width: 100%;" tcg-type='input'>
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<div class="col-md-6 mb-4">
										<select class="form-control" id="kelurahan" name="id_kelurahan" style="width: 100%;" tcg-type='input'>
											<option value="">Pilih Kelurahan</option>
										</select>
									</div>
									<div class="col-md-12 mb-4">
                                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Jalan" tcg-type='input'>
                                        <div class="invalid-feedback warning-alamat"></div>
									</div>
                                    </div>
                                    <div class="mb-4">
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-square" onclick="getCurrentPlace()"><i class="fa fa-map-pin mr-2"></i> Dapatkan Lokasi</button>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12"><div id="map" style="position:relative; width: 100%; height: 100%; min-height: 350px; z-index: 1;"></div>
                                    </div>
                                    <div class="col-md-12">NB : Silahkan klik di peta <b>(<i class="fa fa-map-marker"></i>)</b> untuk perubahan data koordinat.</div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="latitude">Lintang</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control" tcg-type='input'>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="latitude">Bujur</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control" tcg-type='input'>
                                    </div>
                                    </div>
                                </div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="gambar_sampul">Gambar Sampul</label>
								<div class="col-md-9">
                                    <input type="file" class="dropify" id="gambar_sampul" name="gambar_sampul">
									<div class="invalid-feedback warning-gambar_sampul"></div>
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
			<form id="deleteForm" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body" style="height: auto;">
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=initMap&libraries=places"></script>

<script>
    var profil = null;

	$(document).ready(function () {
		$("#editModal select").select2({
			dropdownParent: $('#editModal')
		});

		$('input').on('keyup change', function () {
			var name = $(this).attr('name')
			$('input[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('select').on('change', function () {
			var name = $(this).attr('name')
			$('.warning-' + name).html('')
		});

		$('#editForm').submit(function (e) {
            e.preventDefault();

            simpan();
		});

		$('#deleteForm').submit(function (e) {
            e.preventDefault();

            hapus();
		});

		$('.modal').on('hidden.bs.modal', function (e) {
            let modal = $(this);
            let frm = modal.find("#editForm");

			$('select').find('option:selected').removeAttr('selected');
			$('input').val('');
            $('#foto').val(null);

            <?php if(policy('SAKA','read')): ?>
			$('select[name=satkerPicked] option[value="<?= $this->session->userdata('id_satker') ?>"]').attr('selected','selected');
			$('input[name="satker"]').val("<?= $this->session->userdata('id_satker') ?>")
			<?php endif ?>

			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
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
                        let field = $('#kabupaten');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#kabupaten').change(function(){ 
			var id= $(this).val();

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
                        let field = $('#kecamatan');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");
					}
				});
				return false;
			} else {
				$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 

		$('#kecamatan').change(function(){ 
			var id= $(this).val();

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
                        let field = $('#kelurahan');
						field.html(html);
                        //set value
                        let val = field.attr("defaultValue");
                        field.val( val ).trigger("change");
					}
				});
				return false;
			} else {
				$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 

		$('#kelurahan').change(function(){
			var id= $(this).val();
		}); 

        //datatable
        dt = $('#dt').DataTable( {
            lengthChange: false,
            "ajax": "<?php echo site_url() ?>sakabahari/rekap",
            "columns": [
                {
                    data: null,
                    className: "text-center",
                    orderable: 'false',
                    render: function(data, type, row, meta) {
                        if(type != 'display') {
                            return data;
                        }

                        let str = '';
                        <?php if(policy('SAKA','update')): ?>
                        str += '<button onclick="showEditModal(`' +row['id_sakabahari']+ '`); event.stopPropagation();" class="btn btn-sm btn-primary"><i class="fa fa-pencil "></i></button>';
                        <?php endif ?>
                        <?php if(policy('SAKA','delete')): ?>
                        str += '<button onclick="showDeleteModal(`' +row['id_sakabahari']+ '`, `' +row['nama']+ '`); event.stopPropagation();" class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></button>';
                        <?php endif ?>
                        <?php if(policy('SAKA','update')): ?>
                        str += '<a href="<?php echo site_url() ?>sakabahari/profil/' +row['id_sakabahari']+ '" class="btn btn-sm btn-success"><i class="fa fa-user "></i></a>';
						<?php endif ?>

                        return str;
                    }
                },
                {
                    data: null,
                    className: "text-right",
                    orderable: 'false',
                    defaultContent: "",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nama_satker",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "nama",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "deskripsi",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "nama_ketua",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "foto_ketua",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "sekolah_terlibat",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "no_gugus_depan",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "alamat",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "nama_kelurahan",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "nama_kecamatan",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "nama_kabupaten",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "nama_provinsi",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "gambar_sampul",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "updated_by",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "updated_date",
                    className: "text-center",
                    orderable: 'true',
                },
            ],
            // columnDefs: [ {
            //     targets: -1,
            //     visible: true
            // } ]
            //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
            // "footerCallback": function ( row, data, start, end, display ) {
            //     {$tbl.table_id}_refresh(this.api());
            // },
        });

        var buttons = new $.fn.dataTable.Buttons( dt, {
            buttons: [
                {
                    text: 'Tambah Data',
                    className: "btn btn-success",
                    action: function (e, dt, node, config) {
                        showAddModal();
                    }
                }
            ]
        });    
        buttons.container().find(".btn").removeClass("btn-primary");
        buttons.container().addClass("mr-3");

        var buttons2 = new $.fn.dataTable.Buttons( dt, {
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                // {
                // 	extend: 'pdf',
                // 	extend: 'pdfHtml5',
                //     orientation: 'landscape',
                //     pageSize: 'LEGAL',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'print',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                
                'colvis'
            ]
        });    

        buttons.container()
            .appendTo( '#dt_wrapper .col-md-6:eq(0)' );
        buttons2.container()
            .appendTo( '#dt_wrapper .col-md-6:eq(0)' );  
            
        //create tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        dt.on('order.dt search.dt', function () {
            let i = 1;

            dt.cells(null, 1, { search: 'applied', order: 'applied' })
                .every(function (cell) {
                    this.data(i++);
                });
        })
        .draw();

        initMap();
	});

    function simpan() {
        let mode = $('#editForm').attr("tcg-mode");
        if (mode == null) {
            mode == 'edit';
        }

        let url = "<?= site_url() ?>sakabahari/update";
        if (mode == 'add') {
            url = "<?= site_url() ?>sakabahari/store";
        }

        frmData = new FormData();
        elements = $('#editForm').find("[tcg-type='input']");
        elements.each(function(idx, dom) {
            el = $(dom);
            field = el.attr('name');
            val = el.val();
            frmData.append(field, val);
        })

        fileInput = document.querySelector("#foto_ketua");
        if (fileInput.files.length > 0) {
            frmData.append('foto_ketua', fileInput.files[0]);
        }

        fileInput = document.querySelector("#foto_pembina");
        if (fileInput.files.length > 0) {
            frmData.append('foto_pembina', fileInput.files[0]);
        }

        fileInput = document.querySelector("#gambar_sampul");
        if (fileInput.files.length > 0) {
            frmData.append('gambar_sampul', fileInput.files[0]);
        }

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: frmData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            success: function (data) {
                if (data[0].status == 0) {
                    $('input[name="csrf_al"]').val(data[0].csrf)
                    $.each(data[1], function (key, value) {
                        if (value != null && value != '') {
                            $('input[name="' + key + '"]').addClass('is-invalid')
                            $('.warning-' + key).html(value)
                        }
                    });
                } else {
                    dt.ajax.reload();
                    toastr.success("Data berhasil disimpan");
                    $('#editModal').modal('hide');
                }
            },
            error: function (data) {
                console.log(data)
                toastr.error("TIDAK berhasil menyimpan data");
                $('#editModal').modal('hide');
            }
        });

		return false;
    }

    function hapus() {
        let url = $('#deleteForm').attr('action');

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            success: function (data) {
                if (data[0].status == 0) {
                    toastr.error("TIDAK berhasil menghapus data Saka Bahari");
                } else {
                   toastr.success("Berhasil menghapus data Saka Bahari");
                   dt.ajax.reload();
                }
                $('#deleteModal').modal('hide');
            },
            error: function (data) {
                console.log(data);
                toastr.error("TIDAK berhasil menghapus data Saka Bahari");
                $('#deleteModal').modal('hide');
            }
        });
        return false;

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
			url : "<?= site_url() ?>api/getKabupaten/"+id_provinsi,
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
			url : "<?= site_url() ?>api/getKecamatan/"+id_kabupaten,
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
			url : "<?= site_url() ?>api/getKelurahan/"+id_kecamatan,
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

    function showAddModal() {
        $('#editModal').modal();

        $("#editForm").find("[tcg-allow-add=1]").show();
        $("#editForm").find("[tcg-allow-add=0]").hide();
        $('#editForm').attr('tcg-mode', 'add');

        $('#editModal').find(".modal-title").html("Tambah Data");

        if(marker){
            marker.setMap(null);
        }
        
        //reset field
        var dropify = $("#foto_ketua").data('dropify');
        dropify.resetPreview();
        dropify.clearElement();

        dropify = $("#foto_pembina").data('dropify');
        dropify.resetPreview();
        dropify.clearElement();

        dropify = $("#gambar_sampul").data('dropify');
        dropify.resetPreview();
        dropify.clearElement();

        $("#provinsi").val('').trigger("change");
        $("#kabupaten").val('').trigger("change");
        $("#kecamatan").val('').trigger("change");

    }

	function showEditModal(id) {
		$('#editModal').modal();

        $("#editForm").find("[tcg-allow-edit=1]").show();
        $("#editForm").find("[tcg-allow-edit=0]").hide();
        $('#editForm').attr('tcg-mode', 'edit');

        $('#editModal').find(".modal-title").html("Edit Data");

		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url() ?>sakabahari/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
                profil = data.bahari;

                elements = $('#editForm').find("[tcg-type='input']");
                elements.each(function(idx) {
                    el = $(this);
                    field = el.attr('name');
                    val = data.bahari[field];
                    el.val(val);
                    el.attr("defaultValue",val);
                })

                //val = $("#satker").val();
                $("#satker").trigger("change");
                $("#provinsi").trigger("change");

                //dropify
                if (data.bahari["foto_ketua"] != null && data.bahari["foto_ketua"] != '') {
                    let img = "<?= site_url() ?>" +data.bahari["foto_ketua"];

                    // Get dropify instance
                    var dropify = $("#foto_ketua").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

                if (data.bahari["foto_pembina"] != null && data.bahari["foto_pembina"] != '') {
                    let img = "<?= site_url() ?>" +data.bahari["foto_pembina"];

                    // Get dropify instance
                    var dropify = $("#foto_pembina").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

                if (data.bahari["gambar_sampul"] != null && data.bahari["gambar_sampul"] != '') {
                    let img = "<?= site_url() ?>" +data.bahari["gambar_sampul"];

                    // Get dropify instance
                    var dropify = $("#gambar_sampul").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

                //create marker
                let location = new google.maps.LatLng(data.bahari["latitude"],data.bahari["longitude"]);
                placeMarker(map, location);
                map.setCenter(location);

			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function showDeleteModal(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>"' + content + '</b>"');
		$('#deleteForm').attr('action', '<?= site_url() ?>sakabahari/' + id + '/delete');
		$('#deleteModal').modal();
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

		getLocation(loc);
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

	function initMap() {
		const startLocation = new google.maps.LatLng(-6.1755367, 106.8273503);
		infowindow = new google.maps.InfoWindow();
		map = new google.maps.Map(document.getElementById("map"), {
			center: startLocation,
			zoom: 15,
		});

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