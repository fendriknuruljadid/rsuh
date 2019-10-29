<?php echo form_open('Kunjungan/delete');
$jabatan = $_SESSION['jabatan'];
$resepsionis = strpos($jabatan, "resepsionis");
?>
<?php if ($resepsionis === 0){?>
  <style>
    .periksa{
      display: none;
    }
  </style>
<?php
}else{?>
  <style>
    .hapus-kunjungan{
      display: none;
    }
    .ganti-kunjungan{
      display: none;
    }
  </style>
<?php
}?>
<?php if ($resepsionis !== 0): ?>
<style>
  .add_pasien{
    display: none;
  }
  .text-header{
    font-size: 20px;
  }
</style>
<?php endif; ?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <a href="" class="white-text mx-3 text-header">Kunjungan Pasien</a>
            <div>
              <a href="#" data-toggle="modal" data-target="#smallmodal" class="add_pasien">
                <button type="button" id="scan" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Scan QR Code"><h4><i class="fas fa-qrcode mt-0"></i></h4></button>
              </a>
              <a href="<?php base_url(); ?>Kunjungan/input" class="float-right add_pasien">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><h4><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">

        <div class="row form-group">

                <div class="col col-md-2 text-right">
                  <label for="tb" class="form-control-label">Filter Tanggal</label>
                </div>
                <div class="col-12 col-md-4 input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="icon-calender"></i></span>
                    </div>
                    <input type="date" name="tb" id="tanggal" class="form-control" placeholder="tinggi badan" value="<?php echo date('Y-m-d'); ?>" required>
                    <div class="input-group-prepend">
                        <button type="button" onclick="filter_kunjungan()" class="btn btn-success"> <i class="fa fa-search"></i> Filter</button>
                    </div>
                </div>
        </div>

        <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-clock"></i>
              </span>
              <span class="hidden-xs-down">Daftar Tunggu</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">Sudah Periksa</span></a>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active p-20" id="home2" role="tabpanel">
            <?php $this->load->view('Kunjungan/belum') ?>
          </div>
          <div class="tab-pane  p-20" id="profile2" role="tabpanel">
            <?php $this->load->view('Kunjungan/sudah') ?>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
</div>
<!-- <div id="kunjungan_belum">
asdaskdjaskdhakjshdkjah
</div> -->
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
<script type="text/javascript">

$(document).ready(function(){
        $("#loader").hide();
        $('#example_blm').DataTable();
        $('#example_sdh').DataTable();
        $(document).on("click",".panggilan_pasien",function(){
          var no_antrian = $(this).attr("antrian");
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>Antrian/panggil1/',
            data: { antrian: no_antrian },
            beforeSend: function () {
                   // $('#kunjungan_belum').hide();
                   // $('#loader').show();
               },
            success: function(response) {
              alert(response);
              // $("#loader").hide();
              // $('#kunjungan_belum').show('medium');
              // $("#kunjungan_belum").html(response);
              // $('#example_blm').DataTable();
            }
          });
        })
});


