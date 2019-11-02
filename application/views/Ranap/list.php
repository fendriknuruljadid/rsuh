<?php
$jabatan = $_SESSION['jabatan'];
$resepsionis = strpos($jabatan, "resepsionis");
$pranap = strpos($jabatan, "PRANAP");
?>
<?php if ($resepsionis === 0 ){?>
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
            <a href="" class="white-text mx-3 text-header">Kunjungan Pasien Rawat Inap</a>
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

        <!-- <div class="row form-group">

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
        </div> -->

        <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-clock"></i>
              </span>
              <span class="hidden-xs-down">Pasien Saat Ini</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">Pasien Pulang</span></a>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active p-20" id="home2" role="tabpanel">
            <?php $this->load->view('Ranap/belum') ?>
          </div>
          <div class="tab-pane  p-20" id="profile2" role="tabpanel">
            <?php $this->load->view('Ranap/sudah') ?>
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
<script type="text/javascript">

$(document).ready(function(){
        $("#loader").hide();
        $('#example_blm').DataTable();
        $('#example_sdh').DataTable();
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
