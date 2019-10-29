<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Stok Opname</a></h4>

            </div>
            <div class="card-body card-block">
              <a href="<?php echo base_url()."StokOpname/input" ?>">
              <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#tabel_obat" data-placement="top" title="" data-original-title="scrollmodal" moda>
                                            <i class="fa fa-plus"></i> Tambah Stok Opname
                </button></a>
              <div class="col-sm-12 row">
                <div class="form-group animated flipIn col-md-6 col-sm-12">
                  <label for="exampleInputuname">NOTA :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ti-notepad"></i></span>
                    </div>
                    <input type="text" name="keluhan" class="form-control"  >
                  </div>
                </div>
                <div class="form-group animated flipIn col-md-6 col-sm-12">
                  <label for="exampleInputuname">Tanggal :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal">
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-hover table-striped ">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>No Batch</th>
                      <th>Nama Obat</th>
                      <th>Satuan</th>
                      <th>Harga Beli</th>
                      <th>Jumlah Komputer</th>
                      <th>Jumlah Real</th>
                      <th>Selisih</th>
                      <!-- <th width="%5">opsi</th> -->
                    </tr>
                  </thead>
                  <tbody id="tabel_batch">
                    <?php $no=1; foreach ($stok_opname as  $value): ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $value->no_batch ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo $value->satuan ?></td>
                        <td><?php echo $value->harga_beli ?></td>
                        <td><?php echo $value->jumlah_komp ?></td>
                        <td><?php echo $value->jumlah_real ?></td>
                        <td><?php echo $value->selisih ?></td>
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
  </div>
</div>
