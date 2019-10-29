<?php echo form_open('Kunjungan/delete');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Billing Pasien Rawat Inap</a></h3>

      </div>

      <div class="card-body">
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Pelayanan</th>
                <th>Tanggal</th>
                <th>Jam Kunjungan</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Kamar</th>
                <th>Kelas Perawatan</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="billing">

              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id = $value->no_urutkunjungan;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><h4><span class="badge badge-pill purple-gradient">Rawat Inap</span></h4></td>
                  <td><?php echo date("d-m-Y",strtotime($value->tgl));?></td>
                  <td><?php echo $value->jam_daftar;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><?php echo $value->nama_kamar ?></td>
                  <td><?php echo "Kelas ".$value->kelas ?></td>

                  <td>

                    <div class="btn-group">
                      <?php
                      if ($value->billing!=1) {?>
                        <?php if ($value->cetak_billing==0): ?>
                          <a href="<?php if ($value->siap_pulang!=0): ?>
                            <?php echo base_url()."BillingRanap/tagihan/".$value->no_urutkunjungan; ?>
                          <?php endif; ?><?php if ($value->siap_pulang==0): ?>
                            #
                          <?php endif; ?>">
                            <button type="button" class="btn btn-primary btn-sm" <?php if ($value->siap_pulang==0): ?>
                              disabled
                            <?php endif; ?>
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i> Tagihan</button>
                          </a>
                        <?php else: ?>
                          <a href="<?php echo base_url()."BillingRanap/invoice/".$value->no_urutkunjungan; ?>">
                            <button type="button" class="btn btn-primary btn-sm" style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i> Bayar</button>
                          </a>
                        <?php endif; ?>


                        <?php


                      }else{?>
                        <a  target="_blank" href="<?php echo base_url()."BillingRanap/print_tagihan/".$value->no_urutkunjungan; ?>">
                          <button type="button" class="btn btn-danger btn-sm"
                          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Ulang Tagihan</button>
                        </a>
                        <a target="_blank" href="<?php echo base_url()."BillingRanap/kwitansi/".$value->no_urutkunjungan; ?>">
                          <button type="button" class="btn btn-warning btn-sm"
                          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Print Pembayaran</button>
                        </a>

                        <?php

                      }
                      ?>
                  </div>

                </td>
              </tr>
              <?php $no++; endforeach; ?>


            </tbody>

          </table>

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
<script>
$(document).ready(function(){
  $("#loader").hide();
    $(document).on("click","#filter_data",function(){
      var tgl = $("#tanggal_fil").val();
      var sts = $("#sts").val();
      var poli = $("#asal_poli").val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Billing/filter_billing/',
        data: { tanggal:tgl,sts:sts,poli:poli},
        beforeSend: function () {
               // $('#kunjungan_sudah').hide();
               $('#loader').show();
               // alert(tgl);
           },
        success: function(response) {
          $("#loader").hide();
          // $('#kunjungan_sudah').show('medium');
          $("#billing").html(response);
          $('#example').DataTable();
        }
    })
})

});
</script>
