<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Riwayat Laborat</a></h4>

    </div>

    <!-- Card content -->
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
          <th>Kode Lab</th>
          <th>Jenis Lab</th>
          <th>Nilai Normal</th>
          <th>Hasil</th>
        </thead>
        <tbody id="diagnosa">
          <?php foreach ($this->ModelPeriksa->get_lab(@$hasil_periksa['idperiksa'])->result() as $data): ?>
            <tr>
              <td><?php echo $data->kodelab ?></td>
              <td><?php echo $data->nama?></td>
              <td><?php echo $data->nilainormal?></td>
              <td><?php echo $data->hasil?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>



      </div>

    </div>
    <!-- Card Narrower -->

  </div>
