<div class="section">
	<div class="page-header">
	    <div class="page-leftheader">
			<h4 class="page-title mb-0">Profil Kampung Bahari Nusantara</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row" id="aktivitas">
		<div class="col-md-8">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Aktifitas</h3>
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
                <div class="card-footer">
                <?php echo $this->pagination->create_links(); ?>
                </div>
			</div>
			
			<!-- <ul class="pagination justify-content-center">
				<li class="page-item page-prev disabled">
					<a class="page-link" href="#" tabindex="-1">Prev</a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item page-next">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul> -->
		</div>
		<div class="col-md-4">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<h3 class="card-title">Total Pelaporan Per Bulan</h3>
					<div class="card-options">
						<select class="form-control" style="height:32px;" name="years" id="years" style="width: 100%;">
						</select>
						&nbsp;&nbsp;
						<a href="#" style="margin-top:5px;" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" style="margin-top:5px;" class="card-options-fullscreen" id="bar-chart-horizontal-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<label id="flag-bar-chart-horizontal" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="bar-chart-laporanperbulan" style="height:500px;" class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- Row End-->
	<div class="row" id="galeri">
		<div class="col-md-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Galeri</h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
				</div>
			</div>
			
			<!-- <ul class="pagination justify-content-center">
				<li class="page-item page-prev disabled">
					<a class="page-link" href="#" tabindex="-1">Prev</a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item page-next">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul> -->
		</div>
	</div>

</div>


<div class="modal fade" id="detildataKerawanSosial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kerawanan Sosial</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="card-body">
			<div class="table-responsive">
						<table id="example" class="table table-striped  table-bordered key-buttons text-nowrap">
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

