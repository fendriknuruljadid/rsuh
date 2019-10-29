<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <a href="" class="white-text mx-3 text-header">Admisi Rawat Inap</a>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-clock"></i>
              </span>
              <span class="hidden-xs-down">Admisi Belum Di ACC</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#home3" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-clock"></i>
              </span>
              <span class="hidden-xs-down">Admisi Sudah Di ACC</span></a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active p-20" id="home2" role="tabpanel">
            <?php $this->load->view('Admisi/belum') ?>
          </div>
          <div class="tab-pane p-20" id="home3" role="tabpanel">
            <?php $this->load->view('Admisi/sudah') ?>
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
<?php echo form_close();?>
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
