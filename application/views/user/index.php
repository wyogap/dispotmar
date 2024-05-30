<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> User Management</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data User</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Master Data User</div>
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
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal"
								data-target="#tambahdata">Tambah Data</button>
						</div>
					</div>

					<br>
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th class="text-center">Opsi</th>
								<th style="width: 5%;">No</th>
								<th>Nama Pegawai</th>
								<th>Pangkat</th>
								<th>NRP</th>
								<th>Jabatan</th>
								<th>Satker</th>
								<th>Telp</th>
								<th>Email</th>
								<th>Username</th>
								<th>Role</th>
								<th>Notifikasi</th>
								<th>Updated By</th>
								<th>Last Updated</th>

							</thead>
							<tbody>
								<?php $no = 1; foreach($users as $user): ?>
								<tr>
									<td>
									<?php if(policy('USERMAN','update')): ?>
										<button onclick="editModal(`<?= encrypt($user->id_user); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
									<?php endif ?>
									<?php if(policy('USERMAN','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($user->id_user); ?>`,'<?= $user->nama_pegawai; ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
									<?php endif ?>
									</td>
									<td><?= $no++;?></td>
									<td><?= $user->nama_pegawai;?></td>
									<td><?= $user->pangkat;?></td>
									<td><?= $user->nrp;?></td>
									<td><?= $user->pangkat;?></td>
									<td><?= $user->nama_satker;?></td>
									<td><?= $user->phone;?></td>
									<td><?= $user->email;?></td>
									<td><?= $user->username;?></td>
									<td><?= $user->nama_role;?></td>
									<td class="text-center">
										<form id="notifableForm<?= $user->id_user ?>" method="POST" action="<?= site_url() ?>user_management/notifable/update">
											<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
											<input type="hidden" name="id" value="<?= encrypt($user->id_user) ?>">
											<input type="checkbox" style="display: none;" id="notifable<?= $user->id_user ?>" name="notifable" value="0" <?= ($user->notifable == 1) ? 'checked' : '' ?>>
											<span data-toggle="tooltip" data-placement="top" title="<?= ($user->notifable == 1) ? 'Matikan' : 'Hidupkan' ?> Notifikasi" style="font-size: 30px;cursor: pointer;" id="notifStatus<?= $user->id_user ?>" class="<?= ($user->notifable == 1) ? 'text-success' : '' ?>" onclick="doSubmit(<?= $user->id_user ?>)">
												<i id="notifClass<?= $user->id_user ?>" class="typcn typcn-volume-<?= ($user->notifable == 1) ? 'up' : 'mute' ?>"></i>
											</span>
										</form>
									</td>
									<td><?= $user->nama_pegawai2;?></td>
									<td><?= $user->LastUpdated;?></td>
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
	<div class="modal-dialog" role="document" style="margin-right:700px;">
		<div class="modal-content" style="width:1200px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="addForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<br>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Role</label>
								<div class="col-md-9">
									<select class="form-control" name="role" id="role" style="width:100%">
										<option value="">Pilih Role</option>
										<?php foreach($roles as $role):?>
										<option value="<?= $role->id_role; ?>"><?= $role->nama_role; ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-role"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker</label>
								<div class="col-md-9">
									<select class="form-control" style="width: 100%;" id="satker" name="satker">
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker):?>
										<option value="<?= $satker->id_satker; ?>"><?= $satker->nama_satker; ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Pegawai</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="name" value="">
									<div class="invalid-feedback warning-name"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pangkat</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="pangkat" value="">
									<div class="invalid-feedback warning-pangkat"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">NRP</label>
								<div class="col-md-9">
									<input type="number" class="form-control" name="nrp" value="">
									<div class="invalid-feedback warning-nrp"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">No.Telp</label>
								<div class="col-md-9">
									<input type="number" class="form-control" name="phone" value="">
									<div class="invalid-feedback warning-phone"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" value="">
									<div class="invalid-feedback warning-email"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Username</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="username" value="">
									<div class="invalid-feedback warning-username"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Katasandi</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least 1 number & 1 uppercase or lowercase & 1 special Character & 8 or more characters" value="">
									<div class="invalid-feedback warning-password"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Konfirmasi Katasandi</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="passconf" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least 1 number & 1 uppercase or lowercase & 1 special Character & 8 or more characters" value="">
									<div class="invalid-feedback warning-passconf"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Foto</label>
								<div class="col-md-9">
									<input type="file" class="dropify" id="photo" name="photo">
									<div class="invalid-feedback warning-photo"></div>
									<br>
									<label class=" col-form-label" style="color:red;">*Size Foto 470 x 658 (jpg/jpeg/png)</label>
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
	<div class="modal-dialog" role="document" style="margin-right:700px;">
		<div class="modal-content" style="width:1200px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" id="id" name="id_user" value="">
				<div class="modal-body">
					<br>
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Role</label>
								<div class="col-md-9">
									<select class="form-control " id="roleEdit" name="role" style="width:100%">
										<option value="">Pilih Role</option>
										<?php foreach($roles as $role):?>
										<option value="<?= $role->id_role; ?>"><?= $role->nama_role; ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-role"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker</label>
								<div class="col-md-9">
									<select class="form-control " id="satkerEdit" name="satker" style="width: 100%;">
										<option selected="selected" value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker):?>
										<option value="<?= $satker->id_satker; ?>"><?= $satker->nama_satker; ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Pegawai</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="nameEdit" name="name" value="">
									<div class="invalid-feedback warning-name"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pangkat</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="pangkatEdit" name="pangkat" value="">
									<div class="invalid-feedback warning-pangkat"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">NRP</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="nrpEdit" name="nrp" value="">
									<div class="invalid-feedback warning-nrp"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-3 col-form-label">No.Telp</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="phoneEdit" name="phone" value="">
									<div class="invalid-feedback warning-phone"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" id="emailEdit" name="email" value="">
									<div class="invalid-feedback warning-email"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Dapatkan Notifikasi</label>
								<div class="col-md-9">
									<input type="checkbox" class="form-control" id="notifableEdit" style="width:20px;" name="notifable">
									<div class="invalid-feedback warning-notifable"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Username</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="usernameEdit" name="username" value="">
									<div class="invalid-feedback warning-username"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Ganti Password</label>
								<div class="col-md-9">
									<input type="checkbox" class="form-control" id="cekgantipassword" style="width:20px;" name="cekgantipassword">
									<div class="invalid-feedback warning-password"></div>
								</div>
							</div>
							<div id="hidegantipassword" style="display:none;">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Katasandi</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="passwordEdit" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least 1 number & 1 uppercase or lowercase & 1 special Character & 8 or more characters" value="">
									<div class="invalid-feedback warning-password"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Konfirmasi Katasandi</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="passconfEdit" name="passconf" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least 1 number & 1 uppercase or lowercase & 1 special Character & 8 or more characters" value="">
									<input type="password" class="form-control" style="display:none;" id="passconfEdit_old" name="passconf_old">
									<div class="invalid-feedback warning-passconf"></div>
								</div>
							</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Foto</label>
								<div class="col-md-9">
									<small style="color:red;">Ubah Foto</small>
									<input type="file" class="dropify" id="photoedit" name="photoedit">
									<input type="hidden" class="form-control-file" name="oldImage" value="">
									<br>
									<label class=" col-form-label" style="color:red;">*Size Foto 470 x 658 (jpg/jpeg/png)</label>
									<br>
									<img class="img-thumbnail mb-3" id="imagePreview" src="">
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="formDelete" method="POST" action="">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
					value="<?= $this->security->get_csrf_hash();?>">
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

