
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h4><a href="" class="white-text mx-3">Permintaan Resep</a></h4>
      </div>
      <div class="card-body">
        <div class="row col-xl-12">
          <div class="col-xl-2 col-md-6 col-sm-6">
            <input type="date" class="form-control" value="<?php echo date("Y-m-d")?>" id="tanggal_fil">
          </div>

          <div class="col-xl-2 col-md-6 col-sm-6">
            <select class="mdb-select colorful-select dropdown-info sm-form" id="sts">
              <option value="" selected>Semua Status Billing</option>
              <option value="0">Belum Dibayar</option>
              <option value="1">Sudah Dibayar</option>
            </select>
          </div>
          <div class="col-xl-2 col-md-6 col-sm-6">
            <select class="mdb-select colorful-select dropdown-info sm-form" id="ambil">
              <option value="" selected>Semua Status Ambil</option>
              <option value="0">Belum Diambil</option>
              <option value="1">Sudah Diambil</option>
            </select>
          </div>
          <div class="col-xl-2 col-md-6 col-sm-6">
            <select class="mdb-select colorful-select dropdown-info sm-form" id="asal_poli">
              <option value="" selected>Semua Poli</option>
              <option value="UMU">Poli Umum</option>
              <option value="OBG">Poli Obgyn</option>
              <option value="GIG">Poli Gigi</option>
              <option value="INT">Internis</option>
              <option value="IGD">UGD/IGD</option>
            </select>
          </div>
          <div class="col-xl-2 col-md-6 col-sm-6">
            <button class="btn btn-info btn-sm" type="button" id="filter_data">Filter</button>
          </div>
        </div>
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered ">
            <thead>
              <tr><th></th>
                <th>No Resep</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Tujuan Pelayanan</th>
                <th>Tanggal</th>
                <th>Status Billing</th>
                <th>Status Ambil</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody id="resep">
              <?php $no = 1; foreach ($resep as $value):
                $tupel = $value->acc_ranap=='1'?'RANAP':$value->tujuan_pelayanan;
                ?>
                <td><?php echo $no; ?></td>
                <td><?php echo $value->no_resep; ?></td>
                <td><?php echo $value->noRM; ?></td>
                <td><?php echo $value->namapasien; ?></td>
                <td><?php echo $tupel?></td>
                <td><?php echo date("d-m-Y h:i:s",strtotime($value->tanggal))?></td>
                <td>
                  <?php if ($tupel!="RANAP"): ?>

                    <?php if ($value->billing==1) {?>
                      <span class="badge badge-success">Sudah Dibayar</span>
                      <?php
                    }else{?><span class="badge badge-danger">Belum Dibayar</span>
                    <?php
                  }
                  ?>
                <?php endif; ?>
              </td>
              <td><?php if ($value->ambil==1) {?>
                <span class="badge badge-success">Sudah Diambil</span>
                <?php
              }else{?><span class="badge badge-secondary">Belum Diambil</span>
              <?php
            }
            ?></td>
            <td>
              <?php if ($value->status_resep==1) {?>

                <a href="<?php echo base_url()."Resep/detail/".$value->no_resep;?>" >
                  <button id="<?php echo $value->no_resep?>" type="button" class="detail_pembelian btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Resep Pasien">
                    Detail
                  </button>
                </a>

                <a href="<?php echo base_url()."Resep/print/".$value->no_resep;?>" target="_blank" >
                  <button id="<?php echo $value->no_resep?>" type="button" class="detail_pembelian btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Resep Pasien">
                    Print Resep
                  </button>
                </a>
                <?php
                if ($value->ambil!=1) {?>
                  <a href="<?php echo base_url()."Resep/berikan/".$value->no_resep;?>" >
                    <button id="<?php echo $value->no_resep?>" type="button" class="detail_pembelian btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Berikan Resep Pasien">
                      Berikan Obat
                    </button>
                  </a>
                  <?php
                }
                ?>
                <?php
              }else{?>

                <a href="<?php echo $value->billing==1 || $value->acc_ranap==1?base_url()."Resep/tebusan/".$value->no_resep:"#";?>" >
                  <button id="<?php echo $value->no_resep?>" <?php echo $value->billing==1 || $value->acc_ranap==1?'':'disabled'?> type="button" class="detail_pembelian btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Siapkan Resep Pasien">
                    Siapkan Obat
                  </button>
                </a>
                <a href="#" >
                  <button  data-toggle="modal" data-target="#smallmodal2" id="<?php echo $value->no_resep?>" type="button" class="lihat_detail btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Detail Resep">
                    Detail
                  </button>
                </a>
                <?php if ($value->billing!=1): ?>

                    <button nama="<?php echo $value->namapasien?>" id="<?php echo $value->no_resep?>" data-toggle="modal" data-target="#smallmodal" type="button" class="edit_resep btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Resep Pasien">
                      Edit Resep
                    </button>
                <?php endif; ?>
                <?php
              }
              ?>
            </td>
          </tr>
          <?php $no++;  endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