function filter_kunjungan() {
  var tgl = $("#tanggal").val();
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>Kunjungan/filter_belum/' + tgl,
     data: { filter_tgl: tgl },
     beforeSend: function () {
            $('#kunjungan_belum').hide();
            $('#loader').show();
        },
     success: function(response) {
       $("#loader").hide();
       $('#kunjungan_belum').show('medium');
       $("#kunjungan_belum").html(response);
       $('#example_blm').DataTable();
     }
   });
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>Kunjungan/filter_sudah/' + tgl,
     data: { filter_tgl: tgl },
     beforeSend: function () {
            $('#kunjungan_sudah').hide();
            $('#loader').show();
        },
     success: function(response) {
       $("#loader").hide();
       $('#kunjungan_sudah').show('medium');
       $("#kunjungan_sudah").html(response);
       $('#example_sdh').DataTable();
     }
   });
}
</script>
<!-- Central Modal Large Info-->
  <div class="modal fade" id="ganti_tupel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <?php echo form_open(base_url()."Kunjungan/ganti_tupel");?>
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Ganti Tujuan Pelayanan</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">

          <div class="row form-group">
              <div class="col col-md-">
                  <label for="jenis_pasien" class=" form-control-label">Ganti Ke</label>
              </div>
              <div class="col-12 col-md-9">
                <?php foreach ($tupel as $value): ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="<?php echo $value->kode_tupel?>" name="tupel" value="<?php echo $value->kode_tupel?>" class="custom-control-input ganti_tupel"  required <?php if ($value->kode_tupel=="UMU"): ?>
                      checked
                    <?php endif; ?>>

                    <label class="custom-control-label" for="<?php echo $value->kode_tupel?>"><?php echo $value->tujuan_pelayanan?></label>
                  </div>
                <?php endforeach; ?>


              </div>
          </div>
          <input type="hidden" name="nokun" class="ganti_nokun">

          <input type="hidden" name="no_rm" class="no_rm">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="no_antrian" class=" form-control-label">No Antrian
                      Sebelumnya</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" name="no_antrian" id="no_antrian" class="form-control"
                         placeholder="no antrian" value="<?php echo $no_antrian; ?>" required>
              </div>
          </div>
        </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-outline-success waves-effect" >Simpan</button>
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
        </div>
        <?php echo form_close();?>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->

<!-- modal small -->
			<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Scan QR</h5>
							<button type="button" class="close pause" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body card-block">
                  <select></select><br><br>
                  <center><canvas></canvas></center>
                  <script type="text/javascript" src="<?php echo base_url()?>desain/assets/custom/qr_reader/js/qrcodelib.js"></script>
                  <script type="text/javascript" src="<?php echo base_url()?>desain/assets/custom/qr_reader/js/webcodecamjs.js"></script>
                  <script type="text/javascript" src="<?php echo base_url()?>desain/assets/custom/qr_reader/js/webcodecamjquery.js"></script>
                  <!-- <script type="text/javascript">
                  	var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
                      var arg = {
                          resultFunction: function(result) {
                            window.location = "<?php echo base_url();?>Kunjungan/input/"+result.code;
                          	// var aChild = document.createElement('li');
                          	// aChild[txt] = result.format + ': ' + result.code;
                            //   document.querySelector('body').appendChild(aChild);
                          }
                      };
                      $("#scan").click(function(){
                        new WebCodeCamJS("canvas").init(arg).play();
                      });
                      $(".pause").click(function(){
                        new WebCodeCamJS("canvas").init(arg).stop();
                      });
                      </script> -->
                      <?php if ($_SESSION['jabatan']=='resepsionis'): ?>
                        <script type="text/javascript">
                            var arg = {
                                resultFunction: function(result) {
                                    // $('body').append($('<li>' + result.format + ': ' + result.code + '</li>'));
                                    // alert(result.code);
                                    window.location = "<?php echo base_url();?>Kunjungan/input/"+result.code;
                                }
                            };
                            var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
                            decoder.buildSelectMenu("select");

                            /*  Without visible select menu
                                decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
                            */
                            $("#scan").click(function(){
                              decoder.play();
                            });
                            $('select').on('change', function(){
                                decoder.stop().play();
                            });
                        </script>
                      <?php endif; ?>

								</div>
							</div>
						</div>
						<div class="modal-footer">
								<button class="btn btn-danger btn-md pull-right pause" data-dismiss="modal">close</button>
						</div>
			</div>
		</div>
	</div>
			<!-- end modal small -->
<script>
$(document).on("click",".ganti_tupel",function(){
    var poli = $(this).val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Kunjungan/no_urut/' + poli,
        data: {poli: poli},
        success: function (response) {
            $("#no_antrian").val(response);
        }
    })
  });
</script>