<!-- Script -->
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#satker").select2({
        dropdownParent: $('#tambahdata')
    });

	$("#role").select2({
        dropdownParent: $('#tambahdata')
    });

	$("#roleEdit").select2({
        dropdownParent: $('#editModal')
    });

	$("#satkerEdit").select2({
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

	$('#addForm').submit(function(){
		var formData = new FormData();
		formData.append('csrf_al', $('input[name="csrf_al"]').val());
		formData.append('name', $('input[name="name"]').val());
		formData.append('pangkat', $('input[name="pangkat"]').val());
		formData.append('nrp', $('input[name="nrp"]').val());
		formData.append('satker', $('select[name="satker"]').val());
		formData.append('phone', $('input[name="phone"]').val());
		formData.append('email', $('input[name="email"]').val());
		formData.append('username', $('input[name="username"]').val());
		formData.append('password', $('input[name="password"]').val());
		formData.append('passconf', $('input[name="passconf"]').val());
		formData.append('role', $('select[name="role"]').val());
		// Attach file
		formData.append('photo', $('#photo')[0].files[0]); 
		$.ajax({
			type : "POST",
			url  : "user_management/store",
			dataType : "json",
			data : formData,
			processData: false,
			contentType: false,
			success: function(data){
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function(key, value) {
						$('.warning-'+key).html(value)
						$('.warning-'+key).show()
						if ($('input[name="'+key+'"]').val() == '') {
							$('input[name="'+key+'"]').addClass('is-invalid')
						}
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

	$('#editForm').submit(function () {
		var formData = new FormData();
		formData.append('csrf_al', $('input[name="csrf_al"]').val());
		formData.append('id_user', $('input[name="id_user"]').val());
		formData.append('name', $('#nameEdit').val());
		formData.append('pangkat', $('#pangkatEdit').val());
		formData.append('nrp', $('#nrpEdit').val());
		formData.append('satker', $('#satkerEdit').val());
		formData.append('phone', $('#phoneEdit').val());
		formData.append('email', $('#emailEdit').val());
		formData.append('username', $('#usernameEdit').val());

		if($('#cekgantipassword:checkbox:checked').length > 0)
		{
			formData.append('password', $('#passwordEdit').val());
			formData.append('passconf', $('#passconfEdit').val());
		}
		else
		{
			formData.append('password', "TidakEdit");
			formData.append('passconf', "TidakEdit");
			formData.append('pass_old', $('#passconfEdit_old').val());
		}

		formData.append('role', $('#roleEdit').val());
		if ($('#notifableEdit').is(":checked")) {
			formData.append('notifable', 1);
		}else{
			formData.append('notifable', 0);
		}
		// Attach file
		formData.append('photo', $('#photoedit')[0].files[0]);
		$.ajax({
			type: "POST",
			url: "user_managements/update",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data)
				if (data[0].status == 0) {
					$('input[name="csrf_al"]').val(data[0].csrf)
					$.each(data[1], function (key, value) {
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
				console.log(data)
			}
		});
		return false;
	});

	$('#editModal').on('hidden.bs.modal', function (e) {
		$('input').val('');
		$('select').find('option:selected').removeAttr('selected');
		$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
	});

    $('#cekgantipassword').change(function() {
        if(this.checked) 
		{
            var returnVal = confirm("Apakah yakin akan mengganti password ?!");
			if(returnVal == true)
			{
				$(this).prop("checked", true);
				$('#hidegantipassword').show();
			}

			if(returnVal == false)
			{
				$(this).prop("checked", false);
				$('#hidegantipassword').hide();
			}
        }
		else
		{
			$('#hidegantipassword').hide();
		}     
    });
});

	function editModal(id){
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'user_management/'+id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function(data){
				$('select[name=satker]').find('option:selected').removeAttr('selected');
				$('select[name=role]').find('option:selected').removeAttr('selected');
				$('input[name="id_user"]').val(id);
				$('input[name="name"]').val(data.user.nama_pegawai);
				$('input[name="pangkat"]').val(data.user.pangkat);
				$('input[name="nrp"]').val(data.user.nrp);
				$('input[name="phone"]').val(data.user.phone);
				$('input[name="email"]').val(data.user.email);
				$('input[name="username"]').val(data.user.username);
				$('input[name="oldImage"]').val(data.user.photo);
				//$('input[name="password"]').val(data.user.password);
				//$('input[name="passconf"]').val(data.user.password);
				$('input[name="passconf_old"]').val(data.user.password);
				$('#imagePreview').attr('src',`<?= base_url();?>/uploads/users/`+data.user.photo);
				if (data.user.notifable == 1) {
					$('input[name="notifable"]').attr('checked',true);
				}else{
					$('input[name="notifable"]').attr('checked',false);
				}
				//$("select[name=satker] option[value="+data.user.id_satker+"]").attr('selected','selected');
				//$("select[name=role] option[value="+data.user.id_role+"]").attr('selected','selected');

				$("#satkerEdit").val(data.user.id_satker);
				$("#roleEdit").val(data.user.id_role);
				
				$("#satkerEdit").trigger('change');
				$("#roleEdit").trigger('change');
			},
			error: function(){
				alert('Could not displaying data');
			}           
		});
	}

	function deleteConfirm(id,content){
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>'+content+'</b>');
		$('#formDelete').attr('action', 'user_management/'+id+'/delete');
		$('#deleteModal').modal();
	}

	function doSubmit(id){
		$('#notifStatus'+id).toggleClass('text-success');
		$('#notifClass'+id).toggleClass('typcn-volume-up typcn-volume-mute');
		var checkBoxes = $("#notifable"+id);
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
		if (checkBoxes.is(":checked")) {
			checkBoxes.val(1)
		}else{
			checkBoxes.val(0)
		}

		$('#notifableForm'+id).submit();
	}

</script>
