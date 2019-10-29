<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Form Periksa Pasien</a></h4>
            </div>
            <div class="card-body card-block">
              <div class="row">
                <div class="col-xl-6 col-md-12">
                  <div class="row form-group">
                    <div class="col-xl-6 col-md-6">
                      <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                    </div>
                    <div class="col-xl-6 col-md-6">
                      <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xl-6 col-md-6">
                      <label for="tanggal" class=" form-control-label">Tanggal</label>
                    </div>
                    <div class="col-xl-6 col-md-6">
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-md-12">
                  <div class="row form-group">
                    <div class="col-xl-4 col-md-6">
                      <label for="norm" class=" form-control-label">No Rm :</label>
                    </div>
                    <div class="col-xl-8 col-md-6">
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xl-4 col-md-6">
                      <label for="norm" class=" form-control-label">Pasien :</label>
                    </div>
                    <div class="col-xl-4 col-md-3 col-sm-6">
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
                    </div>
                    <div class="col-xl-4 col-md-3 col-sm-6">
                      <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <h4> <b>Riwayat Kehamilan, Persalinan dan Nifas yang lalu</b> <button class="btn btn-info" type="button" data-toggle="modal" data-target="#tambahriwayat"><i class="fa fa-plus"></i> Tambah Riwayat
              </button></h4>
              <div class="table-responsive" id="riwayat">
                <table id="example" class="table table-striped table-bordered table-hover">
                  <thead>
                    <th>NO</th>
                    <th>Tahun Partus</th>
                    <th>Tempat Partus</th>
                    <th>Umur Hamil</th>
                    <th>Jenis Persalinan</th>
                    <th>Penolong</th>
                    <th>Penyulit</th>
                    <th>JK</th>
                    <th>BB</th>
                    <th>H/M</th>
                  </thead>
                  <tbody>
                    <?php $no=0; foreach ($riwayat as $value): $no++;?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value->tahunpartus; ?></td>
                        <td><?php echo $value->tempatpartus; ?></td>
                        <td><?php echo $value->umurhamil; ?></td>
                        <td><?php echo $value->jenispersalinan; ?></td>
                        <td><?php echo $value->penolong; ?></td>
                        <td><?php echo $value->penyulit; ?></td>
                        <td><?php echo $value->jk; ?></td>
                        <td><?php echo $value->bb." Kg"; ?></td>
                        <td><?php echo $value->hm; ?></td>
                      </tr>
                    <?php endforeach; ?>
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
                        <?php echo form_open_multipart('Pasien/insert_riwayatobgyn'); ?>
                        <input type="text" name="norm" value="<?php echo @$pasien['noRM']; ?>" hidden>
                        <input type="text" name="nokun" value="<?php echo @$idkunjungan; ?>" hidden>
                        <?php echo @$error; ?>
                        <?php $this->load->view('Pasien/riwayatobgyn') ?>
                        <?php echo $this->Core->btn_input() ?>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <?php echo form_open_multipart('Periksa/insert_obgyn');?>
                <?php echo @$error;?>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="card border-success" style="border: 2px solid;">
                      <div class="card-header bg-success text-white">
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
            <?php echo form_close(); ?>
            <input type="hidden" id="sekarang" value="<?php echo date("m/d/Y")?>">
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
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
$(document).ready(function(){
  $(document).on("click",".flour_albus",function(){
    if ($(".flour_albus:checked").length == 0) {
      // alert("bdajbd");
      $(".berbau").removeAttr("checked");
      $(".berbau").attr("disabled","disabled");
      $(".gatal").removeAttr("checked");
      $(".gatal").attr("disabled","disabled");

    }else{
      // alert("a");;
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
    // alert(data.hpht);
    myajax_request(base_url+"Periksa/kandungan",data1,function(res){
      // alert(res.uk);
      $("#uk").val(res.uk);
      $("#hpl").val(res.hpl);
    })
    // alert(parseInt(tanggal[0]));
    // var HPL = '';
    // var HHT = parseInt(tanggal[0]);
    // var bulan = parseInt(tanggal[1]);
    // var tahun = parseInt(tanggal[2]);
    // // HPL naigale
    // if(bulan >=1 && bulan <= 3){
    //   HHT   = +HHT +7;
    //   bulan = +bulan + 9;
    //   tahun = +tahun + 0;
    // } else if (bulan >= 4 && bulan <= 12){
    //   HHT   = +HHT +7;
    //   bulan = bulan - 3;
    //   tahun = +tahun + 1;
    // }
    // if(bulan == 2){
    //   if(tahun%2==0){
    //     if(HHT>=29){
    //       HHT   = HHT - 29;
    //       bulan = bulan - 1;
    //     }
    //   } else {
    //     if(HHT>=28){
    //       HHT = HHT - 28;
    //       bulan = bulan - 1;
    //     }
    //   }
    // }else if(bulan%2==0){
    //   if(bulan==8){
    //     if(HHT>31){
    //       HHT   = HHT - 31;
    //       bulan = +bulan + 1;
    //     }
    //   } else if(bulan>12){
    //     if(HHT>30){
    //       HHT   = HHT - 30;
    //       bulan = bulan - 12;
    //       tahun = +tahun + 1;
    //     }else{
    //       bulan = bulan - 12;
    //       tahun = +tahun + 1;
    //     }
    //   }else{
    //     if(HHT>30){
    //       HHT   = HHT - 30;
    //       if(bulan>=12){
    //         bulan = bulan - 11;
    //       } else {
    //         bulan = +bulan + 1;
    //       }
    //     }
    //   }
    // } else if(bulan%2!=0){
    //   if(bulan>12){
    //     if(HHT>31){
    //       HHT   = HHT - 31;
    //       bulan = bulan - 12;
    //       tahun = +tahun + 1;
    //     }else{
    //       bulan = bulan - 11;
    //       tahun = +tahun + 1;
    //     }
    //   }else if(HHT>31){
    //     HHT   = HHT - 31;
    //     bulan = +bulan + 1;
    //   }
    // }
    // HPL = HHT+'-'+bulan+'-'+tahun;
    // // alert(HPL);
    // // var uk = parseInt()
    // $("#hpl").val(HPL);

    // alert(daysBetween(end,tanggal));

  })




  // $(document).on("click",)

})
</script>
