<?php echo form_open_multipart('Ranap/pulang/',array("id"=>"form_pulang"));?>
<div class="col-md-12 col-xl-6">
  <div class="form-group animated flipIn">
    <label for="exampleInputuname">Alasan Dipulangkan</label>
    <div class="input-group mb-3">
      <select name="alasan" id="pilih_jenis_pasien" class="mdb-select colorful-select dropdown-info sm-form">
        <option id="" value="1">Sembuh</option>
        <option id="" value="0">Meninggal Dunia</option>
        <option id="" value="2">Pulang Paksa</option>
        <option id="" value="3">Dirujuk</option>
        <option id="" value="4">Melarikan Diri</option>
      </select>
    </div>
  </div>
</div>
<div class="col-md-12 col-xl-6">
  <div class="form-group animated flipIn">
    <button class="btn btn-success">Pulangkan</button>
  </div>
</div>
<?php echo form_close()?>
