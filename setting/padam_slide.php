<?php
require('../config/config.inc.php');
if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_POST['padam'])) {
  $id = $_POST['padam'];
  $sql = "SELECT * FROM " . database_prefix ."_slider WHERE `slider_id`='$id'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $url = $row['url'];
    unlink('../images/'. $url);
    $sql = "DELETE FROM " . database_prefix ."_slider WHERE `slider_id`='$id'";
    $result = mysqli_query($dbc, $sql);
    $sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
    $result = mysqli_query($dbc, $sql);
    echo 'ok';
}
}
 ?>
