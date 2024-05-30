<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Organisasi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Personel</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Data Personel</div>
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
									<th>Opsi</th>
									<th>No</th>
									<th>Satker</th>
									<th>Level</th>
									<th>Perwira</th>
									<th>Bintara</th>
									<th>Tamtama</th>
									<th>Jumlah Personel</th>
									<th>Struktur</th>
									<th>Tgl Update</th>
									<th>Updated By</th>
									<th>Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($personels as $personel): ?>
								<tr>
									<td class="text-center">
									<?php if(policy('ORG','update')): ?>
										<button onclick="editModal(`<?= encrypt($personel->id_personel); ?>`)" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
									<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $personel->nama_satker ?></td>
									<td><?= $personel->level ?></td>
									<td><?= $personel->perwira ?></td>
									<td><?= $personel->bintara ?></td>
									<td><?= $personel->tamtama ?></td>
									<td><?= $personel->jumlah_personel ?></td>
									<td><?= ucwords(str_replace('_',' ',$personel->struktur)) ?></td>
									<td><?= date('d-M-Y',strtotime($personel->updated_date)) ?></td>
									<td><?= $personel->nama_pegawai ?></td>
									<td><?= $personel->LastUpdated ?></td>
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

<!-- Edit Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
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
								<label class="col-md-3 col-form-label" for="perwira">Perwira</label>
								<div class="col-md-9">
									<input type="number" id="perwira" name="perwira" class="form-control">
									<div class="invalid-feedback warning-perwira"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="bintara">Bintara</label>
								<div class="col-md-9">
									<input type="number" id="bintara" name="bintara" class="form-control">
									<div class="invalid-feedback warning-bintara"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="tamtama">Tamtama</label>
								<div class="col-md-9">
									<input type="number" id="tamtama" name="tamtama" class="form-control">
									<div class="invalid-feedback warning-tamtama"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah">Jumlah</label>
								<div class="col-md-9">
									<input type="number" id="jumlah" name="jumlah" class="form-control" readonly>
									<div class="invalid-feedback warning-jumlah"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="struktur">Struktur</label>
								<div class="col-md-9">
									<select class="form-control" name="struktur" id="struktur" style="width:100%;">
										<option value="">Pilih</option>
										<option value="dalam struktur">Dalam Struktur</option>
										<option value="luar struktur">Luar Struktur</option>
									</select>
									<div class="invalid-feedback warning-struktur"></div>
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
<script>
$(document).ready(function(){
	$("#struktur").select2({
		dropdownParent: $('#editModal')
	});
	$('input').on('keyup change', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
		const total = parseInt($('#perwira').val())+parseInt($('#bintara').val())+parseInt($('#tamtama').val())
		$('#jumlah').val(total)
	});
	$('select').on('change', function(){
		var name = $(this).attr('name')
		$('select[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
	});
	$('#editForm').submit(function(){
		$.ajax({
			type : "POST",
			url  : "organisasi_satker_personel/update",
			dataType : "json",
			data : $(this).serialize(),
			success: function(data){
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
	$('#editModal').on('hidden.bs.modal', function (e) {
		$('input').val('');
		$('select').val('');
		$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
	});
});

function editModal(id){
	$('#editModal').modal();
	$.ajax({
        type: 'ajax',
        method: 'GET',
        url: 'organisasi_satker_personel/'+id,
        data: {
			id: id
		},
        dataType: 'json',
        success: function(data){
			$('select[name=struktur]').find('option:selected').removeAttr('selected');
            $('input[name="id"]').val(id);
            $('input[name="perwira"]').val(data.personel.perwira);
            $('input[name="bintara"]').val(data.personel.bintara);
            $('input[name="tamtama"]').val(data.personel.tamtama);
            $('input[name="jumlah"]').val(data.personel.jumlah_personel);
			//$("select[name=struktur] option[value="+data.personel.struktur+"]").attr('selected','selected');
			$("#struktur").val(data.personel.struktur);
			
			$("#struktur").trigger('change');
        },
        error: function(){
            alert('Could not displaying data');
        }           
    });
}
</script>
