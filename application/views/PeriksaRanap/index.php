<?php
if ($this->uri->segment(4)=='') {
  $periksa['idperiksa'] = null;
}else{
  $periksa['idperiksa'] = $this->uri->segment(4);
}
// echo "idperiksa ".$periksa['idperiksa'];
$this->load->model('ModelRole');
$user_Roles = $this->db->get_where('user',array('id_user' => $_SESSION['id_login'], ))->row_array();
$roles_Roles = explode(', ', $user_Roles['roles']);
foreach ($roles_Roles as $value) {
  $Menu_Roles[$value] = true;
  $this->db->reset_query();
  $this->db->select('group_roles_idgroup_roles');
  $this->db->group_by('group_roles_idgroup_roles');
  $Group_Roles = $this->db->get_where('roles',array('roles' => $value, ))->result();
  foreach ($Group_Roles as $value) {
    $Menu_Group[$value->group_roles_idgroup_roles] = true;
  }
}
?>
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!--Grid column-->

<div class="row">
  <div class="row col-xl-4 col-md-12 col-sm-12">
    <div class="col-xl-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

              <h4 id="info"><a href="#" class="white-text mx-3"><i class="fas fa-info-circle"></i> Informasi Kunjungan</a></h4>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Antrian</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_antrian']; ?>" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tanggal Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jam Daftar</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$kunjungan['jam_daftar']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tujuan Poli</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="tupel" id="tupel" class="form-control" placeholder="tujuan pelayanan" value="<?php echo @$tupel['tujuan_pelayanan']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No RM Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Nama Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-12 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jenis Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>

                </div>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row col-xl-8 col-md-12 col-sm-12">
<?php if (@$Menu_Roles['Asesmen']): ?>
  <!--Grid column-->
  <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

    <!--Card-->
    <div class="card white z-depth-2">

      <!--Card Data-->
      <div class="row mt-3">
        <div class="col-md-12 col-12 text-center">
          <?php if ($this->ModelDemografi->get_asesmen_kunjungan($idkunjungan)->num_rows() > 0 || $this->ModelDemografi->get_asesmen_igd_kunjungan($idkunjungan)->num_rows() > 0 ): ?>
            <?php if (@$kunjungan['poli'] == "IGD"): ?>
              <a data-toggle="modal" data-target="#assasmen_igd"
              type="button" class="btn-floating btn-lg blue lighten-2"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
            <?php else: ?>
              <a data-toggle="modal" data-target="#assasmen"
              type="button" class="btn-floating btn-lg blue lighten-2"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
            <?php endif; ?>

          <?php else: ?>
            <?php if (@$kunjungan['poli'] == "IGD"): ?>
              <a href="<?php echo base_url(); ?>Asesmen/input_igd/<?php echo @$idkunjungan."/".@$pasien['noRM']; ?>"
                type="button" class="btn-floating btn-lg blue lighten-2"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
            <?php else: ?>
                <a href="<?php echo base_url(); ?>Asesmen/input/<?php echo @$idkunjungan."/".@$pasien['noRM']; ?>"
                  type="button" class="btn-floating btn-lg blue lighten-2"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row my-3">
        <div class="col-md-12 col-12 text-center">
          <p class="text-primary font-up font-weight-bold">Assasmen Awal Keperawatan</p>
        </div>


      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
      <?php
      $jabatan = $_SESSION['jabatan'];
      $bidan = strpos($jabatan, "bidan");
      $perawat = strpos($jabatan, "pumu");
      $perawatG = strpos($jabatan, "pgig");
      ?>
    <?php endif; ?>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php
              if (@$periksa['idperiksa'] !== null) {
								if (@$tupel['kode_tupel'] == "OBG") {?>
                  <a type="button" class="btn-floating btn-lg purple lighten-2" data-toggle="modal" data-target="#periksaObg">
                <?php
                }else if (@$tupel['kode_tupel'] == "GIG") {
                  ?>
                  <a type="button" class="btn-floating btn-lg purple lighten-2" data-toggle="modal" data-target="#periksaGig">

								<?php
              }else {
                  ?>
                  <a type="button" class="btn-floating btn-lg purple lighten-2" data-toggle="modal" data-target="#periksaUmu">

                <?php
                }

							}else {?>
                <?php if (@$tupel['kode_tupel'] == "OBG"): ?>
                    <a type="button" class="btn-floating btn-lg purple lighten-2" href="<?php echo base_url(); ?>Periksa/obgyn/<?php echo @$idkunjungan; ?>">
                <?php elseif (@$tupel['kode_tupel'] == "GIG"): ?>
                    <a type="button" class="btn-floating btn-lg purple lighten-2" href="<?php echo base_url(); ?>PoliGigi/input/<?php echo @$idkunjungan; ?>">
                <?php else: ?>
                    <a type="button" class="btn-floating btn-lg purple lighten-2" href="<?php echo base_url(); ?>PeriksaRanap/pemeriksaan/<?php echo @$idkunjungan."/".$kunjungan['idrujukan_internal']; ?>">
                <?php endif; ?>
              <?php
              }
              ?>
              <i class="fas fa-stethoscope" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Pemeriksaan Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
