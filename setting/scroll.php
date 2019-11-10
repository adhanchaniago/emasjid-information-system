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
		<?php
		$sql = "SELECT * FROM " . database_prefix ."_scroll";
		$result = mysqli_query($dbc, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				?>
				<div class="row">
					<div class="col-8">
						<div class="form-group">
							<input type="text" class="form-control" id="scroll_text_<?php echo $row['scroll_id']; ?>" placeholder="Scrolling text" value="<?php echo $row['text'];?>">
						</div>
					</div>
					<div class="col-4">
						Paparkan Scroll Text :
						<label class="custom-control custom-radio">
							<input id="radio1" name="scroll_<?php echo $row['scroll_id']; ?>" type="radio" value="1" class="custom-control-input" <?php if($row['paparkan']==1) echo 'checked';?>>
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">ON</span>
						</label>
						<label class="custom-control custom-radio">
							<input id="radio2" name="scroll_<?php echo $row['scroll_id']; ?>" type="radio" value="0" class="custom-control-input" <?php if($row['paparkan']==0) echo 'checked';?>>
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">OFF</span>
						</label>
						<button type="button" class="btn btn-success" onclick="simpan_scroll('scroll_<?php echo $row['scroll_id']; ?>', <?php echo $row['scroll_id']; ?>)">Simpan</button>
						<button type="button" class="btn btn-danger" onclick="padam_scroll(<?php echo $row['scroll_id']; ?>)">Padam</button>
					</div>
				</div>

				<hr>
				<?php
			}
		}
		?>
		<button type="button" class="btn btn-primary btn-lg btn-block" onclick="tambah_scroll()">Tambah Scroll Text</button>
		<hr>
	</div>
	<!-- Bootstrap core JavaScript -->
	<script src="../vendor/jquery/jquery-1.11.2.min.js"></script>
	<script src="../vendor/popper/popper.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="script.js"></script>

	<script>
	function simpan_scroll(x,y){
		$('#mesej').hide();
		var radioName = x;
		var text = 'scroll_text_' + y;
		var formData = {
			'simpan' :y,
			'radio'  :$("input[name='"+ radioName +"']:checked").val(),
			'scroll_text' :$("#" + text).val()
		};
		console.log($("#" + text).val());
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'simpan_scroll.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					window.location.replace("scroll.php");
				}
			}
		});
	}

	function padam_scroll(x){
		$('#mesej').hide();
		var formData = {
			'padam' :x
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'padam_scroll.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					window.location.replace("scroll.php");
				}
			}
		});
	}

	function tambah_scroll(){
		$('#mesej').hide();
		var formData = {
			'tambah' :0
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'padam_scroll.php', // the url where we want to POST
			data    : formData, // our data object
			dataType 	: 'html', // what type of data do we expect back from the server
			encode 		: true,
			success: function(data, status) {
				if(data == "ok") {
					console.log(data);
					window.location.replace("scroll.php");
				}
			}
		});
	}
	</script>
</body>
</html>
