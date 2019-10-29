<?php
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

<div class="col-md-12">
	<div class="card border-primary">
		<div class="card-header bg-primary text-center">
			<h4 class="m-b-0 text-white"> <i class="fa fa-medkit"></i> PEMERIKSAAN PASIEN </h4>
		</div>
		<div class="card-body">
			<div class="row form-group">
				<div class="col col-md-2">
					<label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
				</div>
				<div class="col-12 col-md-3">
					<input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>
				</div>
				<div class="col-12 col-md-3">
					<input type="text" name="tupel" id="tupel" class="form-control" placeholder="tujuan pelayanan" value="<?php echo @$tupel['tujuan_pelayanan']; ?>" required readonly>
				</div>
				<div class="col col-md-1">
					<label for="tanggal" class=" form-control-label">Tanggal</label>
				</div>
				<div class="col-12 col-md-3">
					<input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>
				</div>

			</div>
			<div class="row form-group">
				<div class="col col-md-2">
					<label for="norm" class=" form-control-label">Pasien :</label>
				</div>
				<div class="col-12 col-md-3">
					<input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
				</div>
				<div class="col-12 col-md-4">
					<input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
				</div>
				<div class="col-12 col-md-3">
					<input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card border-primary">
		<div class="card-header text-center">
			<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
			<?php if (@$Menu_Roles['Asesmen']): ?>
				<li class="nav-item">
					<a class="nav-link" id="asesmen-tab" data-toggle="tab" href="#asesmen" role="tab" aria-controls="asesmen">
						<span class="hidden-sm-up">
							<i class="ti-user"></i>
						</span>
						<span class="hidden-xs-down">ASESMEN <?php
            $jabatan = $_SESSION['jabatan'];
            $bidan = strpos($jabatan, "bidan");
            $perawat = strpos($jabatan, "perawat");
            ?> </span></a>
				</li>
			<?php endif; ?>
			<?php if (@$bidan !== 0 && @$perawat !== 0): ?>
				<li class="nav-item">
					<a class="nav-link active" id="pemeriksaan-tab" data-toggle="tab" href="#pemeriksaan" role="tab" aria-controls="pemeriksaan" aria-expanded="true">
						<span class="hidden-sm-up">
							<i class="ti-home"></i>
						</span>
						<span class="hidden-xs-down">PEMERIKSAAN</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if (@$periksa['idperiksa'] == null) {echo "disabled";} ?>" id="tindakan-tab" data-toggle="tab" href="#tindakan" role="tab" aria-controls="tindakan">
						<span class="hidden-sm-up">
							<i class="ti-user"></i>
						</span>
						<span class="hidden-xs-down">TINDAKAN dan DIAGNOSA</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if (@$periksa['idperiksa'] == null) {echo "disabled";} ?>" id="laborat-tab" data-toggle="tab" href="#laborat" role="tab" aria-controls="laborat">
						<span class="hidden-sm-up">
							<i class="ti-pin"></i>
						</span>
						<span class="hidden-xs-down">LABORATURIUM</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if (@$periksa['idperiksa'] == null) {echo "disabled";} ?>" id="resep-tab" data-toggle="tab" href="#resep" role="tab" aria-controls="resep">
						<span class="hidden-sm-up">
							<i class="ti-clipboard"></i>
						</span>
						<span class="hidden-xs-down">RESEP OBAT</span></a>
				</li>
			<?php endif; ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="hidden-sm-up">
							<i class="ti-agenda"></i>
						</span>
						<span class="hidden-xs-down">RIWAYAT</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" id="kunjungan-tab" href="#kunjungan" role="tab" data-toggle="tab" aria-controls="kunjungan">RIWAYAT KUNJUNGAN</a>
						<a class="dropdown-item" id="penyakit-tab" href="#penyakit" role="tab" data-toggle="tab" aria-controls="penyakit">RIWAYAT PENYAKIT</a>
						<!-- <a class="dropdown-item" id="planning-tab" href="#planning" role="tab" data-toggle="tab" aria-controls="planning">RIWAYAT PLANNING</a> -->
						<!-- <a class="dropdown-item" id="rlaborat-tab" href="#rlaborat" role="tab" data-toggle="tab" aria-controls="rlaborat">RIWAYAT LABORATURIuM</a> -->
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pasien-tab" data-toggle="tab" href="#pasien" role="tab" aria-controls="pasien">
						<span class="hidden-sm-up">
							<i class="ti-user"></i>
						</span>
						<span class="hidden-xs-down">DATA PASIEN</span></a>
				</li>
			</ul>
		</div>

	<div class="tab-content tabcontent-border p-20" id="myTabContent">


		<?php if (@$bidan !== 0 && @$perawat !== 0): ?>
		<div role="tabpanel" class="tab-pane fade <?php if (@$bidan !== 0 && @$perawat !== 0): ?>
      show active
    <?php endif; ?>" id="pemeriksaan" aria-labelledby="pemeriksaan-tab">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>PEMERIKSAAN</strong>
							<small>SubForm</small>
						</div>
						<div class="card-body card-block">
							<?php
							if (@$periksa['idperiksa'] !== null) {
								if (@$tupel['kode_tupel'] == "OBG") {
									$this->load->view('Periksa/form/periksa_obgyn');
								}else if (@$tupel['kode_tupel'] == "GIG") {
									$this->load->view('Periksa/form/periksa_gigi');
								}else {
									$this->load->view('Periksa/form/periksa2');
								}

							} else { ?>
								<?php if (@$tupel['kode_tupel'] == "OBG"): ?>
										<a href="<?php echo base_url(); ?>Periksa/obgyn/<?php echo @$idkunjungan; ?>">
								<?php elseif (@$tupel['kode_tupel'] == "GIG"): ?>
										<a href="<?php echo base_url(); ?>PoliGigi/input/<?php echo @$idkunjungan; ?>">
								<?php else: ?>
										<a href="<?php echo base_url(); ?>Periksa/pemeriksaan/<?php echo @$idkunjungan; ?>">
								<?php endif; ?>

								<button type="button" class="btn btn-success"> <i class="fa fa-user-md"></i> Tambah Pemeriksaan</button>
							</a>
							<?php } ?>
						</div>
						<!-- <div class="card-footer"> -->
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="tindakan" role="tabpanel" aria-labelledby="tindakan-tab">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>TINDAKAN dan DIAGNOSA</strong>
							<small>SubForm</small>
						</div>
						<div class="card-body card-block">
							<?php
							$jmldiagnosa = $this->ModelPeriksa->get_diagnosa(@$periksa['idperiksa'])->num_rows();
							$jmltindakan = $this->ModelPeriksa->get_tindakan(@$periksa['idperiksa'])->num_rows();
							if ($jmldiagnosa > 0 && $jmltindakan > null) {
							$this->load->view('Periksa/form/tindakan');
							} else { ?>
							<a href="<?php echo base_url(); ?>Periksa/tindakan/<?php echo @$periksa['idperiksa']; ?>">
								<button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Diagnosa dan Tindakan</button>
							</a>
							<?php } ?>
						</div>
						<!-- <div class="card-footer"> -->
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="laborat" role="tabpanel" aria-labelledby="laborat-tab">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>LABORATURIAM</strong>
							<small>SubForm</small>
						</div>
						<div class="card-body card-block">
							<?php
							$jmllab = $this->ModelPeriksa->get_lab(@$periksa['idperiksa'])->num_rows();
							if ($jmllab > 0) {
							$this->load->view('Periksa/form/laborat');
							} else { ?>
							<a href="<?php echo base_url(); ?>Periksa/lab/<?php echo @$periksa['idperiksa']; ?>">
								<button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Kunjungan LABORAT</button>
							</a>
							<?php } ?>
						</div>
						<!-- <div class="card-footer"> -->
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="resep" role="tabpanel" aria-labelledby="resep-tab">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>RESEP OBAT</strong>
							<small>SubForm</small>
						</div>
						<div class="card-body card-block">

							<?php
							$jmlresep= $this->ModelPeriksa->get_resep(@$periksa['idperiksa'])->num_rows();
							if ($jmlresep > 0) {
							$this->load->view('Periksa/form/resep');
							} else { ?>
								<a href="<?php echo base_url(); ?>Periksa/resep/<?php echo @$periksa['idperiksa']; ?>">
									<button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Resep Obat</button>
								</a>
							<?php } ?>
						</div>
						<!-- <div class="card-footer"> -->
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="tab-pane fade" id="kunjungan" role="tabpanel" aria-labelledby="kunjungan-tab">
			<h1>RIWAYAT KUNJUNGAN</h1>
			<?php $this->load->view('Periksa/riwayat/riwayat_kunjungan')?>
		</div>
		<div class="tab-pane fade" id="penyakit" role="tabpanel" aria-labelledby="penyakit-tab">
			<h1>RIWAYAT PENYAKIT</h1>
			<?php $this->load->view('Periksa/riwayat/riwayat_penyakit')?>
		</div>
		<!-- <div class="tab-pane fade" id="planning" role="tabpanel" aria-labelledby="planning-tab">
			<h1>RIWAYAT PLANNING</h1>
		</div> -->
		<!-- <div class="tab-pane fade" id="rlaborat" role="tabpanel" aria-labelledby="rlaborat-tab">
			<h1>RIWAYAT LABORATURIUM</h1>
		</div> -->
		<div class="tab-pane fade" id="pasien" role="tabpanel" aria-labelledby="pasien-tab">
			<h1>Data Pasien</h1>
			<?php $this->load->view('Periksa/form/data_pasien')?>
		</div>
		<?php if (@$Menu_Roles['Asesmen']): ?>
			<div class="tab-pane fade <?php if ($bidan !== 0 && $perawat !== 0): ?>
      <?php else: ?>
        show active
      <?php endif; ?>" id="asesmen" role="tabpanel" aria-labelledby="asesmen-tab">
				<h1>Asesmen Pasien</h1>
        <?php if ($this->ModelDemografi->get_asesmen_kunjungan($idkunjungan)->num_rows() > 0): ?>
          <a href="<?php echo base_url(); ?>Asesmen/input/<?php echo @$idkunjungan."/".@$pasien['noRM']; ?>">
            <button type="button" class="btn btn-warning"> <i class="fa fa-pencil"></i> Ubah Data</button>
          </a>
          <br>
          <br>
          <?php $this->load->view("Demografi/edit") ?>
        <?php else: ?>
          <a href="<?php echo base_url(); ?>Asesmen/input/<?php echo @$idkunjungan."/".@$pasien['noRM']; ?>">
            <button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Input Data</button>
          </a>
        <?php endif; ?>

			</div>
		<?php endif; ?>

	</div>

</div>
</div></div>
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