<?php if (@$bidan !== 0 && @$perawat !== 0 && @$perawatG !== 0): ?>
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
            <?php if (@$periksa['idperiksa'] == null) {?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">

              <?php
            }else{?>
              <?php
							$jmldiagnosa = $this->ModelPeriksa->get_diagnosa(@$periksa['idperiksa'])->num_rows();
							$jmltindakan = $this->ModelPeriksa->get_tindakan(@$periksa['idperiksa'])->num_rows();
							if ($jmldiagnosa > 0 || $jmltindakan > 0) {?>
                <a type="button" class="btn-floating btn-lg lime darken-2" data-toggle="modal" data-target="#tindakanMedis">
              <?php
							} else { ?>
							<a type="button" class="btn-floating btn-lg lime darken-2" href="<?php echo base_url(); ?>PeriksaRanap/tindakan/<?php echo @$periksa['idperiksa']; ?>">
              <?php } ?>
            <?php
            }
            ?><i class="fas fa-syringe" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Tindakan Medis</p>
            </div>


          </div>
          <!--/.Card content-->


        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) {?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">
              <?php
            }else{?>
              <?php
							$jmllab = $this->ModelPeriksa->get_lab(@$periksa['idperiksa'])->num_rows();
							if ($jmllab > 0) {?>
                <a type="button" class="btn-floating btn-lg brown darken-2" data-toggle="modal" data-target="#permintaanLab">
              <?php } else { ?>
							<a type="button" class="btn-floating btn-lg brown darken-2" href="<?php echo base_url(); ?>PeriksaRanap/lab/<?php echo @$periksa['idperiksa']; ?>">
            <?php
              }
            }
            ?>
              <i class="fas fa-microscope" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Permintaan Laborat</p>
            </div>


          </div>

          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) {?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">
              <?php
            }else{?>
              <?php
							$jmlresep= $this->ModelPeriksa->get_resep(@$periksa['idperiksa'])->num_rows();
              // die(var_dump($periksa['idperiksa']));
							if ($jmlresep > 0) {?>
                <a type="button" class="btn-floating btn-lg g deep-orange darken-2" data-toggle="modal" data-target="#resepPasien">
              <?php } else { ?>
								<a type="button" class="btn-floating btn-lg g deep-orange darken-2" href="<?php echo base_url(); ?>PeriksaRanap/resep/<?php echo @$periksa['idperiksa']; ?>">
              <?php } ?>
            <?php
            }?>

              <i class="fas fa-pills" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Buat Resep Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) {?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">
              <?php
            }else{?>
              <?php
							$jmlbhp= $this->ModelPeriksa->get_bhp(@$periksa['idperiksa'])->num_rows();
							if ($jmlbhp > 0) {?>
                <a type="button" class="btn-floating btn-lg g blue darken-2" data-toggle="modal" data-target="#bhpPasien">
              <?php } else { ?>
								<a type="button" class="btn-floating btn-lg g blue darken-2" href="<?php echo base_url(); ?>PemakaianObat/bhp/<?php echo @$periksa['idperiksa']; ?>">
              <?php } ?>
            <?php
            }?>

              <i class="fas fa-pills" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">BHP Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
                <a type="button" class="btn-floating btn-lg g red darken-5" data-toggle="modal" data-target="#timbang_terima">
              <i class="fas fa-pills" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Timbang Terima Terakhir</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>

      <!-- <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4"></div> -->
      <!--Grid column-->
      <div class="col-xl-3  col-sm-6 col-xs-6 mb-4"></div>
      <!--Grid column-->
      <div class="col-xl-3 col-sm-6 col-xs-6 mb-4"></div>
      <!--Grid column-->
			<?php endif; ?>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg red lighten-2" data-toggle="modal" data-target="#riwayatKunjungan"><i class="fas fa-user-clock" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Riwayat Kunjungan</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg light-green darken-1" data-toggle="modal" data-target="#riwayatPenyakit"><i class="fas fa-diagnoses" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Riwayat Penyakit</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg indigo darken-2" data-toggle="modal" data-target="#riwayatAlergi"><i class="fas fa-book" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Riwayat Alergi</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg orange darken-2" data-toggle="modal" data-target="#riwayatLab"><i class="fas fa-vial" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Riwayat Kunjungan Lab</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg pink darken-2" data-toggle="modal" data-target="#dataPasien"><i class="fas fa-user-secret" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Data Diri Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg red darken-1" data-toggle="modal" data-target="#rujuk_internal"><i class="fas fa-ambulance" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Rujuk Ke Poli Lain</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

  </div>

