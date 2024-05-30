<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php site_url()?>user_master_role"><i class="ti-package mr-1"></i>User Management</a></li>
			<li class="breadcrumb-item active" aria-current="page">Master Role</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Master Data Role</div>
					<div class="card-options">
					<button class="btn btn-success" data-toggle="modal" id="tambahdatas"
								data-target="#tambahdata">Tambah</button>
						<!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						 -->
					</div>
				</div>
				<div class="card-body">
					<!-- <div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-success" data-toggle="modal"
								data-target="#tambahdata">Tambah</button>
						</div>
					</div>
					<br> -->
					<div class="table-responsive">
						<table id="tbl-a" class="table table-striped table-bordered text-nowrap">
							<thead>
								<th class="text-center">Opsi</th>
								<th style="width: 5%;" class="text-center">No</th>
								<th class="text-center">Nama Role</th>
								<th class="text-center">Updated By</th>
								<th class="text-center">Last Updated</th>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($roles as $role): ?>
								<tr>
									<td class="text-center">
									<?php if(policy('USERMAN','update')): ?>
										<a href="<?= site_url()?>role_permission/<?= encrypt($role->id_role)?>">
											<button class="btn btn-sm btn-primary">
												<i class="fa fa-key"></i>
											</button>
										</a>
										<button onclick="editModal(`<?= encrypt($role->id_role); ?>`,'<?= $role->nama_role; ?>')" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
									<?php endif ?>
									<?php if(policy('USERMAN','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($role->id_role); ?>`,'<?= $role->nama_role; ?>')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
									<?php endif ?>
									</td>
									<td class="text-center"><?= $no++;?></td>
									<td class="text-left"><?= $role->nama_role;?></td>
									<td class="text-center"><?= $role->nama_pegawai;?></td>
									<td class="text-center"><?= $role->LastUpdated;?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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
			<form id="addForm" class="form-horizontal" method="POST">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Role</label>
								<div class="col-md-9">
									<input type="text" name="name" class="form-control" placeholder="Ex. Staff" required>
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
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" class="form-horizontal" method="POST">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" id="id" name="id_role" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Role</label>
								<div class="col-md-9">
									<input type="text" id="name" name="name" class="form-control" placeholder="Ex. Staff" required>
									<div class="invalid-feedback warning-name"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Confirmation-->
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
	$('input').on('keyup', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html()
	});
	$('#addForm').submit(function(){
		$.ajax({
			type : "POST",
			url  : "user_master_role/store",
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
			url  : "user_master_role/update",
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
function editModal(id,content){
	$('#id').val(id);
	$('#name').val(content);
	$('#editModal').modal();
}
function deleteConfirm(id,content){
    $('input[name="id"]').val(id);
	$('#delete-modal-content').html('Anda akan menghapus data <b>'+content+'</b>');
	$('#formDelete').attr('action', 'user_master_role/'+id+'/delete');
	$('#deleteModal').modal();
}
</script>
