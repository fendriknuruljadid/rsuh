<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Tujuan Pelayanan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="tujuan_pelayanan" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$tujuan_pelayanan['tujuan_pelayanan']; ?>" required>
            </div>
    </div>


    <div class="row form-group">
            <div class="col col-md-3">
              <label for="polisakit" class=" form-control-label">Poli Sakit</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="polisakitya" name="polisakit" value="1" class="custom-form-control" <?php if (@$tujuan_pelayanan['polisakit']=='1') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="polisakitya">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="polisakit" name="polisakitno" value="0" class="custom-form-control" <?php if (@$tujuan_pelayanan['polisakit']=='0') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="polisakitno">Tidak</label>
              </div>

            </div>
    </div>

  </div>
</div>
