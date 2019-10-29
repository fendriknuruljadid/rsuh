<style>
@media print{
  .left-sidebar,.page-titles,.button_opsi,.footer,.opsi,.asuransi,.diskon{display: none;}
  #footer_tagihan{display: inline;}
}
</style>
<?php echo form_open_multipart('BillingRanap/input');?>
<?php $id = $this->uri->segment(3)?>
<div class="row form-material">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3><b>TAGIHAN</b> <span class="pull-right">#<?php echo $no_invoice?></span></h3><span class="pull-right">NO : <?php echo $no?></span>
        <p style="position:relative;right:10">Nomor Kunjungan <?php echo $data['no_urutkunjungan']?></p>
        <input type="hidden" name="invoice" value="<?php echo $no_invoice?>">
        <hr>
        <div class="row" id="form_tagihan">
          <div class="col-md-12">
            <div class="pull-left" style="margin-left:20px;">
              <address>
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;"/> Utama Husada
                    </h2>
                    <p class="text-muted m-l-5">Jl. Manggar No.134, Tegalsari, Ambulu,<br>Kabupaten Jember, Jawa Timur<br>(68172)</p>
                  </div>
                  <!-- /.col -->
                </div>

              </address>
            </div>
            <div class="pull-right text-right">
              <address>
                <p>Jember, <?php echo date('d-m-Y',strtotime($data['tgl']))?></p>
                <h3>Kepada Yth,</h3>
                <h4 class="font-bold"><?php echo $pasien['namapasien']?></h4>
                <p class="text-muted m-l-30"><?php echo $pasien['alamat']?></p>
              </address>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive m-t-40">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Jenis Pembayaran</th>
                    <th class="text-right">Jumlah</th>
                    <th class="opsi">Opsi <i class="fa fa-gear"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach ($data_billing as $billing) {?>
                    <tr>
                      <td class="text-center"><?php echo $no;?></td>
                      <td><?php echo $billing['pembayaran'];?></td>
                      <td class="text-right"><?php echo number_format($billing['harga'],2,",",'.');?>
                        <input type="text" name="hrg[]" value="<?php echo $billing['harga'];?>" hidden>
                      </td>
                      <td class="opsi">
                        <?php if($billing['opsi']=='resep'){?>
                          <a href="#" data-toggle="modal" data-target="#smallmodal">
                            <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembayaran">
                              <i class="fa fa-edit"></i>
                            </button>
                          </a>
                          <?php
                        }if($billing['opsi']=='japel') {?>
                          <a href="#" data-toggle="modal" data-target="#japel">
                            <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembayaran">
                              <i class="fa fa-edit"></i>
                            </button>
                          </a>
                          <?php
                        } if ($billing['opsi']=='lab') {?>
                          <a href="#" data-toggle="modal" data-target="#lab">
                            <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembayaran">
                              <i class="fa fa-edit"></i>
                            </button>
                          </a>
                          <?php
                        }if ($billing['opsi']=='dapur') {?>
                          <a href="#" data-toggle="modal" data-target="#dapur">
                            <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembayaran">
                              <i class="fa fa-edit"></i>
                            </button>
                          </a>
                          <?php
                        }if ($billing['opsi']=='kamar') {?>
                          <a href="#" data-toggle="modal" data-target="#kamar">
                            <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Riwayat Kamar Perawatan">
                              <i class="fa fa-edit"></i>
                            </button>
                          </a>
                          <?php
                        }

                        ?>
                      </td>
                    </tr>
                    <?php
                    $no++;
                  }?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12">
            <div class="pull-right m-t-30">
              <div class="col col-md-12 pull-right">
                <table border="0">
                  <tr>
                    <!-- <td>Total :</td><td><i>Rp</i></td><td> <?php echo number_format($total,2,",",".");?> <input type="text" name="total" value="<?php echo $total;?>" hidden ></td> -->
                    <tr>
                      <!-- <td>PPN (10%):</td><td><i>Rp</i></td><td> <?php echo number_format($ppn,2,",",".")?> <input type="text" name="ppn" value="<?php echo $ppn;?>" hidden ></td> -->
                    </tr>
                    <tr><td >&nbsp;</td><td>&nbsp;</td></tr>
                    <tr>
                      <td ><h3><b>Total Tagihan :</b></h3>
                      </td>
                      <td align="right"><h3><i>Rp.</i><?php echo number_format($total_billing,2,",",".");?></h3>
                      </td>
                    </tr>
                    <tr>
                      <td ><h3><b>Deposit :</b></h3>
                      </td>
                        <td align="right"><h3><i>Rp.</i><?php echo number_format($deposit,2,",",".");?></h3>
                        </td>
                    </tr>
                    <tr>
                      <td ><h3><b>Total Harus Dibayar :</b></h3>
                      </td>
                      <td align="right"><h3><i>Rp.</i><?php echo number_format($total_akhir,2,",",".");?></h3>
                      </td>
                    </tr>
                    <tr>
                      <td ><h6><i>( <?php echo $terbilang;?></i> )</h6></td><td></td>
                    </tr>
                  </table>
                <table border="0">
                  <tr><td >&nbsp;</td><td >&nbsp;</td><td>&nbsp;</td></tr>
                  <tr>
                    <td><h5><b>Pembayaran :</b></h5></td><td> <i>Rp</i></td><td colspan="3"><input required name="jml_bayar" id="bayar" onkeyup="filter()" type="text" class="form-control money" ></td>
                  </tr>
                  <tr>
                    <td><h5><b>Kembalian       :</b></h5></td><td> <i>Rp</i></td><td colspan="3"><input name="kembalian" id="kembalian" type="text" class="form-control money" readonly></td>
                  </tr>
                </table>

                  <input type="text" hidden name="id" value="<?php echo $this->uri->segment(3); ?>">
                  <input type="text" hidden name="bayar" id="billing_1" value="<?php echo $total_billing;?>">
                  <input type="text" hidden name="depo" id="billing_2" value="<?php echo $deposit;?>">
                  <input type="text" hidden name="bayar_akhir" id="billing" value="<?php echo $total_akhir;?>">
                  <input type="hidden" name="nama" value="<?php echo @$pasien['namapasien']?>">
                  <input type="hidden" name="noRM" value="<?php echo @$pasien['noRM']?>">
                  </div>
                </div>
              </div>
            </div>
            <br><br><hr>
            <div class="col-md-12" id="footer_tagihan" style="margin-top:20px;padding-left:50px;padding-right:50px;display:none;">
              <div class="pull-left" style="margin-left:20px;">
                <address>
                  <h5>Pasien</h5><br><br>
                  <p class="text-muted"><?php echo $pasien['namapasien']?></p>
                </address>
              </div>
              <div class="pull-right text-right">
                <address>
                  <h5>Kasir</h5><br><br>
                  <p class="text-muted m-l-30">Admin</p>
                </address>
              </div>
            </div>
            <div class="text-right button_opsi">
              <button type="button" class="btn btn-outline-secondary pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
              <button class="btn btn-danger" type="submit" id="submit"> Proses Pembayaran </button>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- modal small -->
    <div class="modal fade" id="japel" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Detail Nota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body card-block">
                <div class="table-responsive table table-striped">
                  <div class="table-responsive">
                    <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                      <thead>
                        <th>Nama Jasa</th>
                        <th>Biaya</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <?php $total=0;foreach ($this->ModelBilling->japel2($id)->result() as $value): ?>
                          <tr>
                            <td>
                              <?php echo $value->jsmedis ?>
                            </td>
                            <td>
                              <?php echo $value->harga ?>
                            </td>
                            <td>
                              <?php echo $value->jumlah ?>
                            </td>
                            <td>
                              <?php echo $value->harga_tot?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
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
    <div class="modal fade" id="dapur" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Detail Nota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body card-block">
                <div class="table-responsive table table-striped">
                  <div class="table-responsive">
                    <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                      <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Biaya</th>
                      </thead>
                      <tbody>
                        <?php $no=1;foreach ($detil_dapur as $value): ?>
                          <tr>
                            <td>
                              <?php echo $no++ ?>
                            </td>
                            <td>
                              <?php echo date("d-m-Y",strtotime($value->timestamp)) ?>
                            </td>
                            <td>
                              <?php echo date("h:i:s",strtotime($value->timestamp)) ?>
                            </td>
                            <td>
                              <?php echo "Rp.".number_format($value->harga) ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
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
    <div class="modal fade" id="lab" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Detail Nota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body card-block">
                <div class="table-responsive table table-striped">
                  <div class="table-responsive">
                    <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                      <thead>
                        <th>Kode Lab</th>
                        <th>Nama Lab</th>
                        <th>Biaya</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <?php $lab=0; foreach ($this->ModelBilling->lab2($id)->result() as $value): ?>
                          <tr>
                            <td><?php echo $value->kodelab; ?></td>
                            <td><?php echo $value->nama; ?></td>
                            <td><?php echo $value->harga;?></td>
                            <td><?php echo $value->jumlah;?></td>
                            <td><?php echo $value->total_harga;?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
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
    <div class="modal fade" id="kamar" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="smallmodalLabel">Riwayat Kamar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body card-block">
                <div class="table-responsive table table-striped">
                  <div class="table-responsive">
                    <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                      <thead>
                        <th>No</th>
                        <th>Nama Kamar</th>
                        <th>Kelas</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($riwayat_kamar as $value): ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $value->nama_kamar; ?></td>
                            <td><?php echo "Kelas ".$value->kelas;?></td>
                            <td><?php echo date("d-m-Y",strtotime($value->tanggal))?></td>
                            <td><?php echo $value->tanggal_akhir==NULL?date("d-m-Y"):date("d-m-Y",strtotime($value->tanggal_akhir))?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>desain/dist/simple.money.format.js"></script>
    <?php
    $this->load->view('BillingRanap/form_dialog');
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
    <script type="text/javascript">
    $('.money').simpleMoneyFormat();
    </script>
    <script type="text/javascript">

    // $(document).ready(function(){
    //   $("#submit").attr("disabled", true);
    // });

    function filter() {
      var bayar   = $("#bayar").val().split(',');
      var billing = $("#billing").val();
      var sbayar ="";
      var stotal ;
      for (var i = 0; i < bayar.length; i++) {
          sbayar = sbayar +""+ bayar[i];
      }
      var total;
      total = sbayar - billing;
      $("#kembalian").val(total);
      stotal = $("#kembalian").val().split('.');
      $("#kembalian").val(stotal[0]);
      $("#kembalian").simpleMoneyFormat();

      $("#text_kembalian").html($("#kembalian").val());
      $("#text_pembayaran").html($("#bayar").val());

      // if (total >= 0) {
      //   $("#submit").removeAttr("disabled");
      // }else {
      //   $("#submit").attr("disabled", true);
      // }
    }
    </script>
