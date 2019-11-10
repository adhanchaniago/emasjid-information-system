<?php
require('../config/config.inc.php');
require(MYSQL);

$sql = "UPDATE " . database_prefix ."_status SET `status_utama`='0' WHERE `status_id`='1'";
$result = mysqli_query($dbc, $sql);
 ?>
