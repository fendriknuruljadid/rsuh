<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <?php echo form_open_multipart('Periksa/update_resep/'.$this->uri->segment(4));?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

                  <h4><a href="" class="white-text mx-3">Resep untuk pasien</a></h4>

            </div>
            <div class="card-body card-block">
              <div class="col-md-12">
              <div class="row p-t-20">
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO.PEMERIKSAAN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                      </div>
                      <input type="text" name="nopem" id="nopem" class="form-control" placeholder="nokun" value="<?php echo $this->uri->segment(3) ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">TANGGAL</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                      </div>
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO RM PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NAMA PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="row col-md-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-search" ></i> Cari Obat </button>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="list_resep">
                    <thead>
                      <th>Kode Obat </th>
                      <th>Nama Obat </th>
                      <th>Stok Tersedia</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Signa</th>
                      <th>Total</th>
                      <th width="10%"><i class="fa fa-gear"></i></th>
                    </thead>
                    <tbody id="resep">
                      <?php foreach ($resep_lama as $value):
                        $id=$value->idobat;
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $pr = '';
                         for ($i = 0; $i < 1; $i++) {
                             $pr .= $characters[rand(0, $charactersLength - 1)];
                         }
                        ?>
                        <tr>
                          <td><input hidden value='<?php echo $id?>' name='kode[]'><?php echo $value->idobat?></td>
                          <td><input hidden value='<?php echo $value->nama_obat?>' name='nama[]'><?php echo $value->nama_obat?></td>
                          <td><input hidden value='<?php echo $value->stok_berjalan?>' name='stok_tersedia[]' id='stok_<?php echo $pr;?>'><?php echo $value->stok_berjalan?></td>
                          <td><input hidden value='<?php echo $value->harga?>' name='harga[]' id='hrg_<?php echo $pr.$id;?>'>Rp.<?php echo number_format($value->harga)?></td>
                          <td><input type='number' value='<?php echo $value->jumlah?>' name='jumlah[]' id='<?php echo $pr.$id;?>' class='input_jumlah form-control' required  style='max-width:100px;'></td>
                          <td><input type='text' name='signa[]' value='<?php echo $value->signa?>' class='signa form-control' required></td>
                          <td><input hidden value='<?php echo $value->total_harga?>' name='ttl_harga[]' id='ttl_<?php echo $pr.$id;?>'><p id='total_<?php echo $pr.$id;?>'>Rp.<?php echo number_format($value->total_harga)?></p></td>
                          <td><button type="button" onclick='deleteRowlab(this)' class="btn-danger item-table" data-toggle="tooltip" data-placement="top" data-title="Hapus Obat"><i class="fa fa-trash"></i></button></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- <div class="card-footer"> -->
            <?php echo $this->Core->btn_input(); ?>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">Cari Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>Kode/No Barcode Obat</th>
                <th>Nama Obat</th>
                <th>Kandungan Obat</th>

                <th>Dosis Obat</th>
                <th>Stok Real</th>
                <th>Stok Berjalan</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($resep as $data):
                $id = $data->idobat;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->idobat; ?></td>
                  <td><?php echo $data->nama_obat; ?></td>
                  <td><?php echo $data->kandungan_obat; ?></td>
                  <td><?php echo $data->dosis; ?></td>

                  <td><?php echo $data->stok; ?></td>

                  <td><?php echo $data->stok_berjalan; ?></td>
                  <td>
                    <button id="<?php echo $id;?>"  class="btn-floating aqua-gradient add_obat" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
                      <i class="fa fa-check"></i>
                    </button>
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

  <script type="text/javascript">
  $(document).on("click",".add_obat",function(){
    // alert("jdkajd");
    var idobat = $(this).attr('id');
    select_obat(idobat);
  })
  function select_obat(kode) {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Periksa/cariobat/' + kode,
      data: { idobat: kode },
      dataType:'json',
      async : false,
      success: function(response) {
        if(response.status==0){
          alert("Stok Obat Habis");
          // alert(response.stok);
        }else{
          $("#scrollmodal").modal('toggle');
          tambahobat(response);
        }

      }
    });
  }
  $(document).on('keyup','.input_jumlah',function(){
    var kode = $(this).attr("id");
    var hrg = $("#hrg_"+kode).val();
    var stok = $("#stok_"+kode).val();
    var jml = $(this).val();
    var total = hrg*jml;
    // if(jml>stok){
    //   alert("Jumlah permintaan melebihi stok tersedia");
    // }
    $("#ttl_"+kode).val(total);
    $("#total_"+kode).text('Rp.'+addCommas(total));
  });
  function prefix() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 1; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
  }
  function tambahobat(res) {
    var pr = prefix();
    var kode = res.id_obat;
    var nama = res.nama_obat;
    var dosis = res.dosis;
    var harga =res.harga;
    var markup = "<tr>" +
    "<td><input hidden value='"+ kode +"' name='kode[]'>"+ kode +"</td>" +
    "<td><input hidden value='"+ nama +"' name='nama[]'>"+ nama +"</td>" +
    "<td><input hidden value='"+ res.stok+"' name='stok_tersedia[]' id='stok_"+pr+kode+"'>"+ res.stok +"</td>" +
    "<td><input hidden value='"+ harga +"' name='harga[]' id='hrg_"+pr+kode+"'>Rp."+addCommas(harga)+"</td>" +
    "<td><input type='number' value='' name='jumlah[]' id='"+pr+kode+"' class='input_jumlah form-control' required  style='max-width:100px;'></td>" +
    "<td><input type='text' name='signa[]' value='3dd1' class='signa form-control' required></td>" +
    "<td><input hidden value='' name='ttl_harga[]' id='ttl_"+pr+kode+"'><p id='total_"+pr+kode+"'></p></td>" +
    "<td><button type=\"button\" onclick='deleteRowlab(this)' class=\"btn-danger item-table\" data-toggle=\"tooltip\" data-placement=\"top\" data-title=\"Hapus Obat\"><i class=\"fa fa-trash\"></i></button></td>" +
    "</tr>";
    $("tbody#resep").append(markup);
  }

  function deleteRowlab(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("list_resep").deleteRow(i);
  }
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
</script>
