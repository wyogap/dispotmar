<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Pelaporan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Jenis Pelaporan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Jenis Pelaporan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal" data-target="#tambahdata">
								Tambah Data
							</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
					<table id="example" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>No</th>
								<th>Jenis Pelaporan</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($types as $type): ?>
								<tr>
									<td class="text-center">
									<?php if(policy('LAPHAR','update')): ?>
										<button onclick="editModal(`<?= encrypt($type->id_activity_jenis); ?>`)" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
									<?php endif ?>
									<?php if(policy('LAPHAR','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($type->id_activity_jenis); ?>`,'<?= $type->nama_jenis; ?>')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
									<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $type->nama_jenis ?></td>
									<td><?= $type->nama_pegawai ?></td>
									<td><?= $type->LastUpdated ?></td>
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

<!-- Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="addForm" method="POST" class="form-horizontal">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="name">Jenis Pelaporan</label>
								<div class="col-md-9">
									<input type="text" id="name" name="name" class="form-control">
									<div class="invalid-feedback warning-name"></div>
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

<!-- Edit Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" method="POST" class="form-horizontal">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="name">Jenis Pelaporan</label>
								<div class="col-md-9">
									<input type="text" id="name" name="name" class="form-control">
									<div class="invalid-feedback warning-name"></div>
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$('input').on('keyup onchange', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html()
	});
	$('#addForm').submit(function(){
		$.ajax({
			type : "POST",
			url  : "jenis_pelaporan/store",
			dataType : "json",
			data : $(this).serialize(),
			success: function(data){
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function(key, value) {
						$('input[name="'+key+'"]').addClass('is-invalid')
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
	$('#editForm').submit(function(){
		$.ajax({
			type : "POST",
			url  : "jenis_pelaporan/update",
			dataType : "json",
			data : $(this).serialize(),
			success: function(data){
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function(key, value) {
						$('input[name="'+key+'"]').addClass('is-invalid')
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
	$('#editModal').on('hidden.bs.modal', function (e) {
		$('input[name="name"]').val('');
	});
});

function editModal(id){
	$('#editModal').modal();
	$.ajax({
        type: 'ajax',
        method: 'GET',
        url: 'jenis_pelaporan/'+id,
        data: {
			id: id
		},
        dataType: 'json',
        success: function(data){
            $('input[name="id"]').val(id);
            $('input[name="name"]').val(data.type.nama_jenis);
        },
        error: function(){
            alert('Could not displaying data');
        }           
    });
}

function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', '<?= site_url() ?>jenis_pelaporan/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
