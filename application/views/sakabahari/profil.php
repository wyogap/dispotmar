
<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url() ?>sakabahari"><i class="ti-package mr-1"></i>Saka Bahari</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $bahari->nama; ?></li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-collapsed" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Profil - <?= $bahari->nama; ?></div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 text-right">
                            Nama :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Deskripsi :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->deskripsi; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Alamat :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->alamat; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Ketua :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama_ketua; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Pembina :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama_pembina; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Nama Sekolah :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->sekolah_terlibat; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Gugus Depan :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->no_gugus_depan; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kwartir Rating :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama_kecamatan; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kwartir Cabang :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama_kabupaten; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kwartir Daerah :
						</div>
						<div class="col-md-8 text-left">
                            <?= $bahari->nama_provinsi; ?>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Anggota - <?= $bahari->nama; ?></div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<table id="dt" style="table-layout: auto; width: 100%;" class="table datatable table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>No</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>No HP</th>
								<th>Email</th>
								<th>Alamat</th>
								<th>Foto</th>
							</thead>
                    </table>
                    <br>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Kegiatan - <?= $bahari->nama; ?></h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="latest-timeline-1 activity-scroll" id="mainActivities">
					</div>
				</div>
			</div>
			<?php echo $this->pagination->create_links(); ?>
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
                <input type="hidden" name="id_sakabahari" value="<?= $bahari->id_sakabahari; ?>" tcg-type='input'>
                <input type="hidden" name="id_anggota" value="" tcg-type='input'>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12" tcg-allow-edit=1 tcg-allow-add=1>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="nama">Nama</label>
								<div class="col-md-9">
									<input type="text" id="nama" name="nama" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-nama"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
								<div class="col-md-9">
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-tgl_lahir"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
								<div class="col-md-9">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;" tcg-type='input'>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
									<div class="invalid-feedback warning-jenis_kelamin"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="no_hp">Nomor HP</label>
								<div class="col-md-9">
									<input type="text" id="no_hp" name="no_hp" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-no_hp"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="email">Email</label>
								<div class="col-md-9">
									<input type="text" id="email" name="email" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-email"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="alamat">Alamat</label>
								<div class="col-md-9">
									<input type="text" id="alamat" name="alamat" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-alamat"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="foto">Foto</label>
								<div class="col-md-9">
                                    <input type="file" class="dropify" id="foto" name="foto">
									<div class="invalid-feedback warning-foto"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-save-anggota">Simpan</button>
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

<script type="text/javascript">
	$(function (e) {

		'use strict'
		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		// $("#years").change(function() {
		// 	var id= $(this).val();
		// 	getDataPelaporanBarChart(id);
		// });

		getMainActitivies();

	});


	function getMainActitivies(){
		$.ajax({
			url   : "<?= site_url()?>api/getSakaActivityBySaka/<?= $bahari->id_sakabahari; ?>",
			type  : 'GET',
			async : true,
			dataType : 'json',
			success : function(data){
				//console.log(data);
				var html = '';
				var count = 1;
				var i;
				if (data.length == 0) {
					html = '<div class="wrapper w-100 text-center"><h2 class="text-muted">Data Laporan Belum Tersedia</h2></div>'
				}else{
					for(i=0; i<data.length; i++){

						if(data[i].flag_location == "prov")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kab")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kec")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kel")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KELURAHAN+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KELURAHAN+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
					}
				}
				$('#mainActivities').html(html);
			}
	
		});
	}
	
</script>

<script>
    var profil = null;
    var dt = null;

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

            simpanAnggota();
		});

		$('#deleteForm').submit(function (e) {
            e.preventDefault();

            hapusAnggota();
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

        //datatable
        dt = $('#dt').DataTable( {
            lengthChange: false,
            "ajax": "<?php echo site_url() ?>sakabahari/daftaranggota/<?= $bahari->id_sakabahari; ?>",
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
                        str += '<button onclick="showEditModal(`' +row['id_anggota']+ '`); event.stopPropagation();" class="btn btn-sm btn-primary"><i class="fa fa-pencil "></i></button>';
                        <?php endif ?>
                        <?php if(policy('SAKA','delete')): ?>
                        str += '<button onclick="showDeleteModal(`' +row['id_anggota']+ '`, `' +row['nama']+ '`); event.stopPropagation();" class="btn btn-sm btn-danger"> <i class="fa fa-trash "></i></button>';
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
                    data: "nama",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "tgl_lahir",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "jenis_kelamin",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "no_hp",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "email",
                    className: "text-center",
                    orderable: 'true',
                },
                {
                    data: "alamat",
                    className: "text-left",
                    orderable: 'true',
                },
                {
                    data: "foto",
                    className: "text-left",
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
	});

    function simpanAnggota() {
        let mode = $('#editForm').attr("tcg-mode");
        if (mode == null) {
            mode == 'edit';
        }

        let url = "<?= site_url() ?>sakabahari/anggota/update";
        if (mode == 'add') {
            url = "<?= site_url() ?>sakabahari/anggota/store";
        }

        frmData = new FormData();
        elements = $('#editForm').find("[tcg-type='input']");
        elements.each(function(idx, dom) {
            el = $(dom);
            field = el.attr('name');
            val = el.val();
            frmData.append(field, val);
        })

        fileInput = document.querySelector("#foto");
        if (fileInput.files.length > 0) {
            frmData.append('foto', fileInput.files[0]);
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
                console.log(data);
                toastr.error("TIDAK berhasil menyimpan data");
                $('#editModal').modal('hide');
            }
        });
        return false;

    }

    function hapusAnggota() {
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
                    toastr.error("TIDAK berhasil menghapus data anggota");
                } else {
                   toastr.success("Berhasil menghapus data anggota");
                   dt.ajax.reload();
                }
                $('#deleteModal').modal('hide');
            },
            error: function (data) {
                console.log(data);
                toastr.error("TIDAK berhasil menghapus data anggota");
                $('#deleteModal').modal('hide');
            }
        });
        return false;

    }

    function showAddModal() {
        $('#editModal').modal();

        $("#editForm").find("[tcg-allow-add=1]").show();
        $("#editForm").find("[tcg-allow-add=0]").hide();
        $('#editForm').attr('tcg-mode', 'add');

        $('#editModal').find(".modal-title").html("Tambah Data");
        
        // Reset current preview
        var dropify = $("#foto").data('dropify');
        dropify.resetPreview();
        dropify.clearElement();
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
			url: '<?= site_url() ?>sakabahari/anggota/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
                //profil = data.anggota;

                elements = $('#editForm').find("[tcg-type='input']");
                elements.each(function(idx) {
                    el = $(this);
                    field = el.attr('name');
                    val = data.anggota[field];
                    el.val(val);
                    el.attr("defaultValue",val);
                })

                val = data.anggota['jenis_kelamin'];
                $("#jenis_kelamin").val(val).trigger("change");

                //dropify
                if (data.anggota["foto"] != null && data.anggota["foto"] != '') {
                    let img = "<?= site_url() ?>" +data.anggota["foto"];

                    // Get dropify instance
                    var dropify = $("#foto").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function showDeleteModal(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>"' + content + '"</b>');
		$('#deleteForm').attr('action', '<?= site_url() ?>sakabahari/anggota/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
