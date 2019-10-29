<link href="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet"
type="text/css">
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1 animated fadeInRight">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Kunjungan Pasien</a></h4>
              <div>
                <a href="#" class="float-right" data-toggle="modal" data-target="#tambahpasien">
                  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Pasien Baru"><i class="fas fa-user-plus mt-0"></i></button>
                </a>
              </div>
            </div>
            <!-- <a href="#" class="float-right" data-toggle="modal" data-target="#tambahpasien">
            <h4><span class="badge badge-pill badge-success badge-atas">Tambah Pasien</span></h4>
            <button class="btn btn-circle btn-lg btn-success btn-atas" type="button"><i
            class="fa fa-plus"></i>
          </button>
        </a> -->

        <div class="card-body card-block">
          <?php echo form_open_multipart('Kunjungan/insert'); ?>
          <?php echo @$error; ?>

          <div class="card">
            <div class="card-body card-block">

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="tgl" class=" form-control-label">Tanggal</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="date" name="tgl" id="tgl" class="form-control"
                  placeholder="tanggal" <?php if (is_null(@$kunjungan['tgl'])): ?>
                    value="<?php echo date('Y-m-d'); ?>" <?php else: ?> value="<?php echo @$kunjungan['tgl']; ?>"
                    <?php endif; ?> required>
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="jenis_pasien" class=" form-control-label">Rekam Medis</label>
                  </div>
                  <div class="col-12 col-md-9 ">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-info" type="button" data-toggle="modal"
                        data-target=".bs-example-modal-lg"><i
                        class="fa fa-search"></i> Cari
                      </button>

                    </div>
                    <div class="input-group-prepend">
                      <input type="text" id="noRMkun" name="pasien_noRM"
                      onchange="select_rm()" class="form-control"
                      placeholder="No. Rekamedik" aria-label=""
                      aria-describedby="basic-addon1" autofocus
                      value="<?php echo @$this->uri->segment(3); ?>">
                    </div>
                    <input type="text" id="namakun" class="form-control"
                    placeholder="Nama Pasien" aria-label=""
                    aria-describedby="basic-addon1" readonly>
                  </div>
                  <input type="text" id="alamatkun" class="form-control"
                  placeholder="Alamat Pasien" aria-label=""
                  aria-describedby="basic-addon1" readonly>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="jenis_kunjungan" class=" form-control-label">Asal Pasien</label>
                </div>
                <div class="col-12 col-md-9">

                  <div class="custom-control custom-radio">
                    <input type="radio" id="asal_pasien1" name="asal_pasien" value="Datang Sendiri" class="custom-control-input" checked>
                    <label class="custom-control-label" for="jenis_kunjungan_lama">Datang Sendiri</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="asal_pasien2" name="asal_pasien" value="Rujukan Dokter" class="custom-control-input" required>
                    <label class="custom-control-label" for="asal_pasien2">Rujukan Dokter</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="asal_pasien3" name="asal_pasien" value="Rujukan Bidan" class="custom-control-input" required>
                    <label class="custom-control-label" for="asal_pasien3">Rujukan Bidan</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="asal_pasien4" name="asal_pasien" value="Lainnya" class="custom-control-input" required>
                    <label class="custom-control-label" for="asal_pasien4">Lainnya</label>
                  </div>

                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="jenis_kunjungan" class=" form-control-label">Jenis
                    Kunjungan</label>
                  </div>
                  <div class="col-12 col-md-9">

                    <div class="custom-control custom-radio">
                      <input type="radio" id="jenis_kunjungan_lama" name="jenis_kunjungan"
                      value="1"
                      class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '1') {
                        echo "checked";
                      } ?>>
                      <label class="custom-control-label" for="jenis_kunjungan_lama">Lama</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="jenis_kunjungan_baru" name="jenis_kunjungan"
                      value="0"
                      class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '0') {
                        echo "checked";
                      } ?> required>
                      <label class="custom-control-label" for="jenis_kunjungan_baru">Baru</label>
                    </div>

                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="jenis_kunjungan" class=" form-control-label">Pembayaran</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <select name="jenis_pembayaran" class="mdb-select colorful-select dropdown-info sm-form">
                      <?php foreach ($jenis_pasien as $value): ?>

                        <option value="<?php echo $value->kode_jenis?>"><?php echo $value->jenis_pasien?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="keluhan" class=" form-control-label">Keluhan</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <textarea name="keluhan" id="keluhan" class="form-control"
                    placeholder="keluhan"
                    value="<?php echo @$kunjungan['keluhan']; ?>" required></textarea>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-">
                    <label for="jenis_pasien" class=" form-control-label">Tujuan
                      Pelayanan</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <select name="tujuan_pelayanan" id="select" class="poli mdb-select colorful-select dropdown-info sm-form">
                        <?php foreach ($tupel as $value): ?>
                          <option value="<?php echo $value->kode_tupel; ?>" <?php if (@$kunjungan['tujuan_pelayanan'] == $value->kode_tupel) {
                            echo "selected";
                          } ?>><?php echo $value->tujuan_pelayanan; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="no_antrian" class=" form-control-label">Pilih Dokter</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="dokter" id="dokter" class="form-control" placeholder="Pilih Dokter" value="" required>
                      <input type="text" hidden name="nik_dokter" id="nik_dokter" class="form-control" value="" required>

                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="no_antrian" class=" form-control-label">No Antrian
                        Sebelumnya</label>
                      </div>
                      <div class="col-12 col-md-9">
                        <input type="text" name="no_antrian" id="no_antrian" class="form-control"
                        placeholder="no antrian" value="<?php echo $no_antrian; ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                <?php echo $this->Core->btn_input() ?>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade bs-example-modal-lg" tabindex="-1"
  role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">List
          Pasien</h4>
          <button type="button" class="close"
          data-dismiss="modal" aria-hidden="true">X
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table id="tbl_pasien"
          class="table table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>No Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Jenis Kelamin</th>
              <th>Umur</th>
              <th>alamat</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
