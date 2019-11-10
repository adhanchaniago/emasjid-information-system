<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

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
	<link href="../vendor/datatable/datatables.min.css" rel="stylesheet">
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

		<table id="example" class="table table-bordered" cellspacing="0" width="100%">
				<thead>
						<tr class="bg-primary">
							<th>Gambar</th>
							<th>Dipaparkan?</th>
							<th>Susunan Semasa</th>
							<th>Tindakan</th>
						</tr>
				</thead>
				<tfoot>
					<tr class="bg-primary">
							<th>Gambar</th>
							<th>Dipaparkan?</th>
							<th>Susunan Semasa</th>
							<th>Tindakan</th>
					</tr>
				</tfoot>
				<tbody>

		<?php
		$sql = "SELECT * FROM " . database_prefix ."_slider ORDER BY paparkan DESC, giliran ASC, slider_id DESC";
		$result = mysqli_query($dbc, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if($row['paparkan']=='1') {
					$on = 'checked';
					$off = '';
				}
				else {
					$on = '';
					$off = 'checked';
				}
				?>
				<tr>
				<td><img style="height:200px;" class="img-thumbnail" src="../images/<?php echo $row['url']; ?>"></td>
				<td><?php if($row['paparkan']=='1') echo 'Ya'; else echo 'Tidak'; ?></td>
			<td><?php echo $row['giliran']; ?></td>
			<td>
				Paparkan:
				<br>
			<label class="custom-control custom-radio">
			<input name="slider_<?php echo $row['slider_id']; ?>" type="radio" value="1" class="custom-control-input" <?php echo $on; ?> >
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description">ON</span>
			</label>
			<label class="custom-control custom-radio">
			<input name="slider_<?php echo $row['slider_id']; ?>" type="radio" value="0" class="custom-control-input" <?php echo $off; ?> >
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description">OFF</span>
			</label>
			<br>
			Susunan:<br>
			<input type="text" name="susun_<?php echo $row['slider_id']; ?>" value="<?php echo $row['giliran']; ?>"><hr>
			<button type="button" class="btn btn-success" onclick="simpan_slide('slider_<?php echo $row['slider_id']; ?>','susun_<?php echo $row['slider_id']; ?>', <?php echo $row['slider_id']; ?>)">Simpan</button>
			<button type="button" class="btn btn-danger" onclick="padam_slide(<?php echo $row['slider_id']; ?>)">Padam</button>
		</td>
			</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>
		<h1 align="center">Tambah Gambar Slider</h1><br/>
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
		<button type="button" class="btn btn-success btn-lg btn-block" onclick="kemaskini()">Kemas Kini</button>
	<hr id="line">


	</div>
	<!-- Bootstrap core JavaScript -->
	<script src="../vendor/jquery/jquery-1.11.2.min.js"></script>
	<script src="../vendor/popper/popper.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/datatable/datatables.min.js"></script>

	<script>
	$('#example').DataTable();
	$('#loading').hide();
	$("#uploadimage").on("submit",(function(e) {
		e.preventDefault();
		$('#loading').show();
		$("#message").empty();
		$.ajax({
			url: "ajax_php_file.php", // Url to which the request is send
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
					alert('upload berjaya. Gambar slide akan berasa di muka surat terakhir.');
					window.location.replace("slider.php");
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

	function simpan_slide(x,y,z){
		$('#mesej').hide();
		radioName = x;
		susunName = y;
		var formData = {
			'simpan' :z,
			'radio'  :$("input[name='"+ radioName +"']:checked").val(),
			'susun'  :$("input[name='"+ susunName +"']").val()
		};
		//console.log($("input[name='"+ radioName +"']:checked").val());
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'simpan_slide.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					alert('Berjaya disimpan. Klik Butang kemaskini (berwarna Hijau) di bahagian bawah sekali setelah selesai aktivit.')
				}
			}
		});
	}

	function kemaskini(){
		$('#mesej').hide();
		var formData = {
			'kemaskini' : '1'
		};
		//console.log($("input[name='"+ radioName +"']:checked").val());
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'simpan_slide.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					window.location.replace("slider.php");
				}
			}
		});
	}

	function padam_slide(x){
		$('#mesej').hide();
		var formData = {
			'padam' :x
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'padam_slide.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					window.location.replace("slider.php");
				}
			}
		});
	}
	</script>
</body>
</html>