<div class="modal fade" id="detildataSatker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kerawanan Sosial</h5>
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
				<h5 class="modal-title" id="exampleModalLabel">Kerawanan Sosial</h5>
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

		$("#categoryReport-fullscreen").click(function() {

			if($("#flag-categoryReport").text() == "a")
			{
				$("#flag-categoryReport").text("b");
			}
			else
			{
				$("#flag-categoryReport").text("a");
				$("#categoryReport").height('500px');
			}
		});

		$("#bar-chart-horizontal-fullscreen").click(function() {

			if($("#flag-bar-chart-horizontal").text() == "a")
			{
				$("#flag-bar-chart-horizontal").text("b");
			}
			else
			{
				$("#flag-bar-chart-horizontal").text("a");
				$("#bar-chart-horizontal").height('500px');
			}
		});

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
		getCriminalActitivies();
		getDataPelaporanBarChart(2021);

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>api/getReportCategoryRankPieChart",
			dataType: "json",
			success: function (response) {
				// var chartData = [];
				// $.each(response.labels, function (index, value) {
				// 	chartData[index] = [value, parseInt(response.total[index])];
				// })

				// c3.generate({
				// 	bindto: '#categoryReport', // id of chart wrapper
				// 	data: {
				// 		columns: chartData,
				// 		type: 'pie', // default type of chart
				// 	},
				// 	tooltip: {
				// 		format: {
				// 			value: function (value, ratio, id) {
				// 				//return value+' ('+(ratio*100)+'%)';
				// 				//return value+' (Laporan)';
				// 				return value;
				// 			} 
				// 		}
				// 	},
				// 	axis: {},
				// 	legend: {
				// 		show: true, //hide legend
				// 	},
				// 	padding: {
				// 		bottom: 0,
				// 		top: 0
				// 	},
				// });

				const canvas = document.getElementById("categoryReport");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				
				if (response.labels.length == 0) {
					$("#categoryReport").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					let myChart = new Chart(canvas, {
						type: 'pie',
						data: {
							datasets: [{
								backgroundColor: bacgrounds,
								data: ConvertResponseTotal, //response.total,
							}],
							labels: response.labels,
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: true,
								position: "bottom",
								labels: {
									usePointStyle: true,
								},
							},
							title: {
								display: false,
								text: 'Normal Legend'
							},
							tooltips: {
  								callbacks: {
    							label: function(tooltipItem, data) {
	  								//caption	                       
	  								var idx = tooltipItem['index'];           
	  								var caption = data.labels[idx];  
      								//get the concerned dataset
      								var dataset = data.datasets[tooltipItem.datasetIndex];
      								//calculate the total of this data set
      								var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        								return previousValue + currentValue;
      								});
      								//get the current items value
      								var currentValue = dataset.data[tooltipItem.index];
      								//calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      								var percentage = (currentValue * 100 / total).toFixed(2); //Math.floor(((currentValue/total) * 100)+0.5);

      								return ' ' + caption + ' : ' + percentage + '%';
   									}
  								}
							},
							plugins: {
      							datalabels: {
									display: true,
									anchor: 'end',
        							align: 'start',
        							offset: 10,
									formatter: (value, ctx) => {
										let sum = 0;
										let dataArr = ctx.chart.data.datasets[0].data;
										dataArr.map(data => {
											sum += data;
										});
										let percentage = (value * 100 / sum).toFixed(2)+"%";
										return percentage;
									},
									color: '#fff',
									font: {
          								size: '14'
       								},
								}
							}
						},
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>api/getdatabyyear",
			dataType: "json",
			success: function (data) {
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value='+data[i].tahun+'>'+data[i].tahun+'</option>';
				}
				$('#years').html(html);
			}
		});
	});

	function getDataPelaporanBarChart(year){
		
		var dynamicColorss = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>api/getDataByMonth/" + year,
			dataType: "json",
			success: function (response) {
				var labels = [],totals = [],bacgrounds = [];
				var canvas = null;

				$.each(response, function (index, value) {
					labels.push(index);
					totals.push(value);
					bacgrounds.push(dynamicColorss())
				})

				canvas = document.getElementById("bar-chart-horizontal");
				var chart5;

				if (window.chart5 != undefined) {
					window.chart5.destroy();
				}
					window.chart5 = new Chart(canvas, {
					type: 'horizontalBar',
					data: {
						labels: labels,
						datasets: [{
							label: "Traffic Source",
							backgroundColor: bacgrounds,
							data: totals,
						}]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						tooltips: {
							mode: 'index',
							titleFontSize: 12,
							titleFontColor: '#000',
							bodyFontColor: '#000',
							backgroundColor: '#fff',
							cornerRadius: 3,
							intersect: false,
							position: 'average',
            				yAlign: 'top',
            				xAlign: 'right',

						},
						legend: {
							display: false,
							labels: {
								usePointStyle: true,
							},
						},
						scales: {
							xAxes: [{
								barPercentage: 0.2,
								barSpacing: 3,
								ticks: {
									fontColor: "#8e9cad",
								},
								display: true,
								gridLines: {
									display: true,
									color: 'rgb(142, 156, 173,0.1)',
									drawBorder: false
								},
								scaleLabel: {
									display: false,
									labelString: 'Month',
									fontColor: '#8492a6 '
								}
							}],
							yAxes: [{
								barPercentage: 1,
								barSpacing: 2,
								ticks: {
									fontColor: "#8e9cad",
								},
								display: true,
								gridLines: {
									display: true,
									color: 'rgb(142, 156, 173,0.1)',
									drawBorder: false
								},
								scaleLabel: {
									display: false,
									labelString: 'sales',
									fontColor: '#8492a6 '
								}
							}]
						},
						"hover": {
              					"animationDuration": 0
            				},
							"animation": {
                			"duration": 1,
              				"onComplete": function() {
                				var chartInstance = this.chart,
                 				ctx = chartInstance.ctx;
 
                				ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
               					ctx.textAlign = 'bottom';
                				ctx.textBaseline = 'top';
 
                				this.data.datasets.forEach(function(dataset, i) {
                  				var meta = chartInstance.controller.getDatasetMeta(i);
                  				meta.data.forEach(function(bar, index) {
                    			var data = dataset.data[index];
                    			ctx.fillText(data, bar._model.x + 5, bar._model.y - 5);
                  				});
               					});
              				}
           	 			},
						title: {
							display: false,
							text: 'Normal Legend'
						},
						plugins: {
      							datalabels: {
									display: false,
								}
						}
					}
				});
			}
		});
	}

	function getMainActitivies(){
		$.ajax({
			url   : "<?= site_url()?>api/getAllActivity/<?= $this->uri->segment($this->uri->total_segments()) ?>",
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

	function getCriminalActitivies(){
		$.ajax({
			url   : "<?= site_url()?>api/getCriminalsActivity",
			type  : 'GET',
			async : true,
			dataType : 'json',
			success : function(data){
				var html = '';
				var total = '';
				var count = 0;
				var i;
				if (data.length == 0) {
					html = '<div class="wrapper w-100 text-center"><h3 class="text-muted">Data Laporan Belum Tersedia</h3></div>'
				}else{
					for(i=0; i<data.length; i++){
						count = count + 1;
						html += '<div class="wrapper w-100">'+
									'<p class="mb-2"><a href="#" class=""><span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
									' melaporkan '+data[i].what+' di '+data[i].where+', '+data[i].KELURAHAN+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a></p>'+
									'<div class="d-flex justify-content-between align-items-center ">'+
										'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
									'</div>'+
								'</div>';
						total = '<h1 style="padding-top:20px;">' + count + '</h1>';
					}
				}
				$('#criminals').html(html);
				$('#totalcriminals').html(total);
			}

		});
	}

	function detildataKerawanSosial(value1, value2) {
		$.ajax({
			type: "GET",
			url : "<?= site_url() ?>api/getActivitySosialBySatkerAndActivityType/" + value1 + "/" + value2,
			dataType : 'json',
			success: function (datas) {
			var counter = 1
			var values = ''

			$('#example').empty();
			$('#example').DataTable().destroy();
			for(i=0; i<datas.length; i++){
			counter = counter + i
			values = datas[i].id_activity_sosial

			var table = $('#example').DataTable();
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
			// "<a href='<?= site_url()?>data_pelaporan/<?= encrypt('25');?>/show'><i class='fa fa-eye'></i></a>",
            ]).draw();
			}
		    $("tbody").addClass("text-center");
			}
		});
	}

	function detildataSatker(value1) {
		$.ajax({
			type: "GET",
			url : "<?= site_url() ?>api/getActivitySosialBySatker/" + value1,
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
			url : "<?= site_url() ?>api/getActivitySosialByPersonal/" + value1,
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