<!-- Modal -->
<!-- modal small -->
<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="smallmodalLabel">Daftar Batch Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body card-block">
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;"/> Utama Husada
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col"><br>
                  <h4>Daftar resep dari pasien <span id="nama_pasien" ></span></h4><br>
                </div>
                <!-- /.row -->
              </section>
              <div class="table-responsive">

                    <?php echo form_open_multipart(base_url().'Resep/edit_resep');?>
                    <?php echo @$error;?>
                      <input type="hidden" id="nokun" name="no_kunjungan" value="">
                      <table class="table" id="list_resep">
                      <thead>
                        <th>Kode Obat </th>
                        <th>Nama Obat </th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Jumlah Diambil</th>
                      </thead>
                      <tbody id="detail_resep">

                      </tbody>
                      </table>
                      <p class="pull-left">Grand Total : <input type="hidden" id="grand_total" value=""><i>Rp</i> <span id="total_resep"></span></p>
                      <button type="submit" name="simpan" class="btn btn-success pull-right">Simpan</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-md pull-right" data-dismiss="modal">close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal small -->
  <!-- modal small -->
  <div class="modal fade" id="smallmodal2" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="smallmodalLabel">Daftar Resep</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body card-block">
              <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;"/> Utama Husada
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-12 invoice-col"><br>
                    <h4>Daftar resep dari pasien <span id="nama_pasien" ></span></h4><br>
                  </div>
                  <!-- /.row -->
                </section>
                <div class="table-responsive">

                        <table class="table" id="list_resep">
                        <thead>
                          <th>Kode Obat </th>
                          <th>Nama Obat </th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Total</th>

                        </thead>
                        <tbody id="detail_resep2">

                        </tbody>
                        </table>
                        <p class="pull-left">Grand Total : <input type="hidden" id="grand_total2" value=""><i>Rp</i> <span id="total_resep2"></span></p>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger btn-md pull-right" data-dismiss="modal">close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal small -->


  <div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
  </div>
  <script>
  function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }
  $(document).ready(function(){
    $("#loader").hide();

    $(document).on("click",".edit_resep",function(){
      var nama = $(this).attr("nama");
      $("#nama_pasien").html(nama);
      var no_resep = $(this).attr("id");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Resep/get_resep/',
        dataType : 'json',
        data: { kode:no_resep},
        beforeSend: function () {
          $('#loader').show();
        },
        success: function(response) {
          $("#loader").hide();
          // alert(response);
          set_tabel(response);
        }
      })
    });
    $(document).on("click",".lihat_detail",function(){
      var nama = $(this).attr("nama");
      $("#nama_pasien").html(nama);
      var no_resep = $(this).attr("id");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Resep/get_resep/',
        dataType : 'json',
        data: { kode:no_resep},
        beforeSend: function () {
          $('#loader').show();
        },
        success: function(response) {
          $("#loader").hide();
          // alert(response);
          set_tabel2(response);
        }
      })
    });

    function set_tabel(data){
      var html = '<tr><td colspan="6"><h6>Resep</h6></td></tr>';
      var total = 0;
      for (var i = 0; i < data.length; i++) {
        html +=
          '<tr>'+
          '<td><input type="hidden" name="iddetail_resep[]" value="'+data[i].iddetail_resep+'"><input type="hidden" name="idobat[]" value="'+data[i].idobat+'">'+data[i].idobat+'</td>'+
          '<td>'+data[i].nama_obat+'</td>'+
          '<td><input type="hidden" name="harga[]" id="harga_'+data[i].iddetail_resep+'" class="harga_resep" value="'+data[i].harga+'" <i>Rp.</i>'+addCommas(data[i].harga)+'</td>'+
          '<td><input type="hidden" name="jumlah_awal[]" value="'+data[i].jumlah+'">'+data[i].jumlah+'</td>'+
          '<td id="t_total_v_'+data[i].iddetail_resep+'"><input type="hidden" class="total_harga" name="total_harga[]" id="total_'+data[i].iddetail_resep+'" value="'+data[i].total_harga+'"><i>Rp.</i>'+addCommas(data[i].total_harga)+'</td>'+
          '<td><input type="number" name="jumlah_akhir[]" id="'+data[i].iddetail_resep+'" class="form-control edit_jumlah" value="'+data[i].jumlah+'"></td>'+
        '</tr>';
        total += parseInt(data[i].total_harga);
      }
      $("#grand_total").val(total);
      $("#total_resep").html(addCommas(total));
      $("#detail_resep").html(html);

    }
    function set_tabel2(data){
      var html = '<tr><td colspan="5"><h6>Resep</h6></td></tr>';
      var total = 0;
      for (var i = 0; i < data.length; i++) {
        html +=
          '<tr>'+
          '<td><input type="hidden" name="iddetail_resep[]" value="'+data[i].iddetail_resep+'"><input type="hidden" name="idobat[]" value="'+data[i].idobat+'">'+data[i].idobat+'</td>'+
          '<td>'+data[i].nama_obat+'</td>'+
          '<td><input type="hidden" name="harga[]" id="harga_'+data[i].iddetail_resep+'" class="harga_resep" value="'+data[i].harga+'" <i>Rp.</i>'+addCommas(data[i].harga)+'</td>'+
          '<td><input type="hidden" name="jumlah_awal[]" value="'+data[i].jumlah+'">'+data[i].jumlah+'</td>'+
          '<td id="t_total_v_'+data[i].iddetail_resep+'"><input type="hidden" class="total_harga" name="total_harga[]" id="total_'+data[i].iddetail_resep+'" value="'+data[i].total_harga+'"><i>Rp.</i>'+addCommas(data[i].total_harga)+'</td>'+
        '</tr>';
        total += parseInt(data[i].total_harga);
      }
      $("#grand_total2").val(total);
      $("#total_resep2").html(addCommas(total));
      $("#detail_resep2").html(html);

    }
    $(document).on("click","#filter_data",function(){
      var tgl = $("#tanggal_fil").val();
      var sts = $("#sts").val();
      var poli = $("#asal_poli").val();
      var ambil = $("#ambil").val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Resep/filter_resep/',
        data: { tanggal:tgl,sts:sts,poli:poli,ambil:ambil},
        beforeSend: function () {
          // $('#kunjungan_sudah').hide();
          $('#loader').show();
          // alert(tgl);
        },
        success: function(response) {
          $("#loader").hide();
          // $('#kunjungan_sudah').show('medium');
          $("#resep").html(response);
          $('#example').DataTable();
        }
      })
    })

  });
</script>
