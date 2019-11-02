var playlist = [];
var panggilan = [];
var i = 0;
var active = false;
var url = 'http://utamahusada.com/sim/desain/antrian/';
playlist.push("awal.mp3");
reset();
function reset(){
    $.ajax({
        type  : 'GET',
        url   : 'http://utamahusada.com/sim/Antrian/reset',
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
  // if (poli=="UMU") {
  //   playlist.push("u.mp3");
  // }
  // if (poli=="OBG") {
  //   playlist.push("o.mp3")
  // }
  // if (poli=="OZO") {
  //   playlist.push("oz.mp3")
  // }
  // if (poli=="INT") {
  //   playlist.push("in.mp3")
  // }
  // if (poli=="GIG") {
  //   playlist.push("ig.mp3")
  // }
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

  // if (no < 1000) {
  //   var puluhan = parseInt(no/100);
  //   playlist.push(list[puluhan]);
  //   playlist.push("puluh.mp3");
  //   var satuan = parseInt(no%10);
  //   playlist.push(list[satuan]);
  // }
  if (poli=="UMU") {
    playlist.push("umum.mp3");
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
  if (poli=="LOKET1") {
    playlist.push("loket1.mp3")
  }
  if (poli=="LOKET2") {
    playlist.push("loket2.mp3")
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
        if (p[0]=="UMU") {
          $(".antrian_poliumum").text(pad(p[1],3));
        }
        if (p[0]=="OBG") {
          $(".antrian_poliobgyn").text(pad(p[1],3));
        }
        if (p[0]=="OZO") {
          $(".antrian_poliozon").text(pad(p[1],3));
        }
        if (p[0]=="INT") {
          $(".antrian_poliinternis").text(pad(p[1],3));
        }
        if (p[0]=="GIG") {
          $(".antrian_poligigi").text(pad(p[1],3));
        }
        if (p[0]=="LOKET1") {
          $(".antrian_loket1").text(pad(p[1],3));
        }
        if (p[0]=="LOKET2") {
          $(".antrian_loket2").text(pad(p[1],3));
        }
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
  channel.bind('my-event3', function(data) {
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
