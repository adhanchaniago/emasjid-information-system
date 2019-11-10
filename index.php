<?php
require('config/config.inc.php');
require(MYSQL);

$sql = "SELECT * FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $lat = $row['lat'];
  $lon = $row['lon'];
  $nama_tempat =  $row['nama_tempat'];
  $slide_utama = $row['slide_utama'];
  $jeda_slide = $row['jeda_slide'];
  $effect = $row['effect'];
  $last_update = $row['last_update'];
}

?>
<!DOCTYPE html>
<html lang="ms">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Memaparkan waktu solat, info dan berbagai maklumat.  Khusus untuk kegunaan masjid">
  <meta name="author" content="mohamad.arfakhsy13@gmail.com">
  <link rel="shortcut icon" href="setting/assets/images/islamic-symbols-icon-png-13211-128x106.png" type="image/x-icon">
  <title>Masjid Info</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <style>

  body{
    font-size: 100%;
  }
  .fix-size {
    height: 92vh;
    background: 100% 100% no-repeat center center fixed;
    background-repeat: no-repeat;
    background-size:100% 100%;
    -webkit-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
    background-size: 100% 100%;
    border: 1px solid black;
  }

  .kanan {
    height: 92vh;
    background-color: #333;
    border: 1px solid black;
  }
  .bawah{
    overflow: hidden;
    height: 8vh;
  }

  .text-bawah{
    font-size:1.5em;
    margin: auto;
    padding: auto;
  }

  .clockdate-wrapper {
    background-color: #333;
    padding:2px;
    max-width:350px;
    width:100%;
    text-align:center;
    margin:0 auto;
    margin-top:0%;
  }
  #clock{
    background-color:#4682B4;
    font-family: sans-serif;
    font-size:2.5em;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
  }
  #clock span {
    color:#888;
    text-shadow:0px 0px 1px #333;
    font-size:1em;
    position:relative;
  }
  #date, #day, #hijri, #alamat {
    background-color:#4682B4;
    font-size:1.6em;
    font-family:arial,sans-serif;
    color:#fff;
  }

  .waktu_solat{
    margin-top:2%;
    border-radius: 20px;
    background-color:#004d00;
    font-family: sans-serif;
    font-size:1.9em;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
    border: 3px solid white;
  }

  .solat{
    background-color:red;
  }

  .marquee {
  width: 100%; /* the plugin works for responsive layouts so width is not necessary */
  height: 8vh;
  font-size:2.4em;
  color: yellow;
  font-weight: bold;
  overflow: hidden;
  border:1px solid black;
}
  </style>
</head>

