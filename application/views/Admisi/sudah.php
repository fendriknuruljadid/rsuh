<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Rawat Inap</a>

      </div>
      <div class="card-body">

        <div class="table-responsive" id="kunjungan_belum">

          <table id="example_sdh" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Pelayanan</th>
                <th>Kamar Saat Ini</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="tabel_belum_periksa" >

              <?php $no=1;foreach ($kunjungan_sudah as $value): ?>
                <?php $id_check = $value->no_urutkunjungan;$warna = "badge-primary";?>
                <tr>
                  <td class="no_kunjungan_hari_ini"><?php echo $no;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><h4><span class="badge badge-pill purple-gradient">Rawat Inap</span></h4></td>
                  <td><?php echo $value->nama_kamar." bed ".$value->bed." (kelas ".$value->kelas.")"?></td>
                  <td>
                    <a href="<?php echo base_url()."Admisi/print/".$value->no_urutkunjungan; ?>" target="_blank">
                      <button type="button" class="btn btn-success periksa btn-sm">
                        <i class="fa fa-print"></i> Print
                      </button>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#daftar_kamar">
                      <button type="button" id="<?php echo $value->no_urutkunjungan;?>" class="pilih_kamar btn btn-primary periksa btn-sm">
                       Pindah Kamar
                      </button>
                    </a>
                    <?php if ($value->depo_ranap==0): ?>
                      <button type="button" namapasien="<?php echo $value->namapasien?>" nokun="<?php echo $value->no_urutkunjungan?>" no_rm= "<?php echo $value->pasien_noRM?>" class="btn btn-warning btn-sm bayar_deposit" id="<?php echo $value->no_urutkunjungan;?>" data-toggle="modal" data-target="#detail_sajian"
                        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-bill"></i> Bayar Deposit</button>

                    <?php else: ?>
                    <!-- <span class="badge badge-pill badge-success">  Sudah Bayar </span> -->
                    <a  target="_blank" href="<?php echo base_url()."Deposit/print/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-danger btn-sm"
                      style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Bukti Deposit</button>
                    </a>
                  <?php endif; ?>
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
<!-- Central Modal Large Info-->
  <div class="modal fade" id="daftar_kamar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Daftar Kamar Kosong</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th width="10%">NO</th>
                        <th>Nama Kamar</th>
                        <th>No Bed</th>
                        <th>Kelas Perawatan</th>
                        <th width="10%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($kamar as $data) {?>
                    <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $data->nama_kamar?></td>
                        <td><?php echo $data->bed?></td>
                        <td><?php echo "Kelas ".$data->kelas?></td>
                        <td><a href="#">
                          <button type="button" id="<?php echo $data->no_tt?>" class="pindah_kamar btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pilih">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a></td>
                    </tr>
                  <?php
                  $no++;
                  }?>
                </tbody>
              </table>
          </div>

        </div>

        <!--Footer-->
        <div class="modal-footer">
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->
  <?php
    $this->load->view("Periksa/modal_large",array(
      'id'=>'detail_sajian',
      'judul' => 'Pembayaran Deposit Kunjungan',
      'icon' => 'fas fa-user-secret',
      'view' => 'Admisi/deposit',
      'edit' => 0

    ));
  ?>

  <script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
  <script type="text/javascript">
  		$('.money').simpleMoneyFormat();
  </script>

  <script>
  $(document).ready(function(){
    $(document).on("click",".bayar_deposit",function(){
      var nokun = $(this).attr("nokun");
      var norm = $(this).attr("no_rm");
      var nama = $(this).attr("namapasien");
      $("#nokun").val(nokun);
      $("#no_rm").val(norm);
      $("#namapasien").val(nama);
    })
    $("#loader").hide();
  });
  </script>
<script>
var idkunjungan = 0;
var url = '<?php echo base_url()."Admisi/pindah/"?>';
$(document).on("click",".pilih_kamar",function(){
  idkunjungan = $(this).attr("id");
})
$(document).on("click",".pindah_kamar",function(){
  var no_tt = $(this).attr("id");
  if (confirm("Pindah pasien ke kamar ini")) {
    window.location = url+idkunjungan+"/"+no_tt;
  }
})
</script>
