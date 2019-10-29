<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>USER</strong>
              <small> Form Edit</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('User/update');
              echo form_hidden('id', $this->uri->segment(3));?>
              <?php echo @$error;?>

              <div class="card">
              <div class="card-body card-block">
                <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="agama" class=" form-control-label">Nama Pegawai</label>
                        </div>
                        <div class="col-12 col-md-9">
                              <select name="nik" id="select" class="mdb-select colorful-select dropdown-info md-form" re>
                                <option>...Pilih Pegawai...</option>
                                <?php foreach ($pegawai as $data_pegawai): ?>
                                  <option value="<?php echo $data_pegawai->NIK; ?>" <?php if ($data_pegawai->NIK == @$user['pegawai_NIK']): ?>
                                    <?php echo 'selected'; ?>
                                  <?php endif; ?>><?php echo $data_pegawai->nama ?></option>
                                <?php endforeach; ?>
                              </select>
                        </div>
                </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Username</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo @$user['Nama']; ?>" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Password</label>
                </div>
                <div class="col-5">
                    <input type="password" name="password" id="password" class="form-control" placeholder="password" value="<?php echo @$user['password']; ?>" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Re Password</label>
                </div>
                <div class="col-5 ">
                    <input type="password" name="repassword" id="repassword" class="form-control" placeholder="re-password" value="<?php echo @$user['password']; ?>" required>
                </div>
                <div class="col-4">
                  <?php echo @$_SESSION['error']; ?>
                </div>
              </div>


              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Jabatan</label>
                </div>
                <div class="col-12 col-md-9">
                  <select name="jabatan" id="jabatan" class="mdb-select colorful-select dropdown-info md-form" required onchange="selected()">
                    <option>...Pilih Pegawai...</option>
                    <?php foreach ($jabatan as $value): ?>
                        <option value="<?php echo $value->idjabatan; ?>"
                          <?php if ($value->idjabatan == $user['Jabatan']): ?>
                            selected
                          <?php endif; ?>
                          ><?php echo $value->namajabatan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Roles</label>
                </div>
                <div class="col-12 col-md-9">
                  <div class="opt_roles">
                    <select multiple id="optgroup" name="roles[]">
                      <?php foreach ($group as $g): ?>
                        <optgroup label="<?php echo $g->nama_group ?>">
                          <?php foreach ($this->ModelUsers->get_roles($g->idgroup_roles)->result() as $r): ?>
                            <option value="<?php echo $r->roles ?>"
                              <?php if (isset($j_roles)) {
                                // code...
                              foreach ($j_roles as $value): ?>
                                <?php if ($value == $r->roles): ?>
                                  <?php echo "selected" ?>
                                <?php endif; ?>
                              <?php endforeach; }?>
                              ><?php echo $r->roles ?></option>
                          <?php endforeach; ?>
                        </optgroup>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              </div>

                  </div>


              <button type="submit" class="waves-effect waves-light btn blue m-b-xs text-right">SIMPAN</button>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function selected() {
    var jab = $('#jabatan').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Jabatan/filter_roles/' + jab,
      data: { filter_jab: jab },
      success: function(response) {
        $('.opt_roles').html(response);
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
      }
    });
  }
</script>
