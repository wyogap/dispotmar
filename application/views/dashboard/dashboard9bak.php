<style>
	.ukuran-search{
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
		<div class="col-xl-12" style="height: 90px">
			<div class="card overflow-hidden">
			<div class="card-body" style="height: 80px">
					<form method="GET" action="<?= site_url() ?>dashboard3">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group row">
									<div class="col-md-4 col-form-label">
										<span class="ukuran-search">
											KOTAMA
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select w-100" name="level">
											<option  class="ukuran-search" value="1">Koarmada 1</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-4 col-form-label">
										<span  class="ukuran-search">
											LANTAMAL
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select w-100" name="level">
											<option  class="ukuran-search" value="1">Koarmada 1</option>
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
										<select class="form-control select w-100" name="level">
											<option class="ukuran-search" value="1">Koarmada 1</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-4 col-form-label">
										<span class="ukuran-search">
											JENIS PANTAI
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select w-100" name="level">
											<option class="ukuran-search" value="1">Koarmada 1</option>
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
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Jumlah Pantai</p>
							<!-- <h2 class="mb-1"><?= ($lahantidur[0]->total) ? $lahantidur[0]->total : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Wilayah</p>
							<!-- <h2 class="mb-1"><?= ($lahantidur[0]->budidaya) ? $lahantidur[0]->budidaya : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Satker</p>
							<!-- <h2 class="mb-1"><?= ($lahantidur[0]->lahan) ? $lahantidur[0]->lahan : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-info">
						<div class="card-body text-center">
							<p class="mb-1">Datar</p>
							<h2 class="mb-1">
								<?php if($this->input->get('satker')): ?>
									<?= $satkers2[0]->nama_satker ?>
								<?php else: ?>
									<?= count($satkers2) ?>
								<?php endif ?>
							</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<div class="card bg-info">
						<div class="card-body text-center">
							<p class="mb-1">Curam</p>
							<!-- <h2 class="mb-1"><?= ($personels[0]->totalPersonel) ? $personels[0]->totalPersonel : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-info">
						<div class="card-body text-center">
							<p class="mb-1">Landai</p>
							<!-- <h2 class="mb-1"><?= ($personels[0]->totalPersonel) ? $personels[0]->totalPersonel : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center">
							<p class="mb-1">Wisata</p>
							<!-- <h2 class="mb-1"><?= ($personels[0]->totalPerwira) ? $personels[0]->totalPerwira : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center">
							<p class="mb-1">Pasir Putih</p>
							<!-- <h2 class="mb-1"><?= ($personels[0]->totalBintara) ? $personels[0]->totalBintara : 0 ?></h2> -->
						</div>
					</div>
				</div>
				<!-- <div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center">
							<p class="mb-1">Tamtama</p>
							<h2 class="mb-1"><?= ($personels[0]->totalTamtama) ? $personels[0]->totalTamtama : 0 ?></h2>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- Row End-->


	<!-- row opened -->
	<div class="row">
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Sebaran Mangrove</h5>
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
		<div class="col-xl-8 col-lg-8">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Jumlah Pantai By Lantamal</h5>
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
	</div>
	<!-- row closed -->
<br>
	<!-- row opened -->
	<div class="row">
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Jumlah Pantai By Satker</h5>
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
		<div class="col-xl-8 col-lg-8">
		<div class="card mb-0">
				<div class="card-body">
					<div class="">
						<div class="table-responsive">
							<table id="tbl-rekap" class="table card-table table-striped text-nowrap table-bordered">
								<thead class="border-top bg-info">
									<tr class="color-white">
										<th>Nama Pantai</th>
										<th>Wilayah</th>
										<th>Jenis</th>
										<th>Panjang</th>
										<th>Ket</th>
										<!-- <th>Komoditas</th> -->
									</tr>
								</thead>
								<tbody>
									<?php foreach($rekapPangan as $pangan): ?>
									<tr>
										<td><?= $pangan->nama_satker ?></td>
										<td><?= $pangan->luas_lahan ?></td>
										<td><?= date('d-M-Y',strtotime($pangan->estimasi_panen)) ?></td>
										<td><?= $pangan->estimasi_hasil ?></td>
										<td><?= $pangan->nama_satuan ?></td>
										<!-- <td><?= $pangan->nama_komoditas ?></td> -->
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
