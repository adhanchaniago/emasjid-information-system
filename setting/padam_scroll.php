<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_POST['padam']) && !isset($_POST['tambah'])) {
  $id = $_POST['padam'];
    $sql = "DELETE FROM " . database_prefix ."_scroll WHERE `scroll_id`='$id'";
    $result = mysqli_query($dbc, $sql);
    $sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
    $result = mysqli_query($dbc, $sql);
    echo 'ok';
}

if(!isset($_POST['padam']) && isset($_POST['tambah'])){
  $sql = "INSERT INTO " . database_prefix ."_scroll (`paparkan`) VALUES ('0')";
  $result = mysqli_query($dbc, $sql);
  echo 'ok';
}
 ?>
