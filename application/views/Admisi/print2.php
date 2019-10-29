<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admisi Rawat Inap</title>
  <meta charset="utf-8">
  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
  Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="initial-scale=1.0, target-densitydpi=device-dpi" /><!-- this is for mobile (Android) Chrome -->
  <meta name="viewport" content="initial-scale=1.0, width=device-height"><!--  mobile Safari, FireFox, Opera Mobile  -->
  <script src="<?php echo base_url()?>desain/custom/jSignature/libs/modernizr.js"></script>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="../libs/flashcanvas.js"></script>
  <![endif]-->
  <style type="text/css">

  div {
    margin-top:1em;
    margin-bottom:1em;
  }
  input {
    padding: .5em;
    margin: .5em;
  }
  select {
    padding: .5em;
    margin: .5em;
  }
  td{
    padding-left: 10px;
    padding-right: 10px;
  }

  #signatureparent {
    color:darkblue;
    background-color:darkgrey;
    /*max-width:600px;*/
    /* min-height: 500px; */
    padding:20px;
  }

  /*This is the div within which the signature canvas is fitted*/
  #signature {
    border: 2px dotted black;
    background-color:lightgrey;
    /* min-height: 400px; */
  }
  img{
    max-width: 150px;
    max-height: 150px;
  }

  /* Drawing the 'gripper' for touch-enabled devices */
  html.touch #content {
    float:left;
    width:92%;
  }
  html.touch #scrollgrabber {
    float:right;
    width:4%;
    margin-right:2%;
    background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
  }
  html.borderradius #scrollgrabber {
    border-radius: 1em;
  }

