
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Hutang</a></h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered ">
              <thead>
                  <tr><th></th>
                      <th>No Nota</th>
                      <th>Supplier</th>
                      <th>Tanggal Pembelian</th>
                      <th>Tanggal Jatuh Tempo</th>
                      <th>Total Transaksi</th>
                      <th>Bayar</th>
                      <th>Total Hutang</th>
                      <th width="%5">opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($hutang as $data_hutang):
                  ?>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data_hutang->no_nota; ?></td>
                      <td><?php echo $data_hutang->nama; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal)); ?></td>
                      <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal_jatuh_tempo)); ?></td>
                      <td><?php echo "Rp.".number_format($data_hutang->total_bayar,2,",","."); ?></td>
                      <td><?php echo "Rp.".number_format($data_hutang->bayar,2,",","."); ?></td>
                      <!-- <td><?php echo "Rp.".number_format($data_hutang->sisa,2,",","."); ?></td> -->
                      <td><?php echo "Rp.".number_format($data_hutang->total_hutang,2,",","."); ?></td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#smallmodal">
                        <button id="<?php echo $data_hutang->no_nota?>" type="button" class="detail_pembelian btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembelian">
                          <i class="fa fa-eye"></i>
                        </button>
                        </a>
                        <a href="<?php echo base_url()."Hutang/lunasi/".$data_hutang->no_nota;?>" >
                        <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lunasi Hutang Ini">
                          <i class="fa fa-money-bill"> Lunas</i>
                        </button>
                        </a>
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
<?php $this->load->view($form_dialog)?>
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
  function addCommas(nStr)
{
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

  $(document).on('click','.detail_pembelian',function(){
    var data_detail = {
      'no_nota' : $(this).attr('id'),
    };
    myajax_request(base_url+"PembelianObat/get_detail",data_detail,function(res){
      var tes="";
      for (var i = 0; i < res.length; i++) {
        tes += "<tr>" +
              "<td>"+res[i].idobat+"</td>" +
              "<td>"+res[i].nama_obat+"</td>" +
              "<td>"+res[i].no_batch+"</td>" +
              "<td>"+res[i].tanggal_expired+"</td>" +
              "<td>Rp."+addCommas(res[i].hrg_beli)+"</td>" +
              "<td>"+res[i].jumlah+"</td>" +
              "<td>Rp."+addCommas(res[i].diskon)+"</td>" +
              "<td>Rp."+addCommas(res[i].ppn)+"</td>" +
              "<td>Rp."+addCommas(res[i].total_harga)+"</td>" +
              "</tr>";

      }
      $("#no_nota").html(res[0].no_nota);
      $("#no_nota_s").html(res[0].no_nota_supplier);
      $("#tgl_transaksi").html(res[0].tanggal_masuk);
      $("#j_tempo").html(res[0].tanggal_jatuh_tempo);
      $("#supplier").html(res[0].nama);
      $(".sts").html(res[0].status);
      $("#t_disk").html("Rp."+addCommas(res[0].total_diskon));
      $("#t_ppn").html("Rp."+addCommas(res[0].total_ppn));
      $("#t_harga").html("Rp."+addCommas(res[0].total_transaksi));
      $("#bayar_final").html("Rp."+addCommas(res[0].total_bayar));
      $("#bayar").html("Rp."+addCommas(res[0].bayar));
      $("#sisa").html("Rp."+addCommas(res[0].sisa));
      $("#t_hut").html("Rp."+addCommas(res[0].total_hutang));
      $("#obat").html(tes);
    });
  });
});

</script>
