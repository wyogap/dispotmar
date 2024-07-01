
<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Whatsapp</a></li>
			<li class="breadcrumb-item active" aria-current="page">Testing</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Whatsapp Testing</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
                    <div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                        <label class="col-md-3 col-form-label" for="nomor_wa">Nomor WA</label>
                        <div class="col-md-9">
                            <input type="text" id="nomor_wa" name="nomor_wa" class="form-control" tcg-type='input' value='12345432112343'>
                            <div class="invalid-feedback warning-nomor_wa"></div>
                        </div>
                    </div>
                    <div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                        <label class="col-md-3 col-form-label" for="pesan">Pesan</label>
                        <div class="col-md-9">
                            <textarea type="text" id="pesan" name="pesan" class="form-control" tcg-type='input'></textarea>
                            <div class="invalid-feedback warning-pesan"></div>
                        </div>
                    </div>
                    <div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                        <button class="btn btn-primary btn-kirim">Kirim</button>
                    </div>
                    <div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
                        <label class="col-md-3 col-form-label" for="response">Response</label>
                        <div class="col-md-9">
                            <textarea type="text" id="response" name="response" class="form-control" tcg-type='input'></textarea>
                            <div class="invalid-feedback warning-response"></div>
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
        $(".btn-kirim").on("click", function(e) {
            send_message()
        })

        // $(".btn-kirim").on('keyup', function (e) {
        //     if (e.key === 'Enter' || e.keyCode === 13) {
        //         send_message()
        //     }
        // });
    });

    function send_message() {

        frmData = new FormData();
        frmData.append('nomor_wa', $("#nomor_wa").val());
        frmData.append('message', $("#pesan").val());

        let url = "<?= site_url() ?>wa/message";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: frmData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            success: function (data) {
                if (data.status == 0) {
                    toastr.error(data.error);
                }
                else {
                    $("#response").html(data.message);
                }

            },
            error: function (data) {
                console.log(data)
                toastr.error("TIDAK berhasil menyimpan data");
            }
        });

		return false;
    }

</script>