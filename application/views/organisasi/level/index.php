<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Organisasi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Level</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Data Level</div>
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
							<button class="btn btn-success" data-toggle="modal" id="tambahdatas"
								data-target="#tambahdata">Tambah Data</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<tr>
									<th class="text-center">Opsi</th>
									<th style="width: 5%;" class="text-center">No</th>
									<th class="text-center">Nama Tipe Organisasi</th>
									<th style="width: 5%;" class="text-center">Level</th>
									<th class="text-center">Parent</th>
									<th class="text-center">Updated By</th>
									<th class="text-center">Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($levels as $level): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('ORG','update')): ?>
										<button onclick="editModal(`<?= encrypt($level->id_level); ?>`)" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('ORG','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($level->id_level); ?>`,'<?= $level->jenis_organisasi; ?>')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td class="text-center"><?= $no++;?></td>
									<td class="text-center"><?= $level->jenis_organisasi;?></td>
									<td class="text-center"><?= $level->level;?></td>
									<td class="text-center"><?= $level->parent_organisasi;?></td>
									<td class="text-center"><?= $level->nama_pegawai;?></td>
									<td class="text-center"><?= $level->LastUpdated;?></td>
								</tr>
								<?php endforeach ?>
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
			<form id="addForm" class="form-horizontal" method="POST">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label"> Level Satker</label>
								<div class="col-md-9">
									<select class="form-control select w-100" name="level" id="level" style="width:100%;">
										<option value="1">Level 1</option>
										<option value="2">Level 2</option>
										<option value="3">Level 3</option>
										<option value="4">Level 4</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Tipe Organisasi</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="name" value="">
									<div class="invalid-feedback warning-name"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Parent Organisasi</label>
								<div class="col-md-9">
									<select class="form-control select w-100" name="parent" id="parent" style="width:100%;">
										<option value="">Tidak memiliki parent</option>
										<optgroup label="Level 1">
											<?php foreach($level1 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
										<optgroup label="Level 2">
											<?php foreach($level2 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
										<optgroup label="Level 3">
											<?php foreach($level3 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
										<optgroup label="Level 4">
											<?php foreach($level4 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
									</select>
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
			<form id="editForm" class="form-horizontal" method="POST">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label"> Level Satker</label>
								<div class="col-md-9">
									<select class="form-control select w-100" name="level" id="levelEdit" style="width:100%;">
										<option value="">Pilih</option>
										<option value="1">Level 1</option>
										<option value="2">Level 2</option>
										<option value="3">Level 3</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Tipe Organisasi</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="name" value="">
									<div class="invalid-feedback warning-name"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Parent Organisasi</label>
								<div class="col-md-9">
									<select class="form-control select w-100" name="parent" id="parentEdit" style="width:100%;">
										<option value="">Tidak memiliki parent</option>
										<optgroup label="Level 1">
											<?php foreach($level1 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
										<optgroup label="Level 2">
											<?php foreach($level2 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
										<optgroup label="Level 3">
											<?php foreach($level3 as $lv): ?>
											<option value="<?= $lv->id_level; ?>"><?= $lv->jenis_organisasi;?></option>
											<?php endforeach?>
										</optgroup>
									</select>
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
					<!-- <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a> -->
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
	$("#level").select2({
		dropdownParent: $('#tambahdata')
	});
	$("#parent").select2({
		dropdownParent: $('#tambahdata')
	});

	$("#levelEdit").select2({
		dropdownParent: $('#editModal')
	});
	$("#parentEdit").select2({
		dropdownParent: $('#editModal')
	});

	$('input').on('keyup change', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html()
	});

	$('#addForm').submit(function(){
		$.ajax({
			type : "POST",
			url  : "organisasi_level/store",
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
			url  : "organisasi_levels/update",
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
		$('select[name=level]').find('option:selected').removeAttr('selected');
		$('select[name=parent]').find('option:selected').removeAttr('selected');
		$('input[name="name"]').val('');
	});
});

function editModal(id){
	$('#editModal').modal();
	$.ajax({
        type: 'ajax',
        method: 'GET',
        url: 'organisasi_level/'+id,
        data: {
			id: id
		},
        dataType: 'json',
        success: function(data){
			$('select[name=level]').find('option:selected').removeAttr('selected');
			$('select[name=parent]').find('option:selected').removeAttr('selected');
            $('input[name="id"]').val(id);
            $('input[name="name"]').val(data.level.jenis_organisasi);
			//$("select[name=level] option[value="+data.level.level+"]").attr('selected','selected');
			// if (data.level.id_level_parent) {
			// 	$("select[name=parent] option[value="+data.level.id_level_parent+"]").attr('selected','selected');
			// } else {
			// 	$("select[name=parent] option[value='']").attr('selected','selected');
			// }

			$("#levelEdit").val(data.level.level);
			if (data.level.id_level_parent) {
				$("#parentEdit").val(data.level.id_level_parent);
			} else {
				$("#parentEdit").val();
			}
				
			$("#levelEdit").trigger('change');
			$("#parentEdit").trigger('change');
        },
        error: function(){
            alert('Could not displaying data');
        }           
    });
}

function deleteConfirm(id,content){
    $('input[name="id"]').val(id);
	$('#delete-modal-content').html('Anda akan menghapus data <b>'+content+'</b>');
	$('#formDelete').attr('action', 'organisasi_level/'+id+'/delete');
	$('#deleteModal').modal();
}
</script>
