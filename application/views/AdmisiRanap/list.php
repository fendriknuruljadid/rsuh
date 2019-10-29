<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <?php echo form_open_multipart('Asesmen/insert');?>
          <?php echo @$error;?>
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h3><a href="" class="white-text mx-3">ASESMEN AWAL KEPERAWATAN</a><h3>
              </div>
              <div class="card-body card-block">
                <div class="card-body card-block">
                  <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                    </div>
                    <div class="col-10 col-lg-4 custom-control custom-radio">
                      <input type="text" name="nokun" maxlength="200" placeholder=" nokun " class="form-control" value="">
                    </div>
                    <div class="col col-md-1">
                      <label for="tanggal" class=" form-control-label">Tanggal</label>
                    </div>
                    <div class="col-10 col-lg-4 custom-control custom-radio">
                      <input type="text" name="nokun" maxlength="200" placeholder=" tanggal " class="form-control" value="">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="norm" class=" form-control-label">Pasien :</label>
                    </div>
                    <div class="col-10 col-lg-2 custom-control custom-radio">
                      <input type="text" name="no_rm" maxlength="200" placeholder="No. Rm" class="form-control" value="">
                    </div>
                    <div class="col-10 col-lg-4 custom-control custom-radio">
                      <input type="text" name="nama_pasien" maxlength="200" placeholder=" nama_pasien" class="form-control" value="">
                    </div>
                    <div class="col-12 col-lg-3 custom-control custom-radio">
                      <input type="text" name="jenis_kunjungan" maxlength="200" placeholder=" jenis_kunjungan" class="form-control" value="">
                    </div>
                    <div class="col-12 col-lg-3 custom-control custom-radio">
                      <input type="text" name="jenis_kelamin" maxlength="200" placeholder=" jenis_kelamin" class="form-control" value="">
                    </div>
                  </div>

                  <!-- <input type="hidden" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
                  <input type="hidden" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly> -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN AWAL KEPERAWATAN</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20 p-b-50">

                          </div>

                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <div class="row form-group">
                                  <div class="col col-md-6">
                                    <label class=" form-control-label">Pengkajian Diambil Dari : </label>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="col-lg-4 col-md-6 custom-control custom-radio">
                                    <input type="radio" id="sumberdata1" name="sumberdata" checked class="custom-control-input" value="Pasien">
                                    <label class="custom-control-label" for="sumberdata1">Pasien</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 custom-control custom-radio">
                                    <input type="radio" id="sumberdata2" name="sumberdata" class="custom-control-input" value="Keluarga">
                                    <label class="custom-control-label" for="sumberdata2">Orang Lain</label>
                                  </div>
                                  <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Nama</span>
                                    </div>
                                    <input type="text" class="form-control rj" name="dokter" value="">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Hubungan</span>
                                    </div>
                                    <input type="text" class="form-control rj" name="rs" value="">
                                  </div>
                                  <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-append">
                                      <span class="input-group-text">Tanggal Pengkajian</span>
                                    </div>
                                    <input type="text" class="form-control rj" name="aak_lainnya" value="">

                                  </div>

                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <div class="row form-group">
                                  <div class="col col-md-6">
                                    <label class=" form-control-label">Hasil Pemeriksaan Yang dibawa Keluarga : </label>
                                  </div>
                                </div>
                                <div class="input-group mb-3 col-md-12">
                                  <div class="col-md-6 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="rujukan1" name="rujukan" class="custom-control-input rujukan" value="Ya">
                                    <label class="custom-control-label" for="rujukan1">Laboratorium</label>
                                  </div>
                                  <div class="col-md-6 col-lg-4 mb-3 custom-control custom-radio">
                                    <input type="radio" id="rujukan2" name="rujukan" checked class="custom-control-input rujukan" value="Tidak">
                                    <label class="custom-control-label" for="rujukan2">Radiologi</label>
                                  </div>
                                  <div class="col-md-6 col-lg-4 mb-3 custom-control custom-radio">
                                    <input type="radio" id="rujukan3" name="rujukan" checked class="custom-control-input rujukan" value="Tidak">
                                    <label class="custom-control-label" for="rujukan4">Diagnostik lain</label>
                                  </div>
                                  <div class="col-md-6 col-lg-4 mb-3 custom-control custom-radio">
                                    <input type="radio" id="rujukan4" name="rujukan" checked class="custom-control-input rujukan" value="Tidak">
                                    <label class="custom-control-label" for="rujukan4">Tidak Ada</label>
                                  </div>

                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12" style="margin-bottom:100px">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Obat - obatan dari Rumah</label>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Riwayat Kesehatan</label>
                                </div>
                              </div>
                              <div class="col col-md-7">
                                <label class=" form-control-label">Keluhan Utama :</label>
                              </div>
                                <div class="col-12 col-lg-10 custom-control custom-radio">
                                  <input type="text" class="form-control" name="prj_skor" value="">
                                </div>
                                <div class="col col-md-7">
                                  <label class=" form-control-label">1. Riwayat Kesehatan Sekarang :</label>
                                </div>
                              <div class="col-12 col-lg-10 custom-control custom-radio">
                                <input type="text" class="form-control" name="prj_skor" value="">
                              </div>
                              <div class="col col-md-7">
                                <label class=" form-control-label">Diagnosis Masuk :</label>
                              </div>
                              <div class="col-12 col-lg-10 custom-control custom-radio">
                                <input type="text" class="form-control" name="prj_skor" value="">
                              </div>
                              <div class="col col-md-7">
                                <label class=" form-control-label">2. Riwayat Penyakit Yang Dialami :</label>
                              </div>
                              <div class="col-12 col-lg-10 custom-control custom-radio">
                                <input type="text" class="form-control" name="prj_skor" value="">
                              </div>
                              <div class="col col-md-7">
                                <label class=" form-control-label">a. Dirawat :</label>
                              </div>
                              <div class="col-12 col-md-10 row">
                                <div class="col-12 col-lg-6 custom-control custom-radio">
                                  <input type="radio" id="dirawat1" name="dirawat" class="custom-control-input" value="lain">
                                  <label class="custom-control-label" for="dirawat1"><input type="text" name="alasanya" class="form-control" placeholder="Ya, alasanya" id="dirawat1"> </label>
                                </div>
                                <div class="col-12 col-lg-3 custom-control custom-radio">
                                  <input type="radio" id="dirawat2" name="dirawat" value="" class="custom-control-input">
                                  <label class="custom-control-label" for="dirawat2">Tidak</label>
                                </div>
                              </div>
                              <div class="col col-md-7">
                                <label class=" form-control-label">b. Operasi / Tindakan :</label>
                              </div>
                              <div class="col-12 col-md-10 row">
                                <div class="col-12 col-lg-6 custom-control custom-radio">
                                  <input type="radio" id="operasi1" name="operasi" class="custom-control-input" value="lain">
                                  <label class="custom-control-label" for="operasi1"><input type="text" name="jenis" class="form-control" placeholder="Ya, jenis" id="operasi1"> </label>
                                </div>
                                <div class="col-12 col-lg-3 custom-control custom-radio">
                                  <input type="radio" id="operasi2" checked name="operasi" value="" class="custom-control-input">
                                  <label class="custom-control-label" for="operasi2">Tidak</label>
                                </div>
                                <div class="row form-group">
                                  <div class="col col-md-7">
                                    <label class=" form-control-label">Ketergantungan :</label>
                                  </div>
                                  <div class="col-12 col-md-12 row">
                                    <div class="col-12 col-lg-5 custom-control custom-checkbox">
                                      <input type="checkbox" id="ketergantungan1" checked name="ketergantungan[]" class="custom-control-input" value="Tidak Ada">
                                      <label class="custom-control-label" for="ketergantungan1">Obat - obatan</label>
                                    </div>
                                    <div class="col-12 col-lg-3 custom-control custom-checkbox">
                                      <input type="checkbox" id="ketergantungan2" name="ketergantungan[]" class="custom-control-input" value="Hipertensi">
                                      <label class="custom-control-label" for="ketergantungan2">Rokok</label>
                                    </div>
                                    <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                      <input type="checkbox" id="ketergantungan3" name="ketergantungan[]" class="custom-control-input" value="TB Paru">
                                      <label class="custom-control-label" for="ketergantungan3">Alkohol</label>
                                    </div>
                                    <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                      <input type="checkbox" id="ketergantungan4" name="ketergantungan[]" class="custom-control-input" value="Diabetes Melitus">
                                      <label class="custom-control-label" for="ketergantungan4">Tidak Ketergantungan</label>
                                    </div>
                                  </div>
                                  <div class="col col-md-7">
                                    <label class=" form-control-label">4. Riwayat Alergi :</label>
                                  </div>
                                  <div class="col-12 col-md-10 row">
                                    <div class="col-12 col-lg-6 custom-control custom-radio">
                                      <input type="radio" id="alergi1" name="alergi" class="custom-control-input" value="lain">
                                      <label class="custom-control-label" for="alergi1"><input type="text" name="ya" class="form-control" placeholder="Ya, " id="alergi1"> </label>
                                    </div>
                                    <div class="col-12 col-lg-3 custom-control custom-radio">
                                      <input type="radio" id="alergi2" name="alergi" value="" class="custom-control-input">
                                      <label class="custom-control-label" for="alergi2">Tidak</label>
                                    </div>
                                  </div>
                                  <div class="col col-md-6">
                                    <label class=" form-control-label">Transfusi Darah : </label>
                                  </div>
                                  <div class="col-12 col-md-10 row">
                                    <div class="col-12 col-lg-6 custom-control custom-radio">
                                      <input type="radio" id="transfusi1" name="transfusi" class="custom-control-input" value="lain">
                                      <label class="custom-control-label" for="transfusi1"><input type="text" name="ya" class="form-control" placeholder="Ya, Waktu Terakhir" id="transfusi1"> </label>
                                    </div>
                                    <div class="col-12 col-lg-3 custom-control custom-radio">
                                      <input type="radio" id="transfusi2" name="transfusi" value="" class="custom-control-input">
                                      <label class="custom-control-label" for="transfusi2">Tidak</label>
                                    </div>
                                  </div>
                                  <div class="col col-md-6">
                                    <label class=" form-control-label">Reaksi Yang Timbul : </label>
                                  </div>
                                  <div class="col-12 col-md-10 row">
                                    <div class="col-12 col-lg-6 custom-control custom-radio">
                                      <input type="radio" id="reaksi1" name="reaksi" class="custom-control-input" value="lain">
                                      <label class="custom-control-label" for="reaksi1"><input type="text" name="ada" class="form-control" placeholder="Ada, " id="reaksi1"> </label>
                                    </div>
                                    <div class="col-12 col-lg-3 custom-control custom-radio">
                                      <input type="radio" id="reaksi2" name="reaksi" value="" class="custom-control-input">
                                      <label class="custom-control-label" for="reaksi2">Tidak Ada</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN FUNGSIONAL</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Tingkat Kesadaran</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-3">
                                  <label class=" form-control-label">a. Kesadaran Kuantitatif</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Skala Koma Glasgow</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">E</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_E" value="" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">M</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_M" value="" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">V</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_V" value="" required>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-3">
                                  <label class=" form-control-label">b. Kesadaran Kualitatif</label>
                                </div>
                              </div>

                            </div>

                                <div class="input-group">
                                    <div class="input-group ">
                                      <div class="input-group-prepend">
                                        <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> -->
                                      </div>
                                      <select name="kesadaran" class="mdb-select colorful-select dropdown-info sm-form" required>
                                        <option value="KOMPOMENTIS"
                                          selected
                                        >KOMPOMENTIS (CM)</option>
                                        <option value="SOMNOLENSE"
                                          selected
                                        >SOMNOLENSE</option>
                                        <option value="STUPOR"
                                          selected
                                        >STUPOR</option>
                                        <option value="KOMA"
                                          selected
                                        >KOMA</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Pemeriksaan Fisik : </label>
                                  </div>
                                </div>
                              <div class="col col-md-4">
                                  <label class=" form-control-label">1. Tanda Vital : </label>
                              </div>
                              <div class="card-body card-block">
                                <div class="row form-group col-12">
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">TD</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_td" id="td_dewasa" onkeyup="hitung_imt()" >
                                      <div class="input-group-append">
                                        <span class="input-group-text">mmHg</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">RR</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_rr" id="rr_dewasa" onkeyup="hitung_imt()">
                                      <div class="input-group-append">
                                        <span class="input-group-text">/mnt</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">S</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_s" >
                                      <div class="input-group-append">
                                        <span class="input-group-text">^C</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">N</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_n" id="n">
                                      <div class="input-group-append">
                                        <span class="input-group-text">/ mnt</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-12 col-md-10 row">
                                      <div class="col-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tandavital1" checked name="tandavital" value="Teratur" class="custom-control-input">
                                        <label class="custom-control-label" for="tandavital1">Teratur</label>
                                    </div>
                                      <div class="col-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tandavital2" name="tandavital" value="Tidak Teratur" class="custom-control-input">
                                        <label class="custom-control-label" for="tandavital2">Tidak Teratur</label>
                                      </div>
                                      <div class="col-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tandavital3" name="tandavital" value="Kuat" class="custom-control-input">
                                        <label class="custom-control-label" for="tandavital3">Kuat</label>
                                      </div>
                                      <div class="col-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tandavital4" name="tandavital" value="Lemah" class="custom-control-input">
                                        <label class="custom-control-label" for="tandavital4">Lemah</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">2. Rambut Kepala : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="rambut_kepala1" checked name="rambut_kepala" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="rambut_kepala1">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="rambut_kepala2" name="rambut_kepala" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="rambut_kepala2">Kotor</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="rambut_kepala3" name="rambut_kepala" value="Ada Benjolan" class="custom-control-input">
                                    <label class="custom-control-label" for="rambut_kepala3">Ada Benjolan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="rambut_kepala4" name="rambut_kepala" value="Rontok" class="custom-control-input">
                                    <label class="custom-control-label" for="rambut_kepala4">Rontok</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">3. Mata : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mata1" checked name="mata" value="Tidak Ada Kelainan" class="custom-control-input">
                                    <label class="custom-control-label" for="mata1">Tidak Ada Kelainan</label>
                                </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mata2" name="mata" value="Sekret" class="custom-control-input">
                                    <label class="custom-control-label" for="mata2">Sekret</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mata3" name="mata" value="Sclera Ikteric" class="custom-control-input">
                                    <label class="custom-control-label" for="mata3">Sclera Ikteric</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">4. Hidung : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hidung1" checked name="hidung" value="Tidak Ada Masalah" class="custom-control-input">
                                    <label class="custom-control-label" for="hidung1">Tidak Ada Masalah</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hidung2" name="hidung" value="Epitaksis" class="custom-control-input">
                                    <label class="custom-control-label" for="hidung2">Epitaksis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hidung3" name="hidung" value="Tersumbat" class="custom-control-input">
                                    <label class="custom-control-label" for="hidung3">Tersumbat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hidung4" name="hidung" value="Sekret" class="custom-control-input">
                                    <label class="custom-control-label" for="hidung4">Sekret</label>
                                  </div>
                                  <div class="col-10 col-lg-4 custom-control custom-radio">
                                    <input type="text" name="hidung_lain" maxlength="200" placeholder="Jelaskan ......" class="form-control" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">5. Telinga : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="telinga1" checked name="telinga" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="telinga1">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="telinga2" name="telinga" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="telinga2">Kotor</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="telinga3" name="telinga" value="Tinitus" class="custom-control-input">
                                    <label class="custom-control-label" for="telinga3">Tinitus</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="telinga4" name="telinga" value="Sekret" class="custom-control-input">
                                    <label class="custom-control-label" for="telinga4">Sekret</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Warna</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_telinga" id="telinga">
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Bau</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_telinga" id="telinga">
                                    </div>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="telinga5" name="telinga" value="Pendengaran Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="telinga5">Pendengaran Normal</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">6. Mulut : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut1" checked name="mulut" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut1">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut2" name="mulut" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut2">Kotor</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut3" name="mulut" value="Berbau" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut3">Berbau</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut4" name="mulut" value="Stomatitis" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut4">Stomatitis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut5" name="mulut" value="Luka" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut5">Luka</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="mulut6" name="mulut" value="Nyeri Menelan" class="custom-control-input">
                                    <label class="custom-control-label" for="mulut6">Nyeri Menelan</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Labio : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="labio1" checked name="labio" value="Mukosa" class="custom-control-input">
                                    <label class="custom-control-label" for="labio1">Mukosa</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="labio2" name="labio" value="Kering" class="custom-control-input">
                                    <label class="custom-control-label" for="labio2">Kering</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="labio3" name="labio" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="labio3">Normal</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Lidah : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="lidah1" checked name="lidah" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="lidah1">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="lidah2" name="lidah" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="lidah2">Kotor</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Gigi : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="gigi1" checked name="gigi" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="gigi1">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="gigi2" name="gigi" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="gigi2">Kotor</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="gigi3" name="gigi" value="Karies" class="custom-control-input">
                                    <label class="custom-control-label" for="gigi3">Karies</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="gigi4" name="gigi" value="Gigi Palsu" class="custom-control-input">
                                    <label class="custom-control-label" for="gigi4">Gigi Palsu</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Faring : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="faring1" checked name="faring" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="faring1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="faring2" name="faring" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="faring2">Pembengkakan Tonsil</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">7. Leher : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="leher1" checked name="leher" value="Tidak Ada Kelainan" class="custom-control-input">
                                    <label class="custom-control-label" for="leher1">Tidak Ada Kelainan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="leher2" name="leher" value="Kaku Kuduk" class="custom-control-input">
                                    <label class="custom-control-label" for="leher2">Kaku Kuduk</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="leher3" name="leher" value="Distensi Vena Jugularis" class="custom-control-input">
                                    <label class="custom-control-label" for="leher3">Distensi Vena Jugularis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="leher4" name="leher" value="Pembesaran Kelenjar Tiroid" class="custom-control-input">
                                    <label class="custom-control-label" for="leher4">Pembesaran Kelenjar Tiroid</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">8. Dada / Thorax : </label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">a. Payudara : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="payudara1" checked name="payudara" value="Tidak Ada Kelainan" class="custom-control-input">
                                    <label class="custom-control-label" for="payudara1">Tidak Ada Kelainan</label>
                                </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="payudara2" name="payudara" value="Ada Benjolan" class="custom-control-input">
                                    <label class="custom-control-label" for="payudara2">Ada Benjolan</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="payudara3" name="payudara" value="Puting Tenggelam" class="custom-control-input">
                                    <label class="custom-control-label" for="payudara3">Puting Tenggelam</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">b. Respirasi : </label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Ekspansi Dada : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="dada1" checked name="dada" value="Simetris" class="custom-control-input">
                                    <label class="custom-control-label" for="dada1">Simetris</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="dada2" name="dada" value="Tidak Simetris" class="custom-control-input">
                                    <label class="custom-control-label" for="dada2">Tidak Simetris</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pola Pernapasan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pola1" checked name="pola" value="Dyspneu" class="custom-control-input">
                                    <label class="custom-control-label" for="pola1">Dyspneu</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pola2" name="pola" value="Bradipneu" class="custom-control-input">
                                    <label class="custom-control-label" for="pola2">Bradipneu</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pola3" name="pola" value="Eupnoe" class="custom-control-input">
                                    <label class="custom-control-label" for="pola3">Eupnoe</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pola4" name="pola" value="Orthopneu" class="custom-control-input">
                                    <label class="custom-control-label" for="pola4">Orthopneu</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bunyi Nafas : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyi1" checked name="bunyi" value="Vesiculer" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyi1">Vesiculer</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyi2" name="bunyi" value="Ronchi / Rales" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyi2">Ronchi / Rales</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyi3" name="bunyi" value="Wheezing" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyi3">Wheezing</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyi4" name="bunyi" value="Stridor" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyi4">Stridor</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Retraksi Dada : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="retraksi1" checked name="retraksi" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="retraksi1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="retraksi2" name="retraksi" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="retraksi2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Batuk : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="batuk1" checked name="batuk" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="batuk1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="batuk2" name="batuk" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="batuk2">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="batuk3" name="batuk" value="Dahak" class="custom-control-input">
                                    <label class="custom-control-label" for="batuk3">Dahak</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="batuk4" name="batuk" value="Kering" class="custom-control-input">
                                    <label class="custom-control-label" for="batuk4">Kering</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">c. Jantung : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="jantung1" checked name="jantung" value="Nyeri Dada" class="custom-control-input">
                                    <label class="custom-control-label" for="jantung1">Nyeri Dada</label>
                                </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="jantung2" name="jantung" value="Tidak Nyeri" class="custom-control-input">
                                    <label class="custom-control-label" for="jantung2">Tidak Nyeri</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Irama : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="irama1" checked name="irama" value="Aritmia" class="custom-control-input">
                                    <label class="custom-control-label" for="irama1">Aritmia</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="irama2" name="irama" value="Ritmis" class="custom-control-input">
                                    <label class="custom-control-label" for="irama2">Ritmis</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Frekuensi Denyut : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="denyut1" checked name="denyut" value="Bradicardi" class="custom-control-input">
                                    <label class="custom-control-label" for="denyut1">Bradicardi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="denyut2" name="denyut" value="Takikardi" class="custom-control-input">
                                    <label class="custom-control-label" for="denyut2">Takikardi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="denyut3" name="denyut" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="denyut3">Normal</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bunyi Jantung : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyijantung1" checked name="bunyijantung" value="S1 S2 Murni Reguler" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyijantung1">S1 S2 Murni Reguler</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyijantung2" name="bunyijantung" value="Murmur" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyijantung2">Murmur</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bunyijantung3" name="bunyijantung" value="Gallop" class="custom-control-input">
                                    <label class="custom-control-label" for="bunyijantung3">Gallop</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">9. Abdomen : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen1" checked name="abdomen" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen2" name="abdomen" value="Ascites" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen2">Ascites</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen3" name="abdomen" value="Kembung" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen3">Kembung</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen4" name="abdomen" value="Defans Muscular" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen4">Defans Muscular</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen5" name="abdomen" value="Mual" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen5">Mual</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="abdomen6" name="abdomen" value="Muntah" class="custom-control-input">
                                    <label class="custom-control-label" for="abdomen6">Muntah</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bising Usus : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="usus1" checked name="usus" value="Tidak Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="usus1">Tidak Ada</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="usus2" name="usus" value="Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="usus2">Ada</label>
                                  </div>
                                  <div class="col-10 col-lg-4 custom-control custom-radio">
                                    <input type="text" name="usus_lain" maxlength="200" placeholder=" Jelaskan ...... " class="form-control" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">10. Genitalia : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="genitalia1" checked name="genitalia" value="Kotor" class="custom-control-input">
                                    <label class="custom-control-label" for="genitalia1">Kotor</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="genitalia2" name="genitalia" value="Bersih" class="custom-control-input">
                                    <label class="custom-control-label" for="genitalia2">Bersih</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="genitalia3" name="genitalia" value="Edema" class="custom-control-input">
                                    <label class="custom-control-label" for="genitalia3">Edema</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pengeluaran Cairan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="cairan1" checked name="cairan" value="Tidak Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="cairan1">Tidak Ada</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="cairan2" name="cairan" value="Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="cairan2">Ada</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">jumlah</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_jumlah" id="pn_dewasa" onkeyup="hitung_imt()" >
                                      <div class="input-group-append">
                                        <span class="input-group-text">ml</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Uretra : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="uretra1" checked name="uretra" value="Hipospadia" class="custom-control-input">
                                    <label class="custom-control-label" for="uretra1">Hipospadia</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="uretra2" name="uretra" value="Sekret" class="custom-control-input">
                                    <label class="custom-control-label" for="uretra2">Sekret</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Alat Bantu Berkemih : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="alatbantu1" checked name="alatbantu" value="Tidak Terpasang" class="custom-control-input">
                                    <label class="custom-control-label" for="alatbantu1">Tidak Terpasang</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="alatbantu2" name="alatbantu" value="Kateter" class="custom-control-input">
                                    <label class="custom-control-label" for="alatbantu2">Kateter</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Hari ke....</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_kateter" id="kateter">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Anus : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="anus1" checked name="anus" value="Haemorrhoid" class="custom-control-input">
                                    <label class="custom-control-label" for="anus1">Haemorrhoid</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="anus2" name="anus" value="Lesi" class="custom-control-input">
                                    <label class="custom-control-label" for="anus2">Lesi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="anus3" name="anus" value="Perdarahan" class="custom-control-input">
                                    <label class="custom-control-label" for="anus3">Perdarahan</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">11. Ekstremitas</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bentuk : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bentuk1" checked name="bentuk" value="Simetris" class="custom-control-input">
                                    <label class="custom-control-label" for="bentuk1">Simetris</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bentuk2" name="bentuk" value="Asimetris" class="custom-control-input">
                                    <label class="custom-control-label" for="bentuk2">Asimetris</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Persendian : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sendi1" checked name="sendi" value="Kontraktur" class="custom-control-input">
                                    <label class="custom-control-label" for="sendi1">Kontraktur</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sendi2" name="sendi" value="Pembengkakan" class="custom-control-input">
                                    <label class="custom-control-label" for="sendi2">Pembengkakan</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Kulit : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="kulit1" checked name="kulit" value="Pucat" class="custom-control-input">
                                    <label class="custom-control-label" for="kulit1">Pucat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="kulit2" name="kulit" value="Sianosis" class="custom-control-input">
                                    <label class="custom-control-label" for="kulit2">Sianosis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="kulit3" name="kulit" value="Ikterik" class="custom-control-input">
                                    <label class="custom-control-label" for="kulit3">Ikterik</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="kulit4" name="kulit" value="Lesi / Luka" class="custom-control-input">
                                    <label class="custom-control-label" for="kulit4">Lesi / Luka</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Kondisi....</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_kulit" id="kulit">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Sirkulasi : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sirkulasi1" checked name="sirkulasi" value="Hangat" class="custom-control-input">
                                    <label class="custom-control-label" for="sirkulasi1">Hangat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sirkulasi2" name="sirkulasi" value="Dingin" class="custom-control-input">
                                    <label class="custom-control-label" for="sirkulasi2">Dingin</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sirkulasi3" name="sirkulasi" value="Berkeringat" class="custom-control-input">
                                    <label class="custom-control-label" for="sirkulasi3">Berkeringat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sirkulasi4" name="sirkulasi" value="CRT" class="custom-control-input">
                                    <label class="custom-control-label" for="sirkulasi4">CRT</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <input type="text" class="form-control" aria-label="" name="pn_crt" id="crt">
                                      <div class="input-group-append">
                                        <span class="input-group-text">....detik</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="sirkulasi5" name="sirkulasi" value="Edema" class="custom-control-input">
                                    <label class="custom-control-label" for="sirkulasi5">Edema</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Grade....</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_edema" id="edema">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">12. Punggung</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bentuk Tulang Belakang : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tulangbelakang1" checked name="tulangbelakang" value="Lurus" class="custom-control-input">
                                    <label class="custom-control-label" for="tulangbelakang1">Lurus</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tulangbelakang2" name="tulangbelakang" value="Lordosis" class="custom-control-input">
                                    <label class="custom-control-label" for="tulangbelakang2">Lordosis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tulangbelakang3" name="tulangbelakang" value="Kifosis" class="custom-control-input">
                                    <label class="custom-control-label" for="tulangbelakang3">Kifosis</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tulangbelakang4" name="tulangbelakang" value="Skoliosis" class="custom-control-input">
                                    <label class="custom-control-label" for="tulangbelakang4">Skoliosis</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Kulit : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="kulitpunggung1" checked name="kulitpunggung" value="Lesi / Luka" class="custom-control-input">
                                    <label class="custom-control-label" for="kulitpunggung1">Lesi / Luka</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Kondisi....</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_kulitpunggung" id="kulitpunggung">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Warna : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="warna1" checked name="warna" value="Kemerahan" class="custom-control-input">
                                    <label class="custom-control-label" for="warna1">Kemerahan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="warna2" name="warna" value="Pucat" class="custom-control-input">
                                    <label class="custom-control-label" for="warna2">Pucat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="warna3" name="warna" value="Tidak Ada Kelainan" class="custom-control-input">
                                    <label class="custom-control-label" for="warna3">Tidak Ada Kelainan</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col col-md-2">
                                <label class=" form-control-label">Pengkajian Fungsi</label>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">1. Sensorik</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Penglihatan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penglihatan1" checked name="penglihatan" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="penglihatan1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penglihatan2" name="penglihatan" value="Kabur" class="custom-control-input">
                                    <label class="custom-control-label" for="penglihatan2">Kabur</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penglihatan3" name="penglihatan" value="Kaca Mata" class="custom-control-input">
                                    <label class="custom-control-label" for="penglihatan3">Kaca Mata</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penglihatan4" name="penglihatan" value="Lensa Kontak" class="custom-control-input">
                                    <label class="custom-control-label" for="penglihatan4">Lensa Kontak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Penciuman : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penciuman1" checked name="penciuman" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="penciuman1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="penciuman2" name="penciuman" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="penciuman2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pendengaran : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendengaran1" checked name="pendengaran" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="pendengaran1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendengaran2" name="pendengaran" value="Tuli Kanan/Kiri" class="custom-control-input">
                                    <label class="custom-control-label" for="pendengaran2">Tuli Kanan/Kiri</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendengaran3" name="pendengaran" value="Alat Bantu Dengar" class="custom-control-input">
                                    <label class="custom-control-label" for="pendengaran3">Alat Bantu Dengar</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">2. Kognitif</label>
                                </div>
                              </div>
                              <div class="col-12 col-md-10 row">
                                <div class="col-12 col-lg-2 custom-control custom-radio">
                                  <input type="radio" id="kognitif1" checked name="kognitif" value="Orientasi Penuh" class="custom-control-input">
                                  <label class="custom-control-label" for="kognitif1">Orientasi Penuh</label>
                                </div>
                                <div class="col-12 col-lg-2 custom-control custom-radio">
                                  <input type="radio" id="kognitif2" name="kognitif" value="Pelupa" class="custom-control-input">
                                  <label class="custom-control-label" for="kognitif2">Pelupa</label>
                                </div>
                                <div class="col-12 col-lg-2 custom-control custom-radio">
                                  <input type="radio" id="kognitif3" name="kognitif" value="Bingung" class="custom-control-input">
                                  <label class="custom-control-label" for="kognitif3">Bingung</label>
                                </div>
                                <div class="col-12 col-lg-2 custom-control custom-radio">
                                  <input type="radio" id="kognitif4" name="kognitif" value="Tidak Dapat Dimengerti" class="custom-control-input">
                                  <label class="custom-control-label" for="kognitif4">Tidak Dapat Dimengerti</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">3. Motorik</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Aktifitas Sehari-hari : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas1" checked name="aktifitas" value="Mandiri" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas1">Mandiri</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas2" name="aktifitas" value="Bantuan Minimal" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas2">Bantuan Minimal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas3" name="aktifitas" value="Bantuan Sebagian" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas3">Bantuan Sebagian</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas4" name="aktifitas" value="Ketergantungan Total" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas4">Ketergantungan Total</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas5" name="aktifitas" value="Berjalan" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas5">Berjalan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas6" name="aktifitas" value="Tidak Ada Kesulitan" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas6">Tidak Ada Kesulitan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas7" name="aktifitas" value="Perlu Bantuan" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas7">Perlu Bantuan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas8" name="aktifitas" value="Sering Jatuh" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas8">Sering Jatuh</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="aktifitas9" name="aktifitas" value="Kelumpuhan" class="custom-control-input">
                                    <label class="custom-control-label" for="aktifitas9">Kelumpuhan</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                    <div class="col-lg-12">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>SKRINING NUTRISI</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Intake Nutrisi Lewat : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="intakenutrisi1" checked name="intakenutrisi" value="Oral" class="custom-control-input">
                                <label class="custom-control-label" for="intakenutrisi1">Oral</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="intakenutrisi2" name="intakenutrisi" value="NGT" class="custom-control-input">
                                <label class="custom-control-label" for="intakenutrisi2">NGT</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="intakenutrisi3" name="intakenutrisi" value="Gastrot stomy" class="custom-control-input">
                                <label class="custom-control-label" for="intakenutrisi3">Gasrot stomy</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="intakenutrisi4" name="intakenutrisi" value="Lain lain" class="custom-control-input">
                                <label class="custom-control-label" for="intakenutrisi4">Lain lain</label>
                              </div>
                              <div class="col-10 col-lg-4 custom-control custom-radio">
                                <input type="text" name="intakenutrisi_lain" maxlength="200" placeholder="......" class="form-control" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Kondisi Nutrisi Saat : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kondisinutrisi1" checked name="kondisinutrisi" value="Pasien Operasi" class="custom-control-input">
                                <label class="custom-control-label" for="kondisinutrisi1">Pasien Operasi</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kondisinutrisi2" name="kondisinutrisi" value="Mendapat Kemoterapi" class="custom-control-input">
                                <label class="custom-control-label" for="kondisinutrisi2">Mendapat Kemoterapi</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kondisinutrisi3" name="kondisinutrisi" value="Obesitas" class="custom-control-input">
                                <label class="custom-control-label" for="kondisinutrisi3">Obesitas</label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Penyakit Yang Terkait : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="penyakitterkait1" checked name="penyakitterkait" value="DM" class="custom-control-input">
                                <label class="custom-control-label" for="penyakitterkait1">DM</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="penyakitterkait2" name="penyakitterkait" value="Terapi Diit" class="custom-control-input">
                                <label class="custom-control-label" for="penyakitterkait2">Terapi Diit</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="penyakitterkait3" name="penyakitterkait" value="Gangguan Saluran Cerna" class="custom-control-input">
                                <label class="custom-control-label" for="penyakitterakait3">Gangguan Saluran Cerna</label>
                              </div>
                            </div>
                          </div>
                          <div class="card-body card-block">
                            <div class="row form-group col-12">
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">BB</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="pn_bb" id="bb_dewasa" onkeyup="hitung_imt()" >
                                  <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">TB</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="pn_tb" id="tb_dewasa" onkeyup="hitung_imt()">
                                  <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">LILA</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="pn_lila" >
                                  <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">IMT</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="pn_imt" id="imt">
                                  <div class="input-group-append">
                                    <span class="input-group-text">kg/cm2</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group col-12">
                                <div class="card-header col-12">
                                  <strong>Malnutrion Screening Tool (MST)</strong> untuk pasien dewasa
                                </div><br>
                                <div class="col-lg-6 row">
                                  <strong>1. Apakah ada penurunan berat badan yang tidak diinginkan selam 6 bulan terakhir?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_1" checked name="mst_1" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="mst_1">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_2" name="mst_2" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="mst_2">Tidak Yakin : skor 1</label>
                                  </div>
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="radio" id="mst_3" name="mst_3" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="mst_3">Ya, 1-5kg (skor 1), 6-10 (skor 2), 10-15 (skor 3), <= 15 (skor 4)</label>
                                  </div>
                                  <br><br><br><br>
                                  <strong>2. Apakah asupan makan menurun dikarenakan adanya penurunan nafsu makan atau kesulitan menerima makanan ?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_4" checked name="mst_4" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="mst_4">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_5" name="mst_5" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="mst_5">Ya : skor 2</label>
                                  </div>
                                </div>
                                <div class="col-lg-6 bg-secondary">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TOTAL SKOR :</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="mst_skor" value="0">
                                  </div>
                                  <b>Keterangan :</b><br>
                                  Skor 0 - 1 : Tidak beresiko<br>
                                  Skor 3 - 4 : beresiko (memerlukan asesmen gizi)<br>
                                  Skor <= 4  : Malnutrisi
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>SKRINING NYERI</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Adakah keluhan nyeri : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="keluhannyeri1" checked name="keluhannyeri" value="Tidak" class="custom-control-input">
                                <label class="custom-control-label" for="keluhannyeri1">Tidak</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="keluhannyeri2" name="keluhannyeri" value="Ya, Lanjutkan" class="custom-control-input">
                                <label class="custom-control-label" for="keluhannyeri2">Ya, Lanjutkan</label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5">
                              <label class=" form-control-label">Penyebab / Provoke :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-12 custom-control custom-radio">
                                <input type="text" class="form-control" name="penyebab_provoke" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Kulit : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas1" checked name="kualitas" value="Menekan" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas1">Menekan</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas2" name="kualitas" value="Menusuk" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas2">Menusuk</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas3" name="kualitas" value="Berdenyut Denyut" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas3">Berdenyut Denyut</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas4" name="kualitas4" value="Menyebar" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas4">Menyebar</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas5" name="kualitas" value="Menyengat" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas5">Menyengat</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas6" name="kualitas" value="Pedih" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas6">Pedih</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kualitas7" name="kualitas" value="Lainnya" class="custom-control-input">
                                <label class="custom-control-label" for="kualitas7">Lainnya</label>
                              </div>
                              <div class="col-10 col-lg-4 custom-control custom-radio">
                                <input type="text" name="kualitas_lain" maxlength="200" placeholder="......." class="form-control" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5">
                              <label class=" form-control-label">Lokasi / Radius :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-12 custom-control custom-radio">
                                <input type="text" class="form-control" name="lokasi_radius" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-7">
                              <label class=" form-control-label">Intensitas / Scala : gunakan pengkajian nyeri sesuai dengan usia pasien</label>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-9 custom-control custom-radio">
                                <input type="radio" id="prj_umur1" checked name="prj_umur" class="custom-control-input" value="Anak">
                                <label class="custom-control-label" for="prj_umur1">Usia < 1 tahun : Neonatal Infantts Pain Scale (NIPS)</label>
                              </div>
                              <div class="col-12 col-lg-9 custom-control custom-radio">
                                <input type="radio" id="prj_umur2" name="prj_umur" class="custom-control-input" value="Dewasa">
                                <label class="custom-control-label" for="prj_umur2">Usia < 6 tahun : Face Legs Activity Cray Consolabilitas (FLACCS)</label>
                              </div>
                              <div class="col-12 col-lg-9 custom-control custom-radio">
                                <input type="radio" id="prj_umur3" name="prj_umur" class="custom-control-input" value="Lansia">
                                <label class="custom-control-label" for="prj_umur3">Usia > 6 tahun : Wong Baker Face Pain</label>
                              </div>
                              <div class="col-12 col-lg-9 custom-control custom-radio">
                                <input type="radio" id="prj_umur4" name="prj_umur" class="custom-control-input" value="Lansia">
                                <label class="custom-control-label" for="prj_umur4">Pasien tidak sadar menggunakan Non Verbal Pain Scale</label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5">
                              <label class=" form-control-label">Score :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-12 custom-control custom-radio">
                                <input type="text" class="form-control" name="score" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Durasi / Time : </label>
                            </div>
                            <div class="col-10 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="durasi1" checked name="durasi" value="Mulai kapan" class="custom-control-input">
                                <label class="custom-control-label" for="durasi1">Mulai kapan</label>
                              </div>
                              <div class="col-10 col-lg-4 custom-control custom-radio">
                                <input type="text" name="durasi_lain" maxlength="200" placeholder="......" class="form-control" value="">
                              </div>
                            </div>
                            <div class="col-10 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="durasi2" checked name="durasi" value="Berapa lama" class="custom-control-input">
                                <label class="custom-control-label" for="durasi2">Berapa lama</label>
                              </div>
                              <div class="col-10 col-lg-4 custom-control custom-radio">
                                <input type="text" name="durasi_lain" maxlength="200" placeholder="......" class="form-control" value="">
                              </div>
                            </div>
                            <div class="col-10 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="durasi3" checked name="durasi" value="Frekuensi" class="custom-control-input">
                                <label class="custom-control-label" for="durasi3">Frekuensi</label>
                              </div>
                              <div class="col-10 col-lg-4 custom-control custom-radio">
                                <input type="text" name="durasi_lain" maxlength="200" placeholder="......" class="form-control" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Nyeri hilang jika : </label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="nyerihilang1" checked name="nyerihilang" value="Istirahat" class="custom-control-input">
                                <label class="custom-control-label" for="nyerihilang1">Istirahat</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="nyerihilang2" name="nyerihilang" value="Minum Obat" class="custom-control-input">
                                <label class="custom-control-label" for="nyerihilang2">Minum obat</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="nyerihilang3" name="nyerihilang" value="Lain - lain" class="custom-control-input">
                                <label class="custom-control-label" for="nyerihilang3">Lain - lain</label>
                              </div>
                            </div>
                          </div>

                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>SKRINING RESIKO JATUH</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                          <th width="10%">
                                            <input type="checkbox" class="form-check-input select-all" id="tableMaterialCheckall">
                                            <label class="form-check-label" for="tableMaterialCheckall"></label>
                                          </th>
                                            <th>Lembar pengkajian resiko jatuh sesuai kelompok umur</th>
                                            <th>Total Scor</th>
                                            <th>Kriteria</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <td>
                                            <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck1" name="id[]" value="">
                                            <label class="form-check-label" for="tableMaterialCheck1"></label>
                                          </td>
                                            <td>Untuk anak(usia 0-16 th) menggunakan Humpty Dumpty</td>
                                            <td></td>
                                            <td>Resiko Rendah : 7-11</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck2" name="id[]" value="">
                                            <label class="form-check-label" for="tableMaterialCheck2"></label>
                                          </td>
                                            <td>Untuk dewasa(usia 17-64 th) menggunakan Morse False Scale</td>
                                            <td></td>
                                            <td>Tidak Resiko : 0-24</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck3" name="id[]" value="">
                                            <label class="form-check-label" for="tableMaterialCheck3"></label>
                                          </td>
                                            <td>Untuk lansia(usia >65 th) menggunakan Ontario Modified Sratiffy- Sydney Scoring</td>
                                            <td></td>
                                            <td>Tidak Resiko : 0-5</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                  </table>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>RESPON PSIKOLOGI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi1" checked name="psikologi" value="Denial (Menolak/Tidak Percaya)" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi1">Denial (Menolak/Tidak Percaya)</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi2" name="psikologi" value="Accepetion (Menerima)" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi2">Acception (Menerima)</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi3" name="psikologi" value="Bergaining (Tawar-menawar)" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi3">Bergaining (Tawar-menawar)</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi4" name="psikologi" value="Tidak Semangat" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi4">Tidak Semangat</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi5" name="psikologi" value="Tertekan" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi5">Tertekan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi6" name="psikologi" value="Depresi" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi6">Depresi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi7" name="psikologi" value="Cemas" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi7">Cemas</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi8" name="psikologi" value="Sulit Tidur" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi8">Sulit Tidur</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi9" name="psikologi" value="Takut" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi9">Takut</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi10" name="psikologi" value="Takut Dengan Lingkungan Rumah Sakit" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi10">Takut Dengan Lingkungan Rumah Sakit</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="psikologi11" name="psikologi" value="Takut Dengan Terapi Pembedahan" class="custom-control-input">
                                    <label class="custom-control-label" for="psikologi11">Takut Dengan Terapi Pembedahan</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>SOSIAL, SPIRITUAL, DAN EKONOMI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pendidikan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendidikan1" checked name="pendidikan" value="SD" class="custom-control-input">
                                    <label class="custom-control-label" for="pendidikan1">SD</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendidikan2" name="pendidikan" value="SMP" class="custom-control-input">
                                    <label class="custom-control-label" for="pendidikan2">SMP</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendidikan3" name="pendidikan" value="SMA" class="custom-control-input">
                                    <label class="custom-control-label" for="pendidikan3">SMA</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pendidikan4" name="pendidikan" value="Perguruan Tinggi" class="custom-control-input">
                                    <label class="custom-control-label" for="pendidikan4">Perguruan Tinggi</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Status Perkawinan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="perkawinan1" checked name="perkawinan" value="Kawin" class="custom-control-input">
                                    <label class="custom-control-label" for="perkawinan1">Kawin</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="perkawinan2" name="perkawinan" value="Belum Kawin" class="custom-control-input">
                                    <label class="custom-control-label" for="perkawinan2">Belum Kawin</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="perkawinan3" name="perkawinan" value="Janda / Duda" class="custom-control-input">
                                    <label class="custom-control-label" for="perkawinan3">Janda / Duda</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Tinggal Dengan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggaldengan1" checked name="tinggaldengan" value="Orang Tua" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggaldengan1">Orang Tua</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggaldengan2" name="tinggaldengan" value="Suami" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggaldengan2">Suami</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggaldengan3" name="tinggaldengan" value="Anak" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggaldengan3">Anak</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggaldengan4" name="tinggaldengan" value="Sendiri" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggaldengan4">Sendiri</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggaldengan5" name="tinggaldengan" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="tinggaldengan5"><input type="text" class="form-control" placeholder="Lain - Lain" name="tinggaldengan" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Agama : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agama1" checked name="agama" value="Islam" class="custom-control-input">
                                    <label class="custom-control-label" for="agama1">Islam</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agama2" name="agama" value="Hindu" class="custom-control-input">
                                    <label class="custom-control-label" for="agama2">Hindu</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agama3" name="agama" value="Katholik" class="custom-control-input">
                                    <label class="custom-control-label" for="agama3">Katholik</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agama4" name="agama" value="Buddha" class="custom-control-input">
                                    <label class="custom-control-label" for="agama4">Buddha</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agama5" name="agama" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="agama5"><input type="text" class="form-control" placeholder="Lain - Lain" name="agama" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pekerjaan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pekerjaan1" checked name="pekerjaan" value="Wiraswasta" class="custom-control-input">
                                    <label class="custom-control-label" for="pekerjaan1">Wiraswasta</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pekerjaan2" name="pekerjaan" value="PNS/TNI/POLRI" class="custom-control-input">
                                    <label class="custom-control-label" for="pekerjaan2">PNS/TNI/POLRI</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pekerjaan3" name="pekerjaan" value="Siswa/Mahasiswa" class="custom-control-input">
                                    <label class="custom-control-label" for="pekerjaan">Siswa/Mahasiswa</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pekerjaan4" name="pekerjaan" value="Tidak Bekerja" class="custom-control-input">
                                    <label class="custom-control-label" for="pekerjaan4">Tidak Bekerja</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pekerjaan5" name="pekerjaan" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="pekerjaan5"><input type="text" class="form-control" placeholder="Lainnya..." name="pekerjaan" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pembayaran saat dirumah sakit : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pembayaran1" checked name="pembayaran" value="Pribadi" class="custom-control-input">
                                    <label class="custom-control-label" for="pembayaran1">Pribadi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pembayaran2" name="pembayaran" value="Perusahaan" class="custom-control-input">
                                    <label class="custom-control-label" for="pembayaran2">Perusahaan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pembayaran3" name="pembayaran" value="Asuransi" class="custom-control-input">
                                    <label class="custom-control-label" for="pembayaran">Asuransi</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pembayaran4" name="pembayaran" value="BPJS" class="custom-control-input">
                                    <label class="custom-control-label" for="pembayaran4">BPJS</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pembayaran5" name="pembayaran" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="pekerjaan5"><input type="text" class="form-control" placeholder="Lainnya..." name="pembayaran5" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Tinggal Bersama : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggalbersama1" checked name="tinggalbersama" value="Orang Tua" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggalbersama1">Orang Tua</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggalbersama2" name="tinggalbersama" value="Anak Sendiri" class="custom-control-input">
                                    <label class="custom-control-label" for="tinggalbersama2">Anak Sendiri</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="tinggalbersama3" name="tinggalbersama" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="tinggalbersama3"><input type="text" class="form-control" placeholder="Lainnya..." name="tinggalbersama3" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Budaya dalam keluarga yang mempengaruhi pola kesehatan : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="budayapolakesehatan1" checked name="budayapolakesehatan" value="Tidak Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="budayapolakesehatan1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="budayapolakesehatan2" name="budayapolakesehatan" value="Ada" class="custom-control-input">
                                    <label class="custom-control-label" for="budayapolakesehatan2">Ada</label>
                                  </div>
                                  <div class="col-10 col-lg-4 custom-control custom-radio">
                                    <input type="text" name="budayapolakesehatan_lain" maxlength="200" placeholder=" Jelaskan ...... " class="form-control" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Agama : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma1" checked name="agma" value="Islam" class="custom-control-input">
                                    <label class="custom-control-label" for="agma1">Islam</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma2" name="agma" value="Katholik" class="custom-control-input">
                                    <label class="custom-control-label" for="agma2">Katholik</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma3" name="agma" value="Buddha" class="custom-control-input">
                                    <label class="custom-control-label" for="agma3">Buddha</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma4" name="agma" value="Protestan" class="custom-control-input">
                                    <label class="custom-control-label" for="agma4">Protestan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma5" name="agma" value="Hindu" class="custom-control-input">
                                    <label class="custom-control-label" for="agma5">Hindu</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="agma6" name="agma" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="agma6"><input type="text" class="form-control" placeholder="Lain - Lain" name="agma" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bantuan Spiritual : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bantuanspiritual1" checked name="bantuanspiritual" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="bantuanspiritual1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bantuanspritual2" name="bantuanspiritual" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="bantuanspiritual2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>ASESMEN KOMUNIKASI DAN EDUKASI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bicara : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bicara1" checked name="bicara" value="Normal" class="custom-control-input">
                                    <label class="custom-control-label" for="bicara1">Normal</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bicara2" name="bicara" value="Pelo" class="custom-control-input">
                                    <label class="custom-control-label" for="bicara2">Pelo</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bicara3" name="bicara" value="Gagap" class="custom-control-input">
                                    <label class="custom-control-label" for="bicara3">Gagap</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bicara4" name="bicara" value="Belum Bisa Bicara" class="custom-control-input">
                                    <label class="custom-control-label" for="bicara4">Belum Bisa Bicara</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bicara5" name="bicara" value="Gangguan Bicara Sejak" class="custom-control-input">
                                    <label class="custom-control-label" for="bicara5">Gangguan Bicara Sejak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Apakah Membutuhkan Edukasi : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="edukasi1" checked name="edukasi" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="edukasi1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="eduaksi2" name="edukasi" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="edukasi2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Bahasa Sehari - hari : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bahasa1" checked name="bahasa" value="Indonesia" class="custom-control-input">
                                    <label class="custom-control-label" for="bahasa1">Indonesia</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bahasa2" name="bahasa" value="Asing" class="custom-control-input">
                                    <label class="custom-control-label" for="bahasa2">Asing</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bahasa3" name="bahasa" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="bahasa3"><input type="text" class="form-control" placeholder="Lainnya..." name="bahasa3" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Materi Edukasi</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi1" checked name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi1">Orientasi Ruangan</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi2" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi2">Tim yang memberi Perawatan, Pengobatan, dan Konsultasi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi3" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi3">Pengertian tentang Diagnosis penyakit, Penyebab penyakit, Tanda dan gejala</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi4" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi4">Obat - obatan yang didapat</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi5" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi5">Program diet dan Nutrisi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi6" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi6">Manajemen Nyeri</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi7" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi7">Pencegahan dan Pengendalian Infeksi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi8" name="materiedukasi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="materiedukasi8">Pencegahan dan Pengenalan Risiko Jatuh</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="materiedukasi9" name="materiedukasi" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="materiedukasi9"><input type="text" class="form-control" placeholder="Lainnya..." name="materiedukasi9" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Hambatan Komunikasi : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hambatankomunikasi1" checked name="hambatankomunikasi" value="Tidak Ada Hambatan" class="custom-control-input">
                                    <label class="custom-control-label" for="hambatankomunikasi1">Tidak Ada Hambatan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hambatankomunikasi2" name="hambatankomunikasi" value="Tidak Bersedia" class="custom-control-input">
                                    <label class="custom-control-label" for="hambatankomunikasi2">Tidak Bersedia</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hambatankomunikasi3" name="hambatankomunikasi" value="Cemas" class="custom-control-input">
                                    <label class="custom-control-label" for="hambatankomunikasi3">Cemas</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="hambatankomunikasi4" name="hambatankomunikasi" value="Emosi" class="custom-control-input">
                                    <label class="custom-control-label" for="hambatankomunikasi4">Emosi</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>POLA AKTIFITAS SEHARI - HARI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">1. Pola Istirahat dan Tidur</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="responpsikologi1" checked name="responpsikologi" value="Denial (Menolak/Tidak Percaya)" class="custom-control-input">
                                    <label class="custom-control-label" for="responpsikologi1">Tidak ada kelainan</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="responpsikologi2" name="responpsikologi" value="Acception (Menerima)" class="custom-control-input">
                                    <label class="custom-control-label" for="responpsikologi2">Gelisah</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="responpsikologi3" name="responpsikologi" value="Bergaining (Tawar-menawar)" class="custom-control-input">
                                    <label class="custom-control-label" for="responpsikologi3">Sukar Tidur</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="responpsikologi4" name="responpsikologi" value="Tidak Semangat" class="custom-control-input">
                                    <label class="custom-control-label" for="responpsikologi4">Tidur sering terbangun</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="responpsikologi5" name="responpsikologi" value="Tertekan" class="custom-control-input">
                                    <label class="custom-control-label" for="responpsikologi5">Lama tidur : </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">2. Makan dan Minum</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class=" form-control-label">a.</label>
                                      <span class="input-group-text">Makan</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_makan" id="makan">
                                    <div class="input-group-append">
                                      <span class="input-group-text">x/hari</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Jenis</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_makan" id="makan">
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Pantangan</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_makan" id="makan">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Diet Khusus : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="dietkhusus1" checked name="dietkhusus" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="dietkhusus1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="dietkhusus2" name="dietkhusus" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="dietkhusus2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class=" form-control-label">b.</label>
                                      <span class="input-group-text">Minum</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_minum" id="minum">
                                    <div class="input-group-append">
                                      <span class="input-group-text">ml/hari</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Jenis</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_minum" id="minum">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">3. Eliminasi</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Frekuensi BAB</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_bab" id="bab">
                                    <div class="input-group-append">
                                      <span class="input-group-text">x/hari</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Konsistensi</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_konsistensi" id="konsistensi">
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Warna</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_warna" id="warna">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Frekuensi BAK</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_bak" id="bak">
                                    <div class="input-group-append">
                                      <span class="input-group-text">x/hari</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Warna</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_warna" id="warna">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">4. Kebersihan Diri</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="mandi1" checked name="mandi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="mandi1">Mandi : </label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" aria-label="" name="pn_mandi" id="mandi">
                                  <div class="input-group-append">
                                    <span class="input-group-text">....x/hari</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="sikatgigi1" name="sikatgigi" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="sikatgigi1">Sikat Gigi : </label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" aria-label="" name="pn_sikatgigi" id="sikatgigi">
                                  <div class="input-group-append">
                                    <span class="input-group-text">....x/hari</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="keramas1" name="keramas" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="keramas1">Keramas : </label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" aria-label="" name="pn_keramas" id="keramas">
                                  <div class="input-group-append">
                                    <span class="input-group-text">....x/hari</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>ASESMEN RESTRAIN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Pernah Menggunakan Restrain : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pernahrestrain1" checked name="pernahrestrain" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="pernahrestrain1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="pernahrestrain2" name="pernahrestrain" value="Ya, Jika ya" class="custom-control-input">
                                    <label class="custom-control-label" for="pernahrestrain2">Ya, Jika ya</label>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Kapan</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_restrain" id="restrain">
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Jenisnya</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="pn_restrain" id="restrain">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-2">
                                  <label class=" form-control-label">Saat ini menggunakan Restrain : </label>
                                </div>
                                <div class="col-12 col-md-10 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="restrain1" checked name="restrain" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="restrain1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="restrain2" name="restrain" value="Ya, Jika ya" class="custom-control-input">
                                    <label class="custom-control-label" for="restrain2">Ya, Jika ya lanjut ke asesmen restrain</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PERENCANAAN PASIEN PULANG (Discharge Planning)</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Kriteria Discharge Planning</label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-6">
                                  <label class=" form-control-label">1. Usia Lanjut/Gerontik, Bayi Prematur, Neonatus, Pediatrik Bermasalah</label>
                                </div>
                                <div class="col-12 col-md-5 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="usialanjut1" checked name="usialanjut" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="usialanjut1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="usialanjut2" name="usialanjut" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="usialanjut2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-6">
                                  <label class=" form-control-label">2. Mengalami Keterbatasan Mobilitas</label>
                                </div>
                                <div class="col-12 col-md-5 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="keterbatasanmobilitas1" checked name="keterbatasanmobilitas" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="keterbatasanmobilitas1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="keterbatasanmobilitas2" name="keterbatasanmobilitas" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="keterbatasanmobilitas2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-6">
                                  <label class=" form-control-label">3. Membutuhkan Perawatan dan Pengobatan Berkelanjutan</label>
                                </div>
                                <div class="col-12 col-md-5 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="perawatankelanjutan1" checked name="perawatankelanjutan" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="perawatankelanjutan1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="perawatankelanjutan2" name="perawatankelanjutan" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="perawatankelanjutan2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-6">
                                  <label class=" form-control-label">4. Membutuhkan Bantuan Untuk Melakukan Aktifitas Fisik</label>
                                </div>
                                <div class="col-12 col-md-5 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bantuanfisik1" checked name="bantuanfisik" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="bantuanfisik1">Ya</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="bantuanfisik2" name="bantuanfisik" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="bantuanfisik2">Tidak</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Bila salah satu jawaban "Ya" dari kriteria pulang diatas, maka akan dilanjutkan dengan perencanaan pulang sbb : </label>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang1" checked name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang1">Perawatan diri (Mandi, BAK, BAB)</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang2" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang2">Pemantauan pemberian obat</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang3" name="perencanaanpulang3" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang3">Pemantauan diet</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang4" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang4">Perawatan luka</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang5" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang5">Latihan fisik lanjutan</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang6" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang6">Pendamping tenaga khusus di rumah</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang7" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang7">Bantuan Medis/perawatan di rumah (Home care)</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="perencanaanpulang8" name="perencanaanpulang" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang">Bantuan untuk melakukan aktifitas fisik (Kursi roda, Alat bantu jalan)</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>DAFTAR MASALAH KEPERAWATAN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan1" checked name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan1">Nyeri</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan2" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan2">Keselamatan pasien / resiko jatuh</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan3" name="masalahkeperawatan3" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan3">Penanganan Nutrisi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan4" name="masalahkeperawatan4" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan4">Suhu Tubuh</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan5" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan5">Jalan Nafas / Pertukaran Gas</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan6" name="masalahkeperawatan6" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan">Perfusi Jaringan</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan7" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan7">Eliminasi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan8" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan8">Integritas Kulit</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan9" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan9">Pola Tidur</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan10" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan10">Tumbuh Kembang</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan11" name="masalahkeperawatan12" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan12">Cemas</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan13" name="masalahkeperawatan13" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan13">Mobilitas / Aktifitas</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan14" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan14">Konflik Peran</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan15" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan15">Perawatan Diri</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan16" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="perencanaanpulang">Pengetahuan</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan17" name="masalahkeperawatan" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan18">Komunikasi</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="masalahkeperawatan18" name="masalahkeperawatan18" class="custom-control-input" value="">
                                    <label class="custom-control-label" for="masalahkeperawatan18">Lain - lain : </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php if ($_SESSION['poli']=="OBG"): ?>
                          <hr>
                          <h4> <b>Riwayat Kehamilan, Persalinan dan Nifas yang lalu</b> <button class="btn btn-info" type="button" data-toggle="modal" data-target="#tambahriwayat"><i class="fa fa-plus"></i> Tambah Riwayat
                          </button></h4>
                          <div class="table-responsive mb-3" id="riwayat">
                            <table id="example22" class="table table-striped table-bordered table-hover">
                              <thead>
                                <th>Tahun Partus</th>
                                <th>Tempat Partus</th>
                                <th>Umur Hamil</th>
                                <th>Jenis Persalinan</th>
                                <th>Penolong</th>
                                <th>Penyulit</th>
                                <th>JK</th>
                                <th>BB</th>
                                <th>H/M</th>
                                <th>Opsi</th>
                              </thead>
                              <tbody id="tabel_riwayat">

                              </tbody>
                            </table>
                          </div>
                          <div id="tambahriwayat" class="modal fade" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Tambah Riwayat</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="fa fa-window-close"></i></button>
                                  </div>
                                  <div class="modal-body">
                                    <?php $this->load->view('Pasien/riwayatobgyn') ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-primary input_riwayat">Tambahkan</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-primary" style="border: 2px solid;">
                            <div class="card-header bg-primary text-white">
                              <strong>Riwayat Kesehatan Sekarang :</strong>
                            </div>
                            <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" hidden>
                            <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" hidden>
                            <div class="card-body card-block">
                              1. Riwayat Menstruasi
                              <div class="row p-t-10">
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Menarche Umur :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="input-group">
                                        <input type="number" name="manarcheumur" class="form-control" placeholder="Menarche Umur">
                                        <div class="input-group-append"><span class="input-group-text">Th</span></div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Lamanya Haid :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="input-group">
                                        <input type="number" name="lamahaid" class="form-control" placeholder="Lamanya Haid :">
                                        <div class="input-group-append"><span class="input-group-text">hari</span></div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Siklus :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="siklus1" name="siklus" class="custom-control-input" value="Teratur">
                                        <label class="custom-control-label" for="siklus1">Teratur</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="siklus2" name="siklus" class="custom-control-input" value="Tidak">
                                        <label class="custom-control-label" for="siklus2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Keluhan :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan1" name="keluhan_obgyn[]" value="Dismenorhoe" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan1">Dismenorhoe</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan2" name="keluhan_obgyn[]" value="Spotting" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan2">Spotting</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan3" name="keluhan_obgyn[]" value="Menorrhargia" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan3">Menorrhargia</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan4" name="keluhan_obgyn[]" value="Metrohargia" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan4">Metrohargia</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan5" name="keluhan_obgyn[]" value="lain" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan5"> <input type="text" name="keluhan_obgyn[]" class="form-control" placeholder="Lain - Lain"> </label>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                              </div>

                              <hr>
                              <h5>2. Riwayat Kehamilan (Jika Pasien Hamil)</h5><br>
                              <div class="row p-t-10">
                                <div class="col-xl-6 col-md-12">
                                  <div class="form-group">
                                    <div class="col-md-12 col-xl-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">G</span></div>
                                        <input type="text" name="g" class="form-control" placeholder="...">
                                        <div class="input-group-append"><span class="input-group-text">P</span></div>
                                        <input type="text" name="p" class="form-control" placeholder="...">
                                        <div class="input-group-append"><span class="input-group-text">A</span></div>
                                        <input type="text" name="a" class="form-control" placeholder="...">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">HPHT</span></div>
                                        <input type="text" name="hpht" id="hpht" value="" class="tanggalku form-control" placeholder=".....">
                                      </div>
                                    </div>

                                  </div>

                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">UK</span></div>
                                        <input type="text" name="uk" class="form-control" placeholder="....." value="" readonly id="uk">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">HPL</span></div>
                                        <input type="text" name="hpl" class="form-control" value="" placeholder="....." readonly id="hpl">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-9 col-md-6 col-sm-6">
                                  <div class="form-group">

                                    <div class="col-md-12 col-xl-12">
                                      <input type="text" name="keluhan_kehamilan" class="form-control" placeholder="Keluhan yang dirasakan selama hamil ini">
                                    </div>

                                  </div>
                                </div>
                              </div>


                              <hr>
                              <h5> <b>3. Riwayat Ginekologi</b> </h5><br>
                              <div class="row p-t-10">
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infertilitas" value="Infertilitas" name="infertilitas" class="custom-control-input">
                                        <label class="custom-control-label" for="Infertilitas">Infertilitas</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infeksi" value="Infeksi Virus" name="Infeksi" class="custom-control-input">
                                        <label class="custom-control-label" for="Infeksi">Infeksi Virus</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="PMS" value="PMS" name="PMS" class="custom-control-input">
                                        <label class="custom-control-label" for="PMS">PMS</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Cervitiscronis" value="Cervitiscronis" name="Cervitiscronis" class="custom-control-input">
                                        <label class="custom-control-label" for="Cervitiscronis">Cervitiscronis</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Endometriosis" value="Endometriosis" name="Endometriosis" class="custom-control-input">
                                        <label class="custom-control-label" for="Endometriosis">Endometriosis</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Myoma" value="Myoma" name="Myoma" class="custom-control-input">
                                        <label class="custom-control-label" for="Myoma">Myoma</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="ok" value="Opreasi Kandungan" name="ok" class="custom-control-input">
                                        <label class="custom-control-label" for="ok">Operasi Kandungan</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="pcb" value="Post Coital Bleeding" name="pcb" class="custom-control-input">
                                        <label class="custom-control-label" for="pcb">Post Coital Bleeding</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="fa" value="Flour Albus" name="fag" class="flour_albus custom-control-input">
                                        <label class="custom-control-label" for="fa">Flour Albus</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-6 col-md-12">
                                      <label class=" form-control-label">Gatal :</label>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal1" name="gatal" disabled value="Ya" class="gatal custom-control-input">
                                        <label class="custom-control-label" for="gatal1">Ya</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal2" name="gatal" disabled value="Tidak" class="gatal custom-control-input">
                                        <label class="custom-control-label" for="gatal2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-6 col-md-12">
                                      <label class=" form-control-label">Berbau :</label>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau1" name="berbau" disabled value="Ya" class="berbau custom-control-input">
                                        <label class="custom-control-label" for="berbau1">Ya</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau2" name="berbau" disabled value="Tidak" class="berbau custom-control-input">
                                        <label class="custom-control-label" for="berbau2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <h5 class="m-l-10"> <b>4. Riwayat KB</b> </h5><br>
                            <div class="row p-t-10">
                              <div class="col-xl-2 col-md-2 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Pernah KB</label>
                                  </div>
                                  <div class="col-xl-6 col-md-12">
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="pernahkb1" name="pernahkb" value="Ya" class="pernahkb custom-control-input">
                                      <label class="custom-control-label" for="pernahkb1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="pernahkb2" name="pernahkb" value="Tidak" class="pernahkb custom-control-input" checked>
                                      <label class="custom-control-label" for="pernahkb2">Tidak</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-4 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Metode KB yang Pernah Dipakai :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="text " name="metodekb" class="form-control" placeholder="" id="metode" disabled>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Lamanya :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="number" name="lamakb" class="form-control" placeholder="" id="lama_thn" disabled>
                                      <div class="input-group-append"><span class="input-group-text">tahun</span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Lamanya :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="number" name="lamakb_bln" class="form-control" placeholder="" id="lama_bln" disabled>
                                      <div class="input-group-append"><span class="input-group-text">bulan</span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-6 col-md-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Komplikasi :</label>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi1" name="Komplikasi[]" value="Tidak Ada" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="Komplikasi1">Tidak Ada</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi2" name="Komplikasi[]" value="Pendaharan" class="custom-control-input">
                                      <label class="custom-control-label" for="Komplikasi2">Pendaharan</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi3" name="Komplikasi[]" value="PID/radang panggul" class="custom-control-input">
                                      <label class="custom-control-label" for="Komplikasi3">PID/radang panggul</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <input type="text" name="Komplikasi[]" class="form-control" placeholder="Lain - Lain">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php endif; ?>


                    </div>
                    <div class="card-footer" style='    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    /* flex-wrap: wrap; */'>
                    <div class="col col-sm-12 com-md-12">
                      <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
                      <button type="button" class="btn to-top btn-outline-primary btn-sm pull-left"><i class="fa fa-up"></i> Keatas</button>

                      <button type="submit" class="btn btn-primary btn-sm pull-right">SIMPAN</button>
                    </div>
                  </div>
                  <input type="hidden" id="sekarang" value="<?php echo date("m/d/Y")?>">
                  <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      function hitung_imt(){
        // alert("hdja");
        var tb = $("#tb_dewasa").val();
        var bb = $("#bb_dewasa").val();
        if (tb=='') {
          tb=0;
        }
        if (bb=='') {
          bb=0;
        }
        var imt = parseInt(bb / ((tb/100)*(tb/100)));
        if (isNaN(imt) || imt<0) {
          imt=0;
        }
        $("#imt").val(imt);
      }
      function coba() {
        if ($("input#lain_ridul_check:checked").length == 0) {
          $("#lain_ridul").attr('disabled', true);
        } else {
          $("#lain_ridul").attr('disabled', false)
          $("#lain_ridul").focus();;
        }
      }
      </script>
      <script type="text/javascript">
      // When the user scrolls down 20px from the top of the document, show the button

      function coba() {
        if ($("input#lain_ridul_check:checked").length == 0) {
          $("#lain_ridul").attr('disabled', true);
        } else {
          $("#lain_ridul").attr('disabled', false)
          $("#lain_ridul").focus();;
        }
      }
      function daysBetween(first, second) {

        var newDate = Date.now() + -5*24*3600*1000;

        // Copy date parts of the timestamps, discarding the time parts.
        var one = new Date(first[2], first[0], first[1]);
        var two = new Date(second[2], second[0], second[1]);

        // // Do the math.
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = two.getTime() - one.getTime();
        var days = millisBetween / millisecondsPerDay;

        // Round down.
        return Math.floor(days);
      }
      function deleteRow(r) {
              var i = r.parentNode.parentNode.rowIndex;
              document.getElementById("example22").deleteRow(i);
          }
      $(document).ready(function(){
        $(document).on("click",".rujukan",function(){
          var val = $(this).val();
          // alert(val);
          if (val == 'Ya') {
            $(".rj").removeAttr("disabled");
          }else{

            $(".rj").attr("disabled","disabled");
          }
        })
        $(document).on("click",".input_riwayat",function(){
          var partus = $("#thnpartus").val();
          var tempatpartus = $("#tempatpartus").val();
          var umurhamil = $("#umurhamil").val();
          var jenis_persalinan = $("#jenis_persalinan").val();
          var penolong = $("#penolong").val();
          var penyulit = $("#penyulit").val();
          var jenis_kelamin = $(".jk_bayi:checked").val();
          var bb = $("#bb_bayi").val();
          var hm = $("#hm_bayi").val();
          var html='';
          html += '<tr>'+
          '<td><input type="hidden" name="thnpartus[]" value="'+partus+'">'+partus+'</td>'+
          '<td><input type="hidden" name="tempatpartus[]" value="'+tempatpartus+'">'+tempatpartus+'</td>'+
          '<td><input type="hidden" name="umur[]" value="'+umurhamil+'">'+umurhamil+'</td>'+
          '<td><input type="hidden" name="jenis_persalinan[]" value="'+jenis_persalinan+'">'+jenis_persalinan+'</td>'+
          '<td><input type="hidden" name="penolong[]" value="'+penolong+'">'+penolong+'</td>'+
          '<td><input type="hidden" name="penyulit[]" value="'+penyulit+'">'+penyulit+'</td>'+
          '<td><input type="hidden" name="jk[]" value="'+jenis_kelamin+'">'+jenis_kelamin+'</td>'+
          '<td><input type="hidden" name="bb[]" value="'+bb+'">'+bb+'</td>'+
          '<td><input type="hidden" name="hm[]" value="'+hm+'">'+hm+'</td>'+
          '<td><button type="button" onclick="deleteRow(this)" class="btn-danger btn btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash"></i></button></td>'+
          '</tr>';
          if (partus!='') {
            $("#tabel_riwayat").append(html);

          }
          $("#tambahriwayat").modal("toggle");
        })
        $(document).on("click",".flour_albus",function(){
          if ($(".flour_albus:checked").length == 0) {
            $(".berbau").removeAttr("checked");
            $(".berbau").attr("disabled","disabled");
            $(".gatal").removeAttr("checked");
            $(".gatal").attr("disabled","disabled");

          }else{
            $(".berbau").removeAttr("disabled");
            $("#berbau2").attr("checked","checked");
            $(".gatal").removeAttr("disabled");
            $("#gatal2").attr("checked","checked");

          }
        })
        $(document).on("click",".pernahkb",function(){
          if ($(".pernahkb:checked").val()=="Ya") {
            $("#metode").removeAttr("disabled");
            $("#lama_bln").removeAttr("disabled");
            $("#lama_thn").removeAttr("disabled");
          }else{
            $("#metode").attr("disabled","disabled");
            $("#lama_bln").attr("disabled","disabled");
            $("#lama_thn").attr("disabled","disabled");
          }
        })
        // alert(moment("20120620", "YYYYMMDD").fromNow());
        var base_url = '<?php echo base_url()?>';
        function myajax_request(url,data,callback){
          $.ajax({
            type  : 'POST',
            url   : url,
            async : false,
            dataType : 'json',
            data:data,
            success : function(response){
              callback(response);
            }
          })
        }
        $(document).on("change","#hpht",function(){
          var data = $(this).val();
          var data1 = {hpht:$(this).val()};
          var sekarang = $("#sekarang").val();
          var tanggal = data.split("-");
          var end   = sekarang.split('-');
          myajax_request(base_url+"Periksa/kandungan",data1,function(res){
            $("#uk").val(res.uk);
            $("#hpl").val(res.hpl);
          })
        })


      })
      </script>
