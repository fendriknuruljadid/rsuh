<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Rawat Inap</a>

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

              <?php $no=1;foreach ($kunjungan_sudah as $value): ?>
                <?php $id_check = $value->no_urutkunjungan;$warna = "badge-primary";?>
                <tr>
                  <td class="no_kunjungan_hari_ini"><?php echo $no;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><h4><span class="badge badge-pill purple-gradient">Rawat Inap</span></h4></td>
                  <td><?php echo "Kelas ".$value->kelas?></td>
                  <td><?php echo $value->nama_kamar?></td>
                  <td>
                    <span class="badge badge-success">Pasien Telah Dipulangkan</span>
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