</style>
</head>
<script>
window.print();
</script>
<body>
  <table>
    <tr>
      <td width="50%"><img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;" alt="homepage" class="dark-logo" /></td>
      <td><h2 align="center">Rumah Sakit Utama Husada</h2><p align="center">Jl. Manggar No.134, Tegalsari, Ambulu,<br>
        Kabupaten Jember, Jawa Timur<br>
        (68172)</td>
      </tr>
    </table>
    <table border="1" cellpadding="2" cellspacing="1">
      <tr>
        <td width="30%">NAMA PASIEN</td>
        <td width="40%"><?php echo $pasien['namapasien']?></td>
        <td width="20%">NO RM</td>
        <td width="50%"><?php echo $pasien['noRM']?></td>
      </tr>
      <tr>
        <td width="25%">ALAMAT</td>
        <td colspan="3" width="75%"><?php echo $pasien['alamat']?></td>
      </tr>
    </table><br>
    <table border="1" cellpadding="2" cellspacing="1">
      <tr>
        <td width="30%">Lembar Hak Kuasa ini harus ditanda tangani oleh pasien atau wali (keluarga yang terdekat/ kawan dari induk semarga dan lain sebagainya) bagi pasien yang :  a. secara fisik / mental dinyatakan tidak sanggup untuk mengisi     b. pasien masih dibawah umur. </td>
      </tr>
      <tr>
        <td><center><h2>PERSETUJUAN RAWAT INAP
          DAN KESANGGUPAN MENANGGUNG BIAYA</h2>
        </center>
        <p>Saya yang bertanda tangan di bawah ini pasien / wali pasien</p>
        <table style="margin-left:20px;">
          <tr>
            <td>Nama</td>
            <td> : <?php echo $pasien['wali_ranap']?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td> : <?php echo $pasien['alamat_wali']?></td>
          </tr>
          <tr>
            <td>No KTP/SIM</td>
            <td> : <?php echo $pasien['ktp_wali']?></td>
          </tr>
          <tr>
            <td>No Telp</td>
            <td> : <?php echo $pasien['tlp_wali']?></td>
          </tr>
        </table>
        <p>
          <?php
            if ($pasien['sts_wali']==1) {
              $dirawat = 'diri saya';
            }else if($pasien['sts_wali']==2 || $pasien['sts_wali']==3 ){
              $dirawat = 'anak saya';
            }else if ($pasien['sts_wali']==4 ) {
              $dirawat = "istri saya";
            }else if($pasien['sts_wali']== 5){
              $dirawat = "suami saya";
            }else if($pasien['sts_wali']== 5){
              $dirawat = "orang tua saya";
            }else{
              $dirawat = "saudara saya";
            }
          ?>
          Dengan ini menyatakan bahwa :
          <br>a.	Setuju untuk Rawat Inap dan mengijinkan dokter yang ditunjuk untuk melakukan tindakan diagnosis dan terapi yang dianggap perlu dan penting bagi pasien selama dalam perawatan (termasuk rawat isolasi – bila diperlukan ) terhadap <?php echo $dirawat." <b>".$pasien['namapasien']."</b>"?>
          <br>c.	Bersedia mentaati / mematuhi segala peraturan yang berlaku di Rumah Sakit Utama Husada Ambulu Jember.
          <p align="right">Ambulu, <?php echo date("d-m-Y",strtotime($rujuk['tanggal_rujuk']))?> jam <?php echo date("h:i:s",strtotime($rujuk['tanggal_rujuk']))?></p>
        </p>
        <p align="right" id="gambar"></p>
        <p align="right" style="margin-right:30px"><b><?php echo $pasien['wali_ranap']?></b></p>
      </td>

      </tr>

    </table>
    <!-- <div id="gambar">
    </div> -->
    <input type="hidden" id="data" value="<?php echo $pasien['ttd_wali']?>">

    <script src="<?php echo base_url()?>desain/custom/jSignature/libs/jquery.js"></script>
    <script type="text/javascript">
    jQuery.noConflict()
  </script>
  <script>
  /*  @preserve
  jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
  Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
  Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
  http://dojofoundation.org/license for more information.
  */
  (function($) {
    var topics = {};
    $.publish = function(topic, args) {
      if (topics[topic]) {
        var currentTopic = topics[topic],
        args = args || {};

        for (var i = 0, j = currentTopic.length; i < j; i++) {
          currentTopic[i].call($, args);
        }
      }
    };
    $.subscribe = function(topic, callback) {
      if (!topics[topic]) {
        topics[topic] = [];
      }
      topics[topic].push(callback);
      return {
        "topic": topic,
        "callback": callback
      };
    };
    $.unsubscribe = function(handle) {
      var topic = handle.topic;
      if (topics[topic]) {
        var currentTopic = topics[topic];

        for (var i = 0, j = currentTopic.length; i < j; i++) {
          if (currentTopic[i] === handle.callback) {
            currentTopic.splice(i, 1);
          }
        }
      }
    };
  })(jQuery);

