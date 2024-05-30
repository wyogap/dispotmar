<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Monitoring Produksi Ketahanan Pangan</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card overflow-hidden">
				<div class="card-body">
					<form method="GET" id="search" action="<?= site_url() ?>dashboard3">
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
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard3" class="side-menu">Hapus Filter</a></button>
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
		<div class="col-xl-12 col-md-12 col-lg-12"  style="height: 75px">
		<div class="card bg-dark1">
				<div class="comodity-marquee">
					<?php foreach($komoditasList as $komoditas): ?>
						<span class="bg-dark1">
							<div class="row">
								<div class="d-flex">
									<div class="ml-3">
										<p class="text-white mb-1 fs-12">
											<?= $komoditas->nama_komoditas ?>
										</p>
										<div class="h5 m-0 fs-14 text-warning">
											<?= number_format($komoditas->total,2,".",".") . ' ' . $komoditas->nama_satuan  ?>
										</div>
									</div>
								</div>
							</div>
						</span>
					<?php endforeach ?>
					<span class="bg-dark1">
						<div class="row">
							<div class="d-flex">
								<div class="ml-3">
									<p class="text-white mb-1 fs-12">
									</p>
									<div class="h5 m-0 fs-14 text-warning">
									</div>
								</div>
							</div>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-3">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">Luas Lahan HA by Cluster</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="chart-wrapper">
						<canvas id="bar-chart-horizontal"
							class="h-188 chartjs-render-monitor chart-dropshadow2"></canvas>
					</div>
				</div>
			</div>
			<br>
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">Estimasi Hasil by Komoditas</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="chart-wrapper">
						<canvas id="bar-chart-horizontal2"
							class="chartjs-render-monitor chart-dropshadow2" ></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-9 col-md-9">
			<div class="card mb-0">
				<div class="card-body">
					<div class="">
						<div class="table-responsive">
							<table id="tbl-rekap" class="table card-table table-striped text-nowrap table-bordered">
								<thead class="border-top bg-info">
									<tr class="color-white">
										<th>Satker</th>
										<th>Luas Lahan HA</th>
										<th>Estimasi Panen</th>
										<th>Estimasi Hasil</th>
										<th>Satuan</th>
										<th>Komoditas</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($rekapPangan as $pangan): ?>
									<tr>
										<td><?= $pangan->nama_satker ?></td>
										<td><?= $pangan->luas_lahan ?></td>
										<td><?= date('d-M-Y',strtotime($pangan->estimasi_panen)) ?></td>
										<td><?= number_format($pangan->estimasi_hasil,2,'.','.') ?></td>
										<td><?= $pangan->nama_satuan ?></td>
										<td><?= $pangan->nama_komoditas ?></td>
									</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<td>Total</td>
										<td id="luasLahanTotal"></td>
										<td></td>
										<td id="estimasiHasilTotal"></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>
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

		$(".comodity-marquee").liMarquee({
			direction: 'left',	
			loop:-1,			
			scrolldelay: 10,		
			scrollamount:120,	
			circular: true,		
			drag: true			
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

	function numberWithCommas(x) {
		var parts = x.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		
		return parts.join(".");
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

		var dynamicColors = function() {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getComodityResult?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&kotama=<?= $this->input->get('kotama') ?>&progres=<?= $this->input->get('progres') ?>&satker=<?= $this->input->get('satker') ?>&komoditas=<?= $this->input->get('komoditas') ?>",
			dataType: "json",
			success: function (response) {
				//console.log(response)
				const canvas = document.getElementById("bar-chart-horizontal2");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak",10,50);
					ctx.fillText("Ditemukan",10,70);
				}else{
					var bacgrounds = [];
					
					$.each(response.labels, function(index, value){
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height',response.labels.length*50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Estimasi Hasil",
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
					var replacer= numberWithCommas($('#luasLahanTotal').text());
					//console.log(replacer);
					$('#luasLahanTotal').text(replacer);

					var replacer1= numberWithCommas($('#estimasiHasilTotal').text());
					//console.log(replacer1);
					$('#estimasiHasilTotal').text(replacer1);
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getClusterResult?tmt=<?= $this->input->get('tmt') ?>&panen=<?= $this->input->get('panen') ?>&satker=<?= $this->input->get('satker') ?>&progres=<?= $this->input->get('progres') ?>",
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
					$.each(response.labels, function(index, value){
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
	});
</script>
