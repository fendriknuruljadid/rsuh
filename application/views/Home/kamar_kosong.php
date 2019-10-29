<style >
/* @media print{ */
  .row{
    display: flex;
flex-wrap: wrap;
margin-right: -10px;
margin-left: -10px;
  }
  .col-logo{
    flex: 0 0 4cm;
        max-width: 6.2cm;
        max-height: 3.1cm;
        vertical-align: middle;
        text-align: center;
        padding-top: 8px;
  }
  .col-header{
    flex: 0 0 14cm;
    max-width: 14cm;
    max-height: 3.1cm;
    vertical-align: middle;
    text-align: center;
  }

  .logo{
    width: 90px;height: 90px;
    margin-left: 8px;
  }
  .m-0{
    margin: 0 !important;
  }
  .borderless{
    border-collapse:collapse;
  }
  .background {
    position: absolute;
    width: 750px;
    height: 82%;
    z-index: -1;
  }
  .bg{
    background-image:url(<?php echo base_url() ?>desain/watermark.png);
    width: 750px;
    min-height: 900px;
    background-size: 750px 900px;
   background-repeat: repeat-y;
  }
  .striped tr:nth-child(even) {
    background-color: #b7e2fcc7;
  }
  .striped tr:nth-child(odd) {
    background-color: #f1faffdb;
  }
/* } */


</style>

<div class="row">
  <div class="col-logo">
    <img src="<?php echo base_url() ?>desain/assets/images/rsuh_7.png" class="logo">
  </div>
  <div class="col-header">
    <h1 align="center" class="m-0">RUMAH SAKIT UTAMA HUSADA</h1>
    <h4 align="center" class="m-0">Jl. Manggar No.134, Tegalsari, Ambulu, Kabupaten Jember, Jawa Timur</h4>
    <h4 align="center" class="m-0">Telepon / HP: 0336 - 881186 / 881187 / +6282302227892; Email: utamahusada@yahoo.com</h4>
  </div>

</div>
<hr style="margin-bottom: -5px;">
<hr size="6" color="#000000" style="bgcolor: #000;">
<div class="bg">
  <br>
<h2 align="center">List Kamar Belum Terisi/Kosong</h2>

<br>
  <table class="striped" cellspacing="0" cellpadding="10" width="100%">
      <tr style="background-color:#fff">
          <th align="left">NO</th>
          <th align="left">Nama Kamar</th>
          <th align="left">No Bed</th>
          <th align="left">Kelas</th>
          <th align="left">Status Kamar</th>
      </tr>
      <?php $no= 1;
      foreach ($kamar as $value): ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $value->nama_kamar; ?></td>
        <td><?php echo $value->bed; ?></td>
        <td><?php echo "Kelas ".$value->kelas; ?></td>
        <td><?php echo "Kosong"; ?></td>
      </tr>
      <?php $no++; endforeach; ?>
  </table>
</div>


<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
window.print()
});
</script>
