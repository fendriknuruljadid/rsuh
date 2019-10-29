var playlist = [];
var panggilan = [];
var i = 0;
var active = false;
var url = 'http://utamahusada.esolusindo.com/desain/antrian/';
playlist.push("awal.mp3");
reset();
var waktu = $("#input_jam").val();
waktu = waktu.split(":");
// alert(waktu);
var jam = parseInt(waktu[0]);
var menit = parseInt(waktu[1]);
var detik = parseInt(waktu[2]);
// alert(detik);
function hitung_jam(){
  setTimeout(hitung_jam,1000);
  $(".jam").html(pad(jam,2)+":"+pad(menit,2)+":"+pad(detik,2));
  detik++;
  if (detik>=60) {
    detik = 0;
    menit++;
    if (menit>=60) {
      menit = 0;
      jam++;
      if (jam>24) {
        jam=0;
      }
    }
  }
}
hitung_jam();
function reset(){
    $.ajax({
        type  : 'GET',
        url   : 'http://utamahusada.esolusindo.com/Antrian/reset',
        async : false,
        dataType : 'json',
        success: function(response) {
        }

      })
};
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
function get_audio(poli,no,inisial){
  var list = Array('kosong.mp3','satu.mp3','dua.mp3','tiga.mp3','empat.mp3','lima.mp3','enam.mp3','tujuh.mp3','delapan.mp3','sembilan.mp3','sepuluh.mp3','sebelas.mp3');

  if (inisial=="L") {
    playlist.push("l.mp3")
  }
  if (inisial=="B") {
    playlist.push("b.mp3")
  }
  if (inisial=="EG") {
    playlist.push("e.mp3")
    playlist.push("g.mp3")

  }
  if (inisial=="EP") {
    playlist.push("e.mp3")
    playlist.push("p.mp3")
  }
  if (inisial=="DI") {
    playlist.push("d.mp3")
    playlist.push("i.mp3")

  }
  if (inisial=="MD") {
    playlist.push("m.mp3")
    playlist.push("d.mp3")
  }
  if (inisial=="DD") {
    playlist.push("d.mp3")
    playlist.push("d.mp3")

  }

  if (inisial=="YM") {
    playlist.push("y.mp3")
    playlist.push("m.mp3")

  }

  if (inisial=="AD") {
    playlist.push("a.mp3")
    playlist.push("d.mp3")

  }

  if (no > 100 && no < 200) {
    playlist.push('seratus.mp3');
    var no = parseInt(no-100);
    if (no < 12) {
      playlist.push(list[no]);
    }else{
      var puluhan = parseInt(no/10);
      playlist.push(list[puluhan]);
      playlist.push("puluh.mp3");
      var satuan = parseInt(no%10);
      playlist.push(list[satuan]);
    }

  }
  else if (no > 19 && no < 100) {
    var puluhan = parseInt(no/10);
    playlist.push(list[puluhan]);
    playlist.push("puluh.mp3");
    var satuan = parseInt(no%10);
    playlist.push(list[satuan]);
  }
  else if (no > 11 && no < 20) {
    var no = parseInt(no-10);
    playlist.push(list[no]);
    playlist.push("belas.mp3");
  }else{
    if (no < 12) {
      playlist.push(list[no]);
    }else{
      playlist.push("seratus.mp3");
    }
  }

  if (poli=="UMU") {
    playlist.push("umum.mp3");
  }

  if (poli=="LAB") {
    playlist.push("lab.mp3");
  }
  if (poli=="OBG") {
    playlist.push("obgyn.mp3")
  }
  if (poli=="OZO") {
    playlist.push("ozon.mp3")
  }
  if (poli=="INT") {
    playlist.push("internis.mp3")
  }
  if (poli=="GIG") {
    playlist.push("gigi.mp3")
  }

}
function play_panggilan(){
  // if (!active) {

    var audio = new Audio();
    var poli = panggilan[0];
    // alert(poli);
    var p = poli.split('-');
    get_audio(p[0],p[1],p[2]);
    // alert(p[1]);
    // var playlist = new Array('http://utamahusada.com/sim/desain/antrian/awal.mp3', 'http://utamahusada.com/sim/desain/antrian/u.mp3','http://utamahusada.com/sim/desain/antrian/satu.mp3','http://utamahusada.com/sim/desain/antrian/umum.mp3');
    audio.volume = 0.3;
    audio.loop = false;
    audio.src = url+playlist[0];
    audio.play();
    audio.addEventListener('ended', function () {
      i = ++i < playlist.length ? i : 0;
      // console.log(i)
      audio.src = url+playlist[i];
      audio.play();
      // if (i==0) {
      //   break;
      // }
      if (i==0) {
        audio.pause();
        audio.currentTime = 0;
        playlist = [];
        playlist.push("awal.mp3");
        var lokasi = "";
        if (p[0]=="UMU") {
          $(".antrian_umum").text(p[2]+p[1]);
          lokasi = "Poli Umum";
        }
        if (p[0]=="OBG") {
          $(".antrian_obgyn").text(p[2]+p[1]);
          lokasi = "Poli Obgyn"
        }
        if (p[0]=="OZO") {
          $(".antrian_ozon").text(p[2]+p[1]);
          lokasi = "Poli Obgyn"
        }
        if (p[0]=="INT") {
          $(".antrian_internis").text(p[2]+p[1]);
          lokasi = "Poli Internis";
        }
        if (p[0]=="GIG") {
          $(".antrian_gigi").text(p[2]+p[1]);
          lokasi = "Poli Gigi";
        }

        if (p[0]=="LAB") {
          $(".antrian_laborat").text(p[2]+p[1]);
          lokasi = "Laboratorium";
        }
        $(".antrian_akhir").text(p[2]+p[1]);
        $(".lokasi_akhir").text(lokasi);

        panggilan.shift();
        if (panggilan.length!==0) {
          setTimeout(() => {
          play_panggilan();
        }, Math.floor(Math.random() * 2000) + 1000)

      }else{
          active = false;
          reset();
      }


      }
    },true);
  // }

}
// $(document).on("click",'#panggilan',function(){
//   // var audio = new Audio('http://utamahusada.com/sim/desain/antrian/awal.mp3');
//   // audio.play();
//
//
// })
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('58f10ec738925cc9cf18', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('ci_pusher3');
  channel.bind('my-event55', function(data) {
      // alert(data.no_antrian);
      // if (i==0) {
      // }
      var delayInMilliseconds = 10000; //1 second
      // alert(data.no_antrian);
      if (active) {
        panggilan.push(data.no_antrian);
        reset();
      }else{

        active = true;

        // setTimeout(function() {
          //your code to be executed after 1 second
          panggilan.push(data.no_antrian);
          play_panggilan();

        // }, delayInMilliseconds);


      }

    // alert(data.gambar);
    // var i = new Image(150,150)
    // var signature = data.gambar;
  //Here signatureDataFromDataBase is the string that you saved earlier
    // i.src = 'data:' + signature;
    // $(i).appendTo('#signature'+data.nokun);
    // $("#val_signature"+data.nokun).val(data.gambar);
  });