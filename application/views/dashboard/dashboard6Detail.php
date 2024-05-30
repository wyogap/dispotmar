<div>

	<!-- Modal Header -->
	<div class="modal-header">
		<h4 class="modal-title"><?= $title?> - <?= $nama_satker?>  </h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>

	<!-- Modal body -->
	<div class="modal-body">
		<div class="table-responsive">
			<table id="table-geodemokonsos" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
				<thead>
					<th>No</th>
					<?php foreach($columns as $columnKey => $columnValue): ?>
						<th><?= $columnValue ?></th>
					<?php endforeach ?>
				</thead>
				<tbody>
					<?php $no=1; foreach($tableDatas as $tableData): ?>
					<tr>
						<td><?= $no++ ?></td>
						<?php foreach($columns as $columnKey => $columnValue): ?>
							<td><?= $tableData->{$columnKey} ?></td>
						<?php endforeach ?>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<br>
		</div>
	</div>

	<!-- Modal footer -->
	<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	</div>

</div>

<script>
	$(document).ready(function() {
    	$('#table-geodemokonsos').DataTable();
	} );
</script>