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
		<div class="col-xl-12" style="height: 90px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 80px">
					<form method="GET" action="<?= site_url() ?>dashboard7">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group row">
									<div class="col-md-4 col-form-label">
										<span class="ukuran-search">
											KOTAMA
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select w-100" name="kotamas" id="kotamas">
										<option value="">-- Pilih Kotama --</option>
											<?php foreach($kotamas as $satker): ?>
											<option
												<?= $this->input->get('kotamas') == $satker->kode_satker ? 'selected' : '' ?>
												value="<?= $satker->kode_satker ?>"><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-4 col-form-label">
										<span class="ukuran-search">
											LANTAMAL
										</span>
									</div>
									<div class="col-md-8">
										<select class="form-control select w-100" name="Lantamal" id="lantamal">
										<option value="">-- Pilih Lantamal --</option>
											<?php foreach($lantamal as $satker): ?>
											<option
												<?= $this->input->get('Lantamal') == $satker->kode_satker ? 'selected' : '' ?>
												value="<?= $satker->kode_satker ?>"><?= $satker->nama_satker ?></option>
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
										<select class="form-control select w-100"  name="satkers" id="satkers">
										<option value="">-- Pilih Lanal --</option>
											<?php foreach($satkers as $satker): ?>
											<option
												<?= $this->input->get('satker') == $satker->kode_satker ? 'selected' : '' ?>
												value="<?= $satker->kode_satker ?>"><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
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
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="card bg-secondary">
						<div class="card-body text-center">
							<p class="mb-1">Jumlah Desa</p>
							<h2 class="mb-1"><?= $dataSummary->jumlah_mangrove?></h2>
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
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="mangrove-barchart">
					<div class="card-body">
						<canvas id="chart-lantamal"
								class="chartjs-render-monitor chart-dropshadow2"></canvas>
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
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="mangrove-barchart">
					<div class="card-body">
						<canvas id="chart-satker"
								class="chartjs-render-monitor chart-dropshadow2"></canvas>
					</div>
				</div>
			</div>
		</div>

	</div>
	<br>
	<div id="map-table-part">
	</div>
	<!-- row closed -->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {
		$("#kotamas").change(function() {
			$("#search").submit();
		});
		$("#lantamal").change(function() {
			$("#search").submit();
		});

	});

	function showDetailData(id_satker) {
		var detailUrl = "<?= site_url() ?>dashboard7/detail?id_satker=" + id_satker;
		//console.log("detailUrl", detailUrl)
		$.ajax({
			type: "GET",
			url: detailUrl,
			dataType: "html",
			success: function (response) {
				// console.log("response", response);
				// $("#table-detail-part").html(response);
				$("#map-table-part").html(response);
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
				//console.log("response", response)
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
							},
							onClick: (e, chartEvents) => {
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.id_satkers[_index];
									showDetailData(id_satker)
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
				//console.log("response", response)
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
							},
							onClick: (e, chartEvents) => {
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.kode_satker[_index];
									showDetailData(id_satker)
								}
							}
						}
					});
				}
			}
		});
		
	});







	// $(function (e) {
	// 	'use strict'
	// 	var dynamicColors = function () {
	// 		var r = Math.floor(Math.random() * 255);
	// 		var g = Math.floor(Math.random() * 255);
	// 		var b = Math.floor(Math.random() * 255);
	// 		return "rgb(" + r + "," + g + "," + b + ")";
	// 	}
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "<?= site_url() ?>/dashboard7/cart/2?kotama=<?= $this->input->get('kotama') ?>&lantamal=<?= $this->input->get('lantamal') ?>&lanal=<?= $this->input->get('lanal') ?>",
	// 		dataType: "json",
	// 		success: function (response) {
	// 			console.log("response", response)
	// 			const canvas = document.getElementById("chart-lantamal");

	// 			if (response.labels.length == 0) {
	// 				const ctx = canvas.getContext("2d");
	// 				ctx.font = "1.5rem 'Roboto', sans-serif";
	// 				ctx.fillStyle = '#8492a6';
	// 				ctx.fillText("Data Tidak Ditemukan",10,50);
	// 			} else {
	// 				var bacgrounds = [];
	// 				$.each(response.labels, function (index, value) {
	// 					bacgrounds.push(dynamicColors())
	// 				});

	// 				canvas.setAttribute('height', (response.labels.length*50) + 50)
	// 				/* Chartjs (#bar-chart-horizontal) */
	// 				new Chart(document.getElementById("bar-chart-horizontal"), {
	// 					type: 'horizontalBar',
	// 					data: {
	// 						labels: ["Organic", "Direct", "Campagion"],
	// 						datasets: [{
	// 							label: "Traffic Source",
	// 							backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
	// 								"rgba(9, 176, 236,0.7)"
	// 							],
	// 							data: [5478, 2267, 934, ],
	// 						}]
	// 					},
	// 					options: {
	// 						responsive: true,
	// 						maintainAspectRatio: false,
	// 						tooltips: {
	// 							mode: 'index',
	// 							titleFontSize: 12,
	// 							titleFontColor: '#000',
	// 							bodyFontColor: '#000',
	// 							backgroundColor: '#fff',
	// 							cornerRadius: 3,
	// 							intersect: false,

	// 						},
	// 						legend: {
	// 							display: false,
	// 							labels: {
	// 								usePointStyle: true,
	// 							},
	// 						},
	// 						scales: {
	// 							xAxes: [{
	// 								barPercentage: 0.2,
	// 								barSpacing: 3,
	// 								ticks: {
	// 									fontColor: "#8e9cad",
	// 								},
	// 								display: true,
	// 								gridLines: {
	// 									display: true,
	// 									color: 'rgb(142, 156, 173,0.1)',
	// 									drawBorder: false
	// 								},
	// 								scaleLabel: {
	// 									display: false,
	// 									labelString: 'Month',
	// 									fontColor: '#8492a6 '
	// 								}
	// 							}],
	// 							yAxes: [{
	// 								barPercentage: 1,
	// 								barSpacing: 2,
	// 								ticks: {
	// 									fontColor: "#8e9cad",
	// 								},
	// 								display: true,
	// 								gridLines: {
	// 									display: true,
	// 									color: 'rgb(142, 156, 173,0.1)',
	// 									drawBorder: false
	// 								},
	// 								scaleLabel: {
	// 									display: false,
	// 									labelString: 'sales',
	// 									fontColor: '#8492a6 '
	// 								}
	// 							}]
	// 						},
	// 						title: {
	// 							display: false,
	// 							text: 'Normal Legend'
	// 						},
	// 						onClick: (e, chartEvents) => {
	// 							if (chartEvents && chartEvents.length > 0) {
	// 								var chartEvent = chartEvents[0];
	// 								var _datasetIndex = chartEvent._datasetIndex
	// 								var _index = chartEvent._index
	// 								var id_satker = response.kode_satkers[_index];
	// 								showDetailData(id_satker)
	// 							}
	// 						}
	// 					}
	// 				});
	// 		/* Chartjs (#bar-chart-horizontal) closed */
	// 			}
	// 		}
	// 	});
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "<?= site_url() ?>/dashboard7/cart/3?kotama=<?= $this->input->get('kotama') ?>&lantamal=<?= $this->input->get('lantamal') ?>&lanal=<?= $this->input->get('lanal') ?>",
	// 		dataType: "json",
	// 		success: function (response) {
	// 			console.log("response", response)
	// 			const canvas = document.getElementById("chart-satker");

	// 			if (response.labels.length == 0) {
	// 				const ctx = canvas.getContext("2d");
	// 				ctx.font = "1.5rem 'Roboto', sans-serif";
	// 				ctx.fillStyle = '#8492a6';
	// 				ctx.fillText("Data Tidak Ditemukan",10,50);
	// 			}else{
	// 				var bacgrounds = [];
	// 				$.each(response.labels, function (index, value) {
	// 					bacgrounds.push(dynamicColors())
	// 				});

	// 				canvas.setAttribute('height', (response.labels.length*50) + 50)
	// 				/* Chartjs (#bar-chart-horizontal) */
	// 				new Chart(document.getElementById("bar-chart-horizontal2"), {
	// 					type: 'horizontalBar',
	// 					data: {
	// 						labels: ["Organic", "Direct", "Campagion"],
	// 						datasets: [{
	// 							label: "Traffic Source",
	// 							backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
	// 								"rgba(9, 176, 236,0.7)"
	// 							],
	// 							data: [5478, 2267, 934, ],
	// 						}]
	// 					},
	// 					options: {
	// 						responsive: true,
	// 						maintainAspectRatio: false,
	// 						tooltips: {
	// 							mode: 'index',
	// 							titleFontSize: 12,
	// 							titleFontColor: '#000',
	// 							bodyFontColor: '#000',
	// 							backgroundColor: '#fff',
	// 							cornerRadius: 3,
	// 							intersect: false,

	// 						},
	// 						legend: {
	// 							display: false,
	// 							labels: {
	// 								usePointStyle: true,
	// 							},
	// 						},
	// 						scales: {
	// 							xAxes: [{
	// 								barPercentage: 0.2,
	// 								barSpacing: 3,
	// 								ticks: {
	// 									fontColor: "#8e9cad",
	// 								},
	// 								display: true,
	// 								gridLines: {
	// 									display: true,
	// 									color: 'rgb(142, 156, 173,0.1)',
	// 									drawBorder: false
	// 								},
	// 								scaleLabel: {
	// 									display: false,
	// 									labelString: 'Month',
	// 									fontColor: '#8492a6 '
	// 								}
	// 							}],
	// 							yAxes: [{
	// 								barPercentage: 1,
	// 								barSpacing: 2,
	// 								ticks: {
	// 									fontColor: "#8e9cad",
	// 								},
	// 								display: true,
	// 								gridLines: {
	// 									display: true,
	// 									color: 'rgb(142, 156, 173,0.1)',
	// 									drawBorder: false
	// 								},
	// 								scaleLabel: {
	// 									display: false,
	// 									labelString: 'sales',
	// 									fontColor: '#8492a6 '
	// 								}
	// 							}]
	// 						},
	// 						title: {
	// 							display: false,
	// 							text: 'Normal Legend'
	// 						}
	// 					}
	// 				});
	// 				/* Chartjs (#bar-chart-horizontal) closed */
	// 			}
	// 		}
	// 	});
		

		// /* Chartjs (#bar-chart-horizontal) */
		// new Chart(document.getElementById("bar-chart-horizontal3"), {
		// 	type: 'horizontalBar',
		// 	data: {
		// 		labels: ["Organic", "Direct", "Campagion"],
		// 		datasets: [{
		// 			label: "Traffic Source",
		// 			backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
		// 				"rgba(9, 176, 236,0.7)"
		// 			],
		// 			data: [5478, 2267, 934, ],
		// 		}]
		// 	},
		// 	options: {
		// 		responsive: true,
		// 		maintainAspectRatio: false,
		// 		tooltips: {
		// 			mode: 'index',
		// 			titleFontSize: 12,
		// 			titleFontColor: '#000',
		// 			bodyFontColor: '#000',
		// 			backgroundColor: '#fff',
		// 			cornerRadius: 3,
		// 			intersect: false,

		// 		},
		// 		legend: {
		// 			display: false,
		// 			labels: {
		// 				usePointStyle: true,
		// 			},
		// 		},
		// 		scales: {
		// 			xAxes: [{
		// 				barPercentage: 0.2,
		// 				barSpacing: 3,
		// 				ticks: {
		// 					fontColor: "#8e9cad",
		// 				},
		// 				display: true,
		// 				gridLines: {
		// 					display: true,
		// 					color: 'rgb(142, 156, 173,0.1)',
		// 					drawBorder: false
		// 				},
		// 				scaleLabel: {
		// 					display: false,
		// 					labelString: 'Month',
		// 					fontColor: '#8492a6 '
		// 				}
		// 			}],
		// 			yAxes: [{
		// 				barPercentage: 1,
		// 				barSpacing: 2,
		// 				ticks: {
		// 					fontColor: "#8e9cad",
		// 				},
		// 				display: true,
		// 				gridLines: {
		// 					display: true,
		// 					color: 'rgb(142, 156, 173,0.1)',
		// 					drawBorder: false
		// 				},
		// 				scaleLabel: {
		// 					display: false,
		// 					labelString: 'sales',
		// 					fontColor: '#8492a6 '
		// 				}
		// 			}]
		// 		},
		// 		title: {
		// 			display: false,
		// 			text: 'Normal Legend'
		// 		}
		// 	}
		// });
		// /* Chartjs (#bar-chart-horizontal) closed */

		// /* Chartjs (#bar-chart-horizontal) */
		// new Chart(document.getElementById("bar-chart-horizontal4"), {
		// 	type: 'horizontalBar',
		// 	data: {
		// 		labels: ["Organic", "Direct", "Campagion"],
		// 		datasets: [{
		// 			label: "Traffic Source",
		// 			backgroundColor: ["rgba(34, 5, 191,0.7)", "rgba(255, 102, 0,0.7)",
		// 				"rgba(9, 176, 236,0.7)"
		// 			],
		// 			data: [5478, 2267, 934, ],
		// 		}]
		// 	},
		// 	options: {
		// 		responsive: true,
		// 		maintainAspectRatio: false,
		// 		tooltips: {
		// 			mode: 'index',
		// 			titleFontSize: 12,
		// 			titleFontColor: '#000',
		// 			bodyFontColor: '#000',
		// 			backgroundColor: '#fff',
		// 			cornerRadius: 3,
		// 			intersect: false,

		// 		},
		// 		legend: {
		// 			display: false,
		// 			labels: {
		// 				usePointStyle: true,
		// 			},
		// 		},
		// 		scales: {
		// 			xAxes: [{
		// 				barPercentage: 0.2,
		// 				barSpacing: 3,
		// 				ticks: {
		// 					fontColor: "#8e9cad",
		// 				},
		// 				display: true,
		// 				gridLines: {
		// 					display: true,
		// 					color: 'rgb(142, 156, 173,0.1)',
		// 					drawBorder: false
		// 				},
		// 				scaleLabel: {
		// 					display: false,
		// 					labelString: 'Month',
		// 					fontColor: '#8492a6 '
		// 				}
		// 			}],
		// 			yAxes: [{
		// 				barPercentage: 1,
		// 				barSpacing: 2,
		// 				ticks: {
		// 					fontColor: "#8e9cad",
		// 				},
		// 				display: true,
		// 				gridLines: {
		// 					display: true,
		// 					color: 'rgb(142, 156, 173,0.1)',
		// 					drawBorder: false
		// 				},
		// 				scaleLabel: {
		// 					display: false,
		// 					labelString: 'sales',
		// 					fontColor: '#8492a6 '
		// 				}
		// 			}]
		// 		},
		// 		title: {
		// 			display: false,
		// 			text: 'Normal Legend'
		// 		}
		// 	}
		// });
		// /* Chartjs (#bar-chart-horizontal) closed */

		// var chart = c3.generate({
		// 	bindto: '#chart-pie', // id of chart wrapper
		// 	data: {
		// 		columns: [
		// 			// each columns data
		// 			['data1', 63],
		// 			['data2', 44],
		// 			['data3', 12]
		// 		],
		// 		type: 'pie', // default type of chart
		// 		colors: {
		// 			data1: '#2205bf',
		// 			data2: '#0099ff',
		// 			data3: '#ff1a1a',
		// 		},
		// 		names: {
		// 			// name of each serie
		// 			'data1': 'Persiapan Lahan',
		// 			'data2': 'Proses',
		// 			'data3': 'Terlaksana',
		// 		}
		// 	},
		// 	axis: {},
		// 	legend: {
		// 		show: false, //hide legend
		// 	},
		// 	padding: {
		// 		bottom: 0,
		// 		top: 0
		// 	},
		// });
		// /*chart-pie*/
		// var chart = c3.generate({
		// 	bindto: '#chart-pie2', // id of chart wrapper
		// 	data: {
		// 		columns: [
		// 			// each columns data
		// 			['data1', 63],
		// 			['data2', 40],
		// 			['data3', 12],
		// 			['data4', 14],
		// 			['data5', 20],
		// 			['data6', 29],
		// 		],
		// 		type: 'pie', // default type of chart
		// 		colors: {
		// 			'data1': '#2205bf',
		// 			'data2': '#0099ff',
		// 			'data3': '#ffb209',
		// 			'data4': '#ff1a1a',
		// 			'data5': '#64E572',
		// 			'data6': '#6155ff',
		// 		},
		// 		names: {
		// 			// name of each serie
		// 			'data1': 'A',
		// 			'data2': 'B',
		// 			'data3': 'C',
		// 			'data4': 'D',
		// 			'data5': 'E',
		// 			'data6': 'F'
		// 		}
		// 	},
		// 	axis: {},
		// 	legend: {
		// 		show: false, //hide legend
		// 	},
		// 	padding: {
		// 		bottom: 0,
		// 		top: 0
		// 	},
		// });
		// /*chart-pie*/
		// var chart = c3.generate({
		// 	bindto: '#chart-pie3', // id of chart wrapper
		// 	data: {
		// 		columns: [
		// 			// each columns data
		// 			['data1', 63],
		// 			['data2', 44],
		// 			['data3', 28]
		// 		],
		// 		type: 'pie', // default type of chart
		// 		colors: {
		// 			'data1': '#2205bf',
		// 			'data2': '#0099ff',
		// 			'data3': '#ffb209'
		// 		},
		// 		names: {
		// 			// name of each serie
		// 			'data1': 'A',
		// 			'data2': 'B',
		// 			'data3': 'C'
		// 		}
		// 	},
		// 	axis: {},
		// 	legend: {
		// 		show: false, //hide legend
		// 	},
		// 	padding: {
		// 		bottom: 0,
		// 		top: 0
		// 	},
		// });
		// /*chart-pie*/
		// var chart = c3.generate({
		// 	bindto: '#chart-pie4', // id of chart wrapper
		// 	data: {
		// 		columns: [
		// 			// each columns data
		// 			['data1', 58],
		// 			['data2', 45],
		// 			['data3', 20],
		// 			['data4', 14]
		// 		],
		// 		type: 'pie', // default type of chart
		// 		colors: {
		// 			'data1': '#2205bf',
		// 			'data2': '#0099ff',
		// 			'data3': '#ffb209',
		// 			'data4': '#ff1a1a'
		// 		},
		// 		names: {
		// 			// name of each serie
		// 			'data1': 'A',
		// 			'data2': 'B',
		// 			'data3': 'C',
		// 			'data4': 'D'
		// 		}
		// 	},
		// 	axis: {},
		// 	legend: {
		// 		show: false, //hide legend
		// 	},
		// 	padding: {
		// 		bottom: 0,
		// 		top: 0
		// 	},
		// });


	// });

</script>