<?php $this->load->view("Periksa/modal_avatar")?>
<?php
  if (@$jmlresep > 0) {
  $resepku = $this->ModelPeriksa->get_resep(@$periksa['idperiksa'])->row_array();
  if($resepku['status_resep']==1){
    $edit = 0;
  }else{
    $edit = 1;
  }
  $this->load->view("Periksa/modal_large",array(
    'id'=>'resepPasien',
    'judul' => 'Resep Untuk Pasien Ini',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/resep',
    'edit' => $edit,
    'link' => base_url()."PeriksaRanap/edit_resep/".$periksa['idperiksa']."/".$resepku['resep_no_resep'],

  ));
  }
  if (@$jmllab > 0) {
  $this->load->view("Periksa/modal_large",array(
    'id'=>'permintaanLab',
    'judul' => 'Permintaan Lab Untuk Pasien Ini',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/laborat',
    'edit' => 1,
    'link' => base_url()."PeriksaRanap/edit_lab/".$periksa['idperiksa']
  ));
  }
  if (@$jmldiagnosa > 0 || @$jmltindakan > 0) {
    $this->load->view("Periksa/modal_large",array(
      'id'=>'tindakanMedis',
      'judul' => 'Tindakan & Diagnosa Medis Yang Telah Dilakukan',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/tindakan',
      'edit' => 1,
      'link' => base_url()."PeriksaRanap/edit_tindakan/".$periksa['idperiksa']
    ));
  }
  if (@$periksa['idperiksa'] !== null) {
    if (@$tupel['kode_tupel'] == "OBG") {
      $this->load->view("Periksa/modal_new",array(
        'id'=>'periksaObg',
        'judul' => 'Hasil Periksa Obgyn',
        'icon' => 'fas fa-user-secret',
        'view' => 'Periksa/form/periksa_obgyn'
      ));
    }else if (@$tupel['kode_tupel'] == "GIG") {
      $this->load->view("Periksa/modal_new",array(
        'id'=>'periksaGig',
        'judul' => 'Hasil Periksa Gigi',
        'icon' => 'fas fa-user-secret',
        'view' => 'Periksa/form/periksa_gigi'
      ));
    }else {
      $this->load->view("Periksa/modal_new",array(
        'id'=>'periksaUmu',
        'judul' => 'Hasil Periksa',
        'icon' => 'fas fa-user-secret',
        'view' => 'Periksa/form/periksa2'
      ));
    }

  }
  $this->load->view("Periksa/modal_large",array(
    'id'=>'dataPasien',
    'judul' => 'Data Diri Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/data_pasien'
  ));
  $this->load->view("Periksa/modal_large",array(
    'id'=>'rujuk_internal',
    'judul' => 'Rujuk Ke Poli Lain',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/rujuk'
  ));
  $this->load->view("Periksa/modal_large",array(
    'id'=>'riwayatLab',
    'judul' => 'Riwayat Kunjungan Laborat',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_laborat'
  ));
  $this->load->view("Periksa/modal_large",array(
    'id'=>'riwayatPenyakit',
    'judul' => 'Riwayat Penyakit Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_penyakit'
  ));
  $this->load->view("Periksa/modal_large",array(
    'id'=>'riwayatAlergi',
    'judul' => 'Riwayat Alergi Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_alergi'
  ));
  $this->load->view("Periksa/modal_new",array(
    'id'=>'assasmen',
    'judul' => 'Assasmen Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Demografi/view2'
  ));
  $this->load->view("Periksa/modal_new",array(
    'id'=>'timbang_terima',
    'judul' => 'Timbang Terima Terakhir ',
    'icon' => 'fas fa-user-secret',
    'view' => 'Demografi/view_tt'
  ));
  $this->load->view("Periksa/modal_new",array(
    'id'=>'riwayatKunjungan',
    'judul' => 'Riwayat Kunjungan Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_kunjungan'
  ));

  $this->load->view("Periksa/modal_new",array(
    'id'=>'assasmen_igd',
    'judul' => 'Assasmen Pasien IGD',
    'icon' => 'fas fa-user-secret',
    'view' => 'Demografi/view_igd'
  ));
  if (@$jmlbhp > 0) {
    $this->load->view("Periksa/modal_large",array(
      'id'=>'bhpPasien',
      'judul' => 'Bahan Habis Pakai',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/bhp',
      'edit' => 0,
      'link' => base_url()."PeriksaRanap/edit_lab/".$periksa['idperiksa']
    ));
  }
?>
