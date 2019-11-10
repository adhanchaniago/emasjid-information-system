<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}

require(MYSQL);

if(isset($_POST['lokasi']) && isset($_POST['lat']) && isset($_POST['lon']) && isset($_POST['tempoh_slide'])){
	$lokasi = $_POST['lokasi'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$jeda_slide = $_POST['tempoh_slide'];
	$sql = "UPDATE " . database_prefix ."_umum SET `lat`='$lat', `lon`='$lon', `nama_tempat`='$lokasi', `jeda_slide`='$jeda_slide' WHERE `umum_id`='1'";
	$result = mysqli_query($dbc, $sql);

	$sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
	$result = mysqli_query($dbc, $sql);
	echo 'ok';
}
?>
