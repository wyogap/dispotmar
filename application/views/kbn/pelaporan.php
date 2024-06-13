<div class="section">
	<div class="page-header">
	<div class="page-leftheader">
			<h4 class="page-title mb-0"><?= $title ?></h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-md-8">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Activity Pelaporan</h3>
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
		<div class="col-md-4">
		<div class="card">
				<div class="card-header bg-lime">
					<h3 class="card-title">Top 5 Satker Teraktif</h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="users-images">
					<div class=" p-0">
						<div class="list-1 d-flex align-items-center border-bottom p-4">
							<div class="wrapper w-100 ml-4">
                                <?php if(empty($satkerRank)) { ?>
                                    <div class="mb-0 d-flex">Belum ada data</div>
                                <?php } else { ?>
                                    <?php foreach($satkerRank as $satker): ?>
                                    <div class="mb-0 d-flex">
                                        <div>
                                            <a href="" data-toggle="modal" data-target="#detildataSatker" onclick="detildataSatker(`<?= $satker->id_satker; ?>`)" class="mb-1 font-weight-semibold fs-15"><?= $satker->nama_satker ?></a>
                                        </div>
                                        <div class="ml-auto">
                                            <h5 class="mb-0 mt-0 text-primary"><?= $satker->total?> Pelaporan</h5>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                <?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bg-lime">
					<h3 class="card-title">Top 5 Personel Teraktif</h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="users-images">
					<div class=" p-0">
						<div class="list-1 d-flex align-items-center border-bottom p-4">
							<div class="wrapper w-100 ml-4">
                                <?php if(empty($personelRank)) { ?>
                                    <div class="mb-0 d-flex">Belum ada data</div>
                                <?php } else { ?>
                                    <?php foreach($personelRank as $personel): ?>
                                    <div class="mb-0 d-flex">
                                        <div>
                                            <a href="" data-toggle="modal" data-target="#detildataPersonel" onclick="detildataPersonel(`<?= $personel->id_user; ?>`)" class="mb-1 font-weight-semibold fs-15"><?= $personel->nama_pegawai ?></a>
                                        </div>
                                        <div class="ml-auto">
                                            <h5 class="mb-0 mt-0 text-primary"><?= $personel->total?> Pelaporan</h5>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                <?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

	</div>
	<!-- Row End-->

</div>

<div class="modal fade" id="detildataSatker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Aktivitas SKN Per Satker</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="card-body">
			<div class="table-responsive">
						<table id="example1" class="table table-striped  table-bordered key-buttons text-nowrap">
							<thead>
								<tr>
									<th style="width: 5%;" class="text-center">No</th>
									<th class="text-center">Satker</th>
									<th class="text-center">Jenis</th>
									<th class="text-center">Siapa</th>
									<th class="text-center">Apa</th>
									<th class="text-center">Kapan</th>
									<th class="text-center">Dimana</th>
									<th class="text-center">Mengapa</th>
									<th class="text-center">Bagaimana</th>
									<!-- <th class="text-center">Opsi</th> -->
								</tr>
							</thead>
							<tbody class="text-center">
							</tbody>
						</table>
						<br>
			</div>
								</div>
		</div>
	</div>
</div>

<div class="modal fade" id="detildataPersonel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Aktifitas SKN per Personal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="card-body">
			<div class="table-responsive">
						<table id="example2" class="table table-striped  table-bordered key-buttons text-nowrap">
							<thead>
								<tr>
									<th style="width: 5%;" class="text-center">No</th>
									<th class="text-center">Satker</th>
									<th class="text-center">Jenis</th>
									<th class="text-center">Siapa</th>
									<th class="text-center">Apa</th>
									<th class="text-center">Kapan</th>
									<th class="text-center">Dimana</th>
									<th class="text-center">Mengapa</th>
									<th class="text-center">Bagaimana</th>
									<!-- <th class="text-center">Opsi</th> -->
								</tr>
							</thead>
							<tbody class="text-center">
							</tbody>
						</table>
						<br>
			</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$(function (e) {

		'use strict'
		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$("#years").change(function() {
			var id= $(this).val();
			getDataPelaporanBarChart(id);
		});

		getMainActitivies();

	});


	function getMainActitivies(){
		$.ajax({
			url   : "<?= site_url()?>api/getKbnActivity/<?= $klaster ?>/<?= $this->uri->segment($this->uri->total_segments()) ?>",
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

	function detildataSatker(value1) {
		$.ajax({
			type: "GET",
			url : "<?= site_url() ?>api/getKbnActivityBySatker/<? echo $klaster ?>/" + value1,
			dataType : 'json',
			success: function (datas) {
			var counter = 1
			var values = ''

			$('#example1').empty();
			$('#example1').DataTable().destroy();
			for(i=0; i<datas.length; i++){
			counter = counter + i
			values = datas[i].id_activity_sosial

			var table = $('#example1').DataTable();
			table.row.add( 
			[
			i + 1,
			datas[i].nama_satker,
			datas[i].nama_jenis,
			datas[i].who,
			datas[i].what,
			datas[i].tgl,
			datas[i].where,
			datas[i].why,
			datas[i].how,
			// "<a href='<?= site_url()?>data_pelaporan/<?= encrypt('datas[i].id_activity_sosial');?>/show'><i class='fa fa-eye'></i></a>",
            ]).draw();
			}
		    $("tbody").addClass("text-center");
			}
		});
	}

	function detildataPersonel(value1) {
		$.ajax({
			type: "GET",
			url : "<?= site_url() ?>api/getKbnActivityByPersonel/<? echo $klaster ?>/" + value1,
			dataType : 'json',
			success: function (datas) {
				//console.log(datas)
			var counter = 1
			var values = ''

			$('#example2').empty();
			$('#example2').DataTable().destroy();
			for(i=0; i<datas.length; i++){
			counter = counter + i
			values = datas[i].id_activity_sosial

			var table = $('#example2').DataTable();
			table.row.add( 
			[
			i + 1,
			datas[i].nama_satker,
			datas[i].nama_jenis,
			datas[i].who,
			datas[i].what,
			datas[i].tgl,
			datas[i].where,
			datas[i].why,
			datas[i].how,
			// "<a href='<?= site_url()?>data_pelaporan/<?= encrypt('datas[i].id_activity_sosial');?>/show'><i class='fa fa-eye'></i></a>",
            ]).draw();
			}
		    $("tbody").addClass("text-center");
			}
		});
		$("tbody").addClass("text-center");
	}
	
</script>
