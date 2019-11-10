<?php
require('../config/config.inc.php');
require(MYSQL);

$sql = "SELECT `last_update` FROM `" . database_prefix ."_umum` WHERE `umum_id`='1'";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) { //pernah memohon kursus. ada rekod
  $row = mysqli_fetch_assoc($result);
    echo $row['last_update'];
  }
