<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Pasien Sudah Di Periksa</a>

      </div>
      <div class="card-body">

<div class="table-responsive" id="kunjungan_sudah">
  <table id="example" class="table table-bordered table-striped hover-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>NO RM</th>
                  <th>Nama Pasien</th>
                  <th>Tujuan Pelayanan</th>
                  <th>No Antrian</th>
                  <th>Jam Kunjungan</th>
                  <th>Jenis Kunjungan</th>
                  <th>Status</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>

            <?php $no=1;foreach ($kunjungan_sudah as $value): ?>
              <?php $id_check = $value->no_urutkunjungan;?>
              <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $value->pasien_noRM ?></td>
                <td><?php echo $value->namapasien ?></td>
                <td><?php $k = $value->kode_tupel;
                          $type = "IN";
                          $warna = "badge-primary";
                      if ($k == "UMU"){$warna = "badge-success"; $type="U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type="O";}
                      elseif ($k == "GIG") {$warna = "badge-warning";$type="G";}elseif ($k == "OZO") {$warna = "badge-info";$type="OZ";} ?>
                  <h4><span class="badge badge-pill <?php echo $warna; ?>"><?php echo $value->tujuan_pelayanan;?></span></h4></td>
                  <td><?php echo $type."".$value->no_antrian;?></td>
                <td><?php echo $value->jam_daftar;?></td>
                <td><?php if ($value->jenis_kunjungan == 0) {
                  echo "Baru";
                } else {
                  echo "Lama";
                }?></td>
                <td><?php if ($value->sudah == 1) {
                  echo "Sudah Diperiksa";
                } elseif ($value->sudah == 2) {
                  echo "Pelayanan TINDAKAN";
                } elseif ($value->sudah == 3) {
                  echo "Permintaan Laborat";
                } elseif ($value->sudah == 4) {
                  echo "Pengambilan Resep";
                } elseif ($value->sudah == 5) {
                  echo "Pasien Pulang";
                }
                 ?></td>

                <td>
                  <a href="<?php echo base_url()."Periksa/index/".$value->no_urutkunjungan; ?>">
                    <button type="button" class="btn btn-primary periksa">
                      <i class="fa fa-medkit"></i> DETAIL
                    </button>
                  </a>
                  <?php $rows = $this->db->get_where('rujukan_internal',array('kunjungan_no_urutkunjungan'=>$value->no_urutkunjungan))->num_rows()?>
                  <?php if ($value->billing != 1 && $rows==0): ?>
                    <?php if ($value->siap_pulang !=0): ?>
                      <a href="<?php echo base_url()."Periksa/batal_pulang/".$value->no_urutkunjungan; ?>">
                        <button type="button" class="btn btn-warning periksa">
                          <i class="fa fa-home"></i> Batal Pulang
                        </button>
                      </a>
                    <?php else: ?>
                      <a href="<?php echo base_url()."Periksa/pulang/".$value->no_urutkunjungan; ?>">
                        <button type="button" class="btn btn-success periksa">
                          <i class="fa fa-home"></i> Siap Pulang
                        </button>
                      </a>
                    <?php endif; ?>
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
