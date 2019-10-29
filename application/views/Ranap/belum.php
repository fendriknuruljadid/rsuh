<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Rawat Inap</a>
        <input type="hidden" id="nik_login" value="<?php echo $_SESSION['nik']?>">
      </div>
      <div class="card-body">

        <div class="table-responsive" id="kunjungan_belum">

          <table id="example_blm" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Pelayanan</th>
                <th>Kelas Perawatan</th>
                <th>Kamar Inap</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="tabel_belum_periksa" >

              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id_check = $value->no_urutkunjungan;$warna = "badge-primary";?>
                <tr>
                  <td class="no_kunjungan_hari_ini"><?php echo $no;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><h4><span class="badge badge-pill purple-gradient">Rawat Inap</span></h4></td>
                  <td><?php echo "Kelas ".$value->kelas?></td>
                  <td><?php echo $value->nama_kamar." Bed ".$value->bed?></td>
                  <td>

                    <?php if ($value->siap_pulang==0): ?>
                      <?php if ($_SESSION['jabatan']!="PRANAP"): ?>
                        <a href="<?php echo base_url()."PeriksaRanap/index/".$value->no_urutkunjungan; ?>">
                          <button type="button" class="btn btn-primary periksa btn-sm">
                            <i class="fa fa-medkit"></i> Periksa
                          </button>
                        </a>
                        <a href="<?php echo base_url()."Ranap/pulang/".$value->no_urutkunjungan; ?>">
                          <button type="button" class="btn btn-success periksa btn-sm">
                            <i class="fa fa-home"></i> Siap Pulang
                          </button>
                        </a>
                      <?php endif; ?>

                      <a href="<?php echo base_url()."Asesmen/timbang_terima/".$value->no_urutkunjungan."/".$value->pasien_noRM; ?>">
                        <button type="button" class="btn btn-warning periksa btn-sm">
                          <i class="fa fa-notepad"></i> Timbang Terima
                        </button>
                      </a>
                      <a href="#" data-toggle="modal" data-target="#modal_timbangterima">
                        <button type="button" id="<?php echo $value->no_urutkunjungan?>" class="list_tt btn btn-warning purple-gradient periksa btn-sm">
                          <i class="fa fa-clock"></i> Riwayat Timbang Terima
                        </button>
                      </a>
                      <a href="#" data-toggle="modal" data-target="#modal_periksa">
                        <button type="button" id="<?php echo $value->no_urutkunjungan?>" class="list_periksa btn btn-warning purple-gradient periksa btn-sm">
                          <i class="fa fa-clock"></i> Riwayat Pemeriksaan
                        </button>
                      </a>
                    <?php endif; ?>
                    <?php if ($value->siap_pulang==1): ?>
                      <a href="<?php echo base_url()."Ranap/batal_pulang/".$value->no_urutkunjungan; ?>">
                        <button type="button" class="btn btn-success periksa btn-sm">
                          <i class="fa fa-home"></i> Batal Pulang
                        </button>
                      </a>
                    <?php endif; ?>
                    <a href="<?php echo base_url()."Kunjungan/delete/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-danger hapus-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Kunjungan">
                        <i class="fa fa-cut"></i>
                      </button>
                    </a>
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
  <div class="modal fade" id="modal_timbangterima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Riwayat TImbang Terima</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="table-responsive" id="kunjungan_belum">
            <table id="example_blm" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Perawat Jaga</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody id="history">
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
  <!-- Central Modal Large Info-->
    <div class="modal fade" id="modal_periksa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <p class="heading lead">Riwayat Pemeriksaan</p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

          <!--Body-->
          <div class="modal-body">
            <div class="table-responsive" id="kunjungan_belum">
              <table id="example_blm" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal Periksa</th>
                    <th>Jam</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody id="history_periksa">
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
<script>
$(document).ready(function(){
  $(document).on("click",".list_tt",function(){
    // alert("daj");
    var nokun = $(this).attr("id");
    var nik = $("#nik_login").val();
    // alert(nik);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Ranap/history_tt',
        data: {nokun: nokun,nik:nik},
        success: function (response) {
          // alert(response);
            $("#history").html(response);
        }
    })
  })
  $(document).on("click",".list_periksa",function(){
    // alert("daj");
    var nokun = $(this).attr("id");
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Ranap/history_periksa',
        data: {nokun: nokun},
        success: function (response) {
          // alert(response);
            $("#history_periksa").html(response);
        }
    })
  })
})
</script>
