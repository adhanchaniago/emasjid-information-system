<?php
require('../config/config.inc.php');
require(MYSQL);

if(isset($_POST['umum_get']) && $_POST['umum_get']=='0'){
  $sql = "SELECT * FROM `" . database_prefix ."_umum` WHERE `umum_id`='1'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) === 1) { //pernah memohon kursus. ada rekod
    $row = mysqli_fetch_assoc($result);
    $data['status'] = 'ok';
    $data['result'] = $row;
  }
  $sql = "UPDATE " . database_prefix ."_status SET `umum`='0' WHERE `status_id`='1'";
  $result = mysqli_query($dbc, $sql);
  //returns data as JSON format
    echo json_encode($data);
}else {
  echo 'failed';
}
?>