</script>
<script src="<?php echo base_url()?>desain/custom/jSignature/libs/jSignature.min.noconflict.js"></script>
<script>
(function($){

  $(document).ready(function() {
    var i = new Image()
    var signature = $("#data").val();
    i.src = 'data:' + signature;
    $(i).appendTo('#gambar');

    // This is the part where jSignature is initialized.
    // var $sigdiv = $("#signature").jSignature({'UndoButton':true})

    var $sigdiv = $("#signature").jSignature({height:400,width:720})

    // All the code below is just code driving the demo.
    , $tools = $('#tools')
    , $extraarea = $('#displayarea')
    , pubsubprefix = 'jSignature.demo.'

    // var export_plugins = $sigdiv.jSignature('listPlugins','export')
    // , chops = ['<span><b>Extract signature data as: </b></span><select>','<option value="">(select export format)</option>']
    // , name
    // for(var i in export_plugins){
    // 	if (export_plugins.hasOwnProperty(i)){
    // 		name = export_plugins[i]
    // 		chops.push('<option value="' + name + '">' + name + '</option>')
    // 	}
    // }
    // chops.push('</select><span><b> or: </b></span>')
    //
    // $(chops.join('')).bind('change', function(e){
    // 	if (e.target.value !== ''){
    // 		var data = $sigdiv.jSignature('getData', e.target.value)
    // 		$.publish(pubsubprefix + 'formatchanged')
    // 		if (typeof data === 'string'){
    // 			$('textarea', $tools).val(data)
    // 		} else if($.isArray(data) && data.length === 2){
    // 			$('textarea', $tools).val(data.join(','))
    // 			$.publish(pubsubprefix + data[0], data);
    // 		} else {
    // 			try {
    // 				$('textarea', $tools).val(JSON.stringify(data))
    // 			} catch (ex) {
    // 				$('textarea', $tools).val('Not sure how to stringify this, likely binary, format.')
    // 			}
    // 		}
    // 	}
    // }).appendTo($tools)


    $('<input type="button" value="Reset">').bind('click', function(e){
      $sigdiv.jSignature('reset')
    }).appendTo($tools)
    $('<input type="button" value="Simpan">').bind('click', function(e){
      var data = $sigdiv.jSignature('getData', "svgbase64")
      // alert(data);
      var i = new Image()
      var signature = data;
      //Here signatureDataFromDataBase is the string that you saved earlier
      i.src = 'data:' + signature;
      // $(i).appendTo('#gambar');
      $("#ttd").val(data);
      var nokun = $("#nokun").val();
      if (nokun=='') {
        alert("isi no kunjungan");
      }else{
        $("#form_signature").submit();
      }
    }).appendTo($tools)

    // $('<div><textarea style="width:100%;height:7em;"></textarea></div>').appendTo($tools)

    $.subscribe(pubsubprefix + 'formatchanged', function(){
      $extraarea.html('')
    })

    $.subscribe(pubsubprefix + 'image/svg+xml', function(data) {

      try{
        var i = new Image()
        i.src = 'data:' + data[0] + ';base64,' + btoa( data[1] )
        $(i).appendTo($extraarea)
      } catch (ex) {

      }

      var message = [
        "If you don't see an image immediately above, it means your browser is unable to display in-line (data-url-formatted) SVG."
        , "This is NOT an issue with jSignature, as we can export proper SVG document regardless of browser's ability to display it."
        , "Try this page in a modern browser to see the SVG on the page, or export data as plain SVG, save to disk as text file and view in any SVG-capabale viewer."
      ]
      $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
    });

    $.subscribe(pubsubprefix + 'image/svg+xml;base64', function(data) {
      var i = new Image()
      i.src = 'data:' + data[0] + ',' + data[1]
      $(i).appendTo($extraarea)

      var message = [
        "If you don't see an image immediately above, it means your browser is unable to display in-line (data-url-formatted) SVG."
        , "This is NOT an issue with jSignature, as we can export proper SVG document regardless of browser's ability to display it."
        , "Try this page in a modern browser to see the SVG on the page, or export data as plain SVG, save to disk as text file and view in any SVG-capabale viewer."
      ]
      $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
    });

    $.subscribe(pubsubprefix + 'image/png;base64', function(data) {
      var i = new Image()
      i.src = 'data:' + data[0] + ',' + data[1]
      $('<span><b>As you can see, one of the problems of "image" extraction (besides not working on some old Androids, elsewhere) is that it extracts A LOT OF DATA and includes all the decoration that is not part of the signature.</b></span>').appendTo($extraarea)
      $(i).appendTo($extraarea)
    });

    $.subscribe(pubsubprefix + 'image/jsignature;base30', function(data) {
      $('<span><b>This is a vector format not natively render-able by browsers. Format is a compressed "movement coordinates arrays" structure tuned for use server-side. The bonus of this format is its tiny storage footprint and ease of deriving rendering instructions in programmatic, iterative manner.</b></span>').appendTo($extraarea)
    });

    if (Modernizr.touch){
      $('#scrollgrabber').height($('#content').height())
    }

  })

})(jQuery)
</script>
</body>
</html>
