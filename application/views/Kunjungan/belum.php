<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Tunggu Pasien (Pasien Belum Di Periksa)</a>

      </div>
      <div class="card-body">

        <div class="table-responsive" id="kunjungan_belum">

          <table id="example_blm" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Tujuan Pelayanan</th>
                <th>No Antrian</th>
                <th>Jam Kunjungan</th>
                <th>Jenis Kunjungan</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="tabel_belum_periksa" >

              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id_check = $value->no_urutkunjungan;$warna = "badge-primary";?>
                <tr id="kunjungan_<?php echo $value->pasien_noRM?>">
                  <td class="no_kunjungan_hari_ini"><?php echo $no;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><?php $k = $value->kode_tupel;
                  $type = "IN";
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

                  <td>
                    <a href="<?php echo base_url()."Periksa/index/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-primary periksa btn-sm">
                        <i class="fa fa-medkit"></i> Periksa
                      </button>
                    </a>
                    <a href="#">
                      <button type="button" class="btn btn-success periksa btn-sm panggilan_pasien" antrian="<?php echo $_SESSION['poli']."-".$value->no_antrian;?>">
                        <i class="fa fa-medkit"></i> Panggil Pasien
                      </button>
                    </a>
                    <a href="<?php echo base_url()."Kunjungan/delete/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-danger hapus-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Kunjungan">
                        <i class="fa fa-cut"></i>
                      </button>
                    </a>
                    <a href="<?php echo base_url()."Pasien/edit/".$value->pasien_noRM."/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-warning hapus-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data Pasien">
                        <i class="fa fa-edit"></i>
                      </button>
                    </a>
                    <a href="#">
                      <button type="button" no_kun="<?php echo $value->no_urutkunjungan?>" no_rm="<?php echo $value->noRM?>" class="btn btn-primary ganti-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ganti Tujuan Pelayanan Pasien">
                        <i class="fa fa-edit"></i>
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
<script>
$(document).ready(function(){
  $(document).on("click",".ganti-kunjungan",function(){
    var no = $(this).attr("no_kun");
    var no_rm = $(this).attr("no_rm");
    $(".ganti_nokun").val(no);
    $(".no_rm").val(no_rm);
    $("#ganti_tupel").modal("toggle");

  })
})
</script>
