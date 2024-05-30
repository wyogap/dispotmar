<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Monitoring Status Ketahanan Pangan</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 180px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 170px">
					<form method="GET" id="search" action="<?= site_url() ?>dashboard2">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-6 col-form-label">
										<span>
											<i class="fa fa-calendar"></i> TMT PELAKSANAAN
										</span>
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control pull-right" name="tmt" id="tmt">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-6 col-form-label">
										<span>
											<i class="fa fa-calendar"></i> ESTIMASI PANEN
										</span>
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control pull-right" name="panen" id="panen">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
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
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Satker" name="satker" id="satker">
											<option value="">-- Pilih Satker --</option>
											<?php foreach($satkers as $satker): ?>
											<option
												<?= $this->input->get('satker') == $satker->id_satker ? 'selected' : '' ?>
												value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Komoditas" name="komoditas" id="komoditas">
											<option value="">-- Pilih Komoditas --</option>
											<?php foreach($komoditas as $komodita): ?>
											<option
												<?= $this->input->get('komoditas') == $komodita->id_komoditas ? 'selected' : '' ?>
												value="<?= $komodita->id_komoditas ?>"><?= $komodita->nama_komoditas ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Progress" name="progres" id="progres">
											<option value="">-- Pilih Progress --</option>
											<?php foreach($progress as $progres): ?>
											<option
												<?= $this->input->get('progres') == $progres->id_progres ? 'selected' : '' ?>
												value="<?= $progres->id_progres ?>"><?= $progres->nama_progres ?>
											</option>
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
							<div class="col-md-1" style="display:none;" id="div_hapusfilter">
								<div class="form-group row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard2" class="side-menu">Hapus Filter</a></button>
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
		<div class="col-md-5">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body text-center">
							<p class="mb-1">SATKER</p>
							<h2 class="mb-1">
								<?php if($selectedLanal): ?>
									<?= $selectedLanal->nama_satker ?>
								<?php else: ?>
									<?= $summaryPangan->totalSatker ?>
								<?php endif ?>
							</h2>
						</div>
					</div>
				</div><!-- col end -->
				<div class="col-md-6">
					<div class="card ">
						<div class="card-body text-center">
							<p class="mb-1">LAHAN BUDIDAYA (Ha)</p>
							<h2 class="mb-1">
								<?= number_format(($lahantidur[0]->budidaya) ? $lahantidur[0]->budidaya : 0,2,".",".")  ?>
							</h2>
						</div>
					</div>
				</div><!-- col end -->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body text-center">
							<p class="mb-1">LAHAN TIDUR (Ha)</p>
							<h2 class="mb-1">
								<?= number_format(($lahantidur[0]->lahan) ? $lahantidur[0]->lahan : 0,2,".",".")  ?>
							</h2>
						</div>
					</div>
				</div><!-- col end -->
				<div class="col-md-6">
					<div class="card ">
						<div class="card-body text-center">
							<p class="mb-1">KOMODITAS</p>
							<h2 class="mb-1"><?= $summaryPangan->totalKomoditas ?></h2>
						</div>
					</div>
				</div><!-- col end -->
			</div>
		</div>
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-4">
					<div class="card mb-0">
						<div class="card-header">
							<h5 class="card-title">Status Satker</h5>
							<div class="card-options ">
								<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
										class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-fullscreen" id="chartSatker-fullscreen" data-toggle="card-fullscreen"><i
										class="fe fe-maximize"></i></a>
								<label id="flag-chartSatker" style="display:none;">a</label>
							</div>
						</div>
						<div class="card-body" >
							<!-- <div style="height: 135px;" id="chartSatker" class="chartsh"></div> -->
    						<canvas style="height: 135px;" id="chartSatker"></canvas>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-0">
						<div class="card-header">
							<h5 class="card-title">Kluster</h5>
							<div class="card-options ">
								<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
										class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-fullscreen" id="chartCluster-fullscreen" data-toggle="card-fullscreen"><i
										class="fe fe-maximize"></i></a>
								<label id="flag-chartSatker" style="display:none;">a</label>
							</div>
						</div>
						<div class="card-body">
							<!-- <div style="height: 135px;" id="chartCluster" class="chartsh"></div> -->
    						<canvas style="height: 135px;" id="chartCluster"></canvas>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-0">
						<div class="card-header">
							<h5 class="card-title">Komoditas</h5>
							<div class="card-options ">
								<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
										class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-fullscreen" id="chartKomoditas-fullscreen" data-toggle="card-fullscreen"><i
										class="fe fe-maximize"></i></a>
								<label id="flag-chartKomoditas" style="display:none;">a</label>
							</div>
						</div>
						<div class="card-body">
							<!-- <div style="height: 135px;" id="chartKomoditas" class="chartsh"></div> -->
    						<canvas style="height: 135px;" id="chartKomoditas"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- row closed -->
	<br>
	<!-- row opened -->
	<div class="row">
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by KOTAMA</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<canvas id="bar-chart-horizontal" class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by SATKER</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<canvas id="bar-chart-horizontal2" class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by KOMODITAS</h5>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<canvas id="bar-chart-horizontal3" class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">ESTIMASI HASIL by KOMODITAS</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<canvas id="bar-chart-horizontal4" class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>

