
<?php echo form_open('Lplpo/action');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan LPLPO</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" value="<?php echo date("Y-m-d")?>" id="tgl" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">

                <select name="kelompok" class="mdb-select colorful-select dropdown-info md-form" required>
                  <option value="" disabled selected>Pilih Kelompok Obat</option>
                  <option value="semua">Semua</option>
                  <option value="Narkotika">Narkotika</option>
                  <option value="Psikotropika">Psikotropika</option>
                  <option value="Lainnya">Lainnya</option>

                </select>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <!-- <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</button> -->

            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Tombol Cetak</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h2 >Laporan LPLPO</h2>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
