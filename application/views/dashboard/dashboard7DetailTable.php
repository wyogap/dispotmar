<table id="table-detail" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
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

<script>
	$(document).ready(function() {
    	$('#table-detail').DataTable();
	} );
</script>