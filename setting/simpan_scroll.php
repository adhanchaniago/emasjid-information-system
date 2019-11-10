<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}

require(MYSQL);

if(isset($_POST['simpan']) && isset($_POST['radio'])){
  $paparkan = $_POST['radio'];
  $id = $_POST['simpan'];
  $text = $_POST['scroll_text'];
$sql = "UPDATE " . database_prefix ."_scroll SET `paparkan`='$paparkan', `text`='$text' WHERE `scroll_id`='$id'";
$result = mysqli_query($dbc, $sql);

$sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
$result = mysqli_query($dbc, $sql);
echo 'ok';
}
 ?>