<body>
  <input id="id-last-update" type="hidden" name="last-update" value="<?php echo $last_update; ?>">

  <div class="row no-gutters">
    <div class="col-9">
        <div id="slider">
          <div class="fix-size" style="background-image: url('images/<?php echo $slide_utama;?>')"></div>
          <?php
          $sql = "SELECT * FROM " . database_prefix ."_slider WHERE `paparkan`='1' ORDER BY giliran ASC, slider_id DESC";
          $result = mysqli_query($dbc, $sql);
          if (mysqli_num_rows($result) > 0) { //pernah memohon kursus. ada rekod

            while($row = mysqli_fetch_assoc($result)) {
              ?><div class="fix-size" style="background-image: url('images/<?php echo $row['url'];?>')"></div><?php
            }
          }
          ?>
        </div>

    </div>

    <div class="col-3">
      <div class="kanan">
        <div id="clockdate">
          <div class="clockdate-wrapper">
            <div id="alamat"><?php echo $nama_tempat; ?></div>
            <div id="day"></div>
            <div id="date"><span id="hari"></span> <span id="bulan"></span> <span id="tahun"></span></div>
            <div id="hijri"><span id="hari-islam"></span> <span id="bulan-islam"></span> <span id="tahun-islam"></span></div>
            <div id="clock"></div>
            <div class="waktu_solat"><span id="nama-imsak">IMSAK</span> : <span id="imsak"></span></div>
            <div class="waktu_solat"><span id="nama-subuh">SUBUH</span> : <span id="subuh"></span></div>
            <div class="waktu_solat"><span id="nama-syuruk">SYURUK</span> : <span id="syuruk"></span></div>
            <div class="waktu_solat"><span id="nama-zohor">ZOHOR</span> : <span id="zohor"></span></div>
            <div class="waktu_solat"><span id="nama-asar">ASAR</span> : <span id="asar"></span></div>
            <div class="waktu_solat"><span id="nama-maghrib">MAGHRIB</span> : <span id="maghrib"></span></div>
            <div class="waktu_solat"><span id="nama-isyak">ISYAK</span> : <span id="isyak"></span></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="marquee bg-dark" id="scrollku">
    <?php
    $text = '';
    $sql = "SELECT `text` FROM `" . database_prefix ."_scroll` WHERE `paparkan`='1'";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) { //pernah memohon kursus. ada rekod

      while($row = mysqli_fetch_assoc($result)) {
        //  for ($x = 0; $x <= 15; $x++) {
        //    $text .= '&nbsp;';
        //  }
        $text .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $text .= $row['text'];

      }
    }
    echo $text;
    ?>
  </div>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery-1.11.2.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="vendor/sudoSlider/jquery.sudoSlider.min.js"></script>
  <script type="text/javascript" src="vendor/adhan/Adhan.js"></script>
  <script type="text/javascript" src="vendor/hijricalendar/hijricalendar-kuwaiti.js"></script>
  <script type="text/javascript" src="vendor/marquee/jquery.marquee.min.js"></script>
  <script type="text/javascript">

  var sudoSlider = $("#slider").sudoSlider({
    responsive: true,
    prevNext: false,
    effect: "<?php echo $effect; ?>",
    pause: <?php echo $jeda_slide*1000; ?>,
    auto:true,
    continuous: true
  });

  function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    //ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    //hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " ";

    var months = ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'October', 'NOVEMBER', 'Disember'];
    var days = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curDay+" "+curMonth+" "+curYear;
    document.getElementById("day").innerHTML = curWeekDay.toUpperCase();
    document.getElementById("hari").innerHTML = curDay;
    document.getElementById("bulan").innerHTML = curMonth.toUpperCase();
    document.getElementById("tahun").innerHTML = curYear;

    //tarikh hijrah
    var iMonthNames = new Array("Muharram","Safar","Rabi'ul Awwal","Rabi'ul Akhir", "Jamadil Awal","Jamadil Akhir","Rajab","Shaaban",
    "Ramadan","Syawal","Zulkaedah","Zulhijjah");
    var iDate = kuwaiticalendar(-1);

    document.getElementById("hari-islam").innerHTML = iDate[5];
    document.getElementById("bulan-islam").innerHTML = iMonthNames[iDate[6]].toUpperCase();
    document.getElementById("tahun-islam").innerHTML = iDate[7];



    if(hr=="01" && min=="00" && sec=="00"){
      get_prayer_times();
    }

    //reset paparan waktu solat
    var list = ['imsak', 'subuh', 'syuruk', 'zohor', 'asar', 'maghrib', 'isyak','nama-imsak', 'nama-subuh', 'nama-syuruk', 'nama-zohor', 'nama-asar', 'nama-maghrib', 'nama-isyak'];
    for(var i in list){
      var waktu_solat = document.getElementById(list[i]).classList;
      if (waktu_solat.contains("solat")) {
        waktu_solat.remove("solat");
      }
    }

    // get waktu solat string kepada time kiraan
    var imsak = toDate(document.getElementById("imsak").textContent,"h:m");
    var subuh = toDate(document.getElementById("subuh").textContent,"h:m");
    var syuruk = toDate(document.getElementById("syuruk").textContent,"h:m");
    var zohor = toDate(document.getElementById("zohor").textContent,"h:m");
    var asar = toDate(document.getElementById("asar").textContent,"h:m");
    var maghrib = toDate(document.getElementById("maghrib").textContent,"h:m");
    var isyak = toDate(document.getElementById("isyak").textContent,"h:m");

    //bunyikan beep ketika masuk waktu
    if(today>=subuh && today-subuh<1000) bunyi_beep();
    if(today>=zohor && today-zohor<1000) bunyi_beep();
    if(today>=asar && today-asar<1000) bunyi_beep();
    if(today>=maghrib && today-maghrib<1000) bunyi_beep();
    if(today>=isyak && today-isyak<1000) bunyi_beep();


    //blink 5 minit sebelum solat 1000ms*60*5 = 5minit
    //solat subuh
    if(today<subuh && subuh-today<1000*60*5){
      document.getElementById("subuh").classList.add("blink");
      document.getElementById("nama-subuh").classList.add("blink");
    }

    //solat zohor
    if(today<zohor && zohor-today<1000*60*5){
      document.getElementById("zohor").classList.add("blink");
      document.getElementById("nama-zohor").classList.add("blink");
    }

    //solat asar
    if(today<asar && asar-today<1000*60*5){
      document.getElementById("asar").classList.add("blink");
      document.getElementById("nama-asar").classList.add("blink");
    }

    //solat maghrib
    if(today<maghrib && maghrib-today<1000*60*5){
      document.getElementById("maghrib").classList.add("blink");
      document.getElementById("nama-maghrib").classList.add("blink");
    }

    //solat isyak
    if(today<isyak && isyak-today<1000*60*5){//5 minit
      document.getElementById("isyak").classList.add("blink");
      document.getElementById("nama-isyak").classList.add("blink");
    }


    //highlight waktu solat
    if(today>=subuh && today<syuruk){
      document.getElementById("subuh").classList.add("solat");
      document.getElementById("nama-subuh").classList.add("solat");
      //buang blink pada waktu subuh
      var list = ['nama-subuh', 'subuh'];
      for(var i in list){
        var waktu_blink = document.getElementById(list[i]).classList;
        if (waktu_blink.contains("blink")) {
          waktu_blink.remove("blink");
        }
      }
    }

    if(today>=zohor && asar-today>1000*60*5) {
      document.getElementById("zohor").classList.add("solat");
      document.getElementById("nama-zohor").classList.add("solat");
      //buang blink pada waktu zohor
      var list = ['nama-zohor', 'zohor'];
      for(var i in list){
        var waktu_blink = document.getElementById(list[i]).classList;
        if (waktu_blink.contains("blink")) {
          waktu_blink.remove("blink");
        }
      }
    }

    if(today>=asar && maghrib-today>1000*60*5) {
      document.getElementById("asar").classList.add("solat");
      document.getElementById("nama-asar").classList.add("solat");
      //buang blink pada waktu asar
      var list = ['nama-asar', 'asar'];
      for(var i in list){
        var waktu_blink = document.getElementById(list[i]).classList;
        if (waktu_blink.contains("blink")) {
          waktu_blink.remove("blink");
        }
      }
    }

    if(today>=maghrib && isyak-today>1000*60*5) {
      document.getElementById("maghrib").classList.add("solat");
      document.getElementById("nama-maghrib").classList.add("solat");
      //buang blink pada waktu maghrib
      var list = ['nama-maghrib', 'maghrib'];
      for(var i in list){
        var waktu_blink = document.getElementById(list[i]).classList;
        if (waktu_blink.contains("blink")) {
          waktu_blink.remove("blink");
        }
      }
    }

    if(today>=isyak || subuh-today>1000*60*5) {
      document.getElementById("isyak").classList.add("solat");
      document.getElementById("nama-isyak").classList.add("solat");
      //buang blink pada waktu isyak
      var list = ['nama-isyak', 'isyak'];
      for(var i in list){
        var waktu_blink = document.getElementById(list[i]).classList;
        if (waktu_blink.contains("blink")) {
          waktu_blink.remove("blink");
        }
      }
    }

    setTimeout(function(){ startTime() }, 1000);
  }

  function bunyi_beep(){
    //repeat audio 10 kali
    var times = 10;
    var loop = setInterval(repeat, 1000);

    function repeat() {
      times--;
      if (times === 0) {
        clearInterval(loop);
      }

      var audio = new Audio('audio/beep.mp3');
      audio.loop = false;
      audio.play();
    }
    repeat();
  }

  function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  function get_prayer_times(){
    //kiraan waktu solat

    var today = new Date();
    var coordinates = new adhan.Coordinates(<?php echo $lat; ?>, <?php echo $lon; ?>);
    var params = adhan.CalculationMethod.Singapore();
    params.madhab = adhan.Madhab.Shafi;
    params.adjustments.fajr = 2;
    params.adjustments.sunrise = -2;
    params.adjustments.dhuhr = 1;
    params.adjustments.asr = 1;
    params.adjustments.maghrib = 2;
    params.adjustments.isha = 2;
    var prayerTimes = new adhan.PrayerTimes(coordinates, today, params);
    var formattedTime = adhan.Date.formattedTime;

    document.getElementById('subuh').innerHTML = formattedTime(prayerTimes.fajr, 8, '24h');
    var t_imsak = toDate(document.getElementById("subuh").textContent,"h:m");
    var imsak_jam = t_imsak.getHours();
    var imsak_minit = t_imsak.getMinutes() - 10;
    if(imsak_minit < 0) {
      imsak_minit = 60 - imsak_minit*-1;
      imsak_jam = imsak_jam - 1;
    }
    imsak_minit = checkTime(imsak_minit);
    document.getElementById('imsak').innerHTML = '0' + imsak_jam + ':' + imsak_minit;
    document.getElementById('syuruk').innerHTML = formattedTime(prayerTimes.sunrise, 8, '24h');
    document.getElementById('zohor').innerHTML = formattedTime(prayerTimes.dhuhr, 8, '24h');
    document.getElementById('asar').innerHTML = formattedTime(prayerTimes.asr, 8, '24h');
    document.getElementById('maghrib').innerHTML = formattedTime(prayerTimes.maghrib, 8, '24h');
    document.getElementById('isyak').innerHTML = formattedTime(prayerTimes.isha, 8, '24h');
    //kiraan waktu solat tamat

    //dapatkan waktu solat dari web jakim (XML) perlukan akses internet
    /*

    $.getJSON('query_xml.php?zon=KDH02', function(jd){
      document.getElementById('imsak').innerHTML = jd.Imsak;
      document.getElementById('subuh').innerHTML = jd.Subuh;
      document.getElementById('syuruk').innerHTML = jd.Syuruk;

      //document.getElementById('zohor').innerHTML =   jd.Zohor;
      var t_zohor = toDate(jd.Zohor,"h:m");
      var zohor_jam = t_zohor.getHours();
      var zohor_minit = t_zohor.getMinutes();
      if(zohor_minit < 10) zohor_minit = '0' + zohor_minit;
      if(zohor_jam < 12) {
        zohor_jam = zohor_jam + 12;
      }
      document.getElementById('zohor').innerHTML = zohor_jam + ':' + zohor_minit;

      //document.getElementById('asar').innerHTML = jd.Asar;
      var t_asar = toDate(jd.Asar,"h:m");
      var asar_jam = t_asar.getHours();
      var asar_minit = t_asar.getMinutes();
      if(asar_minit < 10) asar_minit = '0' + asar_minit;
      if(asar_jam < 12) {
        asar_jam = asar_jam + 12;
      }
      document.getElementById('asar').innerHTML = asar_jam + ':' + asar_minit;

      //document.getElementById('maghrib').innerHTML = jd.Maghrib;
      var t_maghrib = toDate(jd.Maghrib,"h:m");
      var maghrib_jam = t_maghrib.getHours();
      var maghrib_minit = t_maghrib.getMinutes();
      if(maghrib_minit < 10) maghrib_minit = '0' + maghrib_minit;
      if(maghrib_jam < 12) {
        maghrib_jam = maghrib_jam + 12;
      }
      document.getElementById('maghrib').innerHTML = maghrib_jam + ':' + maghrib_minit;

      //document.getElementById('isyak').innerHTML = jd.Isyak;
      var t_isyak = toDate(jd.Isyak,"h:m");
      var isyak_jam = t_isyak.getHours();
      var isyak_minit = t_isyak.getMinutes();
      if(isyak_minit < 10) isyak_minit = '0' + isyak_minit;
      if(isyak_jam < 12) {
        isyak_jam = isyak_jam + 12;
      }
      document.getElementById('isyak').innerHTML = isyak_jam + ':' + isyak_minit;
    });
*/

  }

  function toDate(dStr,format) {
    var now = new Date();
    if (format == "h:m") {
      now.setHours(dStr.substr(0,dStr.indexOf(":")));
      now.setMinutes(dStr.substr(dStr.indexOf(":")+1));
      now.setSeconds(0);
      return now;
    }else
    return "Invalid Format";
  }

  function playAudio() {
    var audio = new Audio('audio/beep.mp3');
    audio.loop = false;
    audio.play();
  }

  function paparSliderScroll(){
    var masa_terakhir = document.getElementById("id-last-update").value;
    //umum call
    $.ajax({
      url: 'php/perubahan.php',
      type: 'post',
      success: function(data, status) {
        if(data > masa_terakhir) {
          window.location.replace("index.php");
        }
      }
    }); // end ajax umum call
    setTimeout(function(){ paparSliderScroll() }, 10000);
  }//end function paparSliderScroll

  paparSliderScroll();
  startTime();
  get_prayer_times();

  $('.marquee').marquee({
    //speed in milliseconds of the marquee
    duration: 15000,
    //gap in pixels between the tickers
    gap: 700,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true
  });
</script>
</body>
</html>
