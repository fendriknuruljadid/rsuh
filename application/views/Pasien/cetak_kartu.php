<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" sizes="16x16" href="http://utamahusada.esolusindo.com/desain/assets/images/rsuh_7.png">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UtamaHusada | Cetak Kartu Member</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .bg{
      position: relative;
      left: 0px;
      top: 0px;
      height: 200px;
      width: 350px;
      border: 1px solid black;
      padding: 10px;
      border-radius: 10px;
      background: url('http://utamahusada.com/sim/foto/bg_card.jpg') repeat;
    }
    .head{
      position: relative;
      width: 100%;
      height: 80px;
      /* border: 1px solid red; */
    }
    .isi{
      position: relative;
      bottom: 0px;
      left: 0px;
      width: 200px;
      margin-top: 10px;
      height: 85px;
      /* border: 1px solid green; */
    }

    .no_rm{
      position: absolute;
      bottom: 5px;
      left: 10px;
      width: 200px;
      margin-top: 10px;
      height: 25px;
      text-align: right;
      /* border: 1px solid gray; */
    }
    .qr_code{
      position: absolute;
      right: 10px;
      bottom: 5px;
      width: 130px;
      height: 110px;
      /* border: 1px solid yellow; */
    }
    .rs{
      position: relative;
      top:-75px;
      left:70px;
    }
    .rs-alamat{
      position: relative;
      top:-85px;
      left:0px;
      text-align: center;
      font-size: 12px;
    }
    .alamat{
      font-size: 14px;
    }
    @media print {
    .bg {
        background-color: rgba(197, 239, 247, 1) !important;
        -webkit-print-color-adjust: exact;
    }
}
  </style>
</head>
<!-- <body> -->
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <div class="bg">
      <div class="head">
        <img src="http://utamahusada.com/sim/desain/assets/images/rsuh_7.png" width="50px" height="50px"><h3 class="rs">Rumah Sakit Utama Husada</h3>
        <p class="rs-alamat">Jl. Manggar No.134, Tegalsari, Ambulu,<br>Kabupaten Jember, Jawa Timur<br>(68172)</p>
      </div>
      <div class="isi">
        <b><?php echo @$data_pasien['namapasien'];?></b><br>
        <span class="alamat"><?php echo @$data_pasien['alamat'];?><span>
      </div>
      <div class="no_rm">
        <?php echo @$data_pasien['noRM'];?>
      </div>
      <div class="qr_code">
        <img src="http://utamahusada.com/sim/foto/qrcode_rm/<?php echo @$data_pasien['qrcode'];?>" width="100%" height="100%">

      </div>
      </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
