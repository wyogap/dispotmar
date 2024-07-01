<style>
	.ukuran-search {
		font-size: 12px;
	}

</style>

<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo $title ?></h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 150px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 140px">
					<form method="GET" id="search" action="<?= site_url() ?>dashboard7">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group row">
									<div class="col-md-3 col-form-label">
										<span class="ukuran-search">
											KOTAMA
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select2-show-search border-bottom-0 br-md-0" 
											name="kotama" id="kotama">
										<option value="">Pilih Kotama</option>
											<?php foreach($kotama as $kot): ?>
											<option
												<?= $this->input->get('kotama') == $kot->id_satker ? 'selected' : '' ?>
												value="<?= $kot->id_satker ?>"><?= $kot->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row">
									<div class="col-md-3 col-form-label">
										<span class="ukuran-search">
											LANTAMAL
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select2-show-search border-bottom-0 br-md-0" 
												name="lantamal" id="lantamal">
										<option value="">Pilih Lantamal</option>
											<?php foreach($lantamal as $lan): ?>
											<option
												<?= $this->input->get('lantamal') == $lan->id_satker ? 'selected' : '' ?>
												value="<?= $lan->id_satker ?>"><?= $lan->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-3 col-form-label">
										<span class="ukuran-search">
											SATKER
										</span>
									</div>
									<div class="col-md-9">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"  
											name="lanal" id="lanal">
										<option value="">Pilih Satker</option>
											<?php foreach($satker as $sat): ?>
											<option
												<?= $this->input->get('lanal') == $sat->id_satker ? 'selected' : '' ?>
												value="<?= $sat->id_satker ?>"><?= $sat->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-0">
								<div class="form-group row">
									<div class="col-md-12">
										<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
							<br>
							<div class="col-md-1" style="display:none;" id="div_hapusfilter">
								<div class="form-group row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard7" class="side-menu">Hapus Filter</a></button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Row End-->
	<!-- row opened -->
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Jumlah Desa</p>
							<h2 class="mb-1"><?= $dataSummary->jumlah_penduduk?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Wilayah</p>
							<h2 class="mb-1"><?= $dataSummary->wilayah?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Satker</p>
							<h2 class="mb-1"><?= $dataSummary->satker?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

			<div class="col-xl-4 col-lg-4">
		</div>
	</div>
	<!-- row opened -->
	<div class="row">
		<div class="col-md-6" >
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Jumlah Desa Binaan By Lantamal</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="chart-lantamal-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						<label id="flag-chart-lantamal" style="display:none;">a</label>
					</div>
				</div>
				<div class="desabinaan-barchart" style="height:400px;" id="chart-lantamal_dev">
					<div class="card-body">
						<canvas id="chart-lantamal" class="chartjs-render-monitor chart-dropshadow2"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Jumlah Desa Binaan By Lanal</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
							class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="chart-satker-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						<label id="flag-chart-satker" style="display:none;">a</label>
					</div>
				</div>
				<div class="desabinaan-barchart" style="height:400px;" id="chart-satker_dev">
					<div class="card-body">
						<canvas id="chart-satker" class="chartjs-render-monitor chart-dropshadow2"></canvas>
					</div>
				</div>
			</div>
		</div>

	</div>
	<br>

	<!-- row opened -->
	<div class="row" style="display:none;" id="detail_div">
		<div class="col-md-6">
			<div class="card overflow-hidden">
				<div class="card-body" id="map-part">
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card mb-0" >
				<div class="card-header">
					<h4 class="card-title" id="table-title-part"></h4>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
							class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive" id="table-part">
					</div>
				</div>
			</div>
		<br>
		</div>
	</div>
	<!-- row closed -->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=mapLibReady"></script>
<script src="<?php echo base_url() ?>assets/js/map-util.js"></script>

<script>
	$(document).ready(function () {
		$("#kotama").select2();
		$("#lantamal").select2();
		$("#lanal").select2();

		var valkotama = getUrlVars()["kotama"];
		var vallantamal = getUrlVars()["lantamal"];
		var vallanal = getUrlVars()["lanal"];

		if(valkotama != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(vallantamal != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(vallanal != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}

		$("#kotama").change(function() {
			$("#search").submit();
		});
		$("#lantamal").change(function() {
			$("#search").submit();
		});

		$("#chart-lantamal-fullscreen").click(function() {
			if($("#flag-chart-lantamal").text() == "a")
			{
				$("#flag-chart-lantamal").text("b");
				$("#chart-lantamal_dev").height('auto');
			}
			else
			{
				$("#flag-chart-lantamal").text("a");
				$("#chart-lantamal_dev").height('400');
			}
		});

		$("#chart-satker-fullscreen").click(function() {
			if($("#flag-chart-satker").text() == "a")
			{
				$("#flag-chart-satker").text("b");
				$("#chart-satker_dev").height('auto');
			}
			else
			{
				$("#flag-chart-satker").text("a");
				$("#chart-satker_dev").height('400');
			}
		});

	});

	// Read a page's GET URL variables and return them as an associative array.
	function getUrlVars()
	{
   		var vars = [], hash;
   	 	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
   	 	for(var i = 0; i < hashes.length; i++)
  	  	{
  	      	hash = hashes[i].split('=');	
	        vars.push(hash[0]);
 	       	vars[hash[0]] = hash[1];
 	   	}
 	   	return vars;
	}

	function showDetailData(lantamal, lanal) {
		$('#detail_div').show();
		var detailUrl = "<?= site_url() ?>dashboard7/detail?lantamal=" + lantamal + "&lanal=" + lanal + "&is_partial=true";
		$.ajax({
			type: "GET",
			url: detailUrl,
			dataType: "json",
			success: function (response) {
				// console.log("response", response)
				$("#map-part").html(response['map-part']);
				$("#table-title-part").html(response['table-title-part']);
				$("#table-part").html(response['table-part']);
			}
		});
	}

	$(function (e) {
		'use strict'

		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}


		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/dashboard7/cart/2?kotama=<?= $this->input->get('kotama') ?>&lantamal=<?= $this->input->get('lantamal') ?>&lanal=<?= $this->input->get('lanal') ?>",
			dataType: "json",
			success: function (response) {
				//console.log('Lantamal', response);
				const canvas = document.getElementById("chart-lantamal");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.5rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak Ditemukan",10,50);
				} else {
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height', (response.labels.length*50) + 50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Desa",
								backgroundColor: bacgrounds,
								data: response.total,
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
              					"animationDuration": 1
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
							},
							onClick: (e, chartEvents) => {
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.id_satkers[_index];
									showDetailData(id_satker, "<?= $this->input->get('satkers') ?>")
								}
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/dashboard7/cart/3?kotama=<?= $this->input->get('kotama') ?>&lantamal=<?= $this->input->get('lantamal') ?>&lanal=<?= $this->input->get('lanal') ?>",
			dataType: "json",
			success: function (response) {
				// console.log("response", response)
				const canvas = document.getElementById("chart-satker");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.5rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak Ditemukan",10,50);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height', (response.labels.length*50) + 50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Desa",
								backgroundColor: bacgrounds,
								data: response.total,
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
              					"animationDuration": 1
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
							},
							onClick: (e, chartEvents) => {
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.id_satkers[_index];
									showDetailData('', id_satker)
								}
							}
						}
					});
				}
			}
		});
		
	});
</script>
