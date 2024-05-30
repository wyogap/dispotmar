<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">MONITORING STATUS KETAHANAN PANGAN</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 90px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 80px">
					<form method="GET" action="data_pelaporan">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<button type="button" class="btn btn-default" id="daterange-btn1">
										<span>
											<i class="fa fa-calendar"></i> TMT PELAKSANAAN
										</span>
										<i class="fa fa-caret-down"></i>
									</button>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<button type="button" class="btn btn-default" id="daterange-btn2">
										<span>
											<i class="fa fa-calendar"></i> ESTIMASI PANEN
										</span>
										<i class="fa fa-caret-down"></i>
									</button>
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
											data-placeholder="Pilih Progress" name="satker" id="satker">
											<option value="">-- Pilih Progress --</option>
											<!--ambil data dari mst_pangan_progres -->
											<option value=""></option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group row">
									<div class="col-md-12">
										<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
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
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Status Satker</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div id="chart-pie" class="chartsh"></div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Kluster</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div id="chart-pie2" class="chartsh"></div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Komoditas</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div id="chart-pie3" class="chartsh"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
<br>
	<!-- row opened -->
	<div class="row">
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by KOTAMA</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal"
							class="h-188 chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by SATKER</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal2"
							class="h-188 chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">LUAS LAHAN HA by KOMODITAS</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal3"
							class="h-188 chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">ESTIMASI HASIL  by KOMODITAS</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal4"
							class="h-188 chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(function (e) {
		'use strict'

		/* Chartjs (#bar-chart-horizontal) */
		new Chart(document.getElementById("bar-chart-horizontal"), {
			type: 'horizontalBar',
			data: {
				labels: ["Organic", "Direct", "Campagion"],
				datasets: [{
					label: "Traffic Source",
					backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
						"rgba(9, 176, 236,0.7)"
					],
					data: [5478, 2267, 934, ],
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
				title: {
					display: false,
					text: 'Normal Legend'
				}
			}
		});
		/* Chartjs (#bar-chart-horizontal) closed */

		/* Chartjs (#bar-chart-horizontal) */
		new Chart(document.getElementById("bar-chart-horizontal2"), {
			type: 'horizontalBar',
			data: {
				labels: ["Organic", "Direct", "Campagion"],
				datasets: [{
					label: "Traffic Source",
					backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
						"rgba(9, 176, 236,0.7)"
					],
					data: [5478, 2267, 934, ],
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
				title: {
					display: false,
					text: 'Normal Legend'
				}
			}
		});
		/* Chartjs (#bar-chart-horizontal) closed */
		
		/* Chartjs (#bar-chart-horizontal) */
		new Chart(document.getElementById("bar-chart-horizontal3"), {
			type: 'horizontalBar',
			data: {
				labels: ["Organic", "Direct", "Campagion"],
				datasets: [{
					label: "Traffic Source",
					backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
						"rgba(9, 176, 236,0.7)"
					],
					data: [5478, 2267, 934, ],
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
				title: {
					display: false,
					text: 'Normal Legend'
				}
			}
		});
		/* Chartjs (#bar-chart-horizontal) closed */

		/* Chartjs (#bar-chart-horizontal) */
		new Chart(document.getElementById("bar-chart-horizontal4"), {
			type: 'horizontalBar',
			data: {
				labels: ["Organic", "Direct", "Campagion"],
				datasets: [{
					label: "Traffic Source",
					backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
						"rgba(9, 176, 236,0.7)"
					],
					data: [5478, 2267, 934, ],
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
				title: {
					display: false,
					text: 'Normal Legend'
				}
			}
		});
		/* Chartjs (#bar-chart-horizontal) closed */

		var chart = c3.generate({
			bindto: '#chart-pie', // id of chart wrapper
			data: {
				columns: [
					// each columns data
					['data1', 63],
					['data2', 44],
					['data3', 12]
				],
				type: 'pie', // default type of chart
				colors: {
					data1: '#2205bf',
					data2: '#0099ff',
					data3: '#ff1a1a',
				},
				names: {
					// name of each serie
					'data1': 'Persiapan Lahan',
					'data2': 'Proses',
					'data3': 'Terlaksana',
				}
			},
			axis: {},
			legend: {
				show: false, //hide legend
			},
			padding: {
				bottom: 0,
				top: 0
			},
		});
		/*chart-pie*/
		var chart = c3.generate({
			bindto: '#chart-pie2', // id of chart wrapper
			data: {
				columns: [
					// each columns data
					['data1', 63],
					['data2', 40],
					['data3', 12],
					['data4', 14],
					['data5', 20],
					['data6', 29],
				],
				type: 'pie', // default type of chart
				colors: {
					'data1': '#2205bf',
					'data2': '#0099ff',
					'data3': '#ffb209',
					'data4': '#ff1a1a',
					'data5': '#64E572',
					'data6': '#6155ff',
				},
				names: {
					// name of each serie
					'data1': 'A',
					'data2': 'B',
					'data3': 'C',
					'data4': 'D',
					'data5': 'E',
					'data6': 'F'
				}
			},
			axis: {},
			legend: {
				show: false, //hide legend
			},
			padding: {
				bottom: 0,
				top: 0
			},
		});
		/*chart-pie*/
		var chart = c3.generate({
			bindto: '#chart-pie3', // id of chart wrapper
			data: {
				columns: [
					// each columns data
					['data1', 63],
					['data2', 44],
					['data3', 28]
				],
				type: 'pie', // default type of chart
				colors: {
					'data1': '#2205bf',
					'data2': '#0099ff',
					'data3': '#ffb209'
				},
				names: {
					// name of each serie
					'data1': 'A',
					'data2': 'B',
					'data3': 'C'
				}
			},
			axis: {},
			legend: {
				show: false, //hide legend
			},
			padding: {
				bottom: 0,
				top: 0
			},
		});
		/*chart-pie*/
		var chart = c3.generate({
			bindto: '#chart-pie4', // id of chart wrapper
			data: {
				columns: [
					// each columns data
					['data1', 58],
					['data2', 45],
					['data3', 20],
					['data4', 14]
				],
				type: 'pie', // default type of chart
				colors: {
					'data1': '#2205bf',
					'data2': '#0099ff',
					'data3': '#ffb209',
					'data4': '#ff1a1a'
				},
				names: {
					// name of each serie
					'data1': 'A',
					'data2': 'B',
					'data3': 'C',
					'data4': 'D'
				}
			},
			axis: {},
			legend: {
				show: false, //hide legend
			},
			padding: {
				bottom: 0,
				top: 0
			},
		});

		
	});

</script>