<script>
	$(document).ready(function () {
		$("#kotama").select2();
		$("#satker").select2();
		$("#komoditas").select2();
		$("#progres").select2();

		var valtmt = getUrlVars()["tmt"];
		var valpanen = getUrlVars()["panen"];
		var valkotama = getUrlVars()["kotama"];
		var valsatker = getUrlVars()["satker"];
		var valkomoditas = getUrlVars()["komoditas"];
		var valprogres = getUrlVars()["progres"];

		if(valtmt != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valpanen != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valkotama != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valsatker != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valkomoditas != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valprogres != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}

		$("#kotama").change(function() {
			$("#search").submit();
		});
		$("#satker").change(function() {
			$("#search").submit();
		});
		$("#komoditas").change(function() {
			$("#search").submit();
		});

		$("#chartSatker-fullscreen").click(function() {

			if($("#flag-chartSatker").text() == "a")
			{
				$("#flag-chartSatker").text("b");
			}
			else
			{
				$("#flag-chartSatker").text("a");
				$("#chartSatker").height('135px');
			}
		});
		
		$("#chartCluster-fullscreen").click(function() {

			if($("#flag-chartCluster").text() == "a")
			{
				$("#flag-chartCluster").text("b");
			}
			else
			{
				$("#flag-chartCluster").text("a");
				$("#chartCluster").height('135px');
			}
		});

		$("#chartKomoditas-fullscreen").click(function() {

			if($("#flag-chartKomoditas").text() == "a")
			{
				$("#flag-chartKomoditas").text("b");
			}
			else
			{
				$("#flag-chartKomoditas").text("a");
				$("#chartKomoditas").height('135px');
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
	
	$(function (e) {
		'use strict'

		$('#tmt').daterangepicker({
			autoUpdateInput: false,
			locale: {
				format: 'YYYY-MM-DD'
			}
		});
		$('#panen').daterangepicker({
			autoUpdateInput: false,
			locale: {
				format: 'YYYY-MM-DD'
			}
		});

		<?php if ($this->input->get('tmt')): ?>
			const tmtStart = "<?= explode(' ',$this->input->get('tmt'))[0] ?>"
			const tmtEnd = "<?= explode(' ',$this->input->get('tmt'))[2] ?>"
			$('#tmt').daterangepicker({
				locale: {
					format: 'YYYY-MM-DD'
				},
				startDate: tmtStart,
				endDate: tmtEnd
			});
		<?php endif ?>
		<?php if ($this->input->get('panen')): ?>
			const panenStart = "<?= explode(' ',$this->input->get('panen'))[0] ?>"
			const panenEnd = "<?= explode(' ',$this->input->get('panen'))[2] ?>"
			$('#panen').daterangepicker({
				locale: {
					format: 'YYYY-MM-DD'
				},
				startDate: panenStart,
				endDate: panenEnd
			});
		<?php endif ?>

		$('#tmt').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});
		$('#panen').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});

		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getAreaByKotama?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				
				const canvas = document.getElementById("bar-chart-horizontal");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak",10,50);
					ctx.fillText("Ditemukan",10,70);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height',response.labels.length*50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Luas",
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
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getAreaBySatker?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				const canvas = document.getElementById("bar-chart-horizontal2");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak",10,50);
					ctx.fillText("Ditemukan",10,70);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height',response.labels.length*50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Luas",
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
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getAreaByComodity?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				const canvas = document.getElementById("bar-chart-horizontal3");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak",10,50);
					ctx.fillText("Ditemukan",10,70);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height',response.labels.length*50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Luas",
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
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getEstimateByComodity?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				const canvas = document.getElementById("bar-chart-horizontal4");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak",10,50);
					ctx.fillText("Ditemukan",10,70);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height',response.labels.length*50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Estimasi",
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
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getPanganProgress?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				// if (response.labels.length == 0) {
				// 	$("#chartSatker").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// }else{
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#chartSatker', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 		},
				// 		options: {
            	// 			responsive: true,
        		// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		},
				// 	});
				// }

				const canvas = document.getElementById("chartSatker");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				var SortConvertResponseTotal = ConvertResponseTotal.sort(function(a, b){return a - b});
				
				if (response.labels.length == 0) {
					$("#chartSatker").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
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
								data: SortConvertResponseTotal, //response.total,
							}],
							labels: response.labels,
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false,
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
			url: "<?= site_url() ?>/api/getClusterPieChart?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				// if (response.labels.length == 0) {
				// 	$("#chartCluster").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// }else{
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#chartCluster', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		},
				// 	});
				// }

				const canvas = document.getElementById("chartCluster");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				
				if (response.labels.length == 0) {
					$("#chartCluster").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
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
								display: false,
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
			url: "<?= site_url() ?>/api/getComodityPieChart?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				// if (response.labels.length == 0) {
				// 	$("#chartKomoditas").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// }else{
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#chartKomoditas', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		},
				// 	});
				// }

				const canvas = document.getElementById("chartKomoditas");
				var ConvertResponseTotal = response.total.map(i=>Number(i));

				if (response.labels.length == 0) {
					$("#chartKomoditas").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
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
								display: false,
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
	});
</script>
