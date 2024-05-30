<div class="section">
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Cron Job</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Sensor</li>
		</ol>
	</div>
</div>

<!-- <script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function () {
		getdataSENSOR();
	});

	function getdataSENSOR() {
		//login token
		$.ajax({
    	url:"https://cariudata1.dropadi.com/api/user/signin",
    	type:"POST",
    	data:{
  		"username": "admin", 
  		"password": "admin"
		},
		success: function(response)
		{
			//console.log(response.data.token);
			getdataSENSOR_detail(response.data.token);
		}
		})
	}

	function getdataSENSOR_detail(tokenvalue) {
		// var d = new Date();
		// var dates = d.getFullYear() + "-" + ( '0' + (d.getMonth()+1) ).slice( -2 ) + "-" + d.getDate();
		
		// var timestart_1 = dates + 'T' + '00:10:00' + '%2B07:00';
		// var timeend_1   = dates + 'T' + '06:10:00' + '%2B07:00';
		
		// var timestart_2 = dates + 'T' + '06:10:00' + '%2B07:00';
		// var timeend_2   = dates + 'T' + '12:10:00' + '%2B07:00';

		// var timestart_3 = dates + 'T' + '12:10:00' + '%2B07:00';
		// var timeend_3   = dates + 'T' + '18:10:00' + '%2B07:00';

		// var timestart_4 = dates + 'T' + '18:10:00' + '%2B07:00';
		// var timeend_4   = dates + 'T' + '00:10:00' + '%2B07:00';

		var timestart = '2021-01-05T00:01:00%2B07:00';
		var timeend   =	'2021-01-05T23:59:00%2B07:00';

		localStorage.setItem('myToken', tokenvalue)
    	$.ajax({
			url: 'https://cariudata1.dropadi.com/api/sensor-data?timestamp=' + timestart + ',' + timeend,
        	type: 'GET',
        	dataType: 'json',
        	headers: {
           		Authorization: `Bearer ${localStorage.getItem('myToken')}`
        	},
        	success: function (response) {
				//console.log(response)
            	for(i = 0; i < response.data.items.length; i++){
					insertdataSENSOR(
						response.data.items[i].id,
						response.data.items[i].code,
						response.data.items[i].category,
						response.data.items[i].group_th,
						response.data.items[i].group_label,
						response.data.items[i].node_id,
						response.data.items[i].node_label,
						response.data.items[i].timestamp,
						response.data.items[i].unit,
						response.data.items[i].value
					);
				}
        	}
   	 	})
	}

	function insertdataSENSOR(id,code,category,group_th,group_label,node_id,node_label,timestamp,unit,value)
	{
		var csrfvalue = '<?= $this->security->get_csrf_hash();?>';

		//console.log(code);
		var formData = new FormData();
			formData.append('csrf_al', csrfvalue);
			formData.append('id', id);
			formData.append('code', code);
			formData.append('category', category);
			formData.append('group_th', group_th);
			formData.append('group_label', group_label);
			formData.append('node_id', node_id);
			formData.append('node_label', node_label);
			formData.append('timestamp', timestamp);
			formData.append('unit', unit);
			formData.append('value', value);

		$.ajax({
			type: "POST",
			url: "insertdataSENSOR/store",
			dataType: "json",
			data: formData,
				processData: false,
				contentType: false,
			success: function (data) {
			},
			error: function (data) {
				console.log(data)
			}
		});
		
		return false;
	}

</script>
