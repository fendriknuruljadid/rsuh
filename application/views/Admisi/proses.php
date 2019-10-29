
<style>

	input {
		padding: .5em;
		margin: .5em;
	}
	.ttd{
		max-width: 100px;
		max-width: 100px;
	}
	select {
		padding: .5em;
		margin: .5em;
	}

	#signatureparent {
		color:darkblue;
		background-color:darkgrey;
		/*max-width:600px;*/
		padding:20px;
	}

	/*This is the div within which the signature canvas is fitted*/
	#signature {
    min-height: 400px;
		border: 2px dotted black;
		background-color:lightgrey;
	}

	/* Drawing the 'gripper' for touch-enabled devices */
	html.touch #content {
		float:left;
		width:92%;
	}
	html.touch #scrollgrabber {
		float:right;
		width:4%;
		margin-right:2%;
		background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
	}
	html.borderradius #scrollgrabber {
		border-radius: 1em;
	}

</style>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <a href="" class="white-text mx-3 text-header">Admisi Rawat Inap</a>
						<div>
              <a href="<?php echo base_url()."Admisi/signature/"; ?>" class="float-right" target="_blank">
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Tanda Tangan / Signature"><i class="fas fa-signature mt-0"></i></button>
            </a>
            </div>
      </div>
      <div class="card-body">
        <!-- Validation wizard -->
        <div class="row" id="validation">
            <div class="col-12">
                <div class="card wizard-content">
                    <div class="card-body">
                        <h4 class="card-title">Admisi Rawat Inap</h4>
                        <h6 class="card-subtitle">Pemilihan ruangan dan persetujuan keluarga</h6>
                        <form action="<?php echo base_url()."Admisi/setuju/".$this->uri->segment(3)?>" id="form_custom" method="post" class="validation-wizard wizard-circle">
                            <!-- Step 1 -->
                            <h6>Ruangan Dan Kelas Perawatan</h6>
                            <section style="min-height:400px;margin-top:20px;">
                                <div class="row">
                              <div class="col-md-6"  >

                              <div class="form-group">
                                  <label for="wlastName2"> Kelas Perawatan : <span class="danger">*</span> </label>
                                  <select class="mdb-select required colorful-select dropdown-info sm-form" id="kamar" name="kamar" >
                                    <option value="" disabled selected>Pilih Kamar/Tempat Tidur</option>
                                    <?php foreach ($kamar as $value): ?>
                                      <option value="<?php echo $value->no_tt?>"><?php echo $value->nama_kamar." / kelas ".$value->kelas." / bed ".$value->bed?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="behName1">No RM Pasien</label>
                                      <input type="text" value="<?php echo $pasien['noRM']?>" class="form-control required" id="behName1" name="namapasien" readonly>
                                  </div>
                              </div>
                              <div class="col-md-6"></div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="behName1">Nama Pasien</label>
                                      <input type="text" style="text-transform: uppercase" value="<?php echo $pasien['namapasien']?>" class="form-control required" id="behName1" name="namapasien" readonly>
                                  </div>
                              </div>
                              <div class="col-md-6"></div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="behName1">Alamat</label>
                                      <input type="text" style="text-transform: uppercase" value="<?php echo $pasien['alamat']?>" class="form-control required" id="behName1" name="namapasien" readonly>
                                  </div>
                              </div>
                            </div>
                            </section>

                            <h6>Persetujuan Keluarga Atau Pasien</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
																			<div class="form-group">
				                                  <label for="wlastName3"> Yang Menyetujui Ranap : <span class="danger">*</span> </label>
				                                  <select class="mdb-select required colorful-select dropdown-info sm-form" id="setuju" name="setuju" >
				                                    <option value="" disabled selected>Penanggung Jawab</option>
																						<option value="1" >Pasien Sendiri</option>
																						<option value="2" >Ayah Pasien</option>
																						<option value="3" >Ibu Pasien</option>
																						<option value="4" >Suami Pasien</option>
																						<option value="5" >Istri Pasien</option>
																						<option value="6" >Anak Pasien</option>
																						<option value="7" >Saudara Lain</option>

				                                  </select>
				                                </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="behName1">Nama Pasien / Wali</label>
                                              <input type="text" style="text-transform: uppercase" value="<?php echo $pasien['namapasien']?>" class="form-control required" id="behName1" name="namawali">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="behName1">No KTP/SIM</label>
                                              <input type="text" value="" class="form-control required" id="ktp" name="ktp">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="behName1">Alamat</label>
                                              <input type="text" style="text-transform: uppercase" value="<?php echo $pasien['alamat']?>" class="form-control required" id="behName1" name="alamat">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="behName1">No Telp</label>
                                              <input type="number" value="<?php echo @$pasien['telepon']?>" class="form-control required" id="behName1" name="telp">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="behName1">No Whastapp</label>
                                              <input type="number" value="<?php echo @$pasien['telepon']?>" class="form-control" id="behName1" name="wa">
                                          </div>
                                      </div>

                                    </div>
                                    <div class="col-md-6 p-l-40">
                                      <h6>Signature<h6>
                                        <div id="signature<?php echo $this->uri->segment(3)?>" class="ttd"></div>
                                        <input type="hidden" name="signature" class="mysignature" id="val_signature<?php echo $this->uri->segment(3)?>" value="">
                                    </div>

                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
