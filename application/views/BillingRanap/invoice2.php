<script>
  window.print();
</script>
<style>
  @media print{
    .left-sidebar,.page-titles,.button_opsi,.footer,.opsi,.asuransi,.diskon{display: none;}
    #footer_tagihan{display: inline;}
  }
</style>
<?php echo form_open_multipart('Billing/input');?>
<?php $id = $this->uri->segment(3)?>
<div class="row form-material">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3><b>TAGIHAN</b> <span class="pull-right">#<?php echo $no_invoice?></span></h3>
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
                              <p>Jember, <?php echo date('d-m-Y')?></p>
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
                                          <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Pembayaran">
                                            <i class="fa fa-edit"></i>
                                          </button>
                                          </a>
                                        <?php
                                      } if($billing['opsi']=='japel') {?>
                                        <a href="#" data-toggle="modal" data-target="#japel">
                                        <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Pembayaran">
                                          <i class="fa fa-edit"></i>
                                        </button>
                                        </a>
                                      <?php
                                    } if ($billing['opsi']=='lab') {?>
                                      <a href="#" data-toggle="modal" data-target="#lab">
                                      <button id="" type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Pembayaran">
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

                                        ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                  }?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">

                          <table>
                            <tr>
                              <td>Total :</td><td><i>Rp</i> <?php echo number_format($total,2,",",".");?> <input type="text" name="total" value="<?php echo $total;?>" hidden ></td>
                            </tr>
                            <tr class="asuransi">
                              <td>Asuransi - <?php echo @$jenis_pasien;?> :</td><td><i>Rp</i> <?php echo @$asuransi;?> <input type="text" name="asuransi" value="<?php echo @$asuransi;?>"></td>
                            </tr>
                            <tr class="diskon">
                              <td>Diskon :</td><td><i>Rp</i><input type="text" name="diskon" value="<?php echo @$diskon;?>"></td>
                            </tr>
                            <tr>
                              <td>PPN (10%) :</td><td><i>Rp</i> <?php echo number_format($ppn,2,",",".")?> <input type="text" name="ppn" value="<?php echo $ppn;?>" hidden ></td>
                            </tr>

                          </table>
                            <hr>
                            <input type="text" hidden name="id" value="<?php echo $this->uri->segment(3); ?>">
                            <input type="text" hidden name="bayar" id="billing" value="<?php echo $total_billing;?>">
                            <h3><b>Total Tagihan :</b> <i>Rp</i> <?php echo number_format($total_billing,2,",",".");?></h3>
                            <h6><i>( <?php echo $terbilang;?></i> )</h6>
                        </div>
                    </div>
                    <div class="col-md-12 bayar">
                        <div class="pull-right m-t-30 text-right row">
                            <hr>
                            <div class="row col-12 text-right">
                              <div class="col-md-7" style="top: 9px;"><h5><b>Pembayaran :</b> <i>Rp</i></h5></div> <div class="col-md-5"><h5><input name="jml_bayar" id="bayar" onkeyup="filter()" type="text" class="form-control money" ></h5></div>
                              <div class="col-md-7" style="top: 9px;"><h5><b>Kembalian :</b> <i>Rp</i></h5></div> <div class="col-md-5"><h5><input name="kembalian" id="kembalian" type="text" class="form-control money" readonly></h5></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                </div>
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
                    <button class="btn btn-danger" type="submit" id="submit"> Proses Pembayaran </button>
                    <button onClick="javascript:window.print();" class="btn btn-primary btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                </div>
                <?php foreach ($detail_resep as $data): ?>
                  <input type="hidden" name="idobat[]" value="<?php echo $data->idobat?>">
                  <input type='hidden' name='jumlah_akhir[]' value="<?php echo $data->jumlah?>">
                <?php endforeach; ?>
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
                              </thead>
                            <tbody>
                            <?php foreach ($this->ModelBilling->japel($id)->result() as $value): ?>
                              <tr>
                                <td>
                                  <?php echo $value->jsmedis ?>
                                </td>
                                <td>
                                  <?php echo $value->harga ?>
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
                                </thead>
                              <tbody>
                                <?php $lab=0; foreach ($this->ModelBilling->lab($id)->result() as $value): ?>
                                  <tr>
                                    <td><?php echo $value->kodelab; ?></td>
                                    <td><?php echo $value->nama; ?></td>
                                    <td><?php echo $value->harga;?></td>
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
<script type="text/javascript" src="<?php echo base_url; ?>desain/dist/simple.money.format.js"></script>
<?php
$this->load->view('Billing/form_dialog');
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
	<script type="text/javascript">
		$('.money').simpleMoneyFormat();
	</script>
<script type="text/javascript">

$(document).ready(function(){
  $("#submit").attr("disabled", true);
});

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

  if (total >= 0) {
    $("#submit").removeAttr("disabled");
  }else {
    $("#submit").attr("disabled", true);
  }
}
</script>
