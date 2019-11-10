<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}

require(MYSQL);

if(isset($_POST['simpan']) && isset($_POST['radio']) && isset($_POST['susun']) ){
  $paparkan = $_POST['radio'];
	$susun = $_POST['susun'];
  $id = $_POST['simpan'];
$sql = "UPDATE " . database_prefix ."_slider SET `paparkan`='$paparkan', `giliran`='$susun' WHERE `slider_id`='$id'";
$result = mysqli_query($dbc, $sql);

//$sql = "UPDATE masjid_pekan_status SET `status_utama`='1' WHERE `status_id`='1'";
//$result = mysqli_query($dbc, $sql);
echo 'ok';
}

if(isset($_POST['kemaskini']) && $_POST['kemaskini']=='1' ){

$sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
$result = mysqli_query($dbc, $sql);
echo 'ok';
}

 ?>
