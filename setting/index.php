<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

$sql = "SELECT * FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Memaparkan waktu solat, info dan berbagai maklumat.  Khusus untuk kegunaan masjid">
	<meta name="author" content="mohamad.arfakhsy13">
	<link rel="shortcut icon" href="assets/images/islamic-symbols-icon-png-13211-128x106.png" type="image/x-icon">
	<title>Masjid Info - Konfigurasi</title>

	<!-- Bootstrap core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style>
	body {
		padding-top: 100px;
		font-family: 'Roboto Condensed', sans-serif;
	}
	.kandungan{
		padding-top: 30px;
	}

	</style>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Konfigurasi</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Setting Umum</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="slider.php">Setting Slider</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="scroll.php">Setting Scroll Text</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Log Out</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">


		<div class="form-group">
			<label for="lokasi">Nama Lokasi</label>
			<input type="text" class="form-control" id="nama_lokasi" placeholder="Nama Lokasi" value="<?php echo $row['nama_tempat']; ?>">
		</div>
		<div class="form-group">
			<label for="latitut">Latitude</label>
			<input type="text" class="form-control" id="latitut" placeholder="Latitut" value="<?php echo $row['lat']; ?>">
		</div>
		<div class="form-group">
			<label for="longitut">Longitude</label>
			<input type="text" class="form-control" id="longitut" placeholder="Longitut" value="<?php echo $row['lon']; ?>">
		</div>
		<div class="form-group">
			<label for="longitut">Tempoh Slide (saat)</label>
			<input type="text" class="form-control" id="tempoh_slide" placeholder="Tempoh slide" value="<?php echo $row['jeda_slide']; ?>">
		</div>


		<hr>
		<h1 align="center">Gambar Slide Utama</h1><br/>

		<img style="width:304px;height:228px;" class="img-thumbnail" src="../images/<?php echo $row['slide_utama']; ?>">
		<hr>
		<h1 align="center">Tukar Gambar Slide Utama</h1><br/>
		<hr>
		<div class="row">
			<div class="col-6">
				<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
					<div id="image_preview"><img id="previewing" src="noimage.png" /></div>
					<!--  <div id="selectImage"> -->
					<label>Sila Pilih Gambar</label><br/>
					<input type="file" name="fileToUpload" id="fileToUpload" required />
					<input type="submit" class="btn btn-success" value="Upload" class="submit" />
					<!--      </div> -->
				</form>
			</div>
			<div class="col-6">
				<p id="loading">Loading...</p>
				<p id="message"></p>
			</div>
		</div>
		<hr id="line">
		<button type="button" class="btn btn-primary btn-lg btn-block" onclick="simpan_umum()">Kemas Kini</button>
		<hr id="line">
	</div>
	<!-- Bootstrap core JavaScript -->
	<script src="../vendor/jquery/jquery-1.11.2.min.js"></script>
	<script src="../vendor/popper/popper.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="script.js"></script>

	<script>
	$('#loading').hide();
	$("#uploadimage").on("submit",(function(e) {
		e.preventDefault();
		$('#loading').show();
		$("#message").empty();
		$.ajax({
			url: "ajax_default_image.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data, status) {
				if(data != "berjaya") {
					$("#message").html(data);
				}else{
					$('#loading').hide();
					window.location.replace("index.php");
				}
			}
		});
	}));

	// Function to preview image after validation
	$(function() {
		$("#fileToUpload").change(function() {
			$('#loading').hide();
			$("#message").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg","image/gif"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3])))
			{
				$("#previewing").attr("src","noimage.png");
				$("#message").html("<p id=\'error\'>Sila pilih fail gambar sahaja.</p>"+"<h4>Nota:</h4>"+"<span id=\'error_message\'>Hanya jpeg, jpg, png dan gif sahaja dibenarkan.</span>");
				return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	function imageIsLoaded(e) {
		$("#fileToUpload").css("color","green");
		$("#image_preview").css("display", "block");
		$("#previewing").attr("src", e.target.result);
		$("#previewing").attr("width", "250px");
		$("#previewing").attr("height", "230px");
	};


	function simpan_umum(){
		var formData = {
			'lokasi'        :$('#nama_lokasi').val(),
			'lat'           :$('#latitut').val(),
			'lon'           :$('#longitut').val(),
			'tempoh_slide'  :$('#tempoh_slide').val()
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'simpan_umum.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					alert('Berjaya disimpan');
					window.location.replace("index.php");
				}
			}
		});
	}
	</script>
</body>
</html>
