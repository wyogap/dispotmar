$(function(e) {
	//file export datatable
	var table = $('#example').DataTable( {
		lengthChange: false,
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
			
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ]
		//buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	} );
	table.buttons().container()
		.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	var table = $('#example1').DataTable( {
		lengthChange: false,
		buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
			
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ]
		//buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	} );
	table.buttons().container()
		.appendTo( '#example1_wrapper .col-md-6:eq(0)' );

	var table = $('#example2').DataTable( {
		lengthChange: false,
		buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
			
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ]
		//buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
		} );
	table.buttons().container()
		.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		
	// var table = $('#tbl-b').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );

	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	// var table = $('#tbl-c').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );
			
	// var table = $('#tbl-d').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	// var table = $('#tbl-e').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );	

	// var table = $('#tbl-f').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );
	
	// var table = $('#tbl-g').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );		

	// var table = $('#tbl-h').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	// var table = $('#tbl-i').DataTable( {
	// 	lengthChange: false,
	// 	buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	// } );
	// table.buttons().container()
	// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	var table = $('#tbl-pelaporan').DataTable( {
		lengthChange: false,
		buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
			
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ]
		//buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	} );
	table.buttons().container()
		.appendTo( '#example_wrapper .col-md-6:eq(0)' );

	// sample datatable	
	$('#tbl-a').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-e').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-f').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-g').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-h').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-i').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);


	$('#tbl-a1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-e1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-f1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-g1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-h1').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);


	$('#tbl-a2').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b2').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c2').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d2').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);


	$('#tbl-a3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-e3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-f3').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);

	$('#tbl-a4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-e4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-f4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-g4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-h4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-i4').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);


	$('#tbl-a5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-b5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-c5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-d5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-e5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-f5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-g5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-h5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-i5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-j5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	$('#tbl-k5').DataTable(
		// buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	);
	
	//Details display datatable
	$('#tbl-pantai').DataTable( {
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal( {
					header: function ( row ) {
						var data = row.data();
						return 'Details for '+data[0]+' '+data[1];
					}
				} ),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
					tableClass: 'table'
				} )
			}
		}
	} );

	//export data
	var table = $('#datalaporanharian').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datalaporanharian_wrapper .col-md-6:eq(0)' );

	var table = $('#datajenislaporanharian').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datajenislaporanharian_wrapper .col-md-6:eq(0)' );

	var table = $('#datakomoditas').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datakomoditas_wrapper .col-md-6:eq(0)' );

	var table = $('#datalahantidur').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datalahantidur_wrapper .col-md-6:eq(0)' );

	var table = $('#datarekappangan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datarekappangan_wrapper .col-md-6:eq(0)' );

	var table = $('#datauser').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datauser_wrapper .col-md-6:eq(0)' );

	var table = $('#datasatuankerjapersonel').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasatuankerjapersonel_wrapper .col-md-6:eq(0)' );

	var table = $('#datasatuankerja').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasatuankerja_wrapper .col-md-6:eq(0)' );

	var table = $('#datatokohmasyarakat').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datatokohmasyarakat_wrapper .col-md-6:eq(0)' );

	var table = $('#dataorgagama').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataorgagama_wrapper .col-md-6:eq(0)' );

	var table = $('#dataorgpolitik').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataorgpolitik_wrapper .col-md-6:eq(0)' );

	var table = $('#dataorgmasa').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataorgmasa_wrapper .col-md-6:eq(0)' );

	var table = $('#datapartaipolitik').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapartaipolitik_wrapper .col-md-6:eq(0)' );

	var table = $('#dataumkm').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataumkm_wrapper .col-md-6:eq(0)' );
	
	var table = $('#dataindustrimenengah').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataindustrimenengah_wrapper .col-md-6:eq(0)' );

	var table = $('#datapariwisata').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapariwisata_wrapper .col-md-6:eq(0)' );

	var table = $('#datasejarah').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasejarah_wrapper .col-md-6:eq(0)' );
	
	var table = $('#databudaya').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#databudaya_wrapper .col-md-6:eq(0)' );

	var table = $('#datamiliterpolisi').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datamiliterpolisi_wrapper .col-md-6:eq(0)' );

	var table = $('#datajumlahpenduduk').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datajumlahpenduduk_wrapper .col-md-6:eq(0)' );

	var table = $('#datademoagama').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datademoagama_wrapper .col-md-6:eq(0)' );

	var table = $('#datasukubangsa').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasukubangsa_wrapper .col-md-6:eq(0)' );

	var table = $('#datadesabinaan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datadesabinaan_wrapper .col-md-6:eq(0)' );

	var table = $('#datadesapesisir').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datadesapesisir_wrapper .col-md-6:eq(0)' );

	var table = $('#datasakabahari').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasakabahari_wrapper .col-md-6:eq(0)' );

	var table = $('#datapekerjaanmasyarakat').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapekerjaanmasyarakat_wrapper .col-md-6:eq(0)' );

	var table = $('#datasekolahmaritim').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasekolahmaritim_wrapper .col-md-6:eq(0)' );

	var table = $('#datarumahsakit').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datarumahsakit_wrapper .col-md-6:eq(0)' );

	var table = $('#datapantai').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapantai_wrapper .col-md-6:eq(0)' );

	var table = $('#datahutan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datahutan_wrapper .col-md-6:eq(0)' );

	var table = $('#datagunung').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datagunung_wrapper .col-md-6:eq(0)' );

	var table = $('#datakerawanan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datakerawanan_wrapper .col-md-6:eq(0)' );

	var table = $('#datahujan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datahujan_wrapper .col-md-6:eq(0)' );

	var table = $('#datatanah').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datatanah_wrapper .col-md-6:eq(0)' );

	var table = $('#dataair').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataair_wrapper .col-md-6:eq(0)' );

	var table = $('#datasungai').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasungai_wrapper .col-md-6:eq(0)' );

	var table = $('#datapulau').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapulau_wrapper .col-md-6:eq(0)' );

	var table = $('#datamangrove').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datamangrove_wrapper .col-md-6:eq(0)' );

	var table = $('#dataperkebunan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataperkebunan_wrapper .col-md-6:eq(0)' );

	var table = $('#datapertanian').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapertanian_wrapper .col-md-6:eq(0)' );

	var table = $('#datapeternakan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapeternakan_wrapper .col-md-6:eq(0)' );

	var table = $('#datapertambangan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapertambangan_wrapper .col-md-6:eq(0)' );

	var table = $('#databudidayaikan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#databudidayaikan_wrapper .col-md-6:eq(0)' );

	var table = $('#datajaringapung').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datajaringapung_wrapper .col-md-6:eq(0)' );

	var table = $('#datakonservasi').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datakonservasi_wrapper .col-md-6:eq(0)' );

	var table = $('#datalistrik').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datalistrik_wrapper .col-md-6:eq(0)' );

	var table = $('#datapelabuhansungai').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapelabuhansungai_wrapper .col-md-6:eq(0)' );

	var table = $('#datapelabuhanlaut').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapelabuhanlaut_wrapper .col-md-6:eq(0)' );

	var table = $('#datapelabuhanikan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datapelabuhanikan_wrapper .col-md-6:eq(0)' );

	var table = $('#datasapras').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datasapras_wrapper .col-md-6:eq(0)' );

	var table = $('#datagalangankapal').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datagalangankapal_wrapper .col-md-6:eq(0)' );

	var table = $('#dataindustrimesin').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataindustrimesin_wrapper .col-md-6:eq(0)' );

	var table = $('#datalautnasional_pelayaran').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datalautnasional_pelayaran_wrapper .col-md-6:eq(0)' );

	var table = $('#datalautnasional_ekspedisi').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datalautnasional_ekspedisi_wrapper .col-md-6:eq(0)' );

	var table = $('#datashipchandler').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#datashipchandler_wrapper .col-md-6:eq(0)' );

	var table = $('#dataindustriperikanan').DataTable( {
		lengthChange: false,
		buttons: 
		[
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
				extend: 'pdf',
				extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                }
			},
			{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
			},
            'colvis'
        ],
		columnDefs: 
		[ {
            targets: -1,
            visible: true
        } ]
	} );
	table.buttons().container().appendTo( '#dataindustriperikanan_wrapper .col-md-6:eq(0)' );

} );