<div id="tambahpasien" class="modal fade" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pasien Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
          class="fa fa-window-close"></i></button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart('Pasien/insert'); ?>
          <?php echo @$error; ?>
          <?php $this->load->view('Pasien/form2') ?>
          <?php echo $this->Core->btn_input() ?>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldokter" tabindex="-1" role="dialog" aria-labelledby="modaljapelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">Daftar Dokter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="example" class="table table-hover table-borderless table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama Dokter</th>
                            <th>Jabatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($pegawai as $data) {?>
                        <?php $id_check = $data->NIK;
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data->NIK?></td>
                            <td><?php echo $data->nama?></td>
                            <td><?php echo $data->jabatan?></td>
                            <td><button type="button" nik="<?php echo $id_check?>" nama="<?php echo $data->nama?>" class="btn btn-circle btn-primary pilih" data-toggle="tooltip" data-placement="right" data-original-title="pilih" data-dismiss="modal">
                                <i class="fas fa-edit"></i>
                              </button>
                            </td>
                        </tr>
                      <?php
                      $no++;
                      }?>
                    </tbody>

                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.min.js"></script>
  <script type="text/javascript">
  function select_rm() {
    var norm = $("#noRMkun").val();
    norm = pad(norm,8);
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Pasien/searchrm/' + norm,
      data: {norm_pasien: norm},
      success: function (response) {
        if (response == "0") {
          swal({
            title: "Pasien Tidak Ditemukan!",
            timer: 3000,
            showConfirmButton: true
          });
          $('#namakun').val("Tidak Ditemukan");
        } else {
          $('#namakun').val(response);
        }

      }
    });
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Pasien/searchrma/' + norm,
      data: {norm_pasien: norm},
      success: function (response) {
        $('#alamatkun').val(response);
      }
    });
    $('#noRMkun').val(norm);
    cekkunjungan();
  }

  function cekkunjungan() {
    var noRM = $('#noRMkun').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Kunjungan/hitung_riwayat/' + noRM,
      success: function (response) {
        if (response > 0) {
          $('#jenis_kunjungan_lama').prop("checked", true);
          $('#jenis_kunjungan_baru').prop("checked", false);
        } else {
          $('#jenis_kunjungan_baru').prop("checked", true);
          $('#jenis_kunjungan_lama').prop("checked", false);
        }
        // alert(response);
      },
      error: function(e) {
        // alert(e);
      }
    });
    // alert(noRM) ;
  }
  function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }

  function no_urut(nik) {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Kunjungan/no_urut/' +nik,
      data: {nik: nik},
      success: function (response) {
        $("#no_antrian").val(response);
      }
    });
  }

  function pilih_pasien(noRM, nama, alamat,jenis) {
    var noRM;
    var nama;
    var alamat;
    var jenis;
    $("#noRMkun").val(noRM);
    $("#namakun").val(nama);
    $("#alamatkun").val(alamat);
    cekkunjungan();
    // alert(jenis);
  }

  var table;
  $(document).ready(function () {
    $(document).on("focus","#dokter",function(){
      $("#modaldokter").modal("toggle");
    });
    $(document).on("click",".pilih",function(){
      var nik = $(this).attr("nik");
      var nama = $(this).attr('nama');
      $("#dokter").val(nik+" - "+nama);
      $("#nik_dokter").val(nik);
      no_urut(nik);
    })
    //datatables
    cekkunjungan();
    var norm = $("#noRMkun").val();
    if (norm !== "") {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Pasien/searchrm/' + norm,
        data: {norm_pasien: norm},
        success: function (response) {
          if (response == "0") {
            swal({
              title: "Pasien Tidak Ditemukan!",
              timer: 3000,
              showConfirmButton: true
            });
            $('#namakun').val("Tidak Ditemukan");
          } else {
            $('#namakun').val(response);
          }

        }
      });
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Pasien/searchrma/' + norm,
        data: {norm_pasien: norm},
        success: function (response) {
          $('#alamatkun').val(response);
        }
      });
    }


    table = $('#tbl_pasien').DataTable({

      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "<?php echo site_url('Kunjungan/get_data_pasien')?>",
        "type": "POST"
      },

      "columnDefs": [
        {
          "targets": [0],
          "orderable": false
        }
      ]
    });

  });


  !function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {


      //Auto Close Timer
      $('#nasdopasid').click(function () {
        swal({
          title: "Pasien Tidak Ditemukan!",
          timer: 3000,
          showConfirmButton: true
        });
      });


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
  }(window.jQuery),

  //initializing
  function ($) {
    "use strict";
    $.SweetAlert.init()
  }(window.jQuery);


</script>
