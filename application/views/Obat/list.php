
<?php echo form_open('Obat/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button>
            </div>
            <a href="" class="white-text mx-3">Data Obat</a>
            <div>
              <a href="<?php base_url(); ?>Obat/input" class="float-right">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th width="10%"><input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                  <label class="form-check-label" for="tableMaterialChec"></label>
                  </th>
                  <th>ID/No Barcode</th>
                  <th>Nama Obat</th>
                  <th>Jenis</th>
                  <th>Kategori</th>
                  <th>Dosis</th>
                  <th>Stok</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($obat as $data) {?>
              <?php $id_check = $data->idobat;?>
              <tr>
                  <td><input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                    <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                  </td>

                  <td><?php echo $data->idobat?></td>
                  <td><?php echo $data->nama_obat?></td>
                  <td><?php echo $data->jenis_obat?></td>
                  <td><?php echo $data->kategori_obat?></td>
                  <td><?php echo $data->dosis?></td>
                  <td><?php if($data->stok==null){echo "0";}else{echo $data->stok;}?></td>
                  <td >
                    <span class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ti-settings"></i>
                    </button>
                    <span class="dropdown-menu animated flipInY">
                      <a class="dropdown-item" href="<?php base_url()?>Obat/edit/<?php echo $data->idobat;?>">Edit Data</a>
                      <a class="dropdown-item detail_batch" href="#" id="<?php echo $id_check?>" data-toggle="modal" data-target="#batchmodal" data-placement="top" title="" data-original-title="More">List Batch</a>
                      <a class="dropdown-item detail_obat" href="#" id="<?php echo $id_check?>" data-toggle="modal" data-target="#scrollmodal" data-placement="top" title="" data-original-title="More">Detail Obat</a>

                      </span>
                    <!-- <a href="<?php base_url()?>Obat/edit/<?php echo $data->idobat;?>">
                    <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
                    <button id="<?php echo $id_check?>" type="button" class="detail_obat btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#scrollmodal" data-placement="top" title="" data-original-title="More"><i class="fa fa-eye"></i></button> -->
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
<div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
<div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>
<?php echo form_close();?>
<?php $this->load->view($form_dialog)?>
<?php $this->load->view('Obat/form_dialog2')?>
<script>
$(function(){
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

  $(document).on('click','.detail_obat',function(){
    var data_obat = {
      'id_obat' : $(this).attr('id'),
    };
    // alert(data_obat.id_obat);
    myajax_request(base_url+"Obat/get_data_obat",data_obat,function(res){
      // alert(res.idobat);
      $("#idobat").val(res.idobat);
      $("#nama_obat").val(res.nama_obat);
      $("#kategori_obat").val(res.kategori_obat);
      $("#jenis_obat").val(res.jenis_obat);
      $("#dosis").val(res.dosis);
      $("#kegunaan").val(res.kegunaan);
      $("#kandungan").val(res.kandungan);
      $("#satuan_besar").val(res.satuan_besar);
      $("#satuan_sedang").val(res.satuan_sedang);
      $("#satuan_kecil").val(res.satuan_kecil);
      $("#harga_satuan_besar").val("Rp."+res.harga_beli_satuan_besar);
      $("#harga_satuan_sedang").val("Rp."+res.harga_beli_satuan_sedang);
      $("#harga_satuan_kecil").val("Rp."+res.harga_beli_satuan_kecil);
      $("#rawat_jalan").val("Rp."+res.harga_1);
      $("#kelas_3").val("Rp."+res.harga_2);
      $("#kelas_2").val("Rp."+res.harga_3);
      $("#kelas_1").val("Rp."+res.harga_4);
      $("#vip").val("Rp."+res.harga_5);
      $("#hrg_ozon").val("Rp."+res.harga_ozon);
    });
  });
  $(document).on('click','.detail_batch',function(){
    var data_obat = {
      'id_obat' : $(this).attr('id'),
    };
    // alert(data_obat.id_obat);
    myajax_request(base_url+"Obat/get_data_batch",data_obat,function(res){
      var html = "";
      for (var i = 0; i < res.length; i++) {

        html += '<tr>'+
          '<td>'+res[i].idobat+'</td>'+
          '<td>'+res[i].no_batch+'</td>'+
          '<td>'+res[i].tanggal_expired+'</td>'+
          '<td>'+res[i].stok+'</td>'+
        '</tr>';
      }
      $("#daftar_batch").html(html);
    });
  });
});

</script>
