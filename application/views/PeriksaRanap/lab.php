<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <?php echo form_open_multipart('PeriksaRanap/input_labkun');?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PASIEN</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">

              <?php echo @$error;?>

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="nokun" class=" form-control-label">NO.PEMERIKSAAN :</label>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="text" name="nopem" id="nopem" class="form-control" placeholder="nopem" value="<?php echo $this->uri->segment(3) ?>" required readonly>
                      </div>
                      <div class="col col-md-1">
                        <label for="tanggal" class=" form-control-label">Tanggal</label>
                      </div>
                      <div class="col-12 col-md-4">
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
              </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <strong>Laboraturium</strong>
                        <small>SubForm</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                              <div class="col col-md-2">
                                <label for="rujukan" class=" form-control-label">Rujukan:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="rujukan" id="rujukan" class="form-control" placeholder="rujukan">
                              </div>
                        </div>
                        <div class="row form-group">
                              <div class="col col-md-2">
                                <label for="perwat1" class=" form-control-label">Perawat 1:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="perawat1" id="perawat1" class="form-control" placeholder="Perawat 1">
                              </div>
                              <div class="col col-md-2">
                                <label for="perwat2" class=" form-control-label">Perawat 2:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="perawat2" id="perawat2" class="form-control" placeholder="Perawat 2">
                              </div>
                        </div>
                        <br>
                        <div class="row form-group">
                              <div class="col col-md-2 text-right">
                                <label for="norm" class=" form-control-label">Laboraturium :</label>
                              </div>
                              <div class="col-12 col-md-6 row">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#scrollmodal"> <i class="fas fa-search-plus"></i> CARI LABORATURIAM</button>
                              </div>

                        </div>
                        <div class="table-responsive table table-striped">
                          <table class="table" id="lab">
                          <thead>
                            <th width="20%">KD Lab</th>
                            <th >Jenis Pemeriksaan</th>
                            <th width="10%"><i class="fas fa-gear"></i></th>
                          </thead>
                          <tbody id="lab">
                          </tbody>
                        </table>
                      </div>

                      </div>
                      <!-- <div class="card-footer"> -->
                        <?php echo $this->Core->btn_input(); ?>
                      <!-- </div> -->
                  </div>
                </div>
              </div>


              <?php echo form_close(); ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">Scrolling Long Content Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive table table-striped">
            <table id="example" class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Kode Lab</th>
                            <th>Jenis Lab</th>
                            <th width="%5">opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($lab as $data):
                        $id = $data->kode_lab;?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data->kode_lab; ?></td>
                            <td><?php echo $data->jenis_lab; ?></td>
                            <td>
                              <a onclick="select_lab('<?php echo $data->kode_lab ?>')" type="button" class="btn-floating peach-gradient" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-dismiss="modal">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                        </tr>
                      <?php $no++;  endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Kode Lab</th>
                          <th>Jenis Lab</th>
                          <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" id="kelas" name="kelas" value="<?php echo @$kunjungan['kelas'];?>">
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
function select_lab(kode) {
   var kelas = $("#kelas").val();
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>PeriksaRanap/labsearch/' + kode +'/'+kelas,
     data: { kode_lab: kode,kelas_rawat:kelas },
     success: function(response) {
       $("tbody#lab").append(response);
     }
   });

}

function select_kode_lab(kode){
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>PeriksaRanap/labsearchkode/' + kode,
    data: { kode_lab: kode },
    success: function(response) {
      $('#kode').val(response);
    }
  });
}

function tambahlab(kode, jenis) {
  var kode;
  var jenis;
          var markup = "<tr>" +
              "<td><input hidden value='"+ kode +"' name='kode_lab[]'>"+ kode +"</td>" +
              "<td><input hidden value='"+ jenis +"' name='jenis_lab[]'>"+ jenis +"</td>" +
              "<td><button type=\"button\" onclick='deleteRowlab(this)' class=\"btn-danger item-table\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Lab\"><i class=\"fas fa-trash\"></i></button></td>" +
              "</tr>";
          $("tbody#lab").append(markup);
}

function deleteRowlab(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("lab").deleteRow(i);
    }
</script>
