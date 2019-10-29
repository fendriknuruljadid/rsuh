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
    width: 750px;
    /* min-height: 900px; */
  }
  .cover{
    background-image:url(<?php echo base_url() ?>desain/watermark.png);
    background-size: 750px 900px;
    background-repeat: repeat-y;
    position: fixed;
    width: 750px;
    height: 900px;
    top: 300px;
    z-index: -1;
  }
  .striped tr:nth-child(even) {
    background-color: #b7e2fcc7;
  }
  .striped tr:nth-child(odd) {
    background-color: #f1faffdb;
  }
  body {
      /* background-color: #CCC; */
      /* margin:135px 0px 0px 0px; */
  }
  .jarak-atas{
    padding-top: 300px;
  }
  .jarak-bawah{
    padding-top: 550px;
  }
  .trans{
    background-color: #fff0 !important;
  }
  div#header {
      position:fixed;
      top:0px;
      left:0px;
      width:100%;
      /* color:#CCC; */
      background:#fff;
      padding:0px 8px 8px 8px;
  }
  div#footer {
      position:fixed;
      bottom:0px;
      left:0px;
      width:100%;
      color:#CCC;
      /* background:#333; */
      padding:8px;
  }
/* } */


</style>
<div class="cover">
</div>
<div id="header">
  <div class="row" style="">
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
  <h2 align="center">HASIL PEMERIKSAAN LAB</h2>
  <div style="background: linear-gradient(40deg,#a5e2fb99,#5aa4ffeb)!important;padding: 25px;border-radius: 10px;">
    <table width="100%" class="borderless">
        <tr>
            <th width="15%" align="left">NO RM </th>
            <th width="35%" align="left">: <?php echo $data_lab['noRM']; ?></th>
            <th width="15%" align="left">DOKTER </th>
            <th width="35%" align="left">: <?php echo $data_lab_2['nama_dokter']; ?></th>
        </tr>
        <tr>
            <th width="15%" align="left">PASIEN </th>
            <th width="35%" align="left">: <?php echo $data_lab['namapasien']; ?></th>
            <th width="15%" align="left">TANGGAL </th>
            <th width="35%" align="left">: <?php echo date("d:m:Y",strtotime($data_lab_2['jam'])) ?></th>
        </tr>
        <tr>
            <th width="15%" align="left">ANALIS </th>
            <th width="35%" align="left">: <?php echo $data_lab['nama_analis'];?></th>
            <th width="15%" align="left">JAM </th>
            <th width="35%" align="left">: <?php echo date("h:i:s",strtotime($data_lab_2['jam'])) ?></th>
        </tr>
      </table>
  </div>
  </div>

  <div class="bg jarak-atas">

    <table class="striped" cellspacing="0" cellpadding="4" width="100%">
        <tr style="background-color:#fff">
            <th align="left">PEMERIKSAAN</th>
            <th align="left">HASIL LAB</th>
            <th align="left">NILAI NORMAL</th>
        </tr>

        <?php $no = 1;
        // for ($j=0; $j < 3; $j++) {
          // code...

          $jml=count($hasil_lab);
        foreach ($hasil_lab as $value): ?>
        <tr>
          <td <?php if (strlen($value->kode_lab) > 3 && strlen($value->kode_lab) < 6): ?>
            style="padding-left:20px;"
            <?php else: ?>
              <?php if (strlen($value->kode_lab) >= 6): ?>

                style="padding-left:50px;"
              <?php endif; ?>
          <?php endif; ?>><?php echo $value->nama ?></td>
          <td><?php echo $value->hasil; ?></td>
          <td><?php echo $value->nilainormal; ?></td>
        </tr>
        <?php if ($jml > 26): ?>
          <?php if ($no == 28): ?>
          <tr class="trans">
            <td colspan="4" style="padding-top: 340px;"></td>
          </tr>
          <?php endif; ?>
        <?php else: ?>
        <?php $t=0; for ($k=20; $k <= 26; $k++) { ?>
          <?php if ($jml == $k) {
            if ($no == $k) { ?>
              <tr class="trans">
                <td colspan="4" style="padding-top: <?php echo 550-(25*$t).'px'; ?>;"></td>
              </tr>
              <tr style="background-color:#fff">
                  <th align="left">PEMERIKSAAN</th>
                  <th align="left">HASIL LAB</th>
                  <th align="left">NILAI NORMAL</th>
              </tr>
          <?php  } } ?>
        <?php $t++; } ?>
        <?php endif; ?>
        <?php $no++; endforeach; ?>
    </table>

    <table width="100%" style="margin-top: 90px">
        <tr>
            <th align="left" style="padding-left:50px;">Analis</th>
            <th align="right" style="padding-right:50px;">Penanggung Jawab</th>
        </tr>
    </table>

    <table width="100%" style="margin-top: 80px">
        <tr>
            <th align="left" style="padding-left:50px;"><?php echo $data_lab['nama_analis'];?></th>
            <th align="right" style="padding-right:50px;">dr.Didit Dwi Rismawa</th>
        </tr>
    </table>
  </div>

</div>

<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
window.print()
});
</script>
